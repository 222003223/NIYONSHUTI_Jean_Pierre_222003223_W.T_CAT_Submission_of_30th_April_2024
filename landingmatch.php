<?php
session_start();

// Connect to database (replace dbname, username, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Assuming $connection is your database connection

    // Sanitize input data
    $match_date = htmlspecialchars($_POST['match_date']);
    $home_club = htmlspecialchars($_POST['home_club']);
    $away_club = htmlspecialchars($_POST['away_club']);
    $referee_names = htmlspecialchars($_POST['referee_names']);

    // Prepare SQL statement with placeholders
    $sql = "INSERT INTO matchs (match_date, home_club, away_club, referee_names) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters to statement
    $stmt->bind_param("ssss", $match_date, $home_club, $away_club, $referee_names);

    // Execute statement
    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}//niyonshuti jean pierre 2222003223 on 10th april 2024

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Validate input data
    $id = $_POST['match_id'];
    $newmatch_date = $_POST['newmatch_date'];
    $newhome_club = $_POST['newhome_club'];
    $newaway_club = $_POST['newaway_club'];
    $newreferee_names = $_POST['newreferee_names'];

    // Assuming $connection is your database connection object

    // Prepare SQL statement with placeholders
    $sql = "UPDATE matchs SET match_date=?, home_club=?, away_club=?, referee_names=? WHERE match_id=?";
    $stmt = $connection->prepare($sql);

    // Bind parameters to statement
    $stmt->bind_param("ssssi", $newmatch_date, $newhome_club, $newaway_club, $newreferee_names, $id);

    // Execute statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['match_id'];

    $sql = "DELETE FROM matchs WHERE match_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains match_id
    $id = $_POST['match_id'];

    // Select match's information from the database
    $sql = "SELECT * FROM matchs WHERE match_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display match information
        $row = $result->fetch_assoc();
        echo "Match_id: " . $row["match_id"] . "<br>";
        echo "Home_club: " . $row["home_club"] . "<br>";
        echo "Match_date: " . $row["match_date"] . "<br>";
        echo "Away_club: " . $row["away_club"] . "<br>";
        echo "Referee_names: " . $row["referee_names"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}
?>
