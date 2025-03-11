<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_id = $_SESSION['user_id'];
    $pg_name = $_POST['pg_name'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $facilities = $_POST['facilities'];
    $available = $_POST['available'];
    
    // Image Upload Handling
    $image_url = '';
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/";
        $image_url = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_url);
    }

    $stmt = $conn->prepare("INSERT INTO pg_listings (owner_id, pg_name, location, price, facilities, image_url, available) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdsss", $owner_id, $pg_name, $location, $price, $facilities, $image_url, $available);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>PG listed successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add PG - StayNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add Your PG Listing</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>PG Name:</label>
            <input type="text" name="pg_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Location:</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Price (₹ per month):</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Facilities:</label>
            <textarea name="facilities" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Availability:</label>
            <select name="available" class="form-control">
                <option value="yes">Available</option>
                <option value="no">Not Available</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Upload Image:</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
