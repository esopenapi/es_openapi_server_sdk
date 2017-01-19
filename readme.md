
# 滴滴企业版openapi服务端php接入sdk

## 一、配置启动参数   
### 说明：开始使用前，请按照说明先配置 config/config.php    

## 二、封装了Authorize类，用来做访问授权（申请access_token）

### 说明：    
1、调用访问授权后，请将返回的授权信息缓存半小时，不要每次调用接口都申请一次授权    
2、缓存过期或调用服务时返回401=>access_token不合法或已过期, 请重新申请授权    
3、获取“企业用车接口”访问授权，请用Authorize::callCar方法；获取“企业管理接口”访问授权，请用Authorize::river方法    

### 使用步骤：
1、必须要先引入autoload.php，如下：  

	require_once '../autoload.php';  
	
2、引入相关的Authorize类及命名空间，如下：  
	
	use Src\Com\Didi\Es\Openapi\Authorize;  
	
3、调用callCar/river方法，如下：  

	$authInfo = Authorize::callCar();  
	
### callCar 例子程序见 test/test_authorize_callcar.php  
### river   例子程序见 test/test_authorize_river.php  

## 三、封装了Request类，用来做接口请求

### 说明：
1、方法会在参数里自动添加client_id、timestamp、sign，接入者无需传入；    
2、get请求，请调用Request::get方法; post请求，请调用Request::post方法。        

### 使用步骤：
1、必须要先引入autoload.php，如下：  

	require_once '../autoload.php';  
	
2、引入相关的Request类及命名空间，如下：  
	
	use Src\Com\Didi\Es\Openapi\Request;  
	
3、初始化必要参数（无需传入client_id、timestamp、sign），如下：  
	
	$params = array(  
		'access_token' => 'a1ec727fc93e39ba93e52ef43a8418f1f69731b5',  
		// 其它参数略  
	);  
	
4、调用get/post方法，如下：  

	$result = Request::get('/v1/common/Address/getAddress', $params, 1000, 1000); 
	 
### get例子程序见 test/test_request_get.php
### post例子程序见 test/test_request_post.php
