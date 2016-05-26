<?php
session_start();

//empty the session
$_SESSION = array();

//destroy the session
session_destroy();

header("Location: index.php");

?>