<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/7
 * Time: 17:07
 */

require_once 'test_config.php';

function dbConnect(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($conn, DB_NAME);
    mysqli_set_charset($conn, 'utf8');

    return $conn;
}
