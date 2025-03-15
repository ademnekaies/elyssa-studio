<?php
// logout.php

session_start(); // Start the session
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: /elyssa studio/login.php");
exit();
?>