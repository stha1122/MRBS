<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Delete booking from database
    $sql = "DELETE FROM bookings WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Booking canceled successfully.";
    } else {
        echo "Error canceling booking: " . $conn->error;
    }
}
?>
