<?php

include "koneksi.php";

// ambil data dan sanitasi
function bersih($data){
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Ambil data dari input form
$nim            = bersih($_POST['nim'] ?? '');
$nama           = bersih($_POST['nama'] ?? '');
$tempatLahir    = bersih($_POST['tempatLahir'] ?? '');
$tanggalLahir   = bersih($_POST['tanggalLahir'] ?? '');
$tglLahir       = date("m/d/Y", strtotime($tanggalLahir));
$jmlSaudara     = bersih($_POST['jmlSaudara'] ?? '');
$alamat         = bersih($_POST['alamat'] ?? '');
$kota           = bersih($_POST['kota'] ?? '');
$jk             = bersih($_POST['jk'] ?? '');              // L / P
$statusKeluarga = bersih($_POST['statusKeluarga'] ?? ''); // K / B
$hobi           = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : "";
$email          = bersih($_POST['email'] ?? '');
$raw_password   = bersih($_POST['password'] ?? ''); // Misalnya dari input form

// Lakukan validasi pada password asli (panjang, kompleksitas, dll.)
if (empty($raw_password) || strlen($raw_password) < 10) {
    die("Password minimal 10 karakter.");
}
// Hashing password menggunakan password_hash()
$hashed_password = password_hash($raw_password, PASSWORD_BCRYPT);

$sql1 = "INSERT INTO mhs (nim,nama,tempatLahir,tanggalLahir,jmlSaudara,alamat,kota,jenisKelamin,
                          statusKeluarga,hobi,email,pass) 
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $koneksi->prepare($sql1);
$stmt->bind_param(
    "ssssssssssss",
    $nim, $nama, $tempatLahir, $tglLahir, $jmlSaudara, $alamat, $kota, $jk,
    $statusKeluarga, $hobi, $email, $hashed_password
);

if ($stmt->execute()) {
    echo "Data berhasil disimpan! <br>";
    echo "<a href='tampilDataMhs.php'>Lihat Data</a>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

$koneksi->close();
$stmt->close();
?>
