<?php
// download.php

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$movie_id = $data['movie_id'];
$user_id = $data['user_id'];

$dsn = 'mysql:host=localhost;dbname=movie_download_system';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'INSERT INTO Downloads (user_id, movie_id, download_date) VALUES (:user_id, :movie_id, NOW())';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':movie_id', $movie_id);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
