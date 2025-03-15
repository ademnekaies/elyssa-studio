<?php
// login.php

require_once __DIR__ . '/app/controllers/LoginController.php'; // Include the LoginController

// Create an instance of the controller and handle the request
$controller = new LoginController();
$controller->handleRequest();
?>
