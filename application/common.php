<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 返回合适的状态码

为每一次的响应返回合适的HTTP状态码。 好的响应应该使用如下的状态码:

200: GET请求成功，及DELETE或PATCH同步请求完成，或者PUT同步更新一个已存在的资源
201: POST 同步请求完成，或者PUT同步创建一个新的资源
202: POST，PUT，DELETE，或PATCH请求接收，将被异步处理
206: GET 请求成功，但是只返回一部分
使用身份认证（authentication）和授权（authorization）错误码时需要注意：

401 Unauthorized: 用户未认证，请求失败
403 Forbidden: 用户无权限访问该资源，请求失败
当用户请求错误时，提供合适的状态码可以提供额外的信息：

422 Unprocessable Entity: 请求被服务器正确解析，但是包含无效字段
429 Too Many Requests: 因为访问频繁，你已经被限制访问，稍后重试
500 Internal Server Error: 服务器错误，确认状态并报告问题
 */


function myJson($status, $msg, $data = ''){
    return json(array(
        'status' => $status,
        'msg'    => $msg,
        'data'   => $data,
        ));
}

function getLedColor($id) {

}

function getActionFeed($id) {

}


function getAPMById($id) {

}

function getPushFrequency($id) {

}

function getPushPattern($id) {

}

function getActionCombo($id) {

}

function getMouseHeatMap($id) {

}

function getStickHeatMap($id) {

}

function getSpringTime($id) {

}

function getLayoutPerform($id) {

}

