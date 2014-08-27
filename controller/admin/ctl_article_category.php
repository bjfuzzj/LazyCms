<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_article_category.php 2012-5-10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_article_category
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ��ʾ���·����б�
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$data = article_category::get_list();

			template::assign('data', $data, PATH_TPLS_ADMIN);
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('article_category_list.tpl', PATH_TPLS_ADMIN);
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
			if (!empty($_POST['article_category']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					article_category::edit(2, $_POST['article_category']);
					msg::message("�޸����·�����Ϣ�ɹ�", "?c=article_category");
					exit;
				} else {
					article_category::edit(1, $_POST['article_category']);
					msg::message("�������·�����Ϣ�ɹ�", "?c=article_category");
					exit;
				}
			}

			// ���޸ļ�¼��֤
			if ( strcasecmp('modify', $t) == 0)
			{
				$cate_id = (empty($_GET['id'])) ? '' : $_GET['id'];
				if (empty($cate_id)) $cate_id = $_POST['article_category']['cate_id'];
				if (empty($cate_id)) throw new Exception("������ʧ.");

				$rs = article_category::get_byid($cate_id);
				if (!isset($rs['cate_id'])) throw new Exception("������ʧ.");

				template::assign('article_category', $rs, PATH_TPLS_ADMIN);
			}

		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('article_category', $_POST['article_category'], PATH_TPLS_ADMIN);
        }
        template::display('article_category_edit.tpl', PATH_TPLS_ADMIN);
	}



	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// �����������������
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function clear()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : intval($_REQUEST['id']);
			if ( empty($id) ) throw new Exception("������ʧ��");
			$data = article_category::get_byid($id);
			template::assign('data', $data, PATH_TPLS_ADMIN);

			if (!empty($_POST['clear_confirm']))
			{
				if (1 == $_POST['clear_confirm']['confirm'])
				{
					article_category::clear($id);
					msg::message("��շ������ݳɹ���", "?c=article_category");
					exit;
				}
			}
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        template::display('article_category_clear.tpl', PATH_TPLS_ADMIN);
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ɾ�������¼
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : intval($_REQUEST['id']);
			if ( empty($id) ) throw new Exception("������ʧ��");

			article_category::del($id);
			msg::message("ɾ�����·���ɹ���", '?c=article_category');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        $this->index();
	}


}
