
<?php
$host = 'localhost';
$dbname = 'eahpdb'; // Ensure this matches your database name
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit(); // Make sure the script exits if the connection fails
}
?>

