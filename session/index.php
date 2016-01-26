<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/7
 * Time: 16:25
 */


if($_GET && $_GET['err']){
    echo "user/password not match, try log in again";
}

if(!empty($_COOKIE)){

    header("Location:logged.php");
}
?>





<form action="logged.php" method="post">
    <div>Username:
        <input type="text" name="username">
    </div>
    <div>Password:
        <input type="password" name="password">
    </div>
    <div>Login:
        <input type="submit" name="Login">
    </div>

</form>