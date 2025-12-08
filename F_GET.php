<!DOCTYPE html>
<html>
<head>
    <title>Form Data (GET)</title>
</head>
<body>

<h2>Form Input Data Mahasiswa - GET</h2>
<form action="proses_get.php" method="GET">
    NIM : <input type="text" name="nim"><br><br>
    Nama : <input type="text" name="nama"><br><br>
    Tempat Lahir : <input type="text" name="tempat_lahir"><br><br>
    Tanggal Lahir : <input type="date" name="tanggal_lahir"><br><br>

    Alamat : <br>
    <textarea name="alamat" rows="4" cols="30"></textarea><br><br>

    Kota :
    <select name="kota">
        <option>Semarang</option>
        <option>Solo</option>
        <option>Salatiga</option>
        <option>Kudus</option>
        <option>Pekalongan</option>
    </select><br><br>

    Jenis Kelamin :
    <input type="radio" name="jk" value="Laki-laki"> Laki-laki
    <input type="radio" name="jk" value="Perempuan"> Perempuan
    <br><br>

    Email : <input type="email" name="email"><br><br>

    <!-- Tambahan -->
    No HP : <input type="text" name="nohp"><br><br>

    Umur : <input type="number" name="umur"><br><br>

    Status :
    <input type="radio" name="status" value="Kawin"> Kawin
    <input type="radio" name="status" value="Belum Kawin"> Belum Kawin
    <br><br>

    Hobi : <br>
    <input type="checkbox" name="hobi[]" value="Membaca"> Membaca <br>
    <input type="checkbox" name="hobi[]" value="Olah Raga"> Olah Raga <br>
    <input type="checkbox" name="hobi[]" value="Musik"> Musik <br>
    <input type="checkbox" name="hobi[]" value="Traveling"> Traveling <br><br>

    <input type="submit" value="Kirim">
</form>

</body>
</html>
