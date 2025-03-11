<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: ../pages/dashboard.php"); // Redirect to user dashboard
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Invalid email or password!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StayNest</title>
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
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 1.5rem;
            text-align: center;
            color: #333;
        }
        .form-control {
            margin-bottom: 1rem;
        }
        .btn-primary {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
        }
        .signup-link {
            text-align: center;
            margin-top: 1rem;
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
    <div class="login-container">
        <a class="brand-img" href="index.php">
            <img src="../assets/logo_org.jpg" alt="PG Finder" class="logo-img">
        </a>
        <h2>Login to StayNest</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="signup-link">
            <p>Don't have an account? <a href="../auth/signup.php">Sign up here</a></p>
        </div>
        <div class="home-icon">
            <a href="../pages/index.php" class="home-link">
                <i class="fas fa-arrow-left"></i> Back to <i class="fas fa-home"></i> 
            </a>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</body>
</html>
