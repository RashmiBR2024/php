<!-- How it works section -->

<head>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<div class="how-it-works-section text-center py-5">
    <h2 class="section-title">How It Works</h2>
    <p class="section-subtitle">Find your perfect PG in just a few steps!</p>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- Step 1 -->
            <div class="col-md-3 step card">
                <div class="icon-container">
                    <i class="fas fa-search-location"></i>
                </div>
                <h3>Search & Explore</h3>
                <p>Find PGs in your desired location with filters to match your needs.</p>
            </div>

            <!-- Step 2 -->
            <div class="col-md-3 step card">
                <div class="icon-container">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3>View Details</h3>
                <p>Check pricing, amenities, reviews, and real images of PGs.</p>
            </div>

            <!-- Step 3 -->
            <div class="col-md-3 step card">
                <div class="icon-container">
                    <i class="fas fa-clone"></i>
                </div>
                <h3>Compare PGs</h3>
                <p>Compare your favorite PGs side by side based on price, amenities, and ratings.</p>
            </div>

            <!-- Step 4 -->
            <div class="col-md-3 step card">
                <div class="icon-container">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Save Your Favorites</h3>
                <p>Save your preferred PGs to easily access them later.</p>
            </div>

            <!-- Step 5 -->
            <div class="col-md-3 step card">
                <div class="icon-container">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3>Contact / Book</h3>
                <p>Contact the owner or book directly from our platform.</p>
            </div>

            <!-- Step 6 -->
            <div class="col-md-3 step card">
                <div class="icon-container">
                    <i class="fas fa-home"></i>
                </div>
                <h3>Move In & Enjoy</h3>
                <p>Settle into your comfortable PG and enjoy your stay!</p>
            </div>
        </div>
    </div>
</div>

<style>
.how-it-works-section{
    font-family: verdana, sans-serif;
}

.card{
    background-color: white;
    border-radius: 10px;
    padding: 30px;
    margin: 20px 30px;
    transition: transform 0.3s ease-in-out;
}
.how-it-works-section {
    background:rgba(248, 249, 250, 0.86);
}
.section-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #2E0961;
    margin-bottom: 10px;
}
.section-subtitle {
    font-size: 1.2rem;
    color: #444;
    margin-bottom: 40px;
}
.step {
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease-in-out;
}
.step:hover {
    transform: translateY(-15px);
}
.icon-container {
    font-size: 3rem;
    color: #2E0961;
    margin-bottom: 15px;
    background-color: white;
}
.step h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #2E0961;
}
.step p {
    font-size: 1rem;
    color: #555;
}

/* Adding new icons and text styles */
.step .fas.fa-clone {
    font-size: 3rem;
}
.step .fas.fa-heart {
    font-size: 3rem;
}
</style>
