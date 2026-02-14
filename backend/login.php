<?php
header("Content-Type: application/json");
session_start();
require "database.php";

$response = ["success" => false, "message" => "Invalid credentials"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

if (empty($email) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "All fields are required"
    ]);
    exit;
}

    // Prepared statement (SECURE)
    $stmt = $conn->prepare("SELECT id, fullname, email, barangay, password, role, mobile_number FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // If you used password_hash()
        if (password_verify($password, $user["password"])) {
            $_SESSION['user'] = [
                'id' => $user["id"],
                'name' => $user["fullname"],
                'email' => $user["email"],
                'role' => $user["role"],
                'barangay' => $user["barangay"],
                'phone' => $user["mobile_number"]

            ];    
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["fullname"] = $user["fullname"];
            $_SESSION["email"] = $user["email"];

            $response = [
                "success" => true,
                "user" => [
                    "id" => $user["id"],
                    "fullname" => $user["fullname"],
                    "email" => $user["email"],
                    "barangay" => $user["barangay"],
                    "role" => $user["role"],
                ]
            ];
        }
    }

    echo json_encode($response);
}
?>
