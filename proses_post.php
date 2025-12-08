<!DOCTYPE html>
<html>
<head>
    <title>Hasil Input POST</title>
</head>
<body>

<h2>Data yang Dikirim dengan Metode POST</h2>

<?php
    $nim           = $_POST['nim'] ?? "";
    $nama          = $_POST['nama'] ?? "";
    $tempat_lahir  = $_POST['tempat_lahir'] ?? "";
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? "";
    $alamat        = $_POST['alamat'] ?? "";
    $kota          = $_POST['kota'] ?? "";
    $jk            = $_POST['jk'] ?? "";
    $email         = $_POST['email'] ?? "";

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
