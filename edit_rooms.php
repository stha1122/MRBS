<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rooms</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Rooms</h1>

        <?php
        session_start();
        include 'db_connect.php';

        // Check if admin is logged in, redirect to login page if not
        if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
            header("Location: manager_login.php");
            exit();
        }

        // Fetch existing rooms from the database
        $sql = "SELECT * FROM meeting_rooms";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display a table with existing rooms and edit buttons
            echo "<table border='1'>";
            echo "<tr><th>Room ID</th><th>Capacity</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["room_id"] . "</td>";
                echo "<td>" . $row["capacity"] . "</td>";
                echo "<td><a href='edit_room.php?room_id=" . $row["room_id"] . "'>Edit</a></td>"; // Edit button links to edit_room.php with room_id parameter
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No meeting rooms found.";
        }

        $conn->close();
        ?>

        <br>
        <a href="admin_dashboard.php">Back to Admin Dashboard</a> <!-- Link back to admin dashboard -->
    </div>
</body>
</html>

