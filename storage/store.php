<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/8
 * Time: 14:27
 */

require_once '../db/db_helper.php';

function get_user_storage_left($conn, $uid){
    $res = mysqli_query($conn, "SELECT * FROM ".USERS_TABLE." WHERE id = $uid");
    $user = mysqli_fetch_array($res);
    $left = $user['max_store'] - $user['used_store'];

    return $left;
}

function get_user_goods_count($conn, $uid, $gid){
    $res = mysqli_query($conn, "SELECT * FROM ".STORAGE_TABLE." WHERE user_id = $uid AND goods_id = $gid");
    if(mysqli_num_rows($res) == 0){
        return 0;
    }else{
        return mysqli_fetch_array($res)['goods_num'];
    }
}

//storage/store.php
//return user's storage infomation(goods_id, goods_name, goods_num)

