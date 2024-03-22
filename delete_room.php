<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Room</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Delete Room</h1>

        <?php
session_start();
include 'db_connect.php';

// Check if admin is logged in, redirect to login page if not
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: manager_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_room"])) {
    $room_id = $_POST["room_id"];

    // Delete associated bookings
    $delete_bookings_sql = "DELETE FROM bookings WHERE room_id = '$room_id'";
    if ($conn->query($delete_bookings_sql) === TRUE) {
        // Bookings deleted successfully, now delete the room
        $delete_room_sql = "DELETE FROM meeting_rooms WHERE room_id = '$room_id'";
        if ($conn->query($delete_room_sql) === TRUE) {
            echo "Room deleted successfully.";
        } else {
            echo "Error deleting room: " . $conn->error;
        }
    } else {
        echo "Error deleting associated bookings: " . $conn->error;
    }
}

$conn->close();
?>

        <br>
        <a href="admin_dashboard.php">Back to Admin Dashboard</a> <!-- Link back to admin dashboard -->
    </div>
</body>
</html>
