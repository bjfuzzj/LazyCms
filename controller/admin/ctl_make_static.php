<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
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
				$static = '�����ɾ�̬ҳ��';
				break;
			case 1 :
				$static = 'ֻ���ɵ�ҳģ��ҳ��';
				break;
			case 2 :
				$static = 'ֻ������վ��ҳ����ҳģ��ҳ��';
				break;
			case 3 :
				$static = 'ֻ������վ��ҳ����ҳģ�顢��ϸ����ҳҳ��';
				break;
			case 9 :
				$static = '������վҳ��';
				break;
			default :
				$static = '�����ɾ�̬ҳ��';
				break;
		}
		template::assign('makestatic', $makestatic, PATH_TPLS_ADMIN);
		template::assign('static', $static, PATH_TPLS_ADMIN);

		if (!empty($_GET['t']))
		{
			template::assign('make', 'make', PATH_TPLS_ADMIN);
		}
        template::display('make_static.tpl', PATH_TPLS_ADMIN);


		// �ֶ�����
		if (!empty($_GET['t']))
		{
			$t = htmlspecialchars(trim($_GET['t']));

			//������վ��ҳ
			if ( ($makestatic > 1) && ($t == 'all' || $t == 'index') ) 
			{
				make_static::make_index();
			}

			//�������·���ҳ
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

			//��������ҳ
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

			//���ɵ�ҳ����ҳ
			if ( ($makestatic > 0) && ($t == 'all' || $t == 'page_category') ) 
			{
				$rs = page_category::get_list();
				foreach ($rs as $v)
				{
					make_static::page_category('write', $v['cate_id']);
				}
			}

			//���ɵ�ҳ
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

			// �������Է���ҳ
			if ( $t == 'all' || $t == 'feedback' )
			{
				make_static::feedback('write');
			}

			msg::message("����ҳ��ɹ�", "?c=make_static");
		}
    }


}
