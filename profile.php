<?php
// profile.php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: /elyssa studio/login.php");
    exit();
}

// Get the user details from the session
$username = $_SESSION['username'];
$email = $_SESSION['email']; // Assuming email is stored in the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - ELYSSA'S STUDIO</title>
    <link rel="stylesheet" href="/elyssa_studio/styles/style5.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Profile</h1>
        <nav>
            <ul>
                <li><a href="/elyssa_studio/dashboard.php">Home</a></li>
                <li><a href="/elyssa_studio/profile.php">Profile</a></li>
                <li><a href="/elyssa_studio/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-section">
        <div class="profile-content">
            <h2>Your Profile</h2>
            <form action="/elyssa studio/update_profile.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit" class="btn">Update Profile</button>
            </form>
        </div>
    </div>

    <script src="/elyssa studio/script.js"></script> <!-- Link to your JavaScript file -->
</body>
</html>