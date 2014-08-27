<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
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
	 * ���ע�ᣬ���� smarty 3 , ע������Ϊ��"function", "block", "compiler" and "modifier"
	 */
	public static function registerPlugin($reg_type, $reg_fun, $obj_fun, $path = PATH_TPLS_MAIN)
	{
		$instance = self::init($path);
		return $instance->registerPlugin($reg_type, $reg_fun, $obj_fun);
	}

	/**
	 * registerPlugin ע�� block ʱ�Կ��ǩ���������б�ǩ����
	 *
	 * registerPlugin �ж���� block ��Ҫ������$params, $content, $smarty, &$repeat
	 * ���� registerPlugin Ŀ�꺯���а� $repeat ������������
	 * Ŀ�꺯��ʾ����function callback_func($params, $content, $smarty, &$repeat){...}
	 *
	 * @param array $params ����Ŀ�꺯���еı�ǩ������ֵ
	 * @param string $content ����Ŀ�꺯���еı�ǩ����ֵ
	 * @param array $data_source ��ǩ����Դ
	 * @param boolen &$repeat �Ƿ�ѭ����ʾ����
	 *
	 * ģ���б�ǩʹ��ʾ����
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

		// ע��һ�������Թ�blockʹ��
		if(!isset($instance->blocksdata)) $instance->blocksdata = array();
		$data_index = substr( md5(serialize($params)), 0, 16);

		// ȡ�ñ�ǩ����
		if(!$instance->blocksdata[$data_index])
		{
			$instance->blocksdata[$data_index] = $data_source;
			if(!$instance->blocksdata[$data_index]) return $repeat = false;
		}

		// ��һ����$smarty->blockvars[$data_index]��Ԫ��
		if(list($key, $item) = each($instance->blocksdata[$data_index])) {
			$repeat = true;
			$instance->assign($params['assign'], $item);
		}
		else
		{
			$repeat = false;
			reset($instance->blocksdata[$data_index]);
		}

		// �����$content��ʵ������һ�ε������н��������Ѿ��������ݵ����ս������$content
		if(!is_null($content)) return $content;
		if(!$repeat) $instance->blocksdata[$data_index] = array();
	}

}

