<?php
require_once 'config.php';
requireLogin();

$success = '';
$error = '';

// Proses hapus pegawai
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    
    $query = "SELECT foto FROM pegawai WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        if ($row['foto'] && file_exists('uploads/' . $row['foto'])) {
            unlink('uploads/' . $row['foto']);
        }
    }
    
    $query = "DELETE FROM pegawai WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        $success = "Data pegawai berhasil dihapus!";
    }
}

// Pesan sukses
if (isset($_GET['success'])) {
    $success = htmlspecialchars($_GET['success']);
}

// Ambil data pegawai
$query = "SELECT * FROM pegawai ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$total_pegawai = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Pegawai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',Tahoma;background:#f5f5f5}
        .navbar{
            background:linear-gradient(135deg,#667eea,#764ba2);
            color:white;padding:20px;
            display:flex;justify-content:space-between;align-items:center
        }
        .container{max-width:1200px;margin:30px auto;padding:0 20px}
        .stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;margin-bottom:30px}
        .stat-card{background:white;padding:25px;border-radius:10px;display:flex;gap:20px}
        .stat-info h3{font-size:14px;color:#777}
        .stat-info p{font-size:32px;font-weight:bold}
        .card{background:white;border-radius:10px;padding:30px}
        .card-header{display:flex;justify-content:space-between;margin-bottom:20px}
        .btn-tambah{
            background:linear-gradient(135deg,#667eea,#764ba2);
            color:white;padding:10px 20px;
            text-decoration:none;border-radius:5px
        }
        table{width:100%;border-collapse:collapse}
        th,td{padding:12px;border-bottom:1px solid #eee}
        th{background:#f8f9fa}
        .foto-preview{width:50px;height:50px;object-fit:cover;border-radius:8px}
        .btn-edit{background:#28a745;color:white;padding:5px 10px;border-radius:4px;text-decoration:none}
        .btn-hapus{background:#dc3545;color:white;padding:5px 10px;border-radius:4px;text-decoration:none}
        .alert-success{background:#d4edda;padding:15px;border-radius:5px;margin-bottom:20px}
    </style>
</head>
<body>

<div class="navbar">
    <h1>📊 Dashboard Sistem Pegawai</h1>
    <div>
        👤 <?= htmlspecialchars($_SESSION['username']) ?>
        <a href="logout.php" style="color:white;margin-left:15px;">Logout</a>
    </div>
</div>

<div class="container">

<?php if ($success): ?>
    <div class="alert-success"><?= $success ?></div>
<?php endif; ?>

<!-- Statistik -->
<div class="stats">
    <div class="stat-card">
        <div style="font-size:40px;">👥</div>
        <div class="stat-info">
            <h3>Total Pegawai</h3>
            <p><?= $total_pegawai ?></p>
        </div>
    </div>
</div>

<!-- Tabel -->
<div class="card">
    <div class="card-header">
        <h2>📋 Daftar Pegawai</h2>
        <a href="tambah_pegawai.php" class="btn-tambah">➕ Tambah Data</a>
    </div>

<?php if ($result && mysqli_num_rows($result) > 0): ?>
<table>
    <thead>
        <tr>
            <th>Foto</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Tanggal Lahir</th>
            <th>Umur</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td>
                <?php if ($row['foto']): ?>
                    <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" class="foto-preview">
                <?php else: ?>
                    📷
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($row['nip']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <?= $row['tanggal_lahir'] 
                    ? date('d/m/Y', strtotime($row['tanggal_lahir'])) 
                    : '-' ?>
            </td>
            <td><?= htmlspecialchars($row['umur']) ?> Tahun</td>
            <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
            <td>
                <a href="edit_pegawai.php?id=<?= $row['id'] ?>" class="btn-edit">✏️</a>
                <a href="?hapus=<?= $row['id'] ?>" class="btn-hapus"
                   onclick="return confirm('Yakin hapus data?')">🗑️</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
<p style="text-align:center;color:#777">Belum ada data pegawai.</p>
<?php endif; ?>

</div>
</div>

</body>
</html>
