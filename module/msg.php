<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: msg.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class msg
{
    /**
     * ������ʾҳ�棬�Զ���ת
	 * 
	 * @param string	$message	��ʾ��Ϣ
	 * @param string	$url		��תҳ��·��
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
