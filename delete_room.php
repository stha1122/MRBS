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

        // Query to select all rooms
        $sql = "SELECT * FROM meeting_rooms";
        $result = $conn->query($sql);

        // Display available rooms and delete button for each room
        if ($result->num_rows > 0) {
            echo "<h2>Available Rooms</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "Room ID: " . $row["room_id"] . " - Capacity: " . $row["capacity"];
                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
                echo "<input type='hidden' name='room_id' value='" . $row["room_id"] . "'>";
                echo "<button type='submit' name='delete_room'>Delete</button>";
                echo "</form>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "No rooms available.";
        }

        // Process room deletion
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
