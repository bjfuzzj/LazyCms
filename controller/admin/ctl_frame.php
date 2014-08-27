<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_frame.php 2011-12-25  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_frame
{

	public static function index()
	{
        template::display('frame.tpl', PATH_TPLS_ADMIN);
	}

    public static function top()
    {
        template::assign('userid', $_SESSION['userid'], PATH_TPLS_ADMIN);
        template::display('top.tpl', PATH_TPLS_ADMIN);
    }

    public static function welcome()
    {
        template::display('welcome.tpl', PATH_TPLS_ADMIN);
    }

	public static function menu()
	{
        template::display('menu.tpl', PATH_TPLS_ADMIN);
	}

}
