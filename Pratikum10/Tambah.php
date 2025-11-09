<?php

require 'Koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);

    if (!empty($nama) && !empty($email)) {
        
        try {
            $sql = "INSERT INTO users (nama, email) VALUES (:nama, :email)";

            $stmt = $pdo->prepare($sql);
  
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
            
            echo "Data berhasil ditambahkan!";
            echo "<br><a href='index.php'>Kembali ke Form</a>";

        } catch(PDOException $e) {
            die("ERROR: Gagal menyimpan data. " . $e->getMessage());
        }

    } else {
        echo "Nama dan Email tidak boleh kosong!";
    }
} else {
    header("location: index.php");
    exit();
}

unset($pdo);
?>