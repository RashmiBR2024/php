<?php 
session_start(); // Start session at the top
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY NEST</title>
    <link iconv="../assets/logo_org.jpg" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include '../components/navbar.php'; ?>

    <div class="container">
        <?php 
        if (isset($page) && file_exists($page)) {
            include $page;
        } else {
            echo "<h3 style='font-family: verdana; text-align: center; margin-top: 100px; color: purple; font-weight: bold;'>Welcome to STAY NEST</h3>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <?php include '../components/footer.php'; ?>
</body>
</html>
