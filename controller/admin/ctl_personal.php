<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_personal.php 2012-5-20  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_personal
{

    public function index()
    {
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // 修改个人密码
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function pwd()
    {
        try
        {
			$user_id = $_SESSION['userid'];
			if (empty($user_id)) throw new Exception("参数丢失.");
			template::assign('user_id', $user_id, PATH_TPLS_ADMIN);

			$rs = member::get_one($user_id);
			if (!isset($rs['user_id'])) throw new Exception("参数丢失.");
			template::assign('member', $rs, PATH_TPLS_ADMIN);

			// 表单处理
			if (!empty($_POST['member']))
			{
				member::self_edit($_POST['member']);
				msg::message("修改个人信息成功", "?c=frame&a=welcome");
				exit;
			}
        }
        catch (Exception $e)
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('member', $_POST['member'], PATH_TPLS_ADMIN);
        }
        template::display('personal_pwd.tpl', PATH_TPLS_ADMIN);
	}
}