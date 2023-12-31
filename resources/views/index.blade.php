<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('assets/css/style.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset ('assets/image/apple-touch-icon.png')}}" alt="LogoBank" width="30px" height="30px">
                    Bank BangTut
                </div>
                <div class="waktu">Waktu Sekarang
                    <div class="jam" id="jam"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sidebar" id="cs">
                <div class="loket" id="cs">Loket -</div>
                <div class="loket1">Nomor Antrian</div>
                <div class="loket2">---</div>
            </div>
            <div class="sidebar" id="teller">
                <div class="loket" >Loket -</div>
                <div class="loket1">Nomor Antrian</div>
                <div class="loket2">---</div>
            </div>

            <div class="content">
                {{-- <iframe width="740px" height="300px" src="https://www.youtube.com/embed/5uKpgxKrDr8?playlist=5uKpgxKrDr8&autoplay=1&mute=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
            </div>
        </div>
        <div class="row">
            <div class="card" id="loket1">
                <div class="loket">LOKET 1</div>
                <div class="loket2">---</div>
            </div>
            <div class="card" id="loket2">
                <div class="loket">LOKET 2</div>
                <div class="loket2">---</div>
            </div>
            <div class="card" id="loket3">
                <div class="loket">LOKET 3</div>
                <div class="loket2">---</div>
            </div>
            <div class="card" id="loket4">
                <div class="loket">LOKET 4</div>
                <div class="loket2">---</div>
            </div>
            <div class="card" id="loket5">
                <div class="loket">LOKET 5</div>
                <div class="loket2">---</div>
            </div>

        </div>
        <div class="row">
            <div class="footer">
                <h1>INI UNTUK INFO</h1>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
<script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        // Add leading zero if needed
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        var timeString = hours + ':' + minutes + ':' + seconds;

        document.getElementById('jam').innerHTML = timeString;
    }

    // Update the clock every second (1000 milliseconds)
    setInterval(updateClock, 1000);

    // Initial update to set the clock immediately
    updateClock();
</script>
</body>
</html>
