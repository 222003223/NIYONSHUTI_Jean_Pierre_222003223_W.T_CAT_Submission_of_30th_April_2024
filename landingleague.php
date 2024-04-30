<?php
session_start();
//niyonshuti jean pierre 2222003223 on 16th april 2024
// Connect to database (replace dbleague_name, userleague_name, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $league_name = $_POST['league_name'];
    $country = $_POST['country'];
    $season = $_POST['season'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $number_club = $_POST['number_club'];
     $sql ="INSERT INTO league (league_name,country,season,start_date,end_date,number_club) VALUES ('$league_name','$country','$season','$start_date','$end_date','$number_club')";
    $stmt = $connection->prepare($sql);
   if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['league_id'];
    $newleague_name = $_POST['newleague_name'];
    $newcountry = $_POST['newcountry'];
    $newseason = $_POST['newseason'];
    $newstart_date = $_POST['newstart_date'];
    $newend_date = $_POST['newend_date'];
    $newnumber_club = $_POST['newnumber_club'];
    $sql = "UPDATE league SET league_name='$newleague_name', country='$newcountry', season='$newseason', start_date='$newstart_date', end_date='$newend_date', number_club='$newnumber_club' WHERE league_id='$id'";
    $stmt = $connection->prepare($sql);
    //$stmt->bind_param("ssssssi", $newleague_name, $newcountry, $newleague, $newstart_date, $newleague_id,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['league_id'];

    $sql = "DELETE FROM league WHERE league_id=$id";
    $stmt = $connection->prepare($sql);
    //$stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains league_id
    $id = $_POST['league_id'];

    // Select bank's information from the database
    $sql = "SELECT * FROM league WHERE league_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display bank information
        $row = $result->fetch_assoc();
        echo "League_id: " . $row["league_id"] . "<br>";
          echo "League_name: " . $row["league_name"] . "<br>";
        echo "Country: " . $row["country"] . "<br>";
        echo "Season: " . $row["season"] . "<br>";
        echo "Start_date: " . $row["start_date"] . "<br>";
        echo "End_date: " . $row["end_date"] . "<br>";
         echo "Number_club: " . $row["number_club"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}


