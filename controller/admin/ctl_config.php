<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_config.php 2012-5-9  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_config
{
    public function index()
    {
        try
        {
			if (!empty($_POST['config']))
			{
				config::set_configs($_POST['config']);
				msg::message("修改系统配置信息成功！", '?c=config');
				exit;
			}

			$configs = array('sysname', 'sysurl', 'title', 'ceoemail', 'icp', 'icpurl', 'metakeyword', 'metadescrip', 'makestatic', 'statictype', 'staticfolder', 'startyear');
			template::assign('config', config::get_configs($configs), PATH_TPLS_ADMIN);
        }
        catch( Exception $e )
        {
            template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('config.tpl', PATH_TPLS_ADMIN);
    }


}
