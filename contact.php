<?php
// contact.php

// Include Composer autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'StrateGix04@gmail.com'; // Replace with your email
        $mail->Password = 'StrateGix04@'; // Replace with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('recipient@example.com'); // Replace with the recipient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body = "Name: $name<br>Email: $email<br>Message: $message";

        // Send the email
        $mail->send();
        echo "<p style='color: green;'>Thank you for your message! We'll get back to you soon.</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>Oops! Something went wrong. Please try again later.</p>";
        echo "Error: " . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ELYSSA'S STUDIO</title>
    <link rel="stylesheet" href="/elyssa studio/styles/style4.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Contact Us</h1>
        <nav>
            <ul>
                <li><a href="/elyssa studio/index.html">Home</a></li>
                <li><a href="/elyssa studio/about.html">About</a></li>
                <li><a href="/elyssa studio/portfolio.html">Portfolio</a></li>
                <li><a href="/elyssa studio/contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="contact-section">
        <div class="contact-content">
            <h2>Get in Touch</h2>
            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </div>

    <script src="/elyssa studio/script.js"></script> <!-- Link to your JavaScript file -->
</body>
</html>
