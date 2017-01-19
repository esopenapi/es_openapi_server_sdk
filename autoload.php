<?php

define('DIDI_ES_OPENAPI_SDK_MK', 'mark');
define('DIDI_ES_OPENAPI_SDK_PATH', __DIR__ . '/');

require_once DIDI_ES_OPENAPI_SDK_PATH . 'config/config.php';

// 支持匹配规则：a_b 或  a/b 或 a\b
function didi_es_openapi_sdk_autoload($class){
    
    if (function_exists('__autoload')) {
        //    Register any existing autoloader function with SPL, so we don't get any clashes
        spl_autoload_register('__autoload');
    }
    $file = preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
    
    $file = DIDI_ES_OPENAPI_SDK_PATH . strtolower($file);
    
    if (is_file($file)) {
        require $file;
    }

}
spl_autoload_register('didi_es_openapi_sdk_autoload');





