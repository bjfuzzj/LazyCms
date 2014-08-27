<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: msg.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class msg
{
    /**
     * 操作提示页面，自动跳转
	 * 
	 * @param string	$message	提示信息
	 * @param string	$url		跳转页面路径
     */
    public static function message($message, $url = null)
    {
        if ($url == null)
        {
            $url = $_SERVER['HTTP_REFERER'];
        }
        template::assign('message', $message, PATH_TPLS_ADMIN);
        template::assign('url', $url, PATH_TPLS_ADMIN);
        template::display('msg.tpl', PATH_TPLS_ADMIN);
        exit();
    }

}
