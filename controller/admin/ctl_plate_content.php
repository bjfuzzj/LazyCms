<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_plate_content.php 2012-5-12  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_plate_content
{
	public function pre()
	{
		if (!empty($_POST['a']))
		{
			$action = strtolower($_POST['a']);
			switch ($action)
			{
				case 'used' : 
					self::used();
					break;
				case 'unable' : 
					self::unable();
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
			$plate_id = (empty($_REQUEST['plate_id'])) ? 0 : intval($_REQUEST['plate_id']); //����ID

			template::assign('plate_id', $plate_id, PATH_TPLS_ADMIN);
			template::assign('plate_category', plate_category::get_one($plate_id), PATH_TPLS_ADMIN);

			$start = (empty($_GET['start'])) ? 0 : (int)$_GET['start']; //��ҳ��ʼֵ
			$page_url = "?c=plate_content&plate_id={$plate_id}"; //ҳ���ַ
			$total = plate_content::page_list($plate_id, $start, true, PAGE_ROWS_ADMIN);
			$data = plate_content::page_list($plate_id, $start, false, PAGE_ROWS_ADMIN);

			// ��¼�б��
			template::assign('page_url', $page_url, PATH_TPLS_ADMIN);
			template::assign('pages', pager::get_page_number_list($total, $start, PAGE_ROWS_ADMIN), PATH_TPLS_ADMIN);
			template::assign('plate_content', $data, PATH_TPLS_ADMIN);
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('plate_content_list.tpl', PATH_TPLS_ADMIN);
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
			if (!empty($_POST['plate_content']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					plate_content::edit(2, $_POST['plate_content']);
					msg::message("�޸İ�����ݳɹ�", "?c=plate_content&plate_id=".$_POST['plate_content']['plate_id']."");
					exit;
				} else {
					plate_content::edit(1, $_POST['plate_content']);
					msg::message("����������ݳɹ�", "?c=plate_content&plate_id=".$_POST['plate_content']['plate_id']."");
					exit;
				}
			}

			// ���޸ļ�¼��֤
			$rs = array();
			if ( strcasecmp('modify', $t) == 0)
			{
				$id = (empty($_GET['id'])) ? '' : $_GET['id'];
				if (empty($id)) $id = $_POST['plate_content']['id'];
				if (empty($id)) throw new Exception("������ʧ.");

				$rs = plate_content::get_one($id);
				if (!isset($rs['id'])) throw new Exception("������ʧ.");

				// ͼƬ����ʱ�����ݽ��н���
				if (2 == $rs['plate_type'])
				{
					$content = plate_content::decode($rs['content']);
					$rs['img_src'] = $content['img_src'];
					$rs['link_url'] = $content['link_url'];
				}

				// ���������Ϣ
				$plate = plate_category::get_one($rs['plate_id']);
				if (!isset($plate['id'])) throw new Exception("������ʧ.");
			} else {
				// ���������֤
				$plate_id = (empty($_REQUEST['plate_id'])) ? '' : $_REQUEST['plate_id'];
				if (empty($plate_id)) $plate_id = $_POST['plate_content']['plate_id'];
				if (empty($plate_id)) throw new Exception("������ʧ.");
				$plate = plate_category::get_one($plate_id);
				if (!isset($plate['id'])) throw new Exception("������ʧ.");

				// ��Ϣ��ʼ��
				$rs['plate_id'] = $plate['id'];
				$rs['plate_type'] = $plate['plate_type'];
				$rs['used'] = 1;
			}
			template::assign('plate_category', $plate, PATH_TPLS_ADMIN);
			template::assign('plate_content', $rs, PATH_TPLS_ADMIN);

		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('plate_content', $_POST['plate_content'], PATH_TPLS_ADMIN);
        }
        template::display('plate_content_edit.tpl', PATH_TPLS_ADMIN);
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ɾ����¼
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫɾ���ļ�¼��");

			plate_content::del($id);
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ����
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function used()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");

			plate_content::set_used($id, 1);
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ����
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function unable()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");

			plate_content::set_used($id, 0);
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}

}
