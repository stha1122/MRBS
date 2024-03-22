<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $room_id = $_POST["room_id"];
    $capacity = $_POST["capacity"];

    // Validate input data
    if (empty($room_id) || empty($capacity)) {
        echo "Please fill out all fields.";
    } else {
        // Update room details in database
        $sql = "UPDATE meeting_rooms SET room_id='$room_id', capacity=$capacity WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Room details updated successfully.";
        } else {
            echo "Error updating room: " . $conn->error;
        }
    }
}
?>

