<?php
require_once "databaseconnection.php"; // Assuming this file contains database connection logic
//niyonshuti jean pierre 2222003223 on 15th april 2024

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM user_admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $uname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: Dashboard.html");
        exit();
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "Method not allowed."; // Redirect if accessed directly without POST method
}

$connection->close();
?>
