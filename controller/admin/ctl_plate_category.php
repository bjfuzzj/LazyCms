<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_plate_category.php 2012-5-12  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_plate_category
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 显示单页分类列表
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$start = (empty($_GET['start'])) ? 0 : (int)$_GET['start']; //分页起始值
			$page_url = "?c=plate_category"; //页面地址
			$total = plate_category::page_list($start, true, PAGE_ROWS_ADMIN);
			$data = plate_category::page_list($start, false, PAGE_ROWS_ADMIN);

			// 记录列表绑定
			template::assign('page_url', $page_url, PATH_TPLS_ADMIN);
			template::assign('pages', pager::get_page_number_list($total, $start, PAGE_ROWS_ADMIN), PATH_TPLS_ADMIN);
			template::assign('plate_category', $data, PATH_TPLS_ADMIN);
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('plate_category_list.tpl', PATH_TPLS_ADMIN);
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

			// 表单处理
			if (!empty($_POST['plate_category']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					plate_category::edit(2, $_POST['plate_category']);
					msg::message("修改板块信息成功", "?c=plate_category");
					exit;
				} else {
					plate_category::edit(1, $_POST['plate_category']);
					msg::message("新增板块信息成功", "?c=plate_category");
					exit;
				}
			}

			// 待修改记录验证
			if ( strcasecmp('modify', $t) == 0)
			{
				$id = (empty($_GET['id'])) ? '' : $_GET['id'];
				if (empty($id)) $id = $_POST['plate_category']['id'];
				if (empty($id)) throw new Exception("参数丢失.");

				$rs = plate_category::get_one($id);
				if (!isset($rs['id'])) throw new Exception("参数丢失.");
			} else {
				$rs['plate_type'] = 1;
			}
			template::assign('plate_category', $rs, PATH_TPLS_ADMIN);

		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('plate_category', $_POST['plate_category'], PATH_TPLS_ADMIN);
        }
        template::display('plate_category_edit.tpl', PATH_TPLS_ADMIN);
	}



	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 清除分类下所有内容
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function clear()
	{
		try
		{
			$id = (empty($_REQUEST['id'])) ? '' : intval($_REQUEST['id']);
			if ( empty($id) ) throw new Exception("参数丢失！");
			$data = plate_category::get_byid($id);
			template::assign('data', $data, PATH_TPLS_ADMIN);

			if (!empty($_POST['clear_confirm']))
			{
				if (1 == $_POST['clear_confirm']['confirm'])
				{
					plate_category::clear($id);
					msg::message("清空分类内容成功！", "?c=plate_category");
					exit;
				}
			}
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        template::display('plate_category_clear.tpl', PATH_TPLS_ADMIN);
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 删除分类记录
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try
		{
			$id = (empty($_REQUEST['id'])) ? '' : intval($_REQUEST['id']);
			if ( empty($id) ) throw new Exception("参数丢失！");

			$data = plate_category::get_one($id);
			template::assign('data', $data, PATH_TPLS_ADMIN);

			if (!empty($_POST['clear_confirm']))
			{
				if (1 == $_POST['clear_confirm']['confirm'])
				{
					plate_category::del($id);
					msg::message("删除板块及旗下所有内容成功！", "?c=plate_category");
					exit;
				}
			}
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        template::display('plate_category_clear.tpl', PATH_TPLS_ADMIN);
	}


}
