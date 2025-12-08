<!DOCTYPE html>
<html>
<head>
    <title>Hasil Input GET</title>
</head>
<body>

<h2>Data yang Dikirim dengan Metode GET</h2>

<?php
    // Ambil data GET secara aman
    $nim           = $_GET['nim'] ?? "";
    $nama          = $_GET['nama'] ?? "";
    $tempat_lahir  = $_GET['tempat_lahir'] ?? "";
    $tanggal_lahir = $_GET['tanggal_lahir'] ?? "";
    $alamat        = $_GET['alamat'] ?? "";
    $kota          = $_GET['kota'] ?? "";
    $jk            = $_GET['jk'] ?? "";
    $email         = $_GET['Email'] ?? "";

    echo "NIM : $nim<br>";
    echo "Nama : $nama<br>";
    echo "Tempat Lahir : $tempat_lahir<br>";
    echo "Tanggal Lahir : $tanggal_lahir<br>";
    echo "Alamat : $alamat<br>";

    /* ----- Menampilkan Kota menggunakan IF ----- */
    if ($kota == "Semarang") {
        echo "Kota : Semarang<br>";
    } elseif ($kota == "Solo") {
        echo "Kota : Solo<br>";
    } elseif ($kota == "Salatiga") {
        echo "Kota : Salatiga<br>";
    } elseif ($kota == "Kudus") {
        echo "Kota : Kudus<br>";
    } else {
        echo "Kota : Pekalongan<br>";
    }

    /* ----- Menampilkan Jenis Kelamin menggunakan IF ----- */
    if ($jk == "Laki-laki") {
        echo "Jenis Kelamin : Laki-laki<br>";
    } else {
        echo "Jenis Kelamin : Perempuan<br>";
    }

    echo "Email : $email<br>";
?>
</body>
</html>
