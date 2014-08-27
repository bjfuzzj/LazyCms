<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_feedback.php 2012-5-16  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_feedback
{
	public static function pre()
	{
		if (!empty($_POST['a']))
		{
			$action = $_POST['a'];
			if ($action == 'del')
			{
				self::del();
				die();
			}
		}
	}

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 显示内容列表
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$flag = (empty($_REQUEST['flag'])) ? 0 : intval($_REQUEST['flag']);
			template::assign('flag', $flag, PATH_TPLS_ADMIN);

			$start = (empty($_GET['start'])) ? 0 : (int)$_GET['start']; //分页起始值
			$page_url = "?c=feedback&flag={$flag}"; //页面地址
			$total = feedback::page_list($flag, $start, true, PAGE_ROWS_ADMIN);
			$data = feedback::page_list($flag, $start, false, PAGE_ROWS_ADMIN);

			// 记录列表绑定
			template::assign('page_url', $page_url, PATH_TPLS_ADMIN);
			template::assign('pages', pager::get_page_number_list($total, $start, PAGE_ROWS_ADMIN), PATH_TPLS_ADMIN);
			template::assign('feedback', $data, PATH_TPLS_ADMIN);
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('feedback_list.tpl', PATH_TPLS_ADMIN);
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

			// 待修改记录验证
			$rs = array();
			if ( strcasecmp('modify', $t) == 0)
			{
				$fid = (empty($_GET['fid'])) ? '' : $_GET['fid'];
				if (empty($fid)) $fid = $_POST['feedback']['fid'];
				if (empty($fid)) throw new Exception("参数丢失.");

				$rs = feedback::get_one($fid);
				if (!isset($rs['fid'])) throw new Exception("参数丢失.");
				feedback::set_flag($fid, 1); //更新留言标志
			}
			template::assign('feedback', $rs, PATH_TPLS_ADMIN);

			// 表单处理
			if (!empty($_POST['feedback']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					feedback::edit(2, $_POST['feedback']);
					msg::message("修改留言信息成功", "?c=feedback");
					exit;
				} else {
					feedback::edit(1, $_POST['feedback']);
					msg::message("新增留言记录成功", "?c=feedback");
					exit;
				}
			}
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('feedback', $_POST['feedback'], PATH_TPLS_ADMIN);
        }
        template::display('feedback_edit.tpl', PATH_TPLS_ADMIN);
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 留言回复
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function reply()
	{
		try
		{
			// 记录验证
			$rs = array();
			$fid = (empty($_GET['fid'])) ? '' : $_GET['fid'];
			if (empty($fid)) $fid = $_POST['feedback']['fid'];
			if (empty($fid)) throw new Exception("参数丢失.");

			$rs = feedback::get_one($fid);
			if (!isset($rs['fid'])) throw new Exception("参数丢失.");
			feedback::set_flag($fid, 1); //更新留言标志
			template::assign('feedback', $rs, PATH_TPLS_ADMIN);

			// 表单处理
			if (!empty($_POST['feedback']))
			{
				feedback::reply($_POST['feedback']);
				msg::message("回复留言成功", "?c=feedback");
				exit;
			}
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('feedback', $_POST['feedback'], PATH_TPLS_ADMIN);
        }
        template::display('feedback_reply.tpl', PATH_TPLS_ADMIN);
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 删除记录
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$fid = (empty($_REQUEST['fid'])) ? '' : $_REQUEST['fid'];
			if (empty($fid)) throw new Exception("请选定要删除的记录！");

			feedback::del($fid);
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        self::index();
	}

}
