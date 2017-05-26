<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        echo '<h1>Title h1</h1>';
        return $this->shownInSite(input('get.time'));
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    private function shownInSite($current_time_hour){

        $num_online = 3;
        //sets timezone :china
        if (date_default_timezone_set('Asia/Shanghai'))
        {

        }

        if (3<$current_time_hour && $current_time_hour < 8)
        {
            return 5 + $num_online;
        }
        elseif (8<=$current_time_hour && $current_time_hour < 12)
        {
            return 13 + 100 * sin(0.8 * ($current_time_hour - 7) * pi()/6) + $num_online * 3;
        }
        elseif (12<=$current_time_hour && $current_time_hour < 14)
        {
            return 13 + 50 * sin(0.8 * ($current_time_hour - 11) * pi()/2) + $num_online * 3;
        }
        elseif (14<=$current_time_hour && $current_time_hour < 18)
        {
            return 13 + 150 * sin(0.8 * ($current_time_hour - 13) * pi()/5) + $num_online * 3;
        }
        elseif (18<=$current_time_hour && $current_time_hour < 21)
        {
            return 13 + 80 * sin(0.8 * ($current_time_hour - 17) * pi()/3) + $num_online * 3;
        }
        //returns a number between 1 and 13
        else{
            $arr = range(1,13);
            shuffle($arr);
            return $arr[1] + $num_online;
        }
    }
}
