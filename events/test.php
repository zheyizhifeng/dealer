<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/7
 * Time: 20:41
 */


require_once '../db/db_helper.php';
require_once 'generator.php';
//test event_generator()

$conn = dbConnect();
events_generator($conn);