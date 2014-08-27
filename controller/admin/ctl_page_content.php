<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_page_content.php 2012-5-12  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_page_content
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// POST实现页面部分功能
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public static function pre()
	{
		if (!empty($_POST['a']))
		{
			$action = strtolower($_POST['a']);
			switch ($action)
			{
				case 'passed' : 
					self::passed();
					break;
				case 'nopass' : 
					self::nopass();
					break;
				case 'restore' : 
					self::restore();
					break;
				case 'del' : 
					self::del();
					break;
			}
			die();
		}
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 显示内容列表
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$cate_id = (empty($_REQUEST['cate_id'])) ? 0 : intval($_REQUEST['cate_id']); //分类ID

			template::assign('cate_id', $cate_id, PATH_TPLS_ADMIN);
			template::assign('page_category', page_category::get_list(), PATH_TPLS_ADMIN);

			$start = (empty($_GET['start'])) ? 0 : (int)$_GET['start']; //分页起始值
			$page_url = "?c=page_content&cate_id={$cate_id}"; //页面地址
			$total = page_content::page_list($cate_id, 1, $start, true, PAGE_ROWS_ADMIN, 0);
			$data = page_content::page_list($cate_id, 1, $start, false, PAGE_ROWS_ADMIN, 0);

			// 记录列表绑定
			template::assign('page_url', $page_url, PATH_TPLS_ADMIN);
			template::assign('pages', pager::get_page_number_list($total, $start, PAGE_ROWS_ADMIN), PATH_TPLS_ADMIN);
			template::assign('page_content', $data, PATH_TPLS_ADMIN);
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('page_content_list.tpl', PATH_TPLS_ADMIN);
    }


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // 编辑记录
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function edit()
	{
		try
		{
			// 操作判断
			$t = (empty($_GET['t'])) ? 'add' : $_GET['t'];
			if ( strcasecmp('modify', $t) != 0) $t = 'add';
			template::assign('t', $t, PATH_TPLS_ADMIN);
			template::assign('page_category', page_category::get_list(), PATH_TPLS_ADMIN);

			// 表单处理
			if (!empty($_POST['page_content']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					page_content::edit(2, $_POST['page_content']);
					msg::message("修改单页内容成功", "?c=page_content&cate_id=".$_POST['page_content']['cate_id']."");
					exit;
				} else {
					page_content::edit(1, $_POST['page_content']);
					msg::message("新增单页内容成功", "?c=page_content&cate_id=".$_POST['page_content']['cate_id']."");
					exit;
				}
			}

			// 待修改记录验证
			$rs = array();
			if ( strcasecmp('modify', $t) == 0)
			{
				$page_id = (empty($_GET['id'])) ? '' : $_GET['id'];
				if (empty($page_id)) $page_id = $_POST['page_content']['page_id'];
				if (empty($page_id)) throw new Exception("参数丢失.");

				$rs = page_content::get_one($page_id);
				if (!isset($rs['page_id'])) throw new Exception("参数丢失.");

			} else {
				// 信息初始化
				$rs['copyfrom'] = '';
				$rs['hits'] = 0;
				$rs['update_time'] = time();
				$rs['passed'] = 1;
				$rs['deleted'] = 0;
			}
			template::assign('page_content', $rs, PATH_TPLS_ADMIN);

		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('page_content', $_POST['page_content'], PATH_TPLS_ADMIN);
        }
        template::display('page_content_edit.tpl', PATH_TPLS_ADMIN);
	}



	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 通过审核
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function passed()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("请选定要操作的记录！");

			page_content::set_state($id, 'passed');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 取消审核
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function nopass()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("请选定要操作的记录！");

			page_content::set_state($id, 'nopass');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 彻底删除记录
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("请选定要删除的记录！");

			page_content::set_state($id, 'del');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


}
