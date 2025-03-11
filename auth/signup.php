<?php
include '../config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone = $_POST['phone'];

    // Check if the email already exists
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger'>Email already exists! Try another.</div>";
    } else {
        // Insert user data into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $phone);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Signup successful! <a href='login.php'>Login here</a></div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - StayNest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        .signup-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .signup-container h2 {
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
        .alert {
            margin-bottom: 1rem;
        }
        .input-group-text {
            height: 38px;
            font-size: 14px; /* Smaller icon size */
            /* padding: 0.375rem 0.75rem; Adjust padding to match smaller icons */
        }
        .input-group-text i:hover {
            color: #007bff; /* Change icon color on hover */
        }
        .form-control::placeholder {
            transition: opacity 0.3s ease;
        }
        .form-control:focus::placeholder {
            opacity: 0.5;
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
    <div class="signup-container">
        <a class="brand-img" href="index.php">
            <img src="../assets/logo_org.jpg" alt="PG Finder" class="logo-img">
        </a>
        <h2>Signup to StayNest</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user "></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <button type="button" class="btn btn-outline-secondary input-group-text" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
        <div class="text-center mt-3">
            Already have an account? <a href="login.php">Login here</a>
        </div>
        <div class="home-icon">
            <a href="../pages/index.php" class="home-link">
                <i class="fas fa-arrow-left"></i> Back to <i class="fas fa-home"></i> 
            </a>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordField = document.querySelector('input[name="password"]');
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>