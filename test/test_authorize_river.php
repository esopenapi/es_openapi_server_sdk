<?php

/**
 * 本例子介绍 获取“企业管理接口”访问授权
 * 调用访问授权后，请将返回的授权信息缓存半小时，不要每次调用接口都申请一次授权。
 * 缓存过期或调用服务时返回401=>access_token不合法或已过期, 请重新申请授权。
 */ 

// 1、必须要先引入autoload.php
require_once '../autoload.php';

// 2、引入相关的Authorize类及命名空间
use Src\Com\Didi\Es\Openapi\Authorize;

// 3、取access_token
$authInfo = Authorize::river();

if (isset($authInfo['access_token'])) {
    // TODO 请将返回的access_token缓存半小时
    print($authInfo['access_token']);
} else {
    // TODO 错误处理
    print_r($authInfo);
}





