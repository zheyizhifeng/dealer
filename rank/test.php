<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/9
 * Time: 23:44
 */

require_once "rank_api.php";

echo "DELETE FROM rank;
INSERT INTO rank(id, pre_wealth, cur_wealth, name)
     SELECT users.id, users.pre_wealth, users.cur_wealth, users.name FROM users
     ORDER BY users.cur_wealth DESC LIMIT 0, 5;
UPDATE rank SET ratio = (rank.cur_wealth - rank.pre_wealth)/rank.pre_wealth WHERE 1;

DELETE FROM rank_ratio;
INSERT INTO rank_ratio(id, name, ratio, cur_wealth)
     SELECT users.id, users.name, (users.cur_wealth - users.pre_wealth) / users.pre_wealth AS GRADE, users.cur_wealth FROM users
          ORDER BY GRADE DESC LIMIT 0, 5;
";
load_rank_lists(dbConnect());