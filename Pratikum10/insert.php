<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses tidak diizinkan. <a href='../index.html'>Kembali</a>");
}

$nama = htmlspecialchars($_POST['nama']);
$email = htmlspecialchars($_POST['email']);

if (empty($nama) || empty($email)) {
    die("Error: Nama dan Email tidak boleh kosong. <a href='../index.html'>Kembali</a>");
}

$stmt = $conn->prepare("INSERT INTO users (nama, email) VALUES (?, ?)");
$stmt->bind_param("ss", $nama, $email);

if ($stmt->execute()) {
    echo "Data berhasil disimpan! Anda akan dialihkan...";
    header("refresh:2;url=../index.html");
} else {
    echo "Error: Gagal menyimpan data. " . $stmt->error;
    echo '<br><a href="../index.html">Kembali</a>';
}

$stmt->close();
$conn->close();