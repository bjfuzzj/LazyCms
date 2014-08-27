<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: template.php 2012-5-7  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class template
{
	private static $instance = null;

	public static function init($path = PATH_TPLS_MAIN)
	{
		if (empty(self::$instance->template_dir) || $path != self::$instance->template_dir)
		{
			self::$instance = new Smarty();
			self::$instance->template_dir = path_exists($path);
			self::$instance->compile_dir = path_exists(PATH_TPLS_COMPILE);
			self::$instance->cache_dir = path_exists(PATH_TPLS_CACHE);

			self::$instance->left_delimiter = '<%{';
			self::$instance->right_delimiter = '}%>';
			self::$instance->caching = false;
			self::$instance->compile_check = true;
			self::$instance->security = true;
			self::$instance->security_settings['PHP_HANDLING'] = SMARTY_PHP_PASSTHRU;
			self::$instance->security_settings['ALLOW_CONSTANTS'] = true;
            
			self::config();
		}
		return self::$instance;
	}

	protected static function config()
	{
		self::$instance->assign('URL', URL);
		self::$instance->assign('URL_HTML', URL_HTML);
		self::$instance->assign('ADMIN_URL', ADMIN_URL);
		self::$instance->assign('date_format', '%Y-%m-%d %H:%M');
		self::$instance->assign('date_format_ymd', '%Y-%m-%d');
	}

	public static function assign($tpl_var, $value, $path = PATH_TPLS_MAIN)
	{
		self::init($path);
        self::$instance->assign($tpl_var, $value);
	}

	public static function display($tpl, $path = PATH_TPLS_MAIN)
	{
		$instance = self::init($path);
		$instance->display($tpl);
	}

	public static function fetch($tpl, $path = PATH_TPLS_MAIN)
	{
		$instance = self::init($path);
		return $instance->fetch($tpl);
	}

	/**
	 * 插件注册，用于 smarty 3 , 注册类型为："function", "block", "compiler" and "modifier"
	 */
	public static function registerPlugin($reg_type, $reg_fun, $obj_fun, $path = PATH_TPLS_MAIN)
	{
		$instance = self::init($path);
		return $instance->registerPlugin($reg_type, $reg_fun, $obj_fun);
	}

	/**
	 * registerPlugin 注册 block 时对块标签及其内容中标签解析
	 *
	 * registerPlugin 中定义的 block 需要参数：$params, $content, $smarty, &$repeat
	 * 并在 registerPlugin 目标函数中把 $repeat 传递至本函数
	 * 目标函数示例：function callback_func($params, $content, $smarty, &$repeat){...}
	 *
	 * @param array $params 来自目标函数中的标签属性数值
	 * @param string $content 来自目标函数中的标签内容值
	 * @param array $data_source 标签数据源
	 * @param boolen &$repeat 是否循环显示内容
	 *
	 * 模板中标签使用示例：
	 * {block assign='row' param1=1, ... , paramN=N }
	 *     {$row.id}
	 *     {$row.title}
	 * {/block}
	 */
	public static function register_block($params, $content, $data_source, &$repeat, $path = PATH_TPLS_MAIN)
	{
		$instance = self::init($path);

		if (empty($data_source) || !is_array($data_source)) return false;
		if (!isset($params['assign'])) $params['assign'] = 'row';

		// 注册一个数组以供block使用
		if(!isset($instance->blocksdata)) $instance->blocksdata = array();
		$data_index = substr( md5(serialize($params)), 0, 16);

		// 取得标签数据
		if(!$instance->blocksdata[$data_index])
		{
			$instance->blocksdata[$data_index] = $data_source;
			if(!$instance->blocksdata[$data_index]) return $repeat = false;
		}

		// 逐一遍历$smarty->blockvars[$data_index]子元素
		if(list($key, $item) = each($instance->blocksdata[$data_index])) {
			$repeat = true;
			$instance->assign($params['assign'], $item);
		}
		else
		{
			$repeat = false;
			reset($instance->blocksdata[$data_index]);
		}

		// 这里的$content其实是在上一次的运行中解析过（已经插入数据的最终结果）的$content
		if(!is_null($content)) return $content;
		if(!$repeat) $instance->blocksdata[$data_index] = array();
	}

}

