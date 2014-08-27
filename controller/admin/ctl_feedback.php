<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
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
	// ��ʾ�����б�
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$flag = (empty($_REQUEST['flag'])) ? 0 : intval($_REQUEST['flag']);
			template::assign('flag', $flag, PATH_TPLS_ADMIN);

			$start = (empty($_GET['start'])) ? 0 : (int)$_GET['start']; //��ҳ��ʼֵ
			$page_url = "?c=feedback&flag={$flag}"; //ҳ���ַ
			$total = feedback::page_list($flag, $start, true, PAGE_ROWS_ADMIN);
			$data = feedback::page_list($flag, $start, false, PAGE_ROWS_ADMIN);

			// ��¼�б��
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

			// ���޸ļ�¼��֤
			$rs = array();
			if ( strcasecmp('modify', $t) == 0)
			{
				$fid = (empty($_GET['fid'])) ? '' : $_GET['fid'];
				if (empty($fid)) $fid = $_POST['feedback']['fid'];
				if (empty($fid)) throw new Exception("������ʧ.");

				$rs = feedback::get_one($fid);
				if (!isset($rs['fid'])) throw new Exception("������ʧ.");
				feedback::set_flag($fid, 1); //�������Ա�־
			}
			template::assign('feedback', $rs, PATH_TPLS_ADMIN);

			// ������
			if (!empty($_POST['feedback']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					feedback::edit(2, $_POST['feedback']);
					msg::message("�޸�������Ϣ�ɹ�", "?c=feedback");
					exit;
				} else {
					feedback::edit(1, $_POST['feedback']);
					msg::message("�������Լ�¼�ɹ�", "?c=feedback");
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
	// ���Իظ�
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function reply()
	{
		try
		{
			// ��¼��֤
			$rs = array();
			$fid = (empty($_GET['fid'])) ? '' : $_GET['fid'];
			if (empty($fid)) $fid = $_POST['feedback']['fid'];
			if (empty($fid)) throw new Exception("������ʧ.");

			$rs = feedback::get_one($fid);
			if (!isset($rs['fid'])) throw new Exception("������ʧ.");
			feedback::set_flag($fid, 1); //�������Ա�־
			template::assign('feedback', $rs, PATH_TPLS_ADMIN);

			// ������
			if (!empty($_POST['feedback']))
			{
				feedback::reply($_POST['feedback']);
				msg::message("�ظ����Գɹ�", "?c=feedback");
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
	// ɾ����¼
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$fid = (empty($_REQUEST['fid'])) ? '' : $_REQUEST['fid'];
			if (empty($fid)) throw new Exception("��ѡ��Ҫɾ���ļ�¼��");

			feedback::del($fid);
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        self::index();
	}

}
