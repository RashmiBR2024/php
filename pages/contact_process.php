<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error!"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
    }

    $conn->close();
}
?>
