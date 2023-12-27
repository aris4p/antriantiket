<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Gaya Kontainer (Flexbox) */
        body {
            display: flex;
            align-items: center; /* Pusatkan secara vertikal */
            justify-content: center; /* Pusatkan secara horizontal */
            height: 100vh; /* Tinggi kontainer 100% dari viewport */
            margin: 0; /* Hapus margin bawaan dari body */
            background-color: #fffacd; /* Krem */
        }

        /* Gaya Grup Tombol */
        .button-group {
            text-align: center;
        }

        /* Gaya Tombol */
        .button {
            margin: 10px; /* Jarak antar tombol */
            padding: 15px 30px; /* Ukuran sedang */
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            background-color: #FF5733; /* Warna merah ke oranan */
            color: #fff; /* Warna teks tombol */
            border-radius: 5px; /* Sudut melengkung pada tombol */
            border: none; /* Tanpa batas tombol */
            cursor: pointer;
            display: inline-block; /* Agar tombol tidak memenuhi lebar penuh */
        }

        /* Efek Hover pada Tombol */
        .button:hover {
            background-color: #FF8C66; /* Warna latar belakang tombol saat dihover */
        }
    </style>
    <title>Tombol Redirect</title>
</head>
<body>
    <!-- Tombol Redirect -->
    <a href="https://antrian.creativeme.tech/tiket" target="_blank" class="button">Halaman Ambil Tiket</a>
    <a href="https://antrian.creativeme.tech/login" target="_blank" class="button">Halaman Login Teller/Customer</a>
    <a href="https://antrian.creativeme.tech/antrian" target="_blank" class="button">Halaman Antrian</a>


</body>
</html>
