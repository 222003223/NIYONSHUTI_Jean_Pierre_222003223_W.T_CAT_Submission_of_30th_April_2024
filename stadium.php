<?php
// Include the database connection file
require_once "databaseconnection.php";
//niyonshuti jean pierre 2222003223 on 11th april 2024
// Perform SELECT query to retrieve data
$sql = "SELECT * FROM stadium";
$result = $connection->query($sql);

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Output data in a table format
    echo "<h2>stadium Information</h2>";
    echo "<table border='1'>";
    echo "<tr><th>User ID</th>
    <th>Stadium Name</th>
    <th>capacity</th>
    <th>Club ID</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["studium_id"] . "</td>";
        echo "<td>" . $row["studium_name"] . "</td>";
        echo "<td>" . $row["capacity"] . "</td>";
        echo "<td>" . $row["club_id"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

// Close the database connection
$connection->close();
?>
