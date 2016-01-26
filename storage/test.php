<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/8
 * Time: 14:42
 */

require_once 'store.php';

$conn = dbConnect();
echo "User(id = 1) Storage left:".get_user_storage_left($conn, 1);
echo "</br>User(id = 1) Goods(id = 1) Count:".get_user_goods_count($conn, 1, 1);
echo "</br>User(id = 1) Goods(id = 2) Count:".get_user_goods_count($conn, 1, 2);