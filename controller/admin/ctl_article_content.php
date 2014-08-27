<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_article_content.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_article_content
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
				case 'clear' :
					self::clear();
					break;
				case 'clear_all' :
					self::clear_all();
					break;
			}
			die();
		}
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ��ʾ���������б�
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$cate_id = (empty($_REQUEST['cate_id'])) ? 0 : intval($_REQUEST['cate_id']); //����ID
			$t = (empty($_REQUEST['t'])) ? 'index' : $_REQUEST['t']; //��������

			template::assign('cate_id', $cate_id, PATH_TPLS_ADMIN);
			template::assign('t', $t, PATH_TPLS_ADMIN);
			template::assign('article_category', article_category::get_list(), PATH_TPLS_ADMIN);

			if (!empty($_REQUEST['keyword']))
			{
				$field = strtolower(trim($_REQUEST['field']));
				$keyword = strip(trim($_REQUEST['keyword']));

				switch ($field)
				{
					case 'title':
						$field_type = 1;
						break;
					case 'tags':
						$field_type = 2;
						break;
					case 'id':
						$field_type = 3;
						break;
					default:
						break;
				}

				template::assign('field', $field, PATH_TPLS_ADMIN);
				template::assign('keyword', $keyword, PATH_TPLS_ADMIN);
			}

			$passed = -1;
			if ( !empty($_REQUEST['passed']) )
			{
				$passed = intval($_REQUEST['passed']);
			}

			if (!empty($t) && $t == 'recycle')
			{
				$deleted = 1;
			} else {
				$deleted = 0;
			}

			$start = (empty($_GET['start'])) ? 0 : (int)$_GET['start']; //��ҳ��ʼֵ
			$total = article_content::page_list($cate_id, 1, $start, true, PAGE_ROWS_ADMIN, $passed, $deleted, $keyword, $field_type);
			$data = article_content::page_list($cate_id, 1, $start, false, PAGE_ROWS_ADMIN, $passed, $deleted, $keyword, $field_type);

			// ��¼�б��
			template::assign('page_url', "?c=article_content&a=index&t={$t}&cate_id={$cate_id}&field={$field}&keyword={$keyword}&passed={$passed}&deleted={$deleted}", PATH_TPLS_ADMIN);
			template::assign('pages', pager::get_page_number_list($total, $start, PAGE_ROWS_ADMIN), PATH_TPLS_ADMIN);
			template::assign('data', $data, PATH_TPLS_ADMIN);
		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('article_content_list.tpl', PATH_TPLS_ADMIN);
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
			template::assign('article_category', article_category::get_list(), PATH_TPLS_ADMIN);

			// ������
			if (!empty($_POST['article']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					article_content::edit(2, $_POST['article']);
					msg::message("�޸��������ݳɹ�", "?c=article_content");
					exit;
				} else {
					article_content::edit(1, $_POST['article']);
					msg::message("�����������ݳɹ�", "?c=article_content");
					exit;
				}
			}

			// ���޸ļ�¼��֤
			$rs = array();
			if ( strcasecmp('modify', $t) == 0)
			{
				$article_id = (empty($_GET['id'])) ? '' : $_GET['id'];
				if (empty($article_id)) $article_id = $_POST['article']['article_id'];
				if (empty($article_id)) throw new Exception("������ʧ.");

				$rs = article_content::get_one($article_id);
				if (!isset($rs['article_id'])) throw new Exception("������ʧ.");

			} else {
				// ��Ϣ��ʼ��
				$rs['copyfrom'] = '';
				$rs['hits'] = 0;
				$rs['update_time'] = time();
				$rs['passed'] = 1;
				$rs['deleted'] = 0;
			}
			template::assign('article', $rs, PATH_TPLS_ADMIN);

		}
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('article', $_POST['article'], PATH_TPLS_ADMIN);
        }
        template::display('article_content_edit.tpl', PATH_TPLS_ADMIN);
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

			article_content::set_state($id, 'passed');
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

			article_content::set_state($id, 'nopass');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ɾ����¼����������վ
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫɾ���ļ�¼��");

			article_content::set_state($id, 'del');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		echo("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ��¼��ԭ
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function restore()
	{
		try
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫ��ԭ�ļ�¼��");

			article_content::set_state($id, 'restore');
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
	public function clear()
	{
		try
		{
			$id = (empty($_REQUEST['id'])) ? '' : $_REQUEST['id'];
			if (empty($id)) throw new Exception("��ѡ��Ҫɾ���ļ�¼��");

			article_content::set_state($id, 'clear');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ��ջ���վ
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function clear_all()
	{
		article_content::clear_all();
		die("<script type='text/javascript'> (function(){history.back(-1);})(); </script>");
	}

}
