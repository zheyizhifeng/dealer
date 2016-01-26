<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/9
 * Time: 23:41
 */

require_once "../db/db_helper.php";

function load_rank_lists($conn){
    mysqli_query($conn, "DELETE FROM rank");
    mysqli_query($conn, "INSERT INTO rank(id, pre_wealth, cur_wealth, name)
     SELECT users.id, users.pre_wealth, users.cur_wealth, users.name FROM users
     ORDER BY users.cur_wealth DESC LIMIT 0, 5");
    mysqli_query($conn, "UPDATE rank SET ratio = (rank.cur_wealth - rank.pre_wealth)/rank.pre_wealth WHERE 1");
    mysqli_query($conn, "DELETE FROM rank_ratio;");
    mysqli_query($conn, "INSERT INTO rank_ratio(id, name, ratio, cur_wealth)
     SELECT users.id, users.name, (users.cur_wealth - users.pre_wealth) / users.pre_wealth AS GRADE, users.cur_wealth FROM users
          ORDER BY GRADE DESC LIMIT 0, 5");
//    mysqli_query($conn, "");
}

function need_refresh_rank($conn){
    $res = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM status"));
    date_default_timezone_set('PRC');

    if((time() - strtotime($res['last_refresh'])) > 60) {
        return 1;
    }else{
        return 0;
    }
}