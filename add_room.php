<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $capacity = $_POST["capacity"];

    // Validate input data
    if (empty($room_id) || empty($capacity)) {
        echo "Please fill out all fields.";
    } else {
        // Insert new room into database
        $sql = "INSERT INTO meeting_rooms (room_id, capacity) VALUES ('$room_id', $capacity)";
        if ($conn->query($sql) === TRUE) {
            echo "New room added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Room</h1>
        <form action="add_room.php" method="post">
            <label for="room_id">Room ID:</label>
            <input type="text" id="room_id" name="room_id" required>
            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" required>
            <button type="submit">Add Room</button>
        </form>
    </div>
</body>
</html>
