<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- <h1>View Bookings</h1>
        <table>
            <tr>
                <th>Room ID</th>
                <th>Booking Date</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        </table> -->

        
            <!-- PHP code to fetch and display bookings -->
            <?php
include 'db_connect.php';

// Retrieve bookings from database
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<h2>Bookings</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Room ID</th><th>Booking Date</th><th>Start Time</th><th>End Time</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["room_id"] . "</td>";
        echo "<td>" . $row["booking_date"] . "</td>";
        echo "<td>" . $row["start_time"] . "</td>";
        echo "<td>" . $row["end_time"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No bookings found.";
}

$conn->close();
?>
        
    </div>
</body>
</html>


