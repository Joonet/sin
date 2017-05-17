<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 17/5/2017
 * Time: 10:36
 */

namespace app\api\controller;

use think\Controller;
use think\Request;

class Mixed extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        define("CONSTANT", 'nidaye');

    }

    public function index(){

        echo CONSTANT;

        $dd = array('Jo','Mi',"Hua");
        sort($dd);
        print_r($dd) ;
    }

}