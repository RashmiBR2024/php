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
    .carousel {
        width: 100%;
    }

    .carousel-control-prev,
    .carousel-control-next {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        height: 40px;
        width: 40px;
        top: 50%;
        transform: translateY(-50%);
    }

    .carousel-control-prev {
        left: 10px;
    }

    .carousel-control-next {
        right: 10px;
    }

    .banner-container {
        position: relative;
        height: 400px; /* Adjust height as needed */
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .banner-container img {
        width: 50%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the banner */
        position: absolute;
        right: 0;
    }

    .banner-text {
        width: 45%;
        position: absolute;
        left: 5%;
        color: rgba(26, 4, 58, 0.9);
        font-family: 'Sofia', sans-serif;
        font-size: 2.5rem;
        font-weight: bold;
        text-align: left;
        padding: 10px 20px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8); /* Add background for better readability */
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .banner-container {
            flex-direction: column;
            height: auto;
        }

        .banner-container img {
            width: 100%;
            height: 300px;
            position: relative;
        }

        .banner-text {
            width: 90%;
            position: relative;
            left: 0;
            text-align: center;
            margin-top: 20px;
            font-size: 2rem;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly more opaque for better readability */
        }
    }

    @media (max-width: 768px) {
        .banner-container img {
            height: 250px;
        }

        .banner-text {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 576px) {
        .banner-container img {
            height: 200px;
        }

        .banner-text {
            font-size: 1.5rem;
            width: 95%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            height: 30px;
            width: 30px;
        }
    }
</style>

<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($images as $index => $image): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>" data-bs-interval="2500">
                <div class="banner-container">
                    <div class="banner-text">
                        <?php echo isset($bannerTexts[$index]) ? $bannerTexts[$index] : ''; ?> <!-- Dynamic text for each banner -->
                    </div>
                    <img src="<?php echo $image; ?>" alt="Banner Image">
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