<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Room</h1>

        <?php
        session_start();
        include 'db_connect.php';

        // Check if admin is logged in, redirect to login page if not
        if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
            header("Location: manager_login.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["room_id"])) {
            $room_id = $_GET["room_id"];

            // Fetch room details from the database
            $sql = "SELECT * FROM meeting_rooms WHERE room_id = '$room_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
            <label for="room_id">Room ID:</label>
            <input type="text" id="room_id" name="room_id" value="<?php echo $row['room_id']; ?>" readonly>
            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" value="<?php echo $row['capacity']; ?>" required>
            <button type="submit">Save Changes</button>
        </form>
        <?php
            } else {
                echo "Room not found.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $room_id = $_POST["room_id"];
            $capacity = $_POST["capacity"];

            // Update room capacity in the database
            $update_sql = "UPDATE meeting_rooms SET capacity = $capacity WHERE room_id = '$room_id'";
            if ($conn->query($update_sql) === TRUE) {
                echo "Room capacity updated successfully.";
            } else {
                echo "Error updating room capacity: " . $conn->error;
            }
        }
        ?>

        <br>
        <a href="edit_rooms.php">Back to Edit Rooms</a> <!-- Link back to edit rooms page -->
    </div>
</body>
</html>
