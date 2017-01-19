<?php
namespace Src\Com\Didi\Es\Openapi;

if (! defined('DIDI_ES_OPENAPI_SDK_MK')) exit('No direct script access allowed');

use Src\Com\Didi\Es\Openapi\Library\Proxy;
/**
 * 请求类
 *
 * @author Mr.Nobody
 *        
 */
class Request
{

    /**
     *  get 请求
     * @param string $uri               接口uri
     * @param array  $params            参数数组         
     * @param number $connectTimeout    连接超时时间毫秒数
     * @param number $excuteTimeout     执行超时时间毫秒数
     */
    public static function get($uri, Array $params = array(), $connectTimeout = 1000, $excuteTimeout = 1000) 
    {
        $proxy = Proxy::getInstance();
        return $proxy->request($uri, $params, Proxy::HTTP_REQUEST_METHOD_GET, $connectTimeout, $excuteTimeout);
    }

    
    /**
     *  post 请求
     * @param string $uri               接口uri
     * @param array  $params            参数数组         
     * @param number $connectTimeout    连接超时时间毫秒数
     * @param number $excuteTimeout     执行超时时间毫秒数
     */
    public static function post($uri, Array $params = array(), $connectTimeout = 1000, $excuteTimeout = 1000) 
    {
        $proxy = Proxy::getInstance();
        return $proxy->request($uri, $params, Proxy::HTTP_REQUEST_METHOD_POST, $connectTimeout, $excuteTimeout);
    }
    
    
} 
