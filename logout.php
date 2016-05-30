<?php
session_start();

//empty the session
$_SESSION = array();

//destroy the session
session_destroy();
$messages = array();
$messages[] = "You have logged out successfully!";
$serialized_messages = serialize($messages);

header("Location: index.php?messages=$serialized_messages");

?>