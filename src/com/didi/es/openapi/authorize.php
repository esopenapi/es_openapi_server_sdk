<?php
namespace Src\Com\Didi\Es\Openapi;

if (! defined('DIDI_ES_OPENAPI_SDK_MK')) exit('No direct script access allowed');

use Src\Com\Didi\Es\Openapi\Library\Proxy;
/**
 * 请求代理类
 *
 * @author Mr.Nobody
 *        
 */
class Authorize
{

    /**
     * 获取叫车类接口授权
     * 
     * @return array
     */
    public static function callCar() 
    {
        $proxy = Proxy::getInstance();
        
        global $didi_es_openapi_sdk_config;
        $params = array(
            'grant_type'    => $didi_es_openapi_sdk_config['client']['grant_type'],
            'phone'         => $didi_es_openapi_sdk_config['client']['phone'],
            'client_secret' => $didi_es_openapi_sdk_config['client']['client_secret'],
        );
        
        $authInfo = $proxy->request('/v1/Auth/authorize', $params, Proxy::HTTP_REQUEST_METHOD_POST);
        return $authInfo;
    }
    

    /**
     * 获取管理类接口授权
     * 
     * @return array
     */
    public static function river()
    {
        $proxy = Proxy::getInstance();
    
        global $didi_es_openapi_sdk_config;
        $params = array(
            'grant_type'    => $didi_es_openapi_sdk_config['client']['grant_type'],
            'phone'         => $didi_es_openapi_sdk_config['client']['phone'],
            'client_secret' => $didi_es_openapi_sdk_config['client']['client_secret'],
        );
    
        $authInfo = $proxy->request('/river/Auth/authorize', $params, Proxy::HTTP_REQUEST_METHOD_POST);
        return $authInfo;
    }
} 
