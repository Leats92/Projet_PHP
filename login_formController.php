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

        $row = mysqli_fetch_array($result);

        if($row["user_type"] == 'admin') {
            
            
       $_SESSION['admin_name'] = $row['name'];  
        header('Location: admin_page.php');


        } else if($row["user_type"] == 'user') {

            $_SESSION['user_name'] = $row['name'];
            header('Location: user_page.php');

    } else {
        $error[] = 'Email ou mot de passe incorrect !';
    }
}
}

?>