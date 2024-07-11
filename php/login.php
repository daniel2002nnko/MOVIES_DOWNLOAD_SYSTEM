<?php
// login.php

session_start();

$dsn = 'mysql:host=localhost;dbname=movie_download_system';
$username = 'root';
$password = '123456789';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = 'SELECT * FROM Users WHERE username = :username AND password = :password';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];

            if ($user['is_admin']) {
                header('Location: ../admin_dashboard.html');
            } else {
                header('Location: ../dashboard.html');
            }
        } else {
            echo 'Invalid username or password';
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
