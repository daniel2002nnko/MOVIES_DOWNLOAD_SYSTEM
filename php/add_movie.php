<?php
// add_movie.php

$dsn = 'mysql:host=localhost;dbname=movie_download_system';
$username = 'root';
$password = '123456789';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $download_link = $_POST['download_link'];

    $query = 'INSERT INTO Movies (title, genre, release_year, download_link) VALUES (:title, :genre, :release_year, :download_link)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':release_year', $release_year);
    $stmt->bindParam(':download_link', $download_link);
    $stmt->execute();

    header('Location: ../admin_dashboard.html');
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
