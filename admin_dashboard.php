<?php
session_start();

// Check if admin is logged in, redirect to login page if not
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: manager_login.php");
    exit();
}

// Logout functionality
if (isset($_GET["logout"]) && $_GET["logout"] === "true") {
    session_destroy(); // Destroy session data
    header("Location: manager_login.php"); // Redirect to login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        
        <div class="menu">
            <a href="add_room.php">Add Room</a> <!-- Link to add new room page -->
            <a href="edit_rooms.php">Edit Rooms</a> <!-- Link to edit rooms page -->
            <a href="delete_room.php">Delete Rooms</a> <!-- Link to delete rooms page -->
            <a href="?logout=true">Logout</a> <!-- Link to logout (destroy session) -->
        </div>
    </div>
</body>
</html>
