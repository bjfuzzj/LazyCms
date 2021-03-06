<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_article_category.php 2012-5-10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_article_category
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 显示文章分类列表
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
			if (!empty($_POST['article_category']))
			{
				if ( strcasecmp('modify', $t) == 0)
				{
					article_category::edit(2, $_POST['article_category']);
					msg::message("修改文章分类信息成功", "?c=article_category");
					exit;
				} else {
					article_category::edit(1, $_POST['article_category']);
					msg::message("新增文章分类信息成功", "?c=article_category");
					exit;
				}
			}

			// 待修改记录验证
			if ( strcasecmp('modify', $t) == 0)
			{
				$cate_id = (empty($_GET['id'])) ? '' : $_GET['id'];
				if (empty($cate_id)) $cate_id = $_POST['article_category']['cate_id'];
				if (empty($cate_id)) throw new Exception("参数丢失.");

				$rs = article_category::get_byid($cate_id);
				if (!isset($rs['cate_id'])) throw new Exception("参数丢失.");

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
	// 清除分类下所有内容
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function clear()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : intval($_REQUEST['id']);
			if ( empty($id) ) throw new Exception("参数丢失！");
			$data = article_category::get_byid($id);
			template::assign('data', $data, PATH_TPLS_ADMIN);

			if (!empty($_POST['clear_confirm']))
			{
				if (1 == $_POST['clear_confirm']['confirm'])
				{
					article_category::clear($id);
					msg::message("清空分类内容成功！", "?c=article_category");
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
	// 删除分类记录
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	public function del()
	{
		try 
		{
			$id = (empty($_REQUEST['id'])) ? '' : intval($_REQUEST['id']);
			if ( empty($id) ) throw new Exception("参数丢失！");

			article_category::del($id);
			msg::message("删除文章分类成功！", '?c=article_category');
		}
		catch( Exception $e )
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
		}
        $this->index();
	}


}
