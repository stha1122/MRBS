<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $room_id = $_POST["room_id"];
    $booking_date = $_POST["booking_date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    // Validate input data
    if (empty($room_id) || empty($booking_date) || empty($start_time) || empty($end_time)) {
        echo "Please fill out all fields.";
    } else {
        // Check for overlapping bookings
        $sql = "SELECT * FROM bookings WHERE room_id=$room_id AND booking_date='$booking_date' AND ((start_time <= '$start_time' AND end_time >= '$start_time') OR (start_time <= '$end_time' AND end_time >= '$end_time')) AND id != $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "Error: Room is already booked for the selected date and time slot.";
        } else {
            // Update booking details in database
            $sql = "UPDATE bookings SET room_id=$room_id, booking_date='$booking_date', start_time='$start_time', end_time='$end_time' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "Booking details updated successfully.";
            } else {
                echo "Error updating booking: " . $conn->error;
            }
        }
    }
}
?>
