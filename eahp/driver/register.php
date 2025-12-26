<?php
require 'db.php'; // Ensure this file is correctly included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO drivers (name, email, password, phone) VALUES (:name, :email, :password, :phone)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashed_password,
            'phone' => $phone
        ]);

        echo 'Registration successful!';
    } catch (PDOException $e) {
        echo 'Registration failed: ' . $e->getMessage();
    }
}
?>

<form method="post">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Phone: <input type="text" name="phone"><br>
    <button type="submit">Register</button>
</form>
