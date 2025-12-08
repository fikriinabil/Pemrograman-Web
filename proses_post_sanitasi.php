<?php

// Fungsi sanitasi
function bersihkan($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

$nim            = isset($_POST['nim']) ? bersihkan($_POST['nim']) : "";
$nama           = isset($_POST['nama']) ? bersihkan($_POST['nama']) : "";
$umur           = isset($_POST['umur']) ? bersihkan($_POST['umur']) : "";
$tempat_lahir   = isset($_POST['tempat_lahir']) ? bersihkan($_POST['tempat_lahir']) : "";
$tanggal_lahir  = isset($_POST['tanggal_lahir']) ? bersihkan($_POST['tanggal_lahir']) : "";
$no_hp          = isset($_POST['no_hp']) ? bersihkan($_POST['no_hp']) : "";
$alamat         = isset($_POST['alamat']) ? bersihkan($_POST['alamat']) : "";
$email          = isset($_POST['email']) ? bersihkan($_POST['email']) : "";

// Sanitasi kota
$kota = bersihkan($_POST['kota'] ?? "");

// Sanitasi jenis kelamin (radio)
$jk = isset($_POST['jk']) ? bersihkan($_POST['jk']) : "-";

// Sanitasi status kawin
$status = isset($_POST['status']) ? bersihkan($_POST['status']) : "-";

// Sanitasi checkbox hobi
$hobi_list = [];
if (!empty($_POST['hobi'])) {
    foreach ($_POST['hobi'] as $h) {
        $hobi_list[] = bersihkan($h);
    }
}
$hobi_output = implode(", ", $hobi_list);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Data POST</title>
</head>
<body>

<h2>Hasil Input Data Mahasiswa (Metode POST)</h2>

<p><b>NIM:</b> <?= $nim ?></p>
<p><b>Nama:</b> <?= $nama ?></p>
<p><b>Umur:</b> <?= $umur ?></p>
<p><b>Tempat Lahir:</b> <?= $tempat_lahir ?></p>
<p><b>Tanggal Lahir:</b> <?= $tanggal_lahir ?></p>
<p><b>No HP:</b> <?= $no_hp ?></p>
<p><b>Alamat:</b> <?= $alamat ?></p>

<p><b>Kota:</b>

<?php
    if ($kota == "Semarang") echo "Semarang";
    elseif ($kota == "Solo") echo "Solo";
    elseif ($kota == "Brebes") echo "Brebes";
    elseif ($kota == "Kudus") echo "Kudus";
    elseif ($kota == "Demak") echo "Demak";
    else echo "Salatiga";
?>
</p>

<p><b>Jenis Kelamin:</b> <?= $jk ?></p>
<p><b>Status:</b> <?= $status ?></p>

<p><b>Hobi:</b> <?= $hobi_output ?></p>

<p><b>Email:</b> <?= $email ?></p>

</body>
</html>
