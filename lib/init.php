<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: init.php 2012-5-7  $
 */

// 设置时区
date_default_timezone_set('Asia/Shanghai');

// 路径初始化，网站的绝对路径，用于载入文件
defined('PATH_ROOT') || define('PATH_ROOT', rtrim(strtr(__FILE__, array('\\' => '/' , '/lib/init.php' => '' , '\lib\init.php' => '', '//' => '/')), '/'));

//防止变量覆盖
foreach($_REQUEST as $_k=>$_v)
{
    if( strlen($_k)>0 && preg_match('/^(cfg_|GLOBALS)/i', $_k) )
    {
        exit('Request var not allow!');
    }
}

// 错误控制
define('DEBUG_LEVEL', true);
if (defined('DEBUG_LEVEL') && DEBUG_LEVEL == true) {
	error_reporting(E_ALL ^ E_NOTICE);
} else {
	error_reporting(0);
}

// 自动转义
if (! get_magic_quotes_gpc() && @function_exists(auto_addslashes)) 
{
	auto_addslashes($_POST);
	auto_addslashes($_GET);
	auto_addslashes($_COOKIE);
	auto_addslashes($_REQUEST);
}

// 脚本执行错误日志
ini_set('error_log', PATH_ROOT.'/data/log/php_error.log');
ini_set('log_errors', '1');
ini_set('memory_limit', '32M');

// 认证字符串
defined('AUTH_KEY') || define('AUTH_KEY', '96335_cms');

// 静态 HTML
(empty($_SERVER['PHP_SELF'])) && $_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'];
$path_info = pathinfo($_SERVER['PHP_SELF']);
$path_x = rtrim(strtr(dirname($path_info['dirname']), array('\\' => '/')), '/');
defined('HOST') || define('HOST', 'http://' . $_SERVER['HTTP_HOST']);
defined('URL') || define('URL', 'http://' . $_SERVER['HTTP_HOST'] . $path_x);
defined('STATIC_HTML') || define('STATIC_HTML', "/html");
defined('URL_HTML') || define('URL_HTML', rtrim(URL . STATIC_HTML, '/'));

// 加载常量及函数库
require 'constants.php';
require 'database.php';
require 'db.php';
require PATH_PLUGIN . '/smarty/Smarty.class.php';
require 'template.php';
require 'functions.php';
