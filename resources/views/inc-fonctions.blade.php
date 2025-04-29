<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;



function readPngSignatureFromContent(string $pngContent, string $filenameForLog = 'unknown.png'): ?string
{
    // Vérifier la signature PNG standard (Cette partie peut rester en dehors du try si elle ne lance pas d'exception)
    if (strlen($pngContent) < 8 || substr($pngContent, 0, 8) !== "\x89PNG\r\n\x1a\n") {
            Log::warning("Signature PNG invalide ou trop courte dans : {$filenameForLog}");
            return null;
    }

    // --- Le bloc TRY commence ici pour le code de parsing qui peut échouer ---
    try {
        $offset = 8; // Commencer après la signature PNG
        $signatureKeyword = 'SignatureComment'; // Le mot-clé utilisé lors de l'injection

        // Parcourir les chunks
        while ($offset < strlen($pngContent)) {
            // Lire la longueur du chunk (4 octets, Big-Endian)
            $lengthData = substr($pngContent, $offset, 4);
            if (strlen($lengthData) < 4) {
                    Log::warning("Données tronquées lors de la lecture de la longueur du chunk PNG dans : {$filenameForLog}");
                    return null; // Données tronquées
            }
            // L'unpack renvoie un tableau, on prend le premier élément
            $length = unpack('N', $lengthData)[1];

            // Lire le type du chunk (4 octets)
            $chunkType = substr($pngContent, $offset + 4, 4);
                if (strlen($chunkType) < 4) {
                    Log::warning("Données tronquées lors de la lecture du type de chunk PNG dans : {$filenameForLog}");
                    return null; // Données tronquées
                }

            // Vérifier si c'est un chunk tEXt et si sa longueur permet de contenir le mot-clé + null + au moins 1 caractère
            if ($chunkType === 'tEXt' && $length >= strlen($signatureKeyword) + 1) {
                $chunkData = substr($pngContent, $offset + 8, $length);
                    if (strlen($chunkData) < $length) {
                        Log::warning("Données tronquées lors de la lecture du chunk tEXt dans : {$filenameForLog}");
                        return null; // Données tronquées
                    }

                // Rechercher le séparateur null byte
                $nullBytePos = strpos($chunkData, "\0");

                // Vérifier si le null byte existe et si la partie avant correspond au mot-clé
                if ($nullBytePos !== false && substr($chunkData, 0, $nullBytePos) === $signatureKeyword) {
                    // La partie après le null byte est notre signature chiffrée
                    $encryptedSignature = substr($chunkData, $nullBytePos + 1);
                    Log::debug("Signature PNG trouvée dans chunk tEXt pour : {$filenameForLog}");
                    return $encryptedSignature;
                }
            }

            // Passer au chunk suivant : Longueur (4) + Type (4) + Data (Length) + CRC (4)
            // Vérifier qu'il reste suffisamment de données pour le prochain en-tête de chunk (longueur + type + crc)
                if ($offset + 8 + $length + 4 > strlen($pngContent)) {
                    // Plus assez de données pour le prochain chunk complet
                    Log::warning("Fin de fichier inattendue après le chunk {$chunkType} dans : {$filenameForLog}");
                    // On a trouvé un chunk mais le fichier semble tronqué après, on peut sortir.
                    break; // Sortir de la boucle while
                }
            $offset += 4 + 4 + $length + 4;
        }

        Log::debug("Chunk tEXt '{$signatureKeyword}' non trouvé dans : {$filenameForLog}");
        return null; // Chunk spécifique non trouvé

    } catch (Exception $e) { // <--- Le CATCH est bien là, mais il manquait le TRY au-dessus
        Log::error("Erreur lors de la lecture de la signature PNG (depuis contenu) de {$filenameForLog}: " . $e->getMessage());
        return null;
    }
}


function readSvgSignatureFromContent(string $svgContent, string $filenameForLog = 'unknown.svg'): ?string
{
    try {
        // Utiliser une regex pour trouver le contenu de la balise <metadata>
        // C'est plus simple ici que de parser tout l'XML si on cherche juste ça.
        // Regex améliorée pour être un peu plus flexible
        if (preg_match('/<svg[^>]*>.*?<metadata>\s*Signature:\s*(.*?)\s*<\/metadata>.*?<\/svg>/is', $svgContent, $matches)) {
             // $matches[1] contient le texte entre "Signature: " et "</metadata>" après "Signature:"
             $encryptedSignature = trim($matches[1]); // Supprimer les espaces blancs autour
             Log::debug("Signature SVG trouvée dans <metadata> pour : {$filenameForLog}");
             return $encryptedSignature;
        }

        Log::debug("Balise <metadata> avec 'Signature:' non trouvée ou format incorrect dans : {$filenameForLog}");
        return null; // Balise ou format non trouvé
    } catch (Exception $e) {
         Log::error("Erreur lors de la lecture de la signature SVG (depuis contenu) de {$filenameForLog}: " . $e->getMessage());
         return null;
    }
}


function verifySb3Signatures(string $sb3FilePath): array
{
    Log::info("Début de la vérification des signatures pour le fichier SB3 : {$sb3FilePath}");

    $zip = new ZipArchive();
    $openResult = $zip->open($sb3FilePath, ZipArchive::CHECKCONS); // Utiliser CHECKCONS pour une meilleure vérification

    if ($openResult !== true) {
        $errorMessage = "Impossible d'ouvrir le fichier SB3 (code ZipArchive: {$openResult}). Chemin : {$sb3FilePath}";
        Log::error($errorMessage);
        return [
            'success' => false,
            'error' => $errorMessage,
            'total_png_svg_entries' => 0,
            'files_with_valid_signature' => [],
            'files_without_signature' => [],
            'files_decryption_failed' => [],
            'first_signature_found' => null,
            'all_signatures_identical' => false, // Impossible de vérifier si l'ouverture échoue
        ];
    }

    Log::info("Fichier SB3 ouvert avec succès. Contient " . $zip->numFiles . " entrées.");

    $filesWithValidSignature = []; // Format : ['filename' => 'decrypted_signature']
    $filesWithoutSignature = []; // Format : ['filename']
    $filesDecryptionFailed = []; // Format : ['filename']
    $totalPngSvgEntries = 0;
    $firstSignatureFound = null;
    $allSignaturesIdentical = true; // Part à true, devient false si une différence est trouvée

    // Parcourir toutes les entrées du ZIP
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $stat = $zip->statIndex($i);
        if (!$stat) {
            Log::warning("Impossible d'obtenir les informations pour l'entrée ZIP index {$i}. Saut.");
            continue;
        }

        $filename = $stat['name'];
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Traiter uniquement les fichiers PNG et SVG
        if ($extension === 'png' || $extension === 'svg') {
            $totalPngSvgEntries++;
            Log::debug("Vérification de la signature pour l'entrée #{$i}: {$filename}");

            $fileContent = $zip->getFromName($filename);

            if ($fileContent === false) {
                Log::warning("Impossible de lire le contenu de l'entrée ZIP : {$filename}. Saut.");
                // On ne peut pas déterminer s'il y a une signature ou non, on l'ignore pour la vérification des signatures.
                continue;
            }

            $encryptedSignature = null;

            // Lire la signature selon le type de fichier
            if ($extension === 'png') {
                $encryptedSignature = readPngSignatureFromContent($fileContent, $filename);
            } elseif ($extension === 'svg') {
                 $encryptedSignature = readSvgSignatureFromContent($fileContent, $filename);
            }

            // Si une signature chiffrée a été trouvée
            if ($encryptedSignature !== null) {
                try {
                    $decryptedSignature = Crypt::decryptString($encryptedSignature);

                    // Si c'est la première signature valide trouvée, la stocker comme référence
                    if ($firstSignatureFound === null) {
                        $firstSignatureFound = $decryptedSignature;
                        Log::debug("Première signature valide trouvée : {$decryptedSignature} dans {$filename}");
                    }

                    // Comparer avec la première signature trouvée
                    if ($decryptedSignature !== $firstSignatureFound) {
                        $allSignaturesIdentical = false;
                        Log::warning("Signature différente trouvée dans {$filename}. Attendue: {$firstSignatureFound}, Trouvée: {$decryptedSignature}");
                    }

                    // Ajouter à la liste des fichiers avec signature valide
                    $filesWithValidSignature[$filename] = $decryptedSignature;

                } catch (Exception $e) {
                    // Échec du déchiffrement
                    $filesDecryptionFailed[] = $filename;
                    Log::error("Échec du déchiffrement de la signature pour {$filename}: " . $e->getMessage());
                    // Marquer comme non identique si au moins une signature valide a été trouvée avant
                     if ($firstSignatureFound !== null) {
                         $allSignaturesIdentical = false;
                     }
                }
            } else {
                // Aucune signature trouvée par les méthodes de lecture
                $filesWithoutSignature[] = $filename;
                Log::debug("Aucune signature trouvée dans : {$filename}");
                 // Marquer comme non identique si au moins une signature valide a été trouvée avant
                 if ($firstSignatureFound !== null) {
                     $allSignaturesIdentical = false;
                 }
            }
        }
        // Ignorer les autres types de fichiers (project.json, wav, etc.)
    }

    // Fermer l'archive ZIP
    $zip->close();
    Log::info("Fermeture de l'archive SB3 : {$sb3FilePath}");

    // Finaliser la vérification d'identité
    // Si moins de 2 signatures valides ont été trouvées, elles sont considérées comme identiques
    if (count($filesWithValidSignature) < 2) {
        $allSignaturesIdentical = true;
    }


    Log::info("Fin de la vérification des signatures pour : {$sb3FilePath}. Résultats : " . count($filesWithValidSignature) . " signées, " . count($filesWithoutSignature) . " sans signature, " . count($filesDecryptionFailed) . " déchiffrement échoué.");

    // Retourner un récapitulatif
    return [
        'success' => true,
        'first_signature_found' => $firstSignatureFound,
        'all_signatures_identical' => $allSignaturesIdentical,
        'total_png_svg_entries' => $totalPngSvgEntries,
        'files_decryption_failed' => $filesDecryptionFailed,
        'files_without_signature' => $filesWithoutSignature,
        'files_with_valid_signature' => $filesWithValidSignature,
    ];
}