<?php
namespace Src\Com\Didi\Es\Openapi\Library;

if (! defined('DIDI_ES_OPENAPI_SDK_MK')) exit('No direct script access allowed');

/**
 * 日志类
 *
 * @author Mr.Nobody
 *        
 */
class Log
{
    
    /**
     * 类实例
     * 
     * @var Log
     */
    private static $_instance = NULL;

    /**
     * 日志级别
     * 
     * @var array
     */
    protected static $_LOG_LEVEL_MAP = array(
        'NONE'      => 0,
        'FATAL'     => 1,
        'ERROR'     => 2,
        'WARNING'   => 4,
        'NOTICE'    => 8,
        'TRACE'     => 16,
        'DEBUG'     => 32,
        'INFO'      => 64
    );

    /**
     * 当前日志级别
     * 
     * @var int
     */
    protected $_logLevel;

    /**
     * 日志文件
     *
     * @var Log
     */
    private $_logFile = '';
    
    /**
     * 构造方法
     */
    protected function __construct()
    {
        global $didi_es_openapi_sdk_config;
        $this->_logLevel = $didi_es_openapi_sdk_config['log']['log_level'];
        $this->_logFile  = $didi_es_openapi_sdk_config['log']['log_path'];
    }

    /**
     * 获取单例
     */
    public static function getInstance()
    {
        if (! self::$_instance) {
            self::$_instance = new Log();
        }
        return self::$_instance;
    }

    /**
     * 日志
     *
     * @param mixed $msg            
     * @param string $level          
     * @param string $mark            
     */
    public function logMsg($msg, $level, $mark = 'normal_log')
    {
        if (empty($this->_logFile)) {
            return;
        }
        
        $level = strtoupper($level);
        if (is_array($msg)) {
            $msg = json_encode($msg);
        }
        
        if (isset(self::$_LOG_LEVEL_MAP[$this->_logLevel]) && isset(self::$_LOG_LEVEL_MAP[$level]) && 
            self::$_LOG_LEVEL_MAP[$this->_logLevel] >= self::$_LOG_LEVEL_MAP[$level]) {
            
            $line = "[" . number_format(microtime(TRUE), 4, '.', '') . "]";
            $line .= "[{$level}]";
            $line .= "[{$mark}]";
            $line .= "[{$msg}]";
            $line .= "\r\n";
            
            $fp = fopen($this->_logFile, 'a');
            fwrite($fp, $line);
            fclose($fp);
        }
    }
}




