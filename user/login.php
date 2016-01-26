<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/9
 * Time: 21:39
 */

require_once "../db/db_helper.php";

//if no cookie saved
//1.check account/password
//2.save cookie

//type 1:login 2:sign up username:  password:
if(!empty($_POST)){
    $conn = dbConnect();
    //$email = $_POST['email'];
    $password = $_POST['password'];
    $stno = $_POST['stno'];


    if($_POST['type'] == 1){
        //login
        $res = mysqli_query($conn, "SELECT * FROM ".USERS_TABLE." WHERE stno = '$stno' AND password = '$password'");
        $n = mysqli_num_rows($res);
        $row = mysqli_fetch_array($res);
        if($n == 1){
            echo "".$row['id'];
        }else{
            echo "-1";
        }
    }else{
        //sign up
        $username = $_POST['username'];
        $res = mysqli_query($conn, "SELECT * FROM ".USERS_TABLE." WHERE stno = '$stno'");
        $n = mysqli_num_rows($res);
        if($n == 1){
            //stno already exists
            echo "-1";
        }else{
            mysqli_query($conn, "INSERT INTO users
            (name, stno, place_id, pre_wealth, cur_wealth, password, max_store, used_store)
            VALUES ('$username','$stno', 2,NULL,1200,'$password',30,0)");
            $res = mysqli_query($conn, "SELECT id FROM users WHERE stno = '$stno'");
            $row = mysqli_fetch_array($res);

            echo "".$row['id'];
        }
    }
}
//
//$conn = dbConnect();
//$res = mysqli_query($conn, "SELECT * FROM users WHERE stno = '03121392'");
//$n = mysqli_num_rows($res);
//echo "".($n == 1);