<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_article.php 2012-5-17  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_article
{
    public static function index()
    {
		$id = (empty($_GET['id'])) ? 0 : intval($_GET['id']);
		if ( empty($id) ) return false;

		// 获取文章信息
		article_content::update_hits($id);
		$article = article_content::get_one($id);
		if ( empty($article['article_id']) ) return false;

		// 获取归属分类信息
		$cate = article_category::get_byid($article['cate_id']);
		if ( empty($cate['cate_id']) ) return false;
		
		// 获取页面模版
		if ( ! empty($cate['detail_tpl']) ) $tpl = PATH_ROOT . $cate['detail_tpl'];
		if ( empty($tpl) ) $tpl = PATH_TPLS_MAIN . '/article_detail.tpl';
		if (is_file($tpl) && file_exists($tpl))
		{
			$tpl_name = basename($tpl);
			$tpl_path = dirname($tpl);
		} else  {
			return false;
		}

		// 页面标题
		$title = config::get_one('title');
		$title = $article['title'] .' - '. $title;
		$path = "<li><a href='".$cate['url']."'>".$cate['cate_name']."</a></li><li>正文</li>";
		
		// 模板变量绑定与插件注册
		template::assign('id', $id, $tpl_path);
		template::assign('article', $article, $tpl_path);
		template::assign('cate', $cate, $tpl_path);
		template::assign('title', $title, $tpl_path);
		template::assign('keywords', $article['tags'], $tpl_path);
		template::assign('description', '', $tpl_path);
		template::assign('path', $path, $tpl_path);

		template::registerPlugin('function', 'site_config', 'func_site_config', $tpl_path);
		template::registerPlugin('function', 'plate', 'func_get_plate_content', $tpl_path);

		template::display($tpl_name, $tpl_path);
	}
}
