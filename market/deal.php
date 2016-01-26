<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/7
 * Time: 17:14
 */

require_once '../db/db_helper.php';
require_once '../storage/store.php';

//

//

//deal.php?gid=1&n=-3

//only for debugging
//test user

if(empty($_COOKIE)) {
    echo "empty cookie.</br>";
    setcookie("uid", 1, 0, "/");
}
//user identification
//TODO
if(empty($_COOKIE)){
   echo "No user has logged in.";
}
if(!empty($_COOKIE)){
    $uid = $_COOKIE['uid'];
}

if(!empty($_GET)){
    $gid = $_GET['gid'];
    $n = $_GET['n'];
}

//arguments identification
if($_GET && $gid && $n){
    //PREVENT SQL INJECTION
    if(is_int((int)$uid) && is_int((int)$gid) && is_int((int)$n)){
        $conn = dbConnect();
        //selling
        if($n < 0){
            $count = get_user_goods_count($conn, $uid, $gid);
            //check whether the user has enough goods
            if($count >= ($n * -1)){
                if($count == ($n * -1)){
                    $sql = "DELETE FROM `storage` WHERE user_id = $uid AND goods_id = $gid";
//                    echo $sql."</br>";
                    mysqli_query($conn, $sql);
                }else{
                    $goods_left = $count + $n;
                    $sql = "UPDATE `storage` SET goods_num=$goods_left WHERE user_id = $uid AND goods_id = $gid";
//                    echo $sql."</br>";
                    mysqli_query($conn, $sql);
                }
            }else{
                //no enough goods to sell

            }
        }else{
        //buying
            $store_left = get_user_storage_left($conn, $uid);
            if($n > $store_left){
                //no enough room for this deal

            }else{
                //change 2 tables : 1.storage 2.user
//                $goods_num = $n +
//                $sql = "UPDATE `storage` SET goods_num=$goods_left WHERE user_id = $uid AND goods_id = $gid";
//                echo $sql."</br>";
//                mysqli_query($conn, $sql);
            }
        }


    }else{
        //BAD VALUE
    }
}else{
    //BAD VALUE
}

//SHOULD JUMP TO HOME PAGE HERE
//TODO
//header("Location:../index.html");