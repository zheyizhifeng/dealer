<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/8
 * Time: 11:12
 */

require_once 'market.php';
require_once '../system/debug_off.php';

$conn = dbConnect();

load_market($conn);

print_table(GOODS_TABLE);
print_table(MARKET_TABLE);

$conn = dbConnect();
$res = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM status"));
date_default_timezone_set('PRC');
echo "Last Refresh:".$res['last_refresh'];
echo "</br>Unix Time:".strtotime($res['last_refresh']);
echo "</br>Cur:".date("H:i:s", time());
echo "</br>Elapsed:".(time() - strtotime($res['last_refresh']));
echo "</br>Elapsed Minutes:".(time() - strtotime($res['last_refresh'])) / 60;
$test = need_refresh($conn) == 1 ? 'YES' : "NO";
echo "</br>Need Refresh? ".($test);