<?php
session_start();
//niyonshuti jean pierre 2222003223 on 14th april 2024
// Connect to database (replace dbname, username, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $stadium_name = $_POST['stadium_name'];
    $capacity = $_POST['capacity'];
    $club_id = $_POST['club_id'];

    $sql = "INSERT INTO stadium (stadium_name, capacity, club_id) VALUES ( ?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $stadium_name, $capacity, $club_id);
    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['stadium_id'];
    $newstadium_name = $_POST['newstadium_name'];
    $newcapacity = $_POST['newcapacity'];
    $newclub_id = $_POST['newclub_id'];

    $sql = "UPDATE stadium SET  stadium_name=?, capacity=?, club_id=? WHERE stadium_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssii", $newstadium_name, $newcapacity, $newclub_id, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['stadium_id'];

    $sql = "DELETE FROM stadium WHERE stadium_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains stadium_id
    $id = $_POST['stadium_id'];

    // Select stadium's information from the database
    $sql = "SELECT * FROM stadium WHERE stadium_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display stadium information
        $row = $result->fetch_assoc();
        echo "stadium_id: " . $row["stadium_id"] . "<br>";
        echo "First Name: " . $row["stadium_name"] . "<br>";
        echo "capacity: " . $row["capacity"] . "<br>";
        echo "stadium ID: " . $row["club_id"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}
?>
