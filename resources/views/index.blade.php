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
                    <div class="jam">12:29</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sidebar">
                <div class="loket">LOKET 1</div>
                <div class="loket1">Nomor Antrian</div>
                <div class="loket2">---</div>
            </div>
            <div class="sidebar">
                <div class="loket">LOKET 2</div>
                <div class="loket1">Nomor Antrian</div>
                <div class="loket2">---</div>
            </div>

            <div class="content">
                <iframe width="740px" height="300px" src="https://www.youtube.com/embed/5uKpgxKrDr8?playlist=5uKpgxKrDr8&autoplay=1&mute=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="loket">LOKET 1</div>
                <div class="loket2">---</div>
            </div>
            <div class="card">
                <div class="loket">LOKET 2</div>
                <div class="loket2">---</div>
            </div>
            <div class="card">
                <div class="loket">LOKET 3</div>
                <div class="loket2">---</div>
            </div>
            <div class="card">
                <div class="loket">LOKET 4</div>
                <div class="loket2">---</div>
            </div>
            <div class="card">
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('309bd6ebbb64634309cd', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
</body>
</html>
