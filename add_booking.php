<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Booking</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required>
            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required>
            <button type="submit" name="submit">Check Availability</button>
        </form>

        <?php
        include 'db_connect.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $booking_date = $_POST["date"];
            $start_time = $_POST["start_time"];
            $end_time = $_POST["end_time"];

            // Check for available rooms
            $sql = "SELECT * FROM meeting_rooms WHERE room_id NOT IN (
                SELECT room_id FROM bookings 
                WHERE booking_date = '$booking_date' 
                AND ((start_time < '$end_time' AND end_time > '$start_time') 
                OR (start_time <= '$start_time' AND end_time >= '$end_time'))
            )";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display available rooms with a form to book a room
                echo "<h2>Available Meeting Rooms</h2>";
                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
                echo "<input type='hidden' name='booking_date' value='$booking_date'>";
                echo "<input type='hidden' name='start_time' value='$start_time'>";
                echo "<input type='hidden' name='end_time' value='$end_time'>";
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Room ID</th><th>Capacity</th><th>Action</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["room_id"] . "</td>";
                    echo "<td>" . $row["capacity"] . "</td>"; // Displaying capacity
                    echo "<td><button type='submit' name='room_id' value='" . $row["room_id"] . "'>Book</button></td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</form>";
            } else {
                echo "No available meeting rooms for the selected date and time slot.";
            }
        }

        // Process the booking when a room is selected
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_id'])) {
            $room_id = $_POST["room_id"];
            $booking_date = $_POST["booking_date"];
            $start_time = $_POST["start_time"];
            $end_time = $_POST["end_time"];

            // Insert the booking into the database
            $insert_sql = "INSERT INTO bookings (room_id, booking_date, start_time, end_time) VALUES ('$room_id', '$booking_date', '$start_time', '$end_time')";
            if ($conn->query($insert_sql) === TRUE) {
                echo "Booking successful.";
            } else {
                echo "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        }
        ?>
    </div>
</body>
</html>
