<?php
namespace Src\Com\Didi\Es\Openapi\Library;

if (! defined('DIDI_ES_OPENAPI_SDK_MK')) exit('No direct script access allowed');

/**
 * 一个简单的curl类
 * 封装了get、post请求
 * 
 * @author Mr.Nobody
 */
class Curl
{

    /**
     * get 请求
     *
     * @param string $url            
     * @param array $data            
     * @param array $header            
     * @param number $connect_timeout            
     * @param number $excute_timeout            
     * @return boolean|mixed
     */
    public static function curlGet($url, Array $data = array(), Array $header = array(), $connect_timeout = 500, $excute_timeout = 1000)
    {
        $ch = curl_init();
        if (! empty($data)) {
            $data = is_array($data) ? http_build_query($data) : $data;
            $url .= (strpos($url, '?') ? '&' : "?") . $data;
        }
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $connect_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $excute_timeout);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
        if ($connect_timeout <= 1000 || $excute_timeout <= 1000) {
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        }
        $result = curl_exec($ch);
        if (0 != curl_errno($ch)) {
            return false;
        }
        curl_close($ch);
        return $result;
    }

    /**
     * post 请求
     *
     * @param string $url
     * @param array $data
     * @param array $header
     * @param number $connect_timeout
     * @param number $excute_timeout
     * @return boolean|mixed
     */
    public static function curlPost($url, Array $data = array(), Array $header = array(), $connect_timeout = 500, $excute_timeout = 1000)
    {
        $ch = curl_init();
        $data_str = is_array($data) ? http_build_query($data) : $data;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $connect_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $excute_timeout);
        ! empty($header) && curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_str);
        
        if ($connect_timeout <= 1000 || $excute_timeout <= 1000) {
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        }
        
        $result = curl_exec($ch);
        if (0 != curl_errno($ch)) {
            return false;
        }
        curl_close($ch);
        
        return $result;
    }
}
