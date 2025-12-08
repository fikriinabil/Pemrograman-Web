<!DOCTYPE html>
<html>
<head>
    <title>Form Data (POST)</title>

    <script>
        function validasiForm() {
            const nama = document.forms["formMhs"]["nama"].value.trim();
            const umur = document.forms["formMhs"]["umur"].value.trim();

            // === Validasi Nama ===
            if (nama === "") {
                alert("Isian Nama tidak boleh kosong");
                document.forms["formMhs"]["nama"].focus();
                return false;
            }

            // cek apakah mengandung angka
            if (/\d/.test(nama)) {
                alert("Isian Nama tidak boleh mengandung angka");
                document.forms["formMhs"]["nama"].value = "";
                document.forms["formMhs"]["nama"].focus();
                return false;
            }

            // === Validasi Umur ===
            if (umur === "") {
                alert("Isian Umur tidak boleh kosong");
                document.forms["formMhs"]["umur"].focus();
                return false;
            }

            // cek apakah mengandung huruf
            if (/[a-zA-Z]/.test(umur)) {
                alert("Isian Umur tidak boleh mengandung huruf");
                document.forms["formMhs"]["umur"].value = "";
                document.forms["formMhs"]["umur"].focus();
                return false;
            }

            return true; // semua valid → form dikirim
        }
    </script>
</head>

<body>

<h2>Form Input Data Mahasiswa - POST</h2>

<form name="formMhs" action="proses_post.php" method="POST" onsubmit="return validasiForm()">

    NIM : <input type="text" name="nim"><br><br>

    Nama : <input type="text" name="nama"><br><br>

    <!-- Tambahan field umur -->
    Umur : <input type="text" name="umur"><br><br>

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

    <input type="submit" value="Kirim">
</form>

</body>
</html>
