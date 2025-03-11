<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        header("Location: ../pages/dashboard.php"); // Redirect back to dashboard if user cancels
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - StayNest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo-img {
            height: 70px; /* Set image height */
            border-radius: 50%; /* Adjust padding (50% is too large) */
        }
        .brand-img{
            text-align: center;
            display: flex;
            justify-content: center;
        }
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .logout-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logout-container h2 {
            margin-bottom: 1.5rem;
            color: #333;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }
        .btn {
            flex: 1;
            padding: 0.5rem;
            font-size: 1rem;
        }
        .home-link{ 
            text-decoration: none;
            color:rgb(30, 176, 27);
            margin-left: 10px;
            transition: color 0.3s;
        }
        .home-icon{
            margin-top: 5%;
            text-align: center;
            display: flex;
            justify-content: center;   
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <a class="brand-img" href="index.php">
            <img src="../assets/logo_org.jpg" alt="PG Finder" class="logo-img">
        </a>
        <h2>Are you sure you want to log out?</h2>
        <form method="POST" action="">
            <div class="btn-group">
                <button type="submit" name="confirm_logout" class="btn btn-danger">Yes, Logout</button>
                <button type="submit" class="btn btn-secondary" class="btn btn-secondary">
                    Cancel
                </button>
                <!-- onclick="window.location.href='../pages/dashboard.php'" -->
            </div>
        </form>
        <!-- <a href="index.php" class="home-link">
            <i class="fas fa-arrow-left"></i> <i class="fas fa-home"></i> Home
        </a> -->
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>