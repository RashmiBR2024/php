<?php 
    include '../components/banner.php';
?>

<!-- search for pg -->
<div class="search-section text-center mt-4">
    <h2 class="search-text">Find Your Perfect Nest to Rest!</h2>
    <a href="listings.php" class="btn btn-primary search-btn">Search for PG</a>
</div>

<style>
    .search-section {
        text-align: center;
        margin-top: 20px;
        font-family: verdana, sans-serif;
        gap: 5%;
        padding: 5%;
    }

    .search-text {
        font-size: 2rem;
        font-weight: bold;
        color: #2E0961;
        margin-bottom: 10px;
    }

    @keyframes bounceSlow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .search-btn {
        background-color: rgb(28, 4, 61); /* Stay Nest branding */
        color: white;
        font-size: 1.3rem;
        margin-top: 20px;
        font-weight: bold;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        transition: background-color 0.3s ease-in-out;
        display: inline-block;
        animation: bounceSlow 1.5s infinite ease-in-out; /* Slow bounce */
    }

    .search-btn:hover {
        background-color: #1A043A;
    }

</style>

<?php 
include "../components/howItWorks.php";
include "../components/callToAction.php"; 
?>