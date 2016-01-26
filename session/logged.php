<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/7
 * Time: 16:30
 */

//session_start();
$name = $_POST['username'];
$pass = $_POST['password'];

echo $name."</br>".$pass;

if($name == "admin" && $pass == "password"){
    setcookie("USER_NAME", $name, time() +  15);
    setcookie($name, $pass, time() + 15);
    header("Location:another_page.php");
}else{
    setcookie("USER_NAME", $name, time() +  15);
    header("Location:../market/market.php");
}

