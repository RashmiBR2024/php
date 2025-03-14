<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Stay Nest</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            margin-top: 40px;
            background: rgb(2, 19, 36);
            color: #fff;
            text-align: center;
            padding: 40px 20px;
        }

        h1, h2, h3 {
            font-family: Verdana, sans-serif;
            font-weight: bold;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.2rem;
            margin: 0;
        }

        .about-container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        /* About Section */
        .about-about {
            background: #fff;
            padding: 40px 0;
        }

        .about-about i {
            font-size: 50px;
            color: #0073e6;
            margin-top: 20px;
        }

        /* Mission & Vision Section */
        .about-mission-vision {
            background: rgba(15, 3, 43, 0.3);
            padding: 40px 0;
        }

        .about-box {
            background: #fff;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .about-mission-vision i {
            font-size: 40px;
            color: rgb(3, 23, 43);
            margin-bottom: 10px;
        }

        /* Why Choose Us Section */
        .about-why-choose-us {
            background: #fff;
            padding: 40px 0;
        }

        .about-why-choose-us .about-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .about-why-choose-us .about-feature {
            width: 45%;
            background: #f9f9f9;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .about-why-choose-us i {
            font-size: 40px;
            color: #0073e6;
            margin-bottom: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            header p {
                font-size: 1rem;
            }

            .about-container {
                width: 95%;
            }

            .about-about i {
                font-size: 40px;
            }

            .about-mission-vision .about-box, .about-why-choose-us .about-feature {
                width: 100%;
                margin: 10px 0;
            }

            .about-why-choose-us .about-container {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem;
            }

            header p {
                font-size: 0.9rem;
            }

            .about-about i, .about-mission-vision i, .about-why-choose-us i {
                font-size: 30px;
            }

            .about-box, .about-feature {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>About Stay Nest</h1>
    <p>Your Trusted Partner in Comfortable and Affordable PG Accommodations</p>
</header>

<section class="about-about">
    <div class="about-container">
        <h2>Who We Are?</h2>
        <p>Stay Nest is dedicated to helping individuals find safe, comfortable, and affordable PG accommodations. Whether you're a student, working professional, or traveler, we provide the best-living spaces tailored to your needs.</p>
        <i class="fas fa-users"></i>
    </div>
</section>

<section class="about-mission-vision">
    <div class="about-container">
        <div class="about-box">
            <i class="fas fa-bullseye"></i>
            <h3>Our Mission</h3>
            <p>To simplify the process of finding the perfect PG by providing verified listings, transparent pricing, and a hassle-free experience.</p>
        </div>
        <div class="about-box">
            <i class="fas fa-eye"></i>
            <h3>Our Vision</h3>
            <p>To be the most trusted PG accommodation provider, ensuring high-quality living spaces with safety, comfort, and convenience.</p>
        </div>
    </div>
</section>

<section class="about-why-choose-us">
    <h2 style="text-align: center">Why Choose Us?</h2>
    <div class="about-container">
        <div class="about-feature">
            <i class="fas fa-home"></i>
            <h3>Verified Listings</h3>
            <p>We ensure all PGs listed on our platform are verified and meet quality standards.</p>
        </div>
        <div class="about-feature">
            <i class="fas fa-money-bill-wave"></i>
            <h3>Affordable Pricing</h3>
            <p>Find the best accommodation options within your budget.</p>
        </div>
        <div class="about-feature">
            <i class="fas fa-shield-alt"></i>
            <h3>Safety & Security</h3>
            <p>Your safety is our priority. All PGs adhere to strict security measures.</p>
        </div>
        <div class="about-feature">
            <i class="fas fa-handshake"></i>
            <h3>Hassle-Free Booking</h3>
            <p>Easy and seamless booking experience without hidden charges.</p>
        </div>
    </div>
</section>

</body>
</html>