<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_member.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_member
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // ��ʾ����Ա�б�
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
    // �༭��¼
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function edit()
	{
		try
		{
			// �����ж�
			$t = (empty($_GET['t'])) ? 'add' : $_GET['t'];
			if ( strcasecmp('modify', $t) != 0) $t = 'add';
			template::assign('t', $t, PATH_TPLS_ADMIN);

			// ������
			if (!empty($_POST['member']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					member::edit(2, $_POST['member']);
					msg::message("�޸Ĺ���Ա��Ϣ�ɹ�", "?c=member");
					exit;
				} else {
					member::edit(1, $_POST['member']);
					msg::message("��������Ա�ɹ�", "?c=member&a=edit_purviews&user_id=".$_POST['member']['user_id']."");
					exit;
				}
			}

			// ���޸ļ�¼��֤
			if ( strcasecmp('modify', $t) == 0)
			{
				$user_id = (empty($_GET['user_id'])) ? '' : $_GET['user_id'];
				if (empty($user_id)) $user_id = $_POST['member']['user_id'];
				if (empty($user_id)) throw new Exception("������ʧ.");

				if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("��ʹ�ô�ʼ���ʺŵ�¼����������ġ��޸ġ����ӽ���༭ҳ�棡");

				$rs = member::get_one($user_id);
				if (!isset($rs['user_id'])) throw new Exception("������ʧ.");

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
    // �༭�û�Ȩ��
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function edit_purviews()
	{
		try
		{
			$user_id = (empty($_REQUEST['user_id'])) ? '' : $_REQUEST['user_id'];
			if (empty($user_id)) throw new Exception("������ʧ.");
			template::assign('user_id', $user_id, PATH_TPLS_ADMIN);

			// ������
			if (!empty($_POST['purview']))
			{
				member::purviews(2, $user_id, $_POST['purview']);
				msg::message("�û�Ȩ�ޱ༭�ɹ�", "?c=member");
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
	// ɾ��һ����¼
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$user_id = (empty($_REQUEST['user_id'])) ? '' : $_REQUEST['user_id'];
			member::del($user_id);
			msg::message("ɾ���ʺųɹ���", '?c=member');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        $this->index();
	}

}
