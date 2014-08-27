<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
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
    // �޸ĸ�������
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function pwd()
    {
        try
        {
			$user_id = $_SESSION['userid'];
			if (empty($user_id)) throw new Exception("������ʧ.");
			template::assign('user_id', $user_id, PATH_TPLS_ADMIN);

			$rs = member::get_one($user_id);
			if (!isset($rs['user_id'])) throw new Exception("������ʧ.");
			template::assign('member', $rs, PATH_TPLS_ADMIN);

			// ������
			if (!empty($_POST['member']))
			{
				member::self_edit($_POST['member']);
				msg::message("�޸ĸ�����Ϣ�ɹ�", "?c=frame&a=welcome");
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