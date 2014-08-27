<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: config.php 2012-5-9  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class config
{

    /**
     * ��ȡ��һ������
	 * 
	 * @param string $key ����������
     */
	public static function get_one($key)
	{
		if (empty($key)) return false;
		$key = addslashes($key);

		$data = db::select('slcms_config', 'cf_value', "cf_name = '{$key}'");
		return (empty($data)) ? false : $data[0]['cf_value'];
	}


    /**
     * ��ȡ����������Ϣ
	 * 
	 * @param array $configs ����������
     */
	public static function get_configs( $configs = array() )
	{
		$values = array();

		foreach( $configs as $key )
		{
			db::query("SELECT cf_value FROM `slcms_config` WHERE `cf_name` = '" . $key . "'");
			$rs = db::fetch_one();
			$values[$key] = $rs['cf_value'];
		}

		return $values;
	}


    /**
     * д�����������Ϣ
	 * 
	 * @param array $configs ������
     */
	public static function set_configs( $configs = array() )
	{
		foreach( $configs as $key => $value )
		{
			db::query("REPLACE `slcms_config` SET `cf_name` = '" . $key . "', `cf_value` = '" . $value . "'");
		}
	}

}

