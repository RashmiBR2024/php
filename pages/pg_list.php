<?php
include '../config.php';

$result = $conn->query("SELECT * FROM pg_listings WHERE available='yes' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Listings - StayNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Available PGs</h2>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <?php if (!empty($row['image_url'])) { ?>
                        <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="PG Image">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['pg_name']; ?></h5>
                        <p class="card-text"><strong>Location:</strong> <?php echo $row['location']; ?></p>
                        <p class="card-text"><strong>Price:</strong> ₹<?php echo $row['price']; ?>/month</p>
                        <p class="card-text"><strong>Facilities:</strong> <?php echo $row['facilities']; ?></p>
                        <p class="card-text"><strong>Contact:</strong> <?php echo $row['contact']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
