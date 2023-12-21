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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: url('IMG_9880.JPG') center/cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Roboto', sans-serif;
    color: #fff;
}

.container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    padding-bottom: 60px;
}

.container .content {
    text-align: center;
}

.container .content h3 {
    font-size: 30px;
    color: #fff;
}

.container .content h3 span {
    background: rgba(66, 43, 107, 0.9);
    color: #fff;
    border-radius: 5px;
    padding: 0 15px;
}

.container .content h1 {
    font-size: 50px;
    color: #fff;
}

.container .content h1 span {
    color: #3D39AA;
}

.container .content p {
    font-size: 25px;
    margin-bottom: 20px;
    color: #fff;
}

.container .content .btn {
    display: inline-block;
    padding: 10px 30px;
    font-size: 20px;
    background: #3D39AA;
    color: #fff;
    margin: 0 5px;
    text-transform: capitalize;
}

.container .content .btn:hover {
    background: #252525;
}

.form-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    padding-bottom: 60px;
    background: url('IMG_9880.JPG') center/cover;
}

.form-container form {
    padding: 20px;
    border-radius: 5px;
    box-shadow: 2px 2px 4px gray;
    background: rgba(66, 43, 107, 0.9);
    text-align: center;
    width: clamp(400px, 50vw, 500px);
    color: #fff;
}

.form-container form h3 {
    font-size: 30px;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.form-container form input,
.form-container form select {
    width: 100%;
    padding: 10px 15px;
    font-size: 17px;
    margin: 8px 0;
    background: rgba(66, 43, 107, 0.9);
    border-radius: 5px;
    color: #fff;
}

.form-container form select option {
    background: rgba(66, 43, 107, 0.9);
}

.form-container form .form-btn {
    background: #3D39AA;
    color: #fff;
    text-transform: capitalize;
    font-size: 20px;
    cursor: pointer;
}

.form-container form .form-btn:hover {
    background: #252525;
}

.form-container form p {
    margin-top: 10px;
    font-size: 20px;
    color: #fff;
}

.form-container form p a {
    color: #EAEAEA;
}

.form-container form .error-msg {
    margin: 10px 0;
    display: block;
    background: #a51010;
    color: #fff;
    border-radius: 5px;
    font-size: 20px;
    padding: 10px;
}


</style>
</head>
<body>
  
<div class="form-container">

<form action="register_form.php" method="POST">
    <h3>Inscrivez-vous</h3>
    <?php
    if(isset($error)){
        foreach($error as $error) {

            echo '<span class="error-msg">' . $error . '</span';

    };
};
    ?>
    <input type = "text" name = "name" required placeholder="Nom d'utilisateur">
    <input type = "email" name = "email" required placeholder="Email">
    <input type = "password" name = "password" required placeholder="Mot de passe">
    <input type = "password" name = "cpassword" required placeholder="Confirmer votre mot de passe">
    <select name="user_type">
    <option value="user">utilisateur</option>
    <option value="admin">admin</option>
</select>
    <input type="submit" name = "submit" value = "S'inscrire" class = "form-btn">
    <p>Vous avez déjà un compte ?<a href = "login_form.php"> Connecter-vous</a></p>
</form>
</div>
</body>
</html>