<?php
// get_movies.php

$dsn = 'mysql:host=localhost;dbname=movie_download_system';
$username = 'root';
$password = '123456789';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT * FROM Movies';
    $stmt = $db->prepare($query);
    $stmt->execute();

    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($movies);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
