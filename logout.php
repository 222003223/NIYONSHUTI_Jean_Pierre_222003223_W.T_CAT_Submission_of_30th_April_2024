<?php
session_start();

// Unset all of the session variables
$_SESSION = array();
//niyonshuti jean pierre 2222003223 on 16th april 2024
// Destroy the session
session_destroy();

// Redirect to index.php
header("Location: index.html");
exit();
?>
