<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            border: 0;
            font-family: 'Roboto', sans-serif;
        }

        /* Navbar styling */
        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 100px;
            margin-left: 50px;
            margin: -5px 40px;
            width: auto;
            border-radius: 50%;
        }

        /* Active link background color */
        .nav-item.active-link {
            background-color: rgba(232, 172, 94, 0.79);
            border-radius: 7px;
        }

        /* Styling for navbar links */
        .navbar-nav .nav-link {
            font-size: 1.2rem;
            font-weight: bold;
            color: rgb(21, 2, 35) !important;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease-in-out, border-radius 0.2s ease-in-out;
        }

        .navbar-nav {
            gap: 20px;
        }

        .nav-item:hover {
            background-color: rgba(232, 172, 94, 0.79);
            border-radius: 7px;
        }

        /* Login/Logout button styling */
        .nav-item-logo .nav-link img {
            height: 30px;
            width: auto;
            border-radius: 50%;
        }

        .nav-item-logo .nav-link {
            padding: 0.5rem;
        }

        /* Make the toggle icon bigger */
        .navbar-toggler {
            padding: 0.5rem;
            font-size: 0.7rem; /* Adjust the size of the icon */
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 1.5em; /* Adjust the width of the icon */
            height: 1.5em; /* Adjust the height of the icon */
        }

        /* Mobile menu adjustments */
        @media (max-width: 992px) {
            .navbar-brand img {
                height: 100px;
            }

            .navbar-nav {
                gap: 5px;
            }

            .navbar-nav .nav-link {
                font-size: 1rem;
                padding: 0.5rem;
            }

            .nav-item-logo .nav-link img {
                height: 25px;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand img {
                height: 50px;
            }

            .navbar-nav .nav-link {
                font-size: 0.9rem;
                padding: 0.4rem;
            }

            .nav-item-logo .nav-link img {
                height: 20px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand img {
                height: 40px;
            }

            .navbar-nav .nav-link {
                font-size: 0.8rem;
                padding: 0.3rem;
            }

            .nav-item-logo .nav-link img {
                height: 18px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="../assets/logo_org.jpg" alt="PG Finder">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Dynamically add 'active-link' class to the current page -->
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'listings.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="listings.php">Listings</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active-link' : ''; ?>">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <!-- Login / Logout Button -->
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item-logo"><a class="nav-link" href="../auth/logout.php"><img src="../assets/logout.jpg" alt="Logout"></a></li>';
                } else {
                    echo '<li class="nav-item-logo"><a class="nav-link" href="../auth/login.php"><img src="../assets/login.jpg" alt="Login/Register"></a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS and its dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var navbarToggler = document.querySelector(".navbar-toggler");
        var navbarNav = document.querySelector("#navbarNav");
        var navLinks = document.querySelectorAll(".nav-link");

        // Function to close the navbar when a link is clicked
        navLinks.forEach(function (link) {
            link.addEventListener("click", function () {
                if (navbarNav.classList.contains("show")) {
                    navbarToggler.click(); // Simulate clicking the toggle button to close it
                }
            });
        });

        // Function to close the navbar when clicking outside
        document.addEventListener("click", function (event) {
            var isClickInsideNavbar = navbarNav.contains(event.target) || navbarToggler.contains(event.target);
            if (!isClickInsideNavbar && navbarNav.classList.contains("show")) {
                navbarToggler.click(); // Close the navbar
            }
        });
    });
</script>

</body>
</html>