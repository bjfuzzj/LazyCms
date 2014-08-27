<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: index.php 2012-5-7  $
 */

require 'lib/init.php';

//@session_save_path(PATH_ROOT.'/data/session');
@session_start();


/**
 * 后台路由
 */
function router() {
    try {
		$controller = 'ctl_' . router_match($_GET['c'], 'login');
		$action = router_match($_GET['a'], 'index');

        $path = PATH_CONTROLLER . '/admin/' . $controller . '.php';
        if (file_exists($path))
		{
			require $path;
		}
		else
		{
			throw new Exception("控制器 {$controller} 不存在！", 1);
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
			throw new Exception("方法 {$action} 不存在！", 2);
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
	$action = preg_replace('|[^a-zA-Z_]+|', '', $action);
	$action = (empty($action)) ? $defaul : $action;

	return $action;
}





/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 自动加载文件
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
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

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 访问控制
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
if ( empty($_GET['c']) || $_GET['c']=='login' || $_GET['c']=='securimage' )
{
}
else 
{
	$auth = auth::instance();
	if(!$auth->is_login())
	{
		header("location: ?c=login");
		exit;
	}
}
router();
session_write_close();

