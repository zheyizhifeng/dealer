<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/8
 * Time: 11:13
 */

require_once '../db/db_helper.php';

function print_table($table){
    echo "</br> $table: </br>";
    $conn = dbConnect();

    $res = mysqli_query($conn, "SELECT * FROM $table");
    $n = mysqli_num_rows($res);
    for($i = 0;$i < $n;$i++){
        $content = mysqli_fetch_array($res);
        print_r($content);
        echo "</br>";
    }
}

function print_query_result($info, $res){
    echo "</br>$info:</br>";

    $n = mysqli_num_rows($res);
    echo "Count:$n</br>";
    for($i = 0;$i < $n;$i++) {
        $row = mysqli_fetch_array($res);
        print_r($row);
        echo "</br>";
    }
}

function print_sql($sql){
    echo "</br>$sql</br>";
}

function print_var($name, $var){
    echo "$name:";
    print_r($var);

    echo "</br>";
}