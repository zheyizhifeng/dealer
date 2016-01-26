<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/9
 * Time: 23:24
 */
header("Content-type: text/html; charset=utf-8");

require_once "rank_api.php";
require_once "../market/market_api.php";
require_once "../db/db_helper.php";


$connection = dbConnect();
if(need_refresh_rank($connection) == 1){
    load_market($connection);
    load_rank_lists($connection);
    set_last_refresh($connection);
}else{

}




$res = mysqli_query($connection, "SELECT * FROM rank LIMIT 0, 8");
$arr = array();
for($i = 0;$i < 8;$i++){
    $row = mysqli_fetch_array($res);
    $name = $row['name'];
    $money = $row['cur_wealth'];
    $ratio = $row['ratio'];
    $a = array('name'=>($name),'money'=>($money),'ratio'=>($ratio));
    array_push($arr, $a);
}
$res = mysqli_query($connection, "SELECT * FROM rank_ratio LIMIT 0, 8");
for($i = 0;$i < 8;$i++){
    $row = mysqli_fetch_array($res);
    $name = $row['name'];
    $money = $row['cur_wealth'];
    $ratio = $row['ratio'];
    $a = array('name'=>($name),'money'=>($money),'ratio'=>($ratio));
    array_push($arr, $a);
}
$ret = json_encode($arr, JSON_UNESCAPED_UNICODE);

echo $ret;