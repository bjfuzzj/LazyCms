<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_category.php 2012-5-18  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_category
{
    public static function index()
    {
		// 获取分类ID
		$id = ( empty($_GET['id']) ) ? 0 : intval($_GET['id']);
		if ( empty($id) ) return false;
		$cate = article_category::get_byid($id);
		if ( ! isset($cate['cate_id']) )  return false;

		$list_type = 0; //分页类型: 0-按记录数分页，1-按年份分页

		// 获取按年份分页参数
		$year = ( empty($_GET['year']) ) ? 0 : intval($_GET['year']);
		if ($year)
		{
			$list_type = 1;
			$base_year = config::get_one('startyear');
			$base_year = ( empty($base_year) ) ? 1970 : intval($base_year);
			if ($year < $base_year || $year > intval(date('Y'))) $year = intval(date('Y'));
		}

		// 获取分类模版
		if ( ! empty($cate['cate_tpl']) ) $tpl = PATH_ROOT . $cate['cate_tpl'];
		if ( empty($tpl) )
		{
			if ($list_type)  $tpl = PATH_TPLS_MAIN . '/article_list_year.tpl';
			else $tpl = PATH_TPLS_MAIN . '/article_list.tpl';
		}
		if (is_file($tpl) && file_exists($tpl))
		{
			$tpl_name = basename($tpl);
			$tpl_path = dirname($tpl);
		} else  {
			return false;
		}

		// 获取按记录数分页参数
		$start = ( empty($_GET['start']) ) ? 0 : intval($_GET['start']);
		$total = article_content::page_list($id, 1, 0, true);
		$page_url = url::article_category($id, $cate['cate_ab'], 0);
		$makestatic = false; // 连接是否为静态页面
		if ( 9 == intval(config::get_one('makestatic')) ) $makestatic = true;

		// 页面标题
		$title = config::get_one('title');
		$title .= ' - ' . $cate['cate_name'];
		$path .= "<li>".$cate['cate_name']."</li>";
		if ($year) $path .= "<li>".$year."年</li>";

		// 模板变量绑定与插件注册
		template::assign('id', $id, $tpl_path);
		template::assign('cate', $cate, $tpl_path);
		template::assign('title', $title, $tpl_path);
		template::assign('keywords', $cate['keywords'], $tpl_path);
		template::assign('description', $cate['description'], $tpl_path);
		template::assign('year', $year, $tpl_path);
		template::assign('path', $path, $tpl_path);

		template::assign('page_url', $page_url, $tpl_path);
		template::assign('total', $total, $tpl_path);
		template::assign('start', $start, $tpl_path);
		template::assign('start_param', url::start(), $tpl_path);
		template::assign('pages', pager::get_page_number_list($total, $start, $cate['page_num'], $makestatic, url::statictype()), $tpl_path);

		template::registerPlugin('function', 'func_article_page_list', 'func_get_article_page_list', $tpl_path);
		template::registerPlugin('block', 'block_article_page_list', 'block_get_article_page_list', $tpl_path);

		template::registerPlugin('function', 'func_article_page_year', 'func_get_article_page_year', $tpl_path);
		template::registerPlugin('block', 'block_article_page_year', 'block_get_article_page_year', $tpl_path);
		template::registerPlugin('function', 'year_list', 'func_get_year_list', $tpl_path);

		template::registerPlugin('function', 'site_config', 'func_site_config', $tpl_path);

		template::registerPlugin('function', 'func_article_category', 'func_article_category', $tpl_path);
		template::registerPlugin('block', 'block_article_category', 'block_article_category', $tpl_path);

		template::registerPlugin('function', 'func_article_list', 'func_get_article_list', $tpl_path);
		template::registerPlugin('block', 'block_article_list', 'block_get_article_list', $tpl_path);

		template::registerPlugin('function', 'func_page_list', 'func_get_page_list', $tpl_path);
		template::registerPlugin('block', 'block_page_list', 'block_get_page_list', $tpl_path);

		template::registerPlugin('function', 'plate', 'func_get_plate_content', $tpl_path);

		template::display($tpl_name, $tpl_path);
	}
}
