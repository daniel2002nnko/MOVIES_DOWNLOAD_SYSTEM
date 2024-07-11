<?php
// register.php

$dsn = 'mysql:host=localhost;dbname=movie_download_system';
$username = 'root';
$password = '123456789';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $query = 'INSERT INTO Users (username, password, email, is_admin) VALUES (:username, :password, :email, 0)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        header('Location: ../index.html');
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
