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

// Validate required fields
$required = ['category','severity','title','description','address','barangay'];

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode([
            "success" => false,
            "message" => "Missing field: $field"
        ]);
        exit;
    }
}

$category    = $_POST['category'];
$severity    = $_POST['severity'];
$title       = $_POST['title'];
$description = $_POST['description'];
$address     = $_POST['address'];
$barangay    = $_POST['barangay'];
$latitude    = $_POST['latitude'] ?? null;
$longitude   = $_POST['longitude'] ?? null;

$imagePath = null;

// Handle image upload
if (!empty($_FILES['image']['name'])) {

    $uploadDir = "../uploads/hazards/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $uploadDir . $fileName;

    $allowedTypes = ['image/jpeg','image/png','image/jpg'];

    if (!in_array($_FILES['image']['type'], $allowedTypes)) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid image type"
        ]);
        exit;
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imagePath = "uploads/hazards/" . $fileName;
    }
}

// Insert into DB
$stmt = $conn->prepare("
    INSERT INTO reports 
    (user_id, category, severity, title, description, address, barangay, latitude, longitude, image_path)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "issssssdds",
    $userId,
    $category,
    $severity,
    $title,
    $description,
    $address,
    $barangay,
    $latitude,
    $longitude,
    $imagePath
);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Report submitted successfully"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Database error"
    ]);
}

$stmt->close();
$conn->close();