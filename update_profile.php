<?php
// update_profile.php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: /elyssa studio/login.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Hash the new password if provided
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    // Update the user's profile in the database
    require_once __DIR__ . '/app/models/UserModel.php';
    $userModel = new UserModel();
    $result = $userModel->updateProfile($user_id, $email, $hashedPassword);

    if ($result) {
        // Update the session email if the email was changed
        $_SESSION['email'] = $email;

        // Redirect to the profile page with a success message
        header("Location: /elyssa studio/profile.php?success=1");
        exit();
    } else {
        // Redirect to the profile page with an error message
        header("Location: /elyssa studio/profile.php?error=1");
        exit();
    }
}
?>