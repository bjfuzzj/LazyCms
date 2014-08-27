<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_feedback.php 2012-5-17  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_feedback
{
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	// ���Ա�����
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public static function index()
    {
		$title = config::get_one('sysname');
		$title .= ' - ���Է���';
		$path = "<li>���Է���</li>";
		$state = 1; // ��״̬

		try
		{
			define('MAX_SUBMIT', 3);

			if (!empty($_POST['feedback']))
			{
				// ��֤����
				$old_cookie = (isset($_COOKIE['fb_num'])) ? (int)$_COOKIE['fb_num'] : 0;
				if ($old_cookie >= MAX_SUBMIT)
				{
					unset($_POST['feedback']);
					throw new Exception('��Ǹ��24Сʱ����ֻ���ύ ' . MAX_SUBMIT . ' ����Ϣ��лл������');
				}
				$old_cookie++;

				// ��¼�ύ����
				if ($old_cookie > MAX_SUBMIT || !isset($_COOKIE['fb_time']) || $_COOKIE['fb_time'] < 1)
				{
					setcookie('fb_time', time(), time() + 86400);
					setcookie('fb_num', $old_cookie, time() + 86400);
				} else {
					setcookie('fb_time', $old_cookie, time() + 86400 - (time() - $_COOKIE['fb_time']));
				}

				// �����ݴ���
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
