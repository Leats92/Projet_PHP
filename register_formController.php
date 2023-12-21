<?php

include_once ("config.php");
include_once ("database.php");

if (isset($_POST["submit"])) {

    $name = mysqli_real_escape_string($db, $_POST["name"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $pass = md5($_POST["password"]);
    $cpass = md5($_POST["cpassword"]);
    $user_type = $_POST["user_type"];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($db, $select);

    if(mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist !';

    } else {

        if($pass != $cpass) {
            $error[] = 'password not matched !';
        } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES ('$name', '$email', '$pass', '$user_type')";
            mysqli_query($db, $insert);
            header("location: login_form.php");
        }
};
}

?>