<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$owner_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM pg_listings WHERE owner_id='$owner_id' ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PG Listings - StayNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>My PG Listings</h2>
    <table class="table">
        <thead>
            <tr>
                <th>PG Name</th>
                <th>Location</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['pg_name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>₹<?php echo $row['price']; ?>/month</td>
                    <td><?php echo ucfirst($row['available']); ?></td>
                    <td>
                        <a href="pg_edit.php?id=<?php echo $row['pg_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="pg_delete.php?id=<?php echo $row['pg_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
