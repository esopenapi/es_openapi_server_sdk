<?php
/**
 * 本例子介绍怎么通过Request类，用post方法调用openapi接口
 * 以乘客投诉接口为例，
 * 接口文档地址 http://open.es.xiaojukeji.com/doc/openapi/common/complaint.html
 */

// 1、必须要先引入autoload.php
require_once '../autoload.php';

// 2、引入相关的Request类及命名空间
use Src\Com\Didi\Es\Openapi\Request;

// 3、传入参数：Request会帮你添加client_id、timestamp、sign，无需手动传入
// ！！！再次提醒，access_token请缓存半小时，不要每次调用接口都申请一次授权。
$params = array(
    'access_token' => 'a1ec727fc93e39ba93e52ef43a8418f1f69731b5',
    'city'         => '北京',
    'input'        => '回龙观',
    'order_id'     => '123123123123',
    'type'         => '147',
    'content'      => '测试一下'
);

// 4、请求接口，调用post方法
$result = Request::post('/v1/common/Complaint/submit', $params, 1000, 1000);

if (FALSE == $result) {
    // 发生了网络异常，或者服务不可达
    echo '发生了网络异常，或者服务不可达';
} elseif (isset($result['errno']) && 0 == $result['errno']) {
    // 请求成功
    print_r($result);
} else {
    // 请求返回错误
    print_r($result);
}






