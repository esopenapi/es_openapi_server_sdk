<?php
if (! defined('DIDI_ES_OPENAPI_SDK_MK')) exit('No direct script access allowed');

/**
 * 配置数组 
 */
$didi_es_openapi_sdk_config                                     = array();

/**
 * 日志相关配置
 * 建议配置:
 * NONE     如果你不希望记日志，可以配成NONE
 * NOTICE   如果你是正式环境，建议配置成NOTICE
 * TRACE    如果你是测试环境，建议配置成TRACE
 */
$didi_es_openapi_sdk_config['log']['log_level']                 = 'TRACE';

/**
 * 日志文件的路径
 * 如果你不打算记日志，请置空
 */
$didi_es_openapi_sdk_config['log']['log_path']                  = DIDI_ES_OPENAPI_SDK_PATH . '/log/didi_es_openapi_sdk.log';

/**
 * curl相关配置 
 * 如果线上环境：请用http://api.es.xiaojukeji.com/
 */
$didi_es_openapi_sdk_config['curl']['host']                     = 'http://api.es.xiaojukeji.com/';

/**
 * client相关配置
 */
$didi_es_openapi_sdk_config['client']['client_id']              = '11111';
$didi_es_openapi_sdk_config['client']['client_secret']          = '11111';
$didi_es_openapi_sdk_config['client']['sign_key']               = '11111';
$didi_es_openapi_sdk_config['client']['grant_type']             = 'client_credentials';
$didi_es_openapi_sdk_config['client']['phone']                  = '11111';






/* End of file config.php */
/* Location: config/config.php */