<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/9
 * Time: 23:30
 */

require_once '../db/test_config.php';
require_once '../system/arguments.php';
require_once '../system/refresh.php';

//require_once '../system/debug.php';
require_once '../system/debug_off.php';

//generate or load a list of goods with events and location information
function load_market(mysqli $conn){
    clear_market($conn);
    //calculate elementary price of each goods
    //for each places
    $places = PLACES_COUNT;
    for($i = 1;$i <= $places;$i++){
//        INSERT INTO `market`(`id`, `name`, `price`, `place_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
        $res_goods_here = mysqli_query($conn, "SELECT * FROM ".GOODS_TABLE." WHERE place_id = $i");

        //print_sql("SELECT * FROM ".GOODS_TABLE." WHERE place_id = $i");
        //print_query_result("place(id = $i) goods list",   $res_goods_here);

        $goods_here_count = mysqli_num_rows($res_goods_here);
        for($j = 0;$j < $goods_here_count;$j++) {
            $goods_here = mysqli_fetch_array($res_goods_here);
            $price = round($goods_here['price']);
            $name = $goods_here['name'];
            $id = $goods_here['goods_id'];
            $min_price = $price * $goods_here['fluctu_min'];
            $max_price = $price * $goods_here['fluctu_max'];
            $price = mt_rand($min_price, $max_price);

            mysqli_query($conn, "INSERT INTO `market`(`id`, `name`, `price`, `place_id`, `goods_id`) VALUES ($j + $i, '$name', $price, $i, $id )");

            print_var("name", $name);
            print_sql("INSERT INTO `market`(`id`, `name`, `price`, `place_id`) VALUES ($j + $i, '$name', $price, $i )");
        }

    }

}

function clear_market($conn){
    mysqli_query($conn, "DELETE FROM ".MARKET_TABLE);
}

function need_refresh($conn){
    $res = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM status"));
    date_default_timezone_set('PRC');

    if((time() - strtotime($res['last_refresh'])) > 60) {
        //echo "test:".(time() - strtotime($res['last_refresh']));
        return 1;
    }else{
        return 0;
    }
}