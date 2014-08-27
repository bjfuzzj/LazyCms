<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_feedback.php 2012-5-17  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_feedback
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// 留言表单处理
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public static function index()
    {
		$title = config::get_one('sysname');
		$title .= ' - 留言反馈';
		$path = "<li>留言反馈</li>";
		$state = 1; // 表单状态

		try
		{
			define('MAX_SUBMIT', 3);

			if (!empty($_POST['feedback']))
			{
				// 验证次数
				$old_cookie = (isset($_COOKIE['fb_num'])) ? (int)$_COOKIE['fb_num'] : 0;
				if ($old_cookie >= MAX_SUBMIT)
				{
					unset($_POST['feedback']);
					throw new Exception('抱歉，24小时内您只能提交 ' . MAX_SUBMIT . ' 次信息。谢谢合作！');
				}
				$old_cookie++;

				// 记录提交次数
				if ($old_cookie > MAX_SUBMIT || !isset($_COOKIE['fb_time']) || $_COOKIE['fb_time'] < 1)
				{
					setcookie('fb_time', time(), time() + 86400);
					setcookie('fb_num', $old_cookie, time() + 86400);
				} else {
					setcookie('fb_time', $old_cookie, time() + 86400 - (time() - $_COOKIE['fb_time']));
				}

				// 表单内容处理
				if ( feedback::addnew($_POST['feedback']) )
				{
					$state = 2;
					unset($_POST['feedback']);
				}
			}

		}
		catch( Exception $e )
		{
            template::assign('error', $e->getMessage());
			template::assign('feedback', $_POST['feedback']);
		}

		template::assign('title', $title);
		template::assign('keywords', '');
		template::assign('description', '');
		template::assign('path', $path);
		template::assign('state', $state);

		template::registerPlugin('function', 'site_config', 'func_site_config');
		template::registerPlugin('function', 'plate', 'func_get_plate_content');

		template::display('feedback.tpl');
	}


}
