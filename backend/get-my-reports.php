<?php
session_start();
header("Content-Type: application/json");
require_once "database.php";

if (!isset($_SESSION['user'])) {
    echo json_encode([
        "success" => false,
        "message" => "Not authenticated"
    ]);
    exit;
}

$userId = $_SESSION['user']['id'];

$stmt = $conn->prepare("
    SELECT * FROM reports 
    WHERE user_id = ?
    ORDER BY created_at DESC
");

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$reports = [];

while ($row = $result->fetch_assoc()) {
    $reports[] = $row;
}

echo json_encode([
    "success" => true,
    "reports" => $reports
]);

$stmt->close();
$conn->close();