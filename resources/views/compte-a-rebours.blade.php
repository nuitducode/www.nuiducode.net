@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <title>Compte à rebours</title>
    <style>
        html,
        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }
    </style>
</head>
<body>



    <div class="text-center text-monospace" style="position:relative;height:100%">

        <div style="position:absolute;top:40px;left:0;right:0;height:30%">
            <img src="{{ asset('img/ndc2023.png') }}" style="height:100%" />
        </div>

        <div style="position:absolute;bottom:0;left:0;right:0;height:65%">

            <div id="settings">

                <table style="margin:40px auto 0px auto">
                    <tr>
                        <td>Fin de la NDC:</td>
                        <td>

                            <select class="form-control form-control-lg" id="day" name="day">
                                <script>
                                    var init = new Date();
                                    var jour = init.getDate();
                                    console.log(jour);
                                    for (var i = 1; i <= 31; i++) {
                                        jour_selected = (i == jour) ? "selected":"";
                                        document.write('<option value="' + i.toString().padStart(2, '0') + '"'+jour_selected+'>' + i.toString().padStart(2, '0') + '</option>');
                                    }
                                </script>
                            </select>

                        </td>
                        <td>

                            <select class="form-control form-control-lg" id="month" name="month">
                                <script>
                                    var mois_noms =  {5:'mai', 6:'juin'};
                                    var mois = init.getMonth();
                                    for (var i = 5; i <= 6; i++) {
                                        mois_selected = (i == mois) ? "selected":"";
                                        document.write('<option value="' + i.toString().padStart(2, '0') + '"'+mois_selected+'>' + mois_noms[i] + '</option>');
                                    }
                                </script>
                            </select>

                        </td>
                        <td> à </td>
                        <td>

                            <select class="form-control form-control-lg" id="hour" name="hour">
                                <script>
                                    var heure = init.getHours();
                                    for (var i = 0; i < 24; i++) {
                                        heure_selected = (i == heure) ? "selected":"";
                                        document.write('<option value="' + i.toString().padStart(2, '0') + '"'+heure_selected+'>' + i.toString().padStart(2, '0') + '</option>');
                                    }
                                </script>
                            </select>
                        
                        </td>
                        <td>h </td>
                        <td>

                            <select class="form-control form-control-lg" id="minute" name="minute">
                                <script>
                                    for (var i = 0; i < 60; i=i+5) {
                                    document.write('<option value="' + i.toString().padStart(2, '0') + '">' + i.toString().padStart(2, '0') + '</option>');
                                    }
                                </script>
                            </select>
                        
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary ml-3" onclick="countdown()"><i class="fa-solid fa-play"></i></button>
                        </td>
                    </tr>
                </table>

            </div>

            <div id="countdown" style="display:none;color:#261B0C">
                <div style="font-size:14vw;font-weight:bold"><span id="countdown_heures"></span><span style="font-size:4vw;opacity:0.5">h </span><span id="countdown_minutes"></span><span style="font-size:4vw;opacity:0.5">m</span></div>
                <div>
                    <button type="button" class="btn btn-light btn-sm"  onclick="window.location.reload();"><i class="fas fa-sync-alt"></i></button>
                    <button id="fullscreen" type="button" style="display:inline" class="btn btn-light btn-sm ml-3"  onclick="fullscreen();"><i class="fa-solid fa-maximize"></i></button>
                    <button id="exitfullscreen" type="button" style="display:none" class="btn btn-light btn-sm ml-3"  onclick="exitfullscreen();"><i class="fa-solid fa-minimize"></i></button>
                </div>
            </div>

        </div>

    </div>

    <script>

        function countdown() {
            function updateCountdown() {
                document.getElementById("settings").style.display = "none";
                document.getElementById("countdown").style.display = "block";
                var now = new Date().getTime();
                var day = document.getElementById("day").value
                var month = document.getElementById("month").value
                var hour = document.getElementById("hour").value
                var minute = document.getElementById("minute").value
                var date = "2023-"+month+"-"+day+"T"+hour+":"+minute+":00";
                var targetTime = new Date(date).getTime();
                var difference = targetTime - now;
                console.log(difference);
                if (difference <= 1000*60*30) {
                    document.getElementById("countdown").style.color = "#dd8412";
                }
                if (difference <= 0) {
                    console.log("Le compte à rebours est terminé !");
                    document.getElementById("countdown").style.color = "#e3342f";
                    document.getElementById("countdown_heures").innerHTML = "00";
                    document.getElementById("countdown_minutes").innerHTML = "00";
                    clearInterval(interval);
                    return;
                }
                var hours = Math.floor(difference / (1000 * 60 * 60));
                var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                document.getElementById("countdown_heures").innerHTML = hours
                document.getElementById("countdown_minutes").innerHTML = minutes
                console.log("Temps restant : " + hours + " heures " + minutes + " minutes");
            }
            updateCountdown();
            var interval = setInterval(updateCountdown, 10000);
        }


        function fullscreen() {
            document.getElementById("fullscreen").style.display = "none";
            document.getElementById("exitfullscreen").style.display = "inline";
            if (!document.fullscreenElement && !document.mozFullScreenElement &&
                !document.webkitFullscreenElement && !document.msFullscreenElement) {
                // Demande le mode plein écran pour différents navigateurs
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari et Opera
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) { // Internet Explorer et Edge
                    document.documentElement.msRequestFullscreen();
                }
            } else {
                // Quitte le mode plein écran pour différents navigateurs
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { // Firefox
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { // Chrome, Safari et Opera
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // Internet Explorer et Edge
                    document.msExitFullscreen();
                }
            }
        }


        function exitfullscreen() {
            document.getElementById("fullscreen").style.display = "inline";
            document.getElementById("exitfullscreen").style.display = "none";
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { // Firefox
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { // Chrome, Safari et Opera
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { // Internet Explorer et Edge
                document.msExitFullscreen();
            }
        } 

	</script>  

</body>
</html>
