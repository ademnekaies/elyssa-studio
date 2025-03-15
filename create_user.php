<?php
// create_user.php

require_once __DIR__ . '/app/controllers/UserController.php'; // Include the UserController

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);

    // Create a new user
    $userController = new UserController();
    $result = $userController->createUser($username, $email, $password, $role);

    if ($result) {
        echo "<p style='color: green;'>User created successfully!</p>";
    } else {
        echo "<p style='color: red;'>Failed to create user. Please try again.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <h1>Create New User</h1>
    
    <?php echo $message; ?>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div>
            <button type="submit">Create User</button>
        </div>
    </form>
</body>
</html>