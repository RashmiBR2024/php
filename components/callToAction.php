<div class="cta-section text-center py-5">
    <p class="cta-heading">What Are You Searching For?</p>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- Section for Add Your PG Button for PG Owners -->
            <div class="cta-card col-md-4 mb-4">
                <h3 class="cta-sub-heading">Add Your PG</h3>
                <p class="cta-description">Add your PG to our platform and help visitors find their perfect place to stay.</p>
                <a href="list-pg.php" class="btn btn-danger btn-lg w-100">
                    <i class="fas fa-plus-circle"></i> List Your PG
                </a>
            </div>

            <!-- Section for Find a PG Now Button for Users -->
            <div class="cta-card col-md-4 mb-4">
                <h3 class="cta-sub-heading">Find Your Perfect PG</h3>
                <p class="cta-description">Search and explore PGs that match your needs and make your stay comfortable.</p>
                <a href="listings.php" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-search"></i> Find a PG Now
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.cta-section {
    background-color: #F8F9FA;
    padding: 50px 0;
    font-family: verdana, sans-serif;
    margin-top: 40px;
}

.cta-heading{
    font-size: 2rem;
    font-weight: bold;
    color: #2E0961;
    margin-bottom: 10px; 
}

.cta-section .btn {
    font-size: 1.2rem;
    font-weight: bold;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease-in-out;
}

.cta-card{
    background-color: white;
    width: 40%;
    border-radius: 10px;
    padding: 30px;
    margin: 20px 30px;
    transition: transform 0.3s ease-in-out;
}

.cta-section .btn i {
    font-size: 1.5rem;
}

.cta-section .btn:hover {
    transform: scale(1.05);
}

.cta-section .btn.btn-danger {
    background-color: #D9534F;
    border-color: #D9534F;
}

.cta-section .btn.btn-danger:hover {
    background-color: #C9302C;
    border-color: #C9302C;
}

.cta-section .btn.btn-primary {
    background-color: #337AB7;
    border-color: #337AB7;
}

.cta-section .btn.btn-primary:hover {
    background-color: #286090;
    border-color: #286090;
}

.cta-sub-heading {
    font-size: 1.4rem;
    font-weight: bold;
    color: #2E0961;
    margin-bottom: 10px;
}

.cta-description {
    font-size: 1rem;
    color: #555;
    margin-bottom: 20px;
}
</style>
