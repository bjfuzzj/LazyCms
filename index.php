<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: index.php 2012-5-16  $
 */
require 'lib/init.php';
require PATH_MODULE . '/register.php';

// ǰ̨·��
function router() {
    try {
		// ģ����ò���Ϊ��ʱ����⾲̬�������ò�ת��
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
			throw new Exception("������ {$controller} �����ڣ�");
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
			throw new Exception("���� {$action} �����ڣ�");
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
 * ·��ҳ���������
 *
 * @param string	$param	ҳ�����
 * @param string	$defaul	����Ĭ��ֵ
 */
function router_match($param, $defaul)
{
	$defaul = (empty($defaul)) ? 'error' : $defaul;
	$action = (empty($param)) ? $defaul : $param;
	//$action = preg_replace('|[^a-zA-Z_]+|', '', $action);
	if (!preg_match('`^([a-zA-Z_]){1,30}$`', $action)) throw new Exception("��������.");
	$action = (empty($action)) ? $defaul : $action;

	return $action;
}


// �Զ������ļ�
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
				throw new Exception('�Ҳ���ģ�� ' . $classname);
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
