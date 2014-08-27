<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_member.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_member
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // 显示管理员列表
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
        try
        {
            $data = member::get_list();
			template::assign('member', $data, PATH_TPLS_ADMIN);
        }
        catch (Exception $e)
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('member_list.tpl', PATH_TPLS_ADMIN);
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
			if (!empty($_POST['member']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					member::edit(2, $_POST['member']);
					msg::message("修改管理员信息成功", "?c=member");
					exit;
				} else {
					member::edit(1, $_POST['member']);
					msg::message("新增管理员成功", "?c=member&a=edit_purviews&user_id=".$_POST['member']['user_id']."");
					exit;
				}
			}

			// 待修改记录验证
			if ( strcasecmp('modify', $t) == 0)
			{
				$user_id = (empty($_GET['user_id'])) ? '' : $_GET['user_id'];
				if (empty($user_id)) $user_id = $_POST['member']['user_id'];
				if (empty($user_id)) throw new Exception("参数丢失.");

				if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("请使用创始人帐号登录，点击顶部的“修改”链接进入编辑页面！");

				$rs = member::get_one($user_id);
				if (!isset($rs['user_id'])) throw new Exception("参数丢失.");

				template::assign('member', $rs, PATH_TPLS_ADMIN);
			}

		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('member', $_POST['member'], PATH_TPLS_ADMIN);
        }
        template::display('member_edit.tpl', PATH_TPLS_ADMIN);
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // 编辑用户权限
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function edit_purviews()
	{
		try
		{
			$user_id = (empty($_REQUEST['user_id'])) ? '' : $_REQUEST['user_id'];
			if (empty($user_id)) throw new Exception("参数丢失.");
			template::assign('user_id', $user_id, PATH_TPLS_ADMIN);

			// 表单处理
			if (!empty($_POST['purview']))
			{
				member::purviews(2, $user_id, $_POST['purview']);
				msg::message("用户权限编辑成功", "?c=member");
				exit;
			}

			template::assign('purview', member::purviews(1, $user_id), PATH_TPLS_ADMIN);
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('purview', $_POST['purview'], PATH_TPLS_ADMIN);
        }
        template::display('member_purviews.tpl', PATH_TPLS_ADMIN);
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 删除一条记录
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$user_id = (empty($_REQUEST['user_id'])) ? '' : $_REQUEST['user_id'];
			member::del($user_id);
			msg::message("删除帐号成功！", '?c=member');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        $this->index();
	}

}
