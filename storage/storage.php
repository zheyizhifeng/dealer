<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/9
 * Time: 21:34
 */

require_once '../db/db_helper.php';

if(empty($_COOKIE)){
    echo "No user has logged in.";
}
if(!empty($_COOKIE)) {
    $uid = $_COOKIE['uid'];
    $conn = dbConnect();
    $res = mysqli_query($conn, "SELECT * FROM ".STORAGE_TABLE." WHERE user_id = $uid");
    $n = mysqli_num_rows($res);
    if($n > 0){
        $arr = array();
        for($i = 0;$i < $n;$i++){
            $row = mysqli_fetch_array($res);
            $goods_name = $row['goods_name'];
            $goods_num = $row['goods_num'];
            $goods_id = $row['goods_id'];
            $a = array('goods_name'=>($goods_name),'goods_num'=>($goods_num),'goods_id'=>($goods_id));
            array_push($arr, $a);
        }
        $ret = json_encode($arr, JSON_UNESCAPED_UNICODE);

        echo $ret;
    }
}