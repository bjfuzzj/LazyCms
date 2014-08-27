<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_page_cate.php 2012-5-17  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_page_cate
{
    public static function index()
    {
		$id = (empty($_GET['id'])) ? 0 : intval($_GET['id']);
		if ( empty($id) ) return false;

		// 获取分类信息
		$page_cate = page_category::get_byid($id);
		if ( empty($page_cate['cate_id']) ) return false;

		// 获取页面模版
		if ( ! empty($page_cate['cate_tpl']) ) $tpl = PATH_ROOT . $page_cate['cate_tpl'];
		if ( empty($tpl) ) $tpl = PATH_TPLS_MAIN . '/page_list.tpl';
		if (is_file($tpl) && file_exists($tpl))
		{
			$tpl_name = basename($tpl);
			$tpl_path = dirname($tpl);
		} else  {
			return false;
		}

		// 页面标题
		$title = config::get_one('title') .' - '. $page_cate['cate_name'];
		$path = "<li>".$page_cate['cate_name']."</li>";
		
		// 模板变量绑定与插件注册
		template::assign('id', $id, $tpl_path);
		template::assign('cate', $page_cate, $tpl_path);
		template::assign('title', $title, $tpl_path);
		template::assign('keywords', '', $tpl_path);
		template::assign('description', '', $tpl_path);
		template::assign('path', $path, $tpl_path);

		template::registerPlugin('function', 'site_config', 'func_site_config', $tpl_path);
		template::registerPlugin('function', 'plate', 'func_get_plate_content', $tpl_path);

		template::registerPlugin('function', 'func_page_category', 'func_page_category', $tpl_path);
		template::registerPlugin('block', 'block_page_category', 'block_page_category', $tpl_path);

		template::registerPlugin('function', 'func_page_list', 'func_get_page_list', $tpl_path);
		template::registerPlugin('block', 'block_page_list', 'block_get_page_list', $tpl_path);

		template::display($tpl_name, $tpl_path);
	}
}
