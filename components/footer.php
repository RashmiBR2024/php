<footer class="footer py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 text-left stay_nest">
                <h5 class="footer-heading">
                    <img src="../assets/logo_org-removebg-preview.png" class="stayNestLogo" alt="Stay Nest Logo">Stay Nest
                </h5>
                <p class="text">Find the perfect PG that suits your needs, location, and budget effortlessly.</p>  
                <p class="text">Easily list your PG and connect with potential tenants looking for a comfortable stay.</p>  
            </div>
            <div class="col-md-3 col-sm-6 text-left quick-links">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="listings.php" class="text-decoration-none hover-underline">Find a PG</a></li>
                    <li><a href="list-pg.php" class="text-decoration-none hover-underline">Add Your PG</a></li>
                    <li><a href="../pages/about.php" class="text-decoration-none hover-underline">About Us</a></li>
                    <li><a href="#" class="text-decoration-none hover-underline">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-6 text-left follow-us">
                <h5 class="footer-heading">Follow Us</h5>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <p>&copy; 2025 Stay Nest. All rights reserved.</p>
    </div>
</footer>

<style>
.text {
    font-size: 0.9rem;
}

.footer {
    padding: 10px;
    width: 100%;
    margin-top: 40px;
    font-family: Verdana, sans-serif;
    background-color: rgb(20, 5, 41);
    color: white;
}

.stay_nest {
    margin-left: 20px;
}

.footer-heading {
    font-size: 1.4rem;
    font-weight: bold;
    color: #fff;
    margin-bottom: 10px;
}

.footer ul {
    padding-left: 0;
}

.footer ul li {
    margin-bottom: 10px;
}

.footer ul li a {
    color: #ddd;
    text-decoration: none;
    font-size: 0.9rem;
}

.footer ul li a:hover {
    color: #fff;
}

.social-icons {
    margin-top: 10px;
}

.social-icon {
    color: #ddd;
    font-size: 1.5rem;
    margin-right: 15px;
    text-decoration: none;
}

.social-icon:hover {
    color: #fff;
}

.footer-bottom {
    border-top: 1px solid #ddd;
    padding: 5px 0;
}

.row {
    margin-left: 0;
    margin-right: 0;
    margin-top: 30px;
    margin-bottom: 40px;
}

.follow-us {
    margin-top: 30px;
    margin-bottom: 25px;
    text-align: left;
}

.footer-bottom p {
    margin-top: 30px;
    font-size: 1rem;
}

.stayNestLogo {
    height: 80px;
    width: 80px;
    border-radius: 50%;
    margin-right: 10px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .stay_nest, .quick-links, .follow-us {
        text-align: center;
        margin-left: 0;
    }

    .follow-us {
        margin-top: 20px;
    }

    .footer-heading {
        font-size: 1.2rem;
    }

    .footer ul li a {
        font-size: 0.8rem;
    }

    .social-icon {
        font-size: 1.2rem;
    }

    .footer-bottom p {
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .stayNestLogo {
        height: 60px;
        width: 60px;
    }

    .footer-heading {
        font-size: 1rem;
    }

    .text {
        font-size: 0.8rem;
    }

    .footer ul li a {
        font-size: 0.7rem;
    }

    .social-icon {
        font-size: 1rem;
    }

    .footer-bottom p {
        font-size: 0.8rem;
    }
}
</style>