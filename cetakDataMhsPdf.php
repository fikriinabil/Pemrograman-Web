<?php
require __DIR__ . '/fpdf186/fpdf.php';
require 'koneksi.php'; // File untuk koneksi ke database
// Membuat kelas turunan FPDF untuk menambahkan footer
class PDF extends FPDF {
// Footer untuk menambahkan nomor halaman dan tanggal
function Footer() {
// Set posisi 1.5 cm dari bawah
$this->SetY(-15);
// Set font untuk footer
$this->SetFont('Arial', 'I', 10);
// Nomor halaman
$this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
}
}
// Query untuk mengambil data mhs
$sql = "SELECT * FROM mhs";
$result = mysqli_query($koneksi, $sql);
// Membuat objek PDF
$pdf = new PDF();
$pdf->AddPage();
// Set Font
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, 'Laporan Daftar Mahasiswa', 0, 1, 'C');
// Memberikan jarak sebelum tabel
$pdf->Ln(10);
// Set header tabel dengan warna latar belakang
$pdf->SetFillColor(230, 230, 230); // Warna latar belakang header (light gray)
$pdf->SetFont('Arial', 'B', 12);
// Header tabel dengan pengisian latar belakang (fill = 1)
$pdf->Cell(10, 10, 'No.', 1, 0, 'C', 1); // Kolom No.
$pdf->Cell(40, 10, 'NIM', 1, 0, 'C', 1); // Kolom NIM
$pdf->Cell(50, 10, 'Nama', 1, 0, 'C', 1); // Kolom Nama
$pdf->Cell(50, 10, 'Tempat Lahir', 1, 0, 'C', 1); // Tempat Lahir
$pdf->Cell(30, 10, 'Tanggal Lahir', 1, 1, 'C', 1); // Tanggal Lahir
// Menampilkan data dosen
$pdf->SetFont('Arial', '', 12);
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
$pdf->Cell(10, 10, $no, 1, 0, 'C');
$pdf->Cell(40, 10, $row['nim'], 1, 0, 'C');
$pdf->Cell(50, 10, $row['nama'], 1, 0, 'C');
$pdf->Cell(50, 10, $row['tempatLahir'], 1, 0, 'C');
$pdf->Cell(30, 10, $row['tanggalLahir'], 1, 1, 'd');
$no++;
}
// Output PDF
$pdf->Output();
?>