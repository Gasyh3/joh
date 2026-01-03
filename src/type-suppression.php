<?php
require __DIR__ . '/config/pdo.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id > 0) {
    $stmt = $pdo->prepare('DELETE FROM types WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

header('Location: type-lecture.php');
exit;
