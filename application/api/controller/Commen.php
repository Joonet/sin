<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 17/5/2017
 * Time: 10:47
 */

$x = 9;
$y = 8;

function index(){
    $GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
}