<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stay_nest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert into database
$sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
if ($conn->query($sql) === TRUE) {
    // Send WhatsApp notification (optional)
    require 'vendor/autoload.php'; // Twilio SDK (install via Composer)
    use Twilio\Rest\Client;
    
    $sid = 'YOUR_TWILIO_SID';
    $token = 'YOUR_TWILIO_AUTH_TOKEN';
    $twilio = new Client($sid, $token);

    $twilio->messages->create(
        "whatsapp:+916366507549", // Replace with Admin's WhatsApp number
        [
            "from" => "whatsapp:+YOUR_TWILIO_NUMBER",
            "body" => "New Message from Contact Us:\nName: $name\nEmail: $email\nMessage: $message"
        ]
    );

    echo "Message sent successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


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
        body {
            font-family: Verdana, sans-serif;
        }

        .contactusheading{
            text-align: right;
            font-size: 2.5rem;
            margin: 0 10px 20px 0;
            font-weight: bold;
            color: rgb(32, 10, 85);
        }

        .GetInTouch{
            font-size: 1.7rem;
            font-weight: bold;
            color:rgb(32, 10, 85);
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .followUshead{
            font-size: 1.7rem;
            font-weight: bold;
            color:rgb(32, 10, 85);
            margin: 40px 0 20px 0;
        }

        .getInTouchicon{
            margin-bottom: 10px;
        }

        .contact-form h4{
            font-weight: bold;
            color:rgb(32, 10, 85);
            font-size: 30px;
            margin-bottom: 20px;
        }

        .contact-info {
            background: #f8f9fa;
            padding: 40px;
            border-radius: 10px;
        }
        .contact-info i {
            font-size: 24px;
            color:rgb(4, 26, 48);
            margin-right: 10px;
        }
        .contact-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="contactusheading mb-4">Contact Us</h2>
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-5" style="width: 480px;">
                <div class="contact-info">
                    <h4 class="GetInTouch">Get in Touch</h4>
                    <p class=getInTouchicon><i class="fas fa-map-marker-alt"></i> Kengeri Upanagara, Bangalore Karnataka</p>
                    <p class=getInTouchicon><i class="fas fa-envelope"></i> support@staynest.com</p>
                    <p class=getInTouchicon><i class="fas fa-phone"></i> +91 63665 07549</p>
                    <h5 class="followUshead">Follow Us</h5>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-7" style="width: 610px;">
                <div class="contact-form">
                    <h4>Send Us a Message</h4>
                    <form action="contact_process.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Google Map (Optional) -->
        <div class="row mt-4">
            <div class="col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d486.08834150189347!2d77.4881836!3d12.926561!3m2!1i1024!2i768!4f13.1!2m1!1s15th%20cross%201st%20d%20main%20mts%20layout%20kengeri%20upanagara%20bengaluru!5e0!3m2!1sen!2sin!4v1737941239029!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm`/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>


