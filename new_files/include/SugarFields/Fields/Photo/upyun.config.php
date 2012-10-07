/**********************************************************************************
 * Modified for supporting UpYun
 *      https://github.com/ericshao/SugarCRM-PhotoField-UpYun
 *                          
 * Contributor(s):      eric.shao@qeemo.me
 *                      
 **********************************************************************************/
<?php
	define('YUSER','sugar');   // 又拍授权用户
	define('YPASS','sugarCRM123');    // 又拍授权密码
	define('YNAME','sugar');     // 又拍存储空间

	$upyun = new UpYun(YNAME, YUSER, YPASS);
	$upyunHost = "http://".YNAME.".b0.upaiyun.com/";
	$upyun->setApiDomain('v0.api.upyun.com');
	$bytes = $upyun->getBucketUsage();
	$kb = $bytes / 1024;
?>