
<?php
// Tentukan informasi koneksi ke database
$host = 'localhost';
$db = 'todo_app'; // Pastikan nama database ini benar
$user = 'root'; // Username untuk MySQL
$pass = ''; // Password untuk MySQL (kosongkan jika tidak ada password)

try {
    // Membuat koneksi PDO
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Set error mode PDO ke exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>
 