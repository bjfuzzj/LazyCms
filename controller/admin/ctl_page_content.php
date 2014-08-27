<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_page_content.php 2012-5-12  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_page_content
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// POSTʵ��ҳ�沿�ֹ���
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
	// ��ʾ�����б�
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$cate_id = (empty($_REQUEST['cate_id'])) ? 0 : intval($_REQUEST['cate_id']); //����ID

			template::assign('cate_id', $cate_id, PATH_TPLS_ADMIN);
			template::assign('page_category', page_category::get_list(), PATH_TPLS_ADMIN);

			$start = (empty($_GET['start'])) ? 0 : (int)$_GET['start']; //��ҳ��ʼֵ
			$page_url = "?c=page_content&cate_id={$cate_id}"; //ҳ���ַ
			$total = page_content::page_list($cate_id, 1, $start, true, PAGE_ROWS_ADMIN, 0);
			$data = page_content::page_list($cate_id, 1, $start, false, PAGE_ROWS_ADMIN, 0);

			// ��¼�б��
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
			template::assign('page_category', page_category::get_list(), PATH_TPLS_ADMIN);

			// ������
			if (!empty($_POST['page_content']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					page_content::edit(2, $_POST['page_content']);
					msg::message("�޸ĵ�ҳ���ݳɹ�", "?c=page_content&cate_id=".$_POST['page_content']['cate_id']."");
					exit;
				} else {
					page_content::edit(1, $_POST['page_content']);
					msg::message("������ҳ���ݳɹ�", "?c=page_content&cate_id=".$_POST['page_content']['cate_id']."");
					exit;
				}
			}

			// ���޸ļ�¼��֤
			$rs = array();
			if ( strcasecmp('modify', $t) == 0)
			{
				$page_id = (empty($_GET['id'])) ? '' : $_GET['id'];
				if (empty($page_id)) $page_id = $_POST['page_content']['page_id'];
				if (empty($page_id)) throw new Exception("������ʧ.");

				$rs = page_content::get_one($page_id);
				if (!isset($rs['page_id'])) throw new Exception("������ʧ.");

			} else {
				// ��Ϣ��ʼ��
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
	// ͨ�����
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function passed()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");

			page_content::set_state($id, 'passed');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ȡ�����
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function nopass()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");

			page_content::set_state($id, 'nopass');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ����ɾ����¼
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫɾ���ļ�¼��");

			page_content::set_state($id, 'del');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


}
