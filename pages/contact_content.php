<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Stay Nest</title>
    <link rel="icon" href="../assets/logo_org.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: Verdana, sans-serif; background-color: #f8f9fa; }
        .contactusheading { text-align: center; font-size: 2.5rem; margin: 20px 0; font-weight: bold; color: rgb(32, 10, 85); }
        .GetInTouch { font-size: 1.7rem; font-weight: bold; color: rgb(32, 10, 85); margin-top: 10px; margin-bottom: 20px; }
        .followUshead { font-size: 1.7rem; font-weight: bold; color: rgb(32, 10, 85); margin: 40px 0 20px 0; }
        .contact-info { background: #ffffff; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .contact-info i { font-size: 24px; color: rgb(4, 26, 48); margin-right: 10px; }
        .contact-form { background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .social-icon { color: rgb(32, 10, 85); margin-right: 15px; font-size: 24px; }
        .social-icon:hover { color: rgb(4, 26, 48); }
        iframe { width: 100%; height: 300px; border: 0; border-radius: 10px; margin-top: 20px; }
        .btn-primary { background-color: rgb(32, 10, 85); border: none; }
        .btn-primary:hover { background-color: rgb(4, 26, 48); }
        .btn-secondary { background-color: #6c757d; border: none; }
        .btn-secondary:hover { background-color: #5a6268; }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .contactusheading { font-size: 2rem; }
            .GetInTouch, .followUshead { font-size: 1.5rem; }
            .contact-info, .contact-form { padding: 15px; }
            .social-icon { font-size: 20px; margin-right: 10px; }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="contactusheading">Contact Us</h2>
    <div class="row">
        <!-- Contact Information -->
        <div class="col-md-6">
            <div class="contact-info">
                <h4 class="GetInTouch">Get in Touch</h4>
                <p><i class="fas fa-map-marker-alt"></i> Kengeri Upanagara, Bangalore, Karnataka</p>
                <p><i class="fas fa-envelope"></i> support@staynest.com</p>
                <p><i class="fas fa-phone"></i> +91 63665 07549</p>
                <h5 class="followUshead">Follow Us</h5>
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-6">
            <div class="contact-form">
                <h4 class="GetInTouch">Send Us a Message</h4>
                <form action="contact_process.php" method="post" id="contactForm">
                <div class="mb-3">
                    <span class="text-danger">*</span><label for="name" class="form-label">Your Name </label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <span class="text-danger">*</span><label for="email" class="form-label">Email Address </label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <span class="text-danger">*</span><label for="phone" class="form-label">Phone Number </label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <span class="text-danger">*</span><label for="message" class="form-label">Your Message </label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Google Map -->
    <div class="row mt-4">
        <div class="col-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d486.08834150189347!2d77.4881836!3d12.926561!3m2!1i1024!2i768!4f13.1!2m1!1s15th%20cross%201st%20d%20main%20mts%20layout%20kengeri%20upanagara%20bengaluru!5e0!3m2!1sen!2sin!4v1737941239029!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <!-- Back to Home Button -->
    <!-- <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary">Back to Home</a>
    </div> -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent the default form submission

    const submitButton = document.querySelector("#contactForm button[type='submit']");
    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
    submitButton.disabled = true;

    const formData = new FormData(this);

    fetch("contact_process.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Parse JSON response
    .then(data => {
        if (data.status === "success") {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: data.message,
                confirmButtonColor: "#3085d6"
            });

            document.getElementById("contactForm").reset(); // Clear the form after success
        } else {
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: data.message,
                confirmButtonColor: "#d33"
            });
        }
    })
    .catch(error => console.error("Error:", error))
    .finally(() => {
        submitButton.innerHTML = "Send Message";
        submitButton.disabled = false;
    });
});
</script>

</body>
</html>