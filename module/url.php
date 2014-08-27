<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: url.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class url
{
	private static $instance;
    private static $makestatic = null; //���ɾ�̬ҳ����Ŀ����
	private static $statictype = '.php'; //��̬ҳ���׺��
	private static $statictypes = array(0=>'.php', 1=>'.html', 2=>'.htm', 3=>'.shtml', 4=>'.shtm', 5=>'.php');
	private static $staticfolder = null;

    public static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new url;
			self::$makestatic = intval(config::get_one('makestatic'));
			self::$staticfolder = config::get_one('staticfolder');
			if ('/' == self::$staticfolder) self::$staticfolder = '';
			self::$statictype = self::statictype();
        }
        return self::$instance;
    }


	/**
     * ��ȡ��̬�ļ���չ��
	 */
	public static function statictype()
	{
		$ftype = intval(config::get_one('statictype'));
		return self::$statictypes[$ftype];
	}


	/**
     * ��վ��ҳ��ַ
	 * ��̬�ļ���··��Ϊ�� /index.��̬ҳ��չ��
	 *
	 * @param string $url_type ·�����ͣ�0--���·���� 1--����·��
	 */
	public static function make_index($url_type = 0)
	{
		self::instance();
		if (self::$makestatic > 1)
		{
			if ('.php' == self::$statictype)
			{
				$url = '/default.php';
			}
			else
			{
				$url = '/index'. self::$statictype;
			}
		}
		else
		{
			$url = "/index.php";
		}
		if ($url_type) $url = URL . $url;

		return $url;
	}

	/**
     * ���·���·��
	 *
	 * ������ҳ�洢·��Ϊ�� /��̬ҳĿ¼/����Ŀ¼/index.��̬ҳ��չ��
	 * ���ఴ��¼��ҳ�洢·��Ϊ�� /��̬ҳĿ¼/����Ŀ¼/index_X.��̬ҳ��չ��
	 * ���ఴ��ݷ�ҳ�洢·��Ϊ�� /��̬ҳĿ¼/����Ŀ¼/YYYY.��̬ҳ��չ��
	 *
	 * @param int $id ģ���¼ID
	 * @param string $path ����Ŀ¼/·��
	 * @param string $url_type ·�����ͣ�0--���·���� 1--����·��
	 */
	public static function article_category($id, $path, $url_type = 0)
	{
		self::instance();
		if (self::$makestatic > 3)
		{
			$url = self::$staticfolder .'/'. $path .'/';
		}
		else
		{
			$url = '/index.php?c=category&id='. $id;
		}
		if ($url_type) $url = URL . $url;

		return $url;
	}


	/**
     * ��������ҳ·��
	 *
	 * ��̬�ļ��洢·��Ϊ�� /��̬ҳĿ¼/detail/YYYYMM/ID.��̬ҳ��չ��
	 *
	 * @param int $id ģ���¼ID
	 * @param datetime $param ��¼����ʱ��
	 * @param string $url_type ·�����ͣ�0--���·���� 1--����·��
     */
	public static function article($id, $create_time, $url_type = 0)
	{
		self::instance();
		if (self::$makestatic > 2)
		{
			$path = ( empty($create_time) ) ? '000000' : date('Ym', $create_time);
			$url = self::$staticfolder .'/detail/'. $path .'/'. $id . self::$statictype;
		}
		else
		{
			$url = '/index.php?c=article&id='. $id;
		}
		if ($url_type) $url = URL . $url;

		return $url;
	}

	/**
     * ��ҳ����ҳ·��
	 *
	 * ��̬�ļ��洢·��Ϊ�� /��̬ҳĿ¼/��ҳ����Ŀ¼/index.��̬ҳ��չ��
	 *
	 * @param int $id ģ���¼ID
	 * @param string $path ����Ŀ¼/·��
	 * @param string $url_type ·�����ͣ�0--���·���� 1--����·��
     */
	public static function page_category($id, $path, $url_type = 0)
	{
		self::instance();
		if (self::$makestatic > 0)
		{
			$url = self::$staticfolder .'/'. $path .'/';
		}
		else
		{
			$url = '/index.php?c=page_cate&id='. $id;
		}
		if ($url_type) $url = URL . $url;

		return $url;
	}

	/**
     * ��ҳ����ҳ·��
	 *
	 * ��̬�ļ��洢·��Ϊ�� /��̬ҳĿ¼/��ҳ����Ŀ¼/��ҳ����.��̬ҳ��չ��
	 *
	 * @param int $id ģ���¼ID
	 * @param string $path ����Ŀ¼/·��
	 * @param string $url_type ·�����ͣ�0--���·���� 1--����·��
     */
	public static function page($id, $path, $page_name, $url_type = 0)
	{
		self::instance();
		if (self::$makestatic > 0)
		{
			$url = self::$staticfolder .'/'. $path .'/'. $page_name . self::$statictype;
		}
		else
		{
			$url = '/index.php?c=page&id='. $page_name;
		}
		if ($url_type) $url = URL . $url;

		return $url;
	}

	/**
     * ���Է���ҳ·��
	 *
	 * ��̬�ļ��洢·��Ϊ�� /feedback.��̬ҳ��չ��
     */
	public static function feedback($url_type = 0)
	{
		self::instance();
		if (self::$makestatic = 9)
		{
			$url = '/feedback'. self::$statictype;
		}
		else
		{
			$url = '/index.php?c=feedback';
		}
		if ($url_type) $url = URL . $url;

		return $url;
	}

	/**
     * ���·��ఴ��ݷ�ҳ
     */
	public static function year($id, $path, $year = 2012, $url_type = 0)
	{
		self::instance();
		if (self::$makestatic > 3)
		{
			$url = self::$staticfolder .'/'. $path .'/'. $year . self::$statictype;
		}
		else
		{
			$url = "/index.php?c=category&id={$id}&year={$year}";
		}
		if ($url_type) $url = URL . $url;

		return $url;
	}


	/**
     * ���·�ҳ��¼��ʼ���Ӳ�����ʽ
     */
	public static function start()
	{
		self::instance();
		if (self::$makestatic > 3)
		{
			$url = 'index';
		}
		else
		{
			$url = '&start=';
		}

		return $url;
	}

}
