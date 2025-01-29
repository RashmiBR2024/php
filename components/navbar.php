<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            border: 0;
            font-family: 'Arial', sans-serif; 
        }

        /* Active link background color */
        .nav-item.active-link {
            background-color: rgba(232, 172, 94, 0.79) !important;
            border-radius: 7px;
        }

        /* Styling for navbar links */
        .navbar-nav .nav-link {
            font-size: 1.2rem;
            color: rgb(21, 2, 35) !important;
            font-family: 'Roboto', sans-serif;
            font-weight: bold !important;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .navbar-nav {
            gap: 10px; /* Adjust the gap as needed */
        }

        .nav-item{
            padding: 0 0;
        }

        .nav-item {
            padding: 0 1rem;
            transition: background-color 0.3s ease-in-out, border-radius 0.2s ease-in-out, width 0.3s ease-in-out;
        }

        .nav-item:hover{
            background-color: rgba(232, 172, 94, 0.79) !important;
            border-radius: 7px;
            width: 90%;
        }

        .nav-link.btn {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        /* Active link background color */
        .active-link {
            background-color: lightbrown;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-5">
        <img src="../assets/logo_org.jpg" alt="PG Finder" style="height: 130px; width: auto; border-radius: 50%">

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Dynamically add 'active-link' class to the current page -->
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active-link' : ''; ?>"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'listings.php') ? 'active-link' : ''; ?>"><a class="nav-link" href="listings.php">Listings</a></li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active-link' : ''; ?>"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active-link' : ''; ?>"><a class="nav-link" href="contact.php">Contact</a></li>

                <!-- Login / Logout Button -->
                <?php
                if (isset($_SESSION['user_id'])) {
                    // btn-danger
                    echo '<li class="nav-item-logo"><a class="nav-link btn text-white" href="logout.php"><img src="../assets/logout.jpg" alt="logout" href="Logout" style="height: 130px; width: auto; border-radius: 50%"></a></li>';
                } else {
                    // btn-success
                    echo '<li class="nav-item-logo"><a class="nav-link btn text-white" href="login.php"><img src="../assets/login.jpg" alt="Login/Register" title="Login/Register" style="height: 30px; width: auto; border-radius: 50%"></a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS and its dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
