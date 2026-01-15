<?php
require_once 'config.php';
requireLogin();

$error = '';
$pegawai = null;

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = (int)$_GET['id'];

// Ambil data pegawai
$query = "SELECT * FROM pegawai WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: dashboard.php?error=Data tidak ditemukan!");
    exit();
}

$pegawai = mysqli_fetch_assoc($result);

// Proses update pegawai
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $umur = mysqli_real_escape_string($conn, $_POST['umur']);
    
    // Validasi
    if (empty($nip) || empty($nama) || empty($email) || empty($tanggal_lahir) || empty($umur)) {
        $error = "Semua field wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } elseif (!is_numeric($umur)) {
        $error = "Umur harus berupa angka!";
    } else {
        // Cek NIP duplikat
        $check_query = "SELECT id FROM pegawai WHERE nip = '$nip' AND id != $id";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error = "NIP sudah digunakan oleh pegawai lain!";
        } else {
            $foto = $pegawai['foto'];
            
            // Upload foto baru
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = $_FILES['foto']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                
                if (in_array($ext, $allowed)) {
                    if ($_FILES['foto']['size'] <= 2097152) {
                        $newname = 'foto_' . time() . '_' . uniqid() . '.' . $ext;
                        $upload_dir = 'uploads/';
                        
                        if (!file_exists($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }
                        
                        if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $newname)) {
                            if ($foto && file_exists($upload_dir . $foto)) {
                                unlink($upload_dir . $foto);
                            }
                            $foto = $newname;
                        } else {
                            $error = "Gagal mengupload foto!";
                        }
                    } else {
                        $error = "Ukuran foto maksimal 2MB!";
                    }
                } else {
                    $error = "Format foto harus JPG, JPEG, PNG, atau GIF!";
                }
            }
            
            // Update
            if (empty($error)) {
                $query = "UPDATE pegawai SET 
                            nip='$nip',
                            nama='$nama',
                            email='$email',
                            tanggal_lahir='$tanggal_lahir',
                            umur='$umur',
                            foto='$foto'
                          WHERE id=$id";
                
                if (mysqli_query($conn, $query)) {
                    header("Location: dashboard.php?success=Data pegawai berhasil diupdate!");
                    exit();
                } else {
                    $error = "Gagal mengupdate data: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pegawai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{font-family:'Segoe UI',Tahoma;background:#f5f5f5}
        .navbar{background:linear-gradient(135deg,#667eea,#764ba2);color:white;padding:20px;display:flex;justify-content:space-between}
        .container{max-width:800px;margin:30px auto;padding:20px}
        .card{background:white;padding:40px;border-radius:10px}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:20px}
        label{font-weight:500;margin-bottom:5px;display:block}
        input{width:100%;padding:12px;border:1px solid #ddd;border-radius:5px}
        .btn{margin-top:20px;padding:12px;border:none;border-radius:5px;color:white}
        .btn-submit{background:#667eea}
        .btn-cancel{background:#6c757d;text-decoration:none;display:inline-block;text-align:center}
        .alert-error{background:#f8d7da;padding:15px;margin-bottom:20px}
    </style>
</head>
<body>

<div class="navbar">
    <h2>📊 Sistem Pegawai</h2>
    <div>👤 <?= htmlspecialchars($_SESSION['username']) ?></div>
</div>

<div class="container">
<div class="card">
<h3>✏️ Edit Pegawai</h3>

<?php if ($error): ?>
<div class="alert-error"><?= $error ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">

<div class="form-row">
    <div>
        <label>NIP *</label>
        <input type="text" name="nip" value="<?= htmlspecialchars($pegawai['nip']) ?>" required>
    </div>
    <div>
        <label>Nama *</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($pegawai['nama']) ?>" required>
    </div>
</div>

<div class="form-row">
    <div>
        <label>Tanggal Lahir *</label>
        <input type="date" name="tanggal_lahir" value="<?= $pegawai['tanggal_lahir'] ?>" required>
    </div>
    <div>
        <label>Umur *</label>
        <input type="number" name="umur" min="1" max="120" value="<?= $pegawai['umur'] ?>" required>
    </div>
</div>

<div>
    <label>Email *</label>
    <input type="email" name="email" value="<?= htmlspecialchars($pegawai['email']) ?>" required>
</div>

<div>
    <label>Foto</label>
    <input type="file" name="foto" accept="image/*">
</div>

<button class="btn btn-submit">💾 Update</button>
<a href="dashboard.php" class="btn btn-cancel">❌ Batal</a>

</form>
</div>
</div>

</body>
</html>
