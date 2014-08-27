<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_make_static.php 2012-5-16  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_make_static
{
    public function index()
    {
		$makestatic = intval(config::get_one('makestatic'));
		switch($makestatic)
		{
			case 0 :
				$static = '不生成静态页面';
				break;
			case 1 :
				$static = '只生成单页模块页面';
				break;
			case 2 :
				$static = '只生成网站首页、单页模块页面';
				break;
			case 3 :
				$static = '只生成网站首页、单页模块、详细内容页页面';
				break;
			case 9 :
				$static = '生成整站页面';
				break;
			default :
				$static = '不生成静态页面';
				break;
		}
		template::assign('makestatic', $makestatic, PATH_TPLS_ADMIN);
		template::assign('static', $static, PATH_TPLS_ADMIN);

		if (!empty($_GET['t']))
		{
			template::assign('make', 'make', PATH_TPLS_ADMIN);
		}
        template::display('make_static.tpl', PATH_TPLS_ADMIN);


		// 手动生成
		if (!empty($_GET['t']))
		{
			$t = htmlspecialchars(trim($_GET['t']));

			//生成网站首页
			if ( ($makestatic > 1) && ($t == 'all' || $t == 'index') ) 
			{
				make_static::make_index();
			}

			//生成文章分类页
			if ( ($makestatic > 3) && ($t == 'all' || $t == 'article_category') ) 
			{
				$rs = article_category::get_list();
				if ( is_array($rs) )
				{
					foreach ($rs as $v)
					{
						make_static::article_category('write', $v['cate_id']);
					}
				}
			}

			//生成内容页
			if ( ($makestatic > 2) && ($t == 'all' || $t == 'article_content') ) 
			{
				db::query("SELECT article_id FROM `slcms_article_content` WHERE passed=1 AND deleted=0");
				$rs = db::fetch_all();
				if ( is_array($rs) )
				{
					foreach ($rs as $v)
					{
						make_static::article_content('write', $v['article_id']);
					}
				}
			}

			//生成单页分类页
			if ( ($makestatic > 0) && ($t == 'all' || $t == 'page_category') ) 
			{
				$rs = page_category::get_list();
				foreach ($rs as $v)
				{
					make_static::page_category('write', $v['cate_id']);
				}
			}

			//生成单页
			if ( ($makestatic > 0) && ($t == 'all' || $t == 'page_content') ) 
			{
				db::query("SELECT page_id FROM `slcms_page_content` WHERE passed=1 ");
				$rs = db::fetch_all();
				if ( is_array($rs) )
				{
					foreach ($rs as $v)
					{
						make_static::page_content('write', $v['page_id']);
					}
				}
			}

			// 生成留言反馈页
			if ( $t == 'all' || $t == 'feedback' )
			{
				make_static::feedback('write');
			}

			msg::message("生成页面成功", "?c=make_static");
		}
    }


}
