<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTH ROUTES
Auth::routes(['verify' => true]);


// ============================================================================
// == PUBLIC
// ============================================================================

// FORMULAIRE INSCRIPTIONS LFIT 2023
Route::any('/LFIT', function(){return redirect('https://forms.gle/eegekTDw7ouavdxx9');});
Route::any('/lfit', function(){return redirect('https://forms.gle/eegekTDw7ouavdxx9');});

// temporaire - presentation nsi
Route::any('/nsi', function(){return redirect('https://docs.google.com/presentation/d/1by2mtnysTBVV9954Q-hj6UKw9CP0N5V4Cy85wqMm4l4');});

// diaporama
Route::any('/diaporama', function(){return redirect('https://nuitducode.github.io/ndc-diaporama-presentation/');});

// documentation
Route::any('/docs', function(){return redirect('https://nuitducode.github.io/DOCUMENTATION/');});

// HOMEPAGE
Route::view('/', 'welcome');

// EDITIONS EN VIDEO
Route::view('/editions-en-video', 'editions-en-video');

// DONNEE PERSONNELLES
Route::view('/donnees-personnelles', 'donnees-personnelles')->name('donnees-personnelles');

// AFFICHE GENERATEUR
Route::view('/affiche-generateur', 'affiche-generateur');

// UNIVERS DE JEU
Route::get('/udj/{token}', [App\Http\Controllers\SiteController::class, 'lien_udj'])->name('lien_udj');

// PRESENTATION
//Route::view('/presentation', 'presentation');

// CONSIGNES
//Route::view('/regles-conseils', 'regles-conseils');

// ORGANISATION
//Route::view('/organisation', 'organisation');

// ENTRAINEMENTS
//Route::view('/entrainements', 'entrainements');

// IMAGES
//Route::view('/images', 'images');

// Atelier Scratch
Route::view('/atelier-scratch', 'atelier-scratch');

// DEPOT CONFIRMATION
Route::view('/jeu-depot-confirmation', 'jeu-depot-confirmation');

// NDC2022
Route::view('/ndc2022', 'ndc2022');
Route::get('/ndc2022/{categorie}', function ($categorie) {
    return view('ndc2022', ['categorie' => $categorie]);
});

// CLEAR COOKIE
Route::get('/direct-register', function(){
   Cookie::queue(Cookie::forget(strtolower(str_replace(' ', '_', config('app.name'))) . '_session'));
   return redirect('/register');
});

Route::get('/direct-login', function(){
   Cookie::queue(Cookie::forget(strtolower(str_replace(' ', '_', config('app.name'))) . '_session'));
   return redirect('/login');
});

Route::get('/direct-welcome', function(){
   Cookie::queue(Cookie::forget(strtolower(str_replace(' ', '_', config('app.name'))) . '_session'));
   return redirect('/');
});

// Redirect
Route::get('/ndc', [App\Http\Controllers\SiteController::class, 'redirect']);
Route::get('/sltn', [App\Http\Controllers\SiteController::class, 'redirect']);
Route::get('/bas', [App\Http\Controllers\SiteController::class, 'redirect']);
Route::get('/ndc/evaluation', [App\Http\Controllers\SiteController::class, 'redirect']);
Route::get('/sltn/evaluation', [App\Http\Controllers\SiteController::class, 'redirect']);
Route::get('/bas/evaluation', [App\Http\Controllers\SiteController::class, 'redirect']);

// Depot jeu
Route::get('/ndc/{token}', [App\Http\Controllers\SiteController::class, 'jeux'])->name('jeux_get');
Route::get('/sltn/{token}', [App\Http\Controllers\SiteController::class, 'jeux'])->name('jeux_get');
Route::get('/bas/{token}', [App\Http\Controllers\SiteController::class, 'jeux'])->name('jeux_get');

Route::get('/ndc/{langage}/{token}', [App\Http\Controllers\SiteController::class, 'jeu_deposer_get'])->name('jeu-deposer_get');
Route::get('/sltn/{langage}/{token}', [App\Http\Controllers\SiteController::class, 'jeu_deposer_get'])->name('jeu-deposer_get');
Route::get('/bas/{langage}/{token}', [App\Http\Controllers\SiteController::class, 'jeu_deposer_get'])->name('jeu-deposer_get');

Route::post('/ndc/jeu-deposer', [App\Http\Controllers\SiteController::class, 'jeu_deposer_post'])->name('ndc-jeu-deposer_post');
Route::post('/sltn/jeu-deposer', [App\Http\Controllers\SiteController::class, 'jeu_deposer_post'])->name('sltn-jeu-deposer_post');
Route::post('/bas/jeu-deposer', [App\Http\Controllers\SiteController::class, 'jeu_deposer_post'])->name('bas-jeu-deposer_post');

// Evaluations
Route::post('/ndc/evaluation', [App\Http\Controllers\SiteController::class, 'evaluation_etape_1_post'])->name('ndc-evaluation-etape-1_post');
Route::post('/ndc/evaluation-creer', [App\Http\Controllers\SiteController::class, 'evaluation_etape_2_post'])->name('ndc-evaluation-etape-2_post');
Route::post('/sltn/evaluation', [App\Http\Controllers\SiteController::class, 'evaluation_etape_1_post'])->name('sltn-evaluation-etape-1_post');
Route::post('/sltn/evaluation-creer', [App\Http\Controllers\SiteController::class, 'evaluation_etape_2_post'])->name('sltn-evaluation-etape-2_post');
Route::post('/bas/evaluation', [App\Http\Controllers\SiteController::class, 'evaluation_etape_1_post'])->name('bas-evaluation-etape-1_post');
Route::post('/bas/evaluation-creer', [App\Http\Controllers\SiteController::class, 'evaluation_etape_2_post'])->name('bas-evaluation-etape-2_post');

// ============================================================================
// == ADMIN
// ============================================================================
Route::view('/console/admin', 'admin')->middleware('auth');
Route::view('/console/admin_jeux', 'admin_jeux')->middleware('auth');
Route::view('/console/admin_evaluations', 'admin_evaluations')->middleware('auth');
Route::view('/console/admin_notes', 'admin_notes')->middleware('auth');
Route::view('/console/admin_finalistes', 'admin_finalistes')->middleware('auth');


// ============================================================================
// == CONSOLE
// ============================================================================

Route::get('/console', [App\Http\Controllers\ConsoleController::class, 'console_get'])->name('console_get');

// VALIDATION FINALISTES
Route::post('/console/validation-finalistes', [App\Http\Controllers\ConsoleController::class, 'valider_finalistes'])->name('valider-finalistes');
Route::post('/console/invalidation-finalistes', [App\Http\Controllers\ConsoleController::class, 'invalider_finalistes'])->name('invalider-finalistes');

// JEUX & EVALUATIONS
Route::view('/console/ndc', 'jeux-console')->middleware('auth');
Route::view('/console/sltn', 'jeux-console')->middleware('auth');
Route::view('/console/bas', 'jeux-console')->middleware('auth');
Route::view('/console/ndc/jeux-evaluations', 'jeux-evaluations')->middleware('auth');
Route::view('/console/sltn/jeux-evaluations', 'jeux-evaluations')->middleware('auth');
Route::view('/console/bas/jeux-evaluations', 'jeux-evaluations')->middleware('auth');
Route::view('/console/ndc/liste-jeux', 'liste-jeux')->middleware('auth');
Route::view('/console/sltn/liste-jeux', 'liste-jeux')->middleware('auth');
Route::view('/console/bas/liste-jeux', 'liste-jeux')->middleware('auth');
Route::view('/console/ndc/liste-evaluations', 'liste-evaluations')->middleware('auth');
Route::view('/console/sltn/liste-evaluations', 'liste-evaluations')->middleware('auth');
Route::view('/console/bas/liste-evaluations', 'liste-evaluations')->middleware('auth');

// EVALUATION FINALISTES
Route::get('/console/evaluation-finalistes/{categorie}', function ($categorie) {
    return view('evaluation-finalistes', ['categorie' => $categorie]);
})->middleware('auth');
Route::post('/console/evaluation-finalistes', [App\Http\Controllers\ConsoleController::class, 'evaluation_finalistes_post'])->name('evaluation-finalistes_post');
Route::view('/console/evaluation-finalistes-categories', 'evaluation-finalistes-categories')->middleware('auth');

// JOUER JEU PYXEL
Route::get('/console/jouer-jeu-pyxel/{jeu_id}', function ($jeu_id) {
    return view('jouer-jeu-pyxel', ['jeu_id' => $jeu_id]);
})->middleware('auth');

// supprimer jeu
Route::any('/console/supprimer-jeu', [App\Http\Controllers\ConsoleController::class, 'redirect']);
Route::any('/console/supprimer-jeu/{jeu_id}', [App\Http\Controllers\ConsoleController::class, 'supprimer_jeu'])->name('supprimer-jeu');

// supprimer evaluation
Route::any('/console/supprimer-evaluation', [App\Http\Controllers\ConsoleController::class, 'redirect']);
Route::any('/console/supprimer-evaluation/{evaluation_id}', [App\Http\Controllers\ConsoleController::class, 'supprimer_evaluation'])->name('supprimer-evaluation');

Route::post('/console/jeu-ajouter', [App\Http\Controllers\ConsoleController::class, 'jeux_lot_ajouter_post'])->name('jeux-lot-ajouter_post');

// jeton generator - inutile l'an prochain
Route::get('/console/jetons-generator', [App\Http\Controllers\ConsoleController::class, 'jetons_generator']);



Route::any('/console/fiche-inscription', [App\Http\Controllers\ConsoleController::class, 'fiche_inscription'])->name('fiche-inscription');
Route::get('/console/fiche-inscription-modifier', [App\Http\Controllers\ConsoleController::class, 'fiche_inscription_modifier_get'])->name('fiche-inscription-modifier_get');
Route::post('/console/fiche-inscription-modifier', [App\Http\Controllers\ConsoleController::class, 'fiche_inscription_modifier_post'])->name('fiche-inscription-modifier_post');
Route::post('/console/fiche-inscription-details', [App\Http\Controllers\ConsoleController::class, 'fiche_inscription_details_post'])->name('fiche-inscription-details_post');


// ============================================================================
// == PYXEL
// ============================================================================

// accueil
Route::get('/pyxel', function() {return view("pyxel/pyxel");})->name('pyxel');

// new project
Route::get('/pyxel/creer', [App\Http\Controllers\PyxelController::class, 'new_project'])->name('new-project');

// studio
Route::any('/pyxel/studio', [App\Http\Controllers\PyxelController::class, 'redirect']);
Route::get('/pyxel/studio/{token_private}', function($token_private) {return view("pyxel/studio", ["token_private"=>$token_private]);})->name('studio');
Route::get('/pyxel/studio/{token_private}/{code_file}', function($token_private, $code_file) {return view("pyxel/studio", ["token_private"=>$token_private, "code_file"=>$code_file]);})->name('studio');

// update project infos
Route::get('/update-project-infos', [App\Http\Controllers\PyxelController::class, 'redirect']);
Route::post('/update-project-infos', [App\Http\Controllers\PyxelController::class, 'update_project_infos'])->name('update-project-infos');

// save code
Route::get('/save-code', [App\Http\Controllers\PyxelController::class, 'redirect']);
Route::post('/save-code', [App\Http\Controllers\PyxelController::class, 'save_code'])->name('save-code');

// save editor
Route::get('/save-editor', [App\Http\Controllers\PyxelController::class, 'redirect']);
Route::post('/save-editor', [App\Http\Controllers\PyxelController::class, 'save_editor'])->name('save-editor');

// iframe player
Route::get('/pyxel/iframe-player', [App\Http\Controllers\PyxelController::class, 'redirect']);
Route::get('/pyxel/iframe-player/{token_public}/{file_to_exe}', function($token_public, $file_to_exe) {
    return view("pyxel/iframe-player", ["token_public"=>$token_public,"file_to_exe"=>$file_to_exe]);
})->name('iframe-player');

// iframe editor
Route::get('/pyxel/iframe-resources-editor', [App\Http\Controllers\PyxelController::class, 'redirect']);
Route::get('/pyxel/iframe-resources-editor/{token_private}/{res_file}', function($token_private, $res_file) {
    return view("pyxel/iframe-resources-editor", ["token_private"=>$token_private, "res_file"=>$res_file]);
})->name('iframe-resources-editor');


// public player
Route::get('/ps', [App\Http\Controllers\PyxelController::class, 'redirect']);