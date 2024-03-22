<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rooms</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
            <!-- PHP code to fetch and display rooms -->
            <?php
include 'db_connect.php';

// Retrieve meeting rooms from database
$sql = "SELECT * FROM meeting_rooms";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<h2>Meeting Rooms</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Room ID</th><th>Capacity</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["room_id"] . "</td>";
        echo "<td>" . $row["capacity"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No meeting rooms found.";
}

$conn->close();
?>
        <!-- </table> -->
    </div>
</body>
</html>


