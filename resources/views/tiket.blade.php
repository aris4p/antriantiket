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
            <div class="tiket">
                <button class="button" id="cs">Customer Service</button>
                <button class="button" id="teller">Teller</button>
                <button class="button" id="reset">RESET TIKET</button>
            </div>
        </div>
        <div class="row">
            <div class="footer">
                <h1>INI UNTUK INFO</h1>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menambahkan event listener untuk tombol Customer Service
            document.getElementById("cs").addEventListener("click", function() {
                setTicketNumber("A");
            });

            // Menambahkan event listener untuk tombol Teller
            document.getElementById("teller").addEventListener("click", function() {
                setTicketNumber("B");
            });

            // Menambahkan event listener untuk tombol Reset
            document.getElementById("reset").addEventListener("click", function() {
                resetTicketNumbers();
            });
        });




        // Fungsi untuk mengatur nomor tiket dan menampilkannya
        function setTicketNumber(prefix) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
            // Mendapatkan nomor tiket berdasarkan prefix dan nilai terakhir dari Local Storage
            let lastTicketNumber = localStorage.getItem(prefix + "LastTicketNumber") || 0;
            lastTicketNumber++;

            // Mengatur nomor tiket di Local Storage
            localStorage.setItem(prefix + "LastTicketNumber", lastTicketNumber);

            // Menggabungkan prefix dan nomor tiket untuk ditampilkan
            let ticketNumber = prefix + padNumber(lastTicketNumber);


            // Menyimpan ke database menggunakan AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('create-tiket') }}", // Gantilah dengan nama file PHP yang sesuai
                data: { category: prefix, ticket_number: ticketNumber,  _token: '{{ csrf_token() }}' },
                success: function(response) {
                    Swal.fire({
                    title: response.data.kode_antrian,
                    text: "Berhasil !!!",
                    icon: "success"
                    });
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }

        // Fungsi untuk mereset nomor tiket ke nilai awal
        function resetTicketNumbers() {
            // Mereset nomor tiket ke nilai awal
            localStorage.setItem("ALastTicketNumber", 0);
            localStorage.setItem("BLastTicketNumber", 0);

            // Memberi tahu pengguna bahwa nomor tiket telah direset
            alert("Ticket numbers have been reset.");
        }

        // Fungsi untuk menambahkan padding nol pada nomor tiket
        function padNumber(number) {
            return number.toString().padStart(3, "0");
        }


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
