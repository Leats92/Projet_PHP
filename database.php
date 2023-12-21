<?php

if (empty($_SESSION)) {
    session_start();
}

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

if ($db === false) {
    die("Connection error: " . mysqli_connect_error());
}

?>