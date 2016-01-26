<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/4/9
 * Time: 19:48
 */

$a = -1;

echo "".is_int($a)."</br>";
echo "".is_int(0)."</br>";
echo "".is_int(+1)."</br>";
echo "".(is_int(+1) && is_int(1) && is_int($a))."</br>";
