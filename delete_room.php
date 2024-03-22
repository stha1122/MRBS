<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Delete room from database
    $sql = "DELETE FROM meeting_rooms WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Room deleted successfully.";
    } else {
        echo "Error deleting room: " . $conn->error;
    }
}
?>
