<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/7
 * Time: 19:54
 */

require_once '../db/db_helper.php';

/**
 * generate the current events and saved into current_events table
 *
 *
 * @param	conn mysqli a connecting mysql connection
 * @return null
 */
function events_generator($conn){
    if($conn == null){
        echo "ERROR:events_generator() got a null mysql connection.";
    }else{
        clear_current_events($conn);

        $event_total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ".EVENTS_TABLE));
        $event_count = mt_rand(1, 3);
        $count = 0;

        //echo "events num: $event_total </br> events count: $event_count</br>";

        for($i = 0;$i < $event_count;$i++){
            $events[$count++] = mt_rand(1, $event_total);
        }
        for($i = 0;$i < $event_count;$i++){
            $sql_check = "SELECT * FROM ".CURRENT_EVENTS_TABLE." WHERE event_id = $events[$i]";
            //echo $sql_check;

            $check = mysqli_query($conn, $sql_check);
            $is_empty = mysqli_num_rows($check);
            //print_r($is_empty);

            if($is_empty == 0){
                //echo "insert event_id = $events[$i]</br>";
                $res = mysqli_query($conn, "SELECT description from ".EVENTS_TABLE." WHERE id = $events[$i]");
                $res_arr = mysqli_fetch_array($res);
                //echo "</br>Current event: ".$res_arr['description']."</br>";
                $content = $res_arr['description'];
                $sql_insert = "INSERT INTO ".CURRENT_EVENTS_TABLE." VALUES ($i, '$content', $events[$i])";
                //echo "insert sql: $sql_insert</br>";
                mysqli_query($conn, $sql_insert);
                //mysqli_query($conn, "INSERT INTO ".CURRENT_EVENTS_TABLE." VALUES (NULL, )")
            }
        }
    }
}

function clear_current_events($conn){
    if($conn == null){
        echo "ERROR:clear_current_events() got a null mysql connection.";
    }else {
        mysqli_query($conn, "DELETE FROM ".CURRENT_EVENTS_TABLE);
    }
}