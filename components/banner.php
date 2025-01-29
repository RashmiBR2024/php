<?php
$bannerDir = '../assets/banner/'; // Adjust path if needed
$images = glob($bannerDir . "*.{jpg,png,jpeg,gif}", GLOB_BRACE); // Fetch all images

// Array of banner texts (make sure the order matches the order of the images)
$bannerTexts = [
    "Welcome to Your Next Home Away From Home!",
    "Find the Best PGs Near You",
    "Stay Smart, Live Comfortably - PGs for Every Budget!",
    "Home-Like Comfort, Hostel-Like Vibes!",
    "Choose your nest to rest!",
    "Stay Close to Colleges, Offices, and More!",
    "Live Where You Work & Study - Best PGs Near You!"
];

if (empty($images)) {
    echo "<p>No banners found.</p>";
    return;
}
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<style>
    .carousel{
        width: 100%;
    }

    .carousel-control-prev {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        height: 50px;
        width: 50px;
        top: 50%;
        left: 2%;
    }

    .carousel-control-next {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        height: 50px;
        width: 50px;
        top: 50%;
        right: 2%;
    }

    .banner-container {
        position: relative;
       height: 400px; /* Adjust height as needed */
        overflow: hidden;
    }
    
    .banner-container img {
        object-fit: fill; /* Ensures the image covers the banner */
        right: 0;
        padding-left: 45%;
    }
    
    .banner-text {
        width: 40%;
        position: absolute;
        top: 45%;
        left: 25%;
        transform: translate(-50%, -50%);
        color: rgba(26, 4, 58, 0.9);
        font-family: 'Sofia', sans-serif;
        font-size: 3rem;
        font-weight: bold;
        text-align: center;
        padding: 10px 20px;
        border-radius: 10px;
    }
</style>

<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner banner-container">
        <?php foreach ($images as $index => $image): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>" data-bs-interval="2500">
                <img src="<?php echo $image; ?>" alt="Banner Image">
                <div class="banner-text">
                    <?php echo isset($bannerTexts[$index]) ? $bannerTexts[$index] : ''; ?> <!-- Dynamic text for each banner -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Navigation Buttons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Auto-scroll every 1.7 seconds -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let bannerCarousel = new bootstrap.Carousel(document.getElementById("bannerCarousel"), {
            interval: 1700,
            ride: "carousel"
        });

        // Force first slide transition after 100ms (fixes delay on first transition)
        setTimeout(() => {
            bannerCarousel.next();
        }, 100);
    });
</script>
