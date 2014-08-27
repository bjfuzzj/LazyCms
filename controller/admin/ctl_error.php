<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_error.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_error
{
    public static function index()
    {
		header("HTTP/1.1 404 Not Found");
		exit();
	}

    public static function error()
    {
		header("HTTP/1.1 404 Not Found");
		exit();
	}
}
