<?php

include_once ("config.php");
include_once ("database.php");


if (!isset($_SESSION["admin_name"])) {
    header('Location: login_form.php');
    exit();
}
?>