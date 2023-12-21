<?php

include_once ("config.php");
include_once ("database.php");

session_start();
session_unset();
session_destroy();
header("Location: login_form.php");

?>