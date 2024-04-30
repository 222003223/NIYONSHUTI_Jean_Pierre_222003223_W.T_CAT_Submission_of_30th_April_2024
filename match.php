<?php
// Include the database connection file
require_once "databaseconnection.php";

// Perform SELECT query to retrieve data
$sql = "SELECT * FROM matchs";
$result = $connection->query($sql);
//niyonshuti jean pierre 2222003223 on 16th april 2024
// Check if any rows are returned
if ($result->num_rows > 0) {
    // Output data in a table format
    echo "<h2>Match Information</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Match_id</th>
    <th>Match_date</th>
    <th>Home_club</th>
    <th>Away_club</th>
    <th>Referee_names</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["match_id"] . "</td>";
        echo "<td>" . $row["match_date"] . "</td>";
        echo "<td>" . $row["home_club"] . "</td>";
        echo "<td>" . $row["away_club"] . "</td>";
        echo "<td>" . $row["referee_names"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

// Close the database connection
$connection->close();
?>
