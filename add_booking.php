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
        <form action="add_booking.php" method="post">
            <label for="room_id">Room ID:</label>
            <input type="text" id="room_id" name="room_id" required>
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" required>
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required>
            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required>
            <button type="submit">Add Booking</button>
        </form>
    </div>
</body>
</html>
<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $booking_date = $_POST["booking_date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    // Validate input data
    if (empty($room_id) || empty($booking_date) || empty($start_time) || empty($end_time)) {
        echo "Please fill out all fields.";
    } else {
        // Check for overlapping bookings
        $sql = "SELECT * FROM bookings WHERE room_id=$room_id AND booking_date='$booking_date' AND ((start_time <= '$start_time' AND end_time >= '$start_time') OR (start_time <= '$end_time' AND end_time >= '$end_time'))";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "Error: Room is already booked for the selected date and time slot.";
        } else {
            // Insert new booking into database
            $sql = "INSERT INTO bookings (room_id, booking_date, start_time, end_time) VALUES ($room_id, '$booking_date', '$start_time', '$end_time')";
            if ($conn->query($sql) === TRUE) {
                echo "New booking added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>

