<?php
require_once 'config.php';
requireLogin();

$error = '';

// Proses tambah pegawai
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
        $check_query = "SELECT id FROM pegawai WHERE nip = '$nip'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error = "NIP sudah digunakan!";
        } else {
            // Upload foto
            $foto = '';
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
            
            // Insert jika tidak ada error
            if (empty($error)) {
                $query = "INSERT INTO pegawai 
                          (nip, nama, email, tanggal_lahir, umur, foto) 
                          VALUES 
                          ('$nip', '$nama', '$email', '$tanggal_lahir', '$umur', '$foto')";
                
                if (mysqli_query($conn, $query)) {
                    header("Location: dashboard.php?success=Data pegawai berhasil ditambahkan!");
                    exit();
                } else {
                    $error = "Gagal menambahkan data: " . mysqli_error($conn);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai - Sistem Pegawai</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 20px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        .card {
            background: white; border-radius: 10px; padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .alert-error {
            background: #f8d7da; color: #721c24;
            padding: 15px; border-radius: 5px; margin-bottom: 20px;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        label { display: block; margin-bottom: 8px; font-weight: 500; }
        input {
            width: 100%; padding: 12px;
            border: 1px solid #ddd; border-radius: 5px;
        }
        .button-group { display: flex; gap: 10px; margin-top: 30px; }
        .btn-submit {
            flex: 1; background: #667eea; color: white;
            padding: 12px; border: none; border-radius: 5px;
        }
        .btn-cancel {
            flex: 1; background: #6c757d; color: white;
            padding: 12px; text-decoration: none; text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>📊 Dashboard Sistem Pegawai</h1>
    <div>
        👤 <?php echo htmlspecialchars($_SESSION['username']); ?>
        <a href="logout.php" style="color:white;margin-left:15px;">Logout</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h2>➕ Tambah Data Pegawai</h2>

        <?php if ($error): ?>
            <div class="alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div>
                    <label>NIP *</label>
                    <input type="text" name="nip" required value="<?= $_POST['nip'] ?? '' ?>">
                </div>
                <div>
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" required value="<?= $_POST['nama'] ?? '' ?>">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" required value="<?= $_POST['tanggal_lahir'] ?? '' ?>">
                </div>
                <div>
                    <label>Umur *</label>
                    <input type="number" name="umur" min="1" max="120" required value="<?= $_POST['umur'] ?? '' ?>">
                </div>
            </div>

            <div>
                <label>Email *</label>
                <input type="email" name="email" required value="<?= $_POST['email'] ?? '' ?>">
            </div>

            <div style="margin-top:20px;">
                <label>Foto Pegawai</label>
                <input type="file" name="foto" accept="image/*">
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">💾 Simpan</button>
                <a href="dashboard.php" class="btn-cancel">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
