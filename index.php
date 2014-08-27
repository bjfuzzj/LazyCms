<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: index.php 2012-5-16  $
 */
require 'lib/init.php';
require PATH_MODULE . '/register.php';

// 前台路由
function router() {
    try {
		// 模块调用参数为空时，检测静态生成设置并转向
		if (empty($_GET['c']))
		{
			$index = url::make_index();
			if ('/index.php' != $index)
			{
				header("Location:". $index);
			}
		}

		$controller = 'ctl_' . router_match($_GET['c'], 'index');
		$action = router_match($_GET['a'], 'index');

        $path = PATH_CONTROLLER .'/'. $controller . '.php';
        if (file_exists($path))
		{
			require $path;
		}
		else
		{
			throw new Exception("控制器 {$controller} 不存在！");
		}

        if (method_exists($controller, $action) === true)
		{
			$instance = new $controller();
            if (method_exists($controller, 'pre') === true)
            {
                $instance->pre();
            }
			$instance->$action();
            if (method_exists($controller, 'post') === true)
            {
                $instance->post();
            }
		}
		else
		{
			throw new Exception("方法 {$action} 不存在！");
		}
    }
    catch (Exception $e)
	{
		if (DEBUG_LEVEL === true)
		{
			echo '<pre>';
			echo $e->getMessage() . $e->getTraceAsString();
			echo '</pre>';
			exit;
		}
		else
		{
			header("HTTP/1.1 404 Not Found");
			// header("location:404.html");
			exit;
		}
	}
}


/**
 * 路由页面参数过滤
 *
 * @param string	$param	页面参数
 * @param string	$defaul	参数默认值
 */
function router_match($param, $defaul)
{
	$defaul = (empty($defaul)) ? 'error' : $defaul;
	$action = (empty($param)) ? $defaul : $param;
	//$action = preg_replace('|[^a-zA-Z_]+|', '', $action);
	if (!preg_match('`^([a-zA-Z_]){1,30}$`', $action)) throw new Exception("参数错误.");
	$action = (empty($action)) ? $defaul : $action;

	return $action;
}


// 自动加载文件
if (function_exists('__autoload')) {
	spl_autoload_register('__autoload');
}
//if (!function_exists('__autoload'))
//{
	function __autoload($classname)
	{
		$classfile = PATH_MODULE . '/' . $classname . '.php';
		try
		{
			if (!is_file($classfile) && ! class_exists($classname))
			{
				throw new Exception('找不到模型 ' . $classname);
			}
			else
			{
				require $classfile;
			}
		}
		catch (Exception $e)
		{
    		if (DEBUG_LEVEL === true)
    		{
    			echo '<pre>';
    			echo $e->getMessage() . $e->getTraceAsString();
    			echo '</pre>';
    			exit();
    		}
    		else
    		{
    			header("HTTP/1.1 404 Not Found");
    			exit;
    		}
		}
	}
//}

router();
