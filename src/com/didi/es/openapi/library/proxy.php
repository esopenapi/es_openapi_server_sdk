<?php
namespace Src\Com\Didi\Es\Openapi\Library;

if (! defined('DIDI_ES_OPENAPI_SDK_MK')) exit('No direct script access allowed');

/**
 * 请求代理类
 * 单例模式
 * @author Mr.Nobody
 *        
 */
class Proxy
{

    /**
     * 类实例
     *
     * @var Log
     */
    private static $_instance = NULL;
    
    /**
     * GET 请求
     * @var string
     */
    const HTTP_REQUEST_METHOD_GET = 'GET';
    
    /**
     * POST 请求
     * @var string
     */
    const HTTP_REQUEST_METHOD_POST = 'POST';

    /**
     * 构造方法
     */
    private function __construct()
    {
        global $didi_es_openapi_sdk_config;
        
        $this->_config = $didi_es_openapi_sdk_config['client'];
        $this->_host   = $didi_es_openapi_sdk_config['curl']['host'];
        $this->_log    = Log::getInstance();
    }

    /**
     * 获取单例
     */
    public static function getInstance()
    {
        if (! self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 代理http请求
     * 
     * @param string    $uri
     * @param array     $params
     * @param string    $method
     * @param number    $connectTimeout 连接超时毫秒数
     * @param number    $excuteTimeout  执行超时毫秒数
     * @return array
     */
    public function request($uri, Array $params = array(), 
        $method = self::HTTP_REQUEST_METHOD_GET, $connectTimeout = 500, $excuteTimeout = 1000)
    {
        
        // 取请求地址
        if ('/' == substr($uri, 0, 1)) {
            $uri = substr($uri, 1);
        }
        $url = $this->_host . $uri;
        
        // 添加通用参数
        $params['client_id']        = $this->_config['client_id'];
        $params['timestamp']        = time();
        $params['sign']             = self::_sign($params, $this->_config['sign_key']);

        // 获取请求结果
        $result = $this->_processRequest($url, $params, $method, $connectTimeout, $excuteTimeout);
        
        return $result;        
    }
    

    /**
     * 请求处理
     *
     * @param string    $url
     * @param array     $params
     * @param number    $connectTimeout 连接超时毫秒数
     * @param number    $excuteTimeout  执行超时毫秒数
     * @return array
     */
    private function _processRequest($url, $params = array(), 
        $httpMethod = self::HTTP_REQUEST_METHOD_GET, $connectTimeout = 500, $excuteTimeout = 1000)
    {
         
        // http 请求
        if (self::HTTP_REQUEST_METHOD_GET == $httpMethod || self::HTTP_REQUEST_METHOD_GET == strtoupper($httpMethod)) {
            $result = Curl::curlGet($url, $params, array(), $connectTimeout, $excuteTimeout);
        } else {
            $result = Curl::curlPost($url, $params, array(), $connectTimeout, $excuteTimeout);
        }
    
        $loginfo = array(
            "url" => $url,
            "method" => $httpMethod,
            "params" => $params,
            "result" => $result
        );
        
        // 网络异常
        if ($result === FALSE) {
            $this->_log->logMsg($loginfo, 'FATAL', 'proxy_result_false');
            return FALSE;
        }
    
        // 返回值非json格式
        $resArray = json_decode($result, TRUE);
        if (! is_array($resArray)) {
            $loginfo['type'] = 'proxy_result_is_not_json';
            $this->_log->logMsg($loginfo, 'FATAL', 'proxy_result_is_not_json');
            return array();
        }
    
        // 请求返回错误
        if (isset($resArray['errno']) && $resArray['errno'] != 0) {
            $this->_log->logMsg($loginfo, 'WARNING', 'proxy_result_errno_is_not_0');
            return $resArray;
        }

        // 请求成功
        $this->_log->logMsg($loginfo, 'TRACE', 'proxy_result_success');
    
        return $resArray;
    }
    
    /**
     * 生成签名串
     *
     * @param array $params 参数数组
     * @param string $encryptMethod 加密算法
     * @return string
     */
    private static function _sign($params, $appkey, $encryptMethod = 'md5')
    {
        $params['sign_key'] = $appkey;
        ksort($params);
        $str = '';
        foreach ($params as $k => $v) {
            if ('' == $str) {
                $str .= $k . '=' . trim($v);
            } else {
                $str .= '&' . $k . '=' . trim($v);
            }
        }
        return $encryptMethod($str);
    }
    
    
} 
