
<?php
require_once "databaseconnection.php";

$sql = "SELECT * FROM league ";
//niyonshuti jean pierre 2222003223 on 16th april 2024
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information of league</title>";
    echo "<h1>The Information of league </h1>";
    echo "<table border='1'>
            <tr>
                <th>League_id</th>
                <th>League_name</th>
                <th>Country</th>
                <th>Season</th>
                <th>Start_date</th>
                <th>End_date</th>
                <th>Number_club</th>
            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["league_id"] . "</td>";
        echo "<td>" . $row["league_name"] . "</td>";
        echo "<td>" . $row["country"] . "</td>";
        echo "<td>" . $row["season"] . "</td>";
        echo "<td>" . $row["start_date"] . "</td>";
        echo "<td>" . $row["end_date"] . "</td>";
        echo "<td>" . $row["number_club"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$connection->close();
?>
