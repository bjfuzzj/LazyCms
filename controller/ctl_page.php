<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_page.php 2012-5-17  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_page
{
    public static function index()
    {
		$id = (empty($_GET['id'])) ? 0 : $_GET['id'];
		if ( empty($id) ) return false;

		// ��ȡ��ҳ��Ϣ
		if (is_numeric($id)) // �����Ͳ���
		{
			$id = intval($id);
			$page = page_content::get_one($id);
		}
		else // ������д�Ͳ���
		{
			if (!preg_match('`^([a-zA-Z0-9_-]){1,30}$`', $id)) return false;
			$page = page_content::get_byname($id);
		}
		if ( empty($page['page_id']) ) return false;

		// ��ȡ����������Ϣ
		$cate = page_category::get_byid($page['cate_id']);
		if ( empty($cate['cate_id']) ) return false;
		
		// ��ȡҳ��ģ��
		if ( ! empty($cate['detail_tpl']) ) $tpl = PATH_ROOT . $cate['detail_tpl'];
		if ( empty($tpl) ) $tpl = PATH_TPLS_MAIN . '/page_detail.tpl';
		if (is_file($tpl) && file_exists($tpl))
		{
			$tpl_name = basename($tpl);
			$tpl_path = dirname($tpl);
		} else  {
			return false;
		}

		// ҳ�����
		$title = config::get_one('title');
		$title = $page['title'] .' - '. $title;
		$path = "<li><a href='".$cate['url']."'>".$cate['cate_name']."</a></li><li>����</li>";
		
		// ģ�����������ע��
		template::assign('id', $id, $tpl_path);
		template::assign('page', $page, $tpl_path);
		template::assign('cate', $cate, $tpl_path);
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
