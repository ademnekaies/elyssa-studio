<?php
// dashboard.php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: /elyssa_studio/login.php");
    exit();
}

// User is logged in, show the dashboard content
?>

<!-- Dashboard content goes here -->
<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ELYSSA'S STUDIO</title>
    <link rel="stylesheet" href="/elyssa studio/styles/style5.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>
        <nav>
            <ul>
                <li><a href="/elyssa studio/dashboard.php">Home</a></li>
                <li><a href="/elyssa studio/profile.php">Profile</a></li>
                <li><a href="/elyssa studio/logout.php">Logout</a></li>
                <li><a href="/elyssa studio/contact.php">contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="dashboard-section">
        <div class="dashboard-content">
            <h2>Dashboard</h2>
            <p>You are now logged in. Welcome to your dashboard!</p>
        </div>
    </div>

    <script src="/elyssa studio/script.js"></script> <!-- Link to your JavaScript file -->
</body>
</html>