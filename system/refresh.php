<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/8
 * Time: 8:55
 */

function set_last_refresh($conn){
    mysqli_query($conn, "UPDATE status SET last_refresh=CURRENT_TIMESTAMP WHERE 1");
}