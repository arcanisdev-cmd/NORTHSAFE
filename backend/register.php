<?php
header('Content-Type: application/json');

include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile_number = trim($_POST['phone'] ?? '');
    $barangay = trim($_POST['barangay'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Basic validation
    if (empty($fullname) || empty($email) || empty($mobile_number) || empty($barangay) || empty($password)) {
        echo json_encode([
            "success" => false,
            "message" => "All fields are required."
        ]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid email format."
        ]);
        exit;
    }

    if ($password !== $confirmPassword) {
        echo json_encode([
            "success" => false,
            "message" => "Passwords do not match."
        ]);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode([
            "success" => false,
            "message" => "Password must be at least 6 characters."
        ]);
        exit;
    }

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode([
            "success" => false,
            "message" => "Email is already registered."
        ]);
        exit;
    }
    $checkStmt->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare(
        "INSERT INTO user (fullname, email, barangay, password, mobile_number)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("sssss", $fullname, $email, $barangay, $hashedPassword, $mobile_number);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Account created successfully"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Registration failed. Please try again."
        ]);
    }

    $stmt->close();
}

$conn->close();
?>