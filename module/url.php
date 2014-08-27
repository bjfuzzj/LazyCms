<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: url.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class url
{
	private static $instance;
    private static $makestatic = null; //生成静态页面项目数组
	private static $statictype = '.php'; //静态页面后缀名
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
     * 获取静态文件扩展名
	 */
	public static function statictype()
	{
		$ftype = intval(config::get_one('statictype'));
		return self::$statictypes[$ftype];
	}


	/**
     * 网站首页地址
	 * 静态文件储路路径为： /index.静态页扩展名
	 *
	 * @param string $url_type 路径类型：0--相对路径， 1--绝对路径
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
     * 文章分类路径
	 *
	 * 分类首页存储路径为： /静态页目录/分类目录/index.静态页扩展名
	 * 分类按记录分页存储路径为： /静态页目录/分类目录/index_X.静态页扩展名
	 * 分类按年份分页存储路径为： /静态页目录/分类目录/YYYY.静态页扩展名
	 *
	 * @param int $id 模块记录ID
	 * @param string $path 链接目录/路径
	 * @param string $url_type 路径类型：0--相对路径， 1--绝对路径
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
     * 文章内容页路径
	 *
	 * 静态文件存储路径为： /静态页目录/detail/YYYYMM/ID.静态页扩展名
	 *
	 * @param int $id 模块记录ID
	 * @param datetime $param 记录生成时间
	 * @param string $url_type 路径类型：0--相对路径， 1--绝对路径
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
     * 单页分类页路径
	 *
	 * 静态文件存储路径为： /静态页目录/单页分类目录/index.静态页扩展名
	 *
	 * @param int $id 模块记录ID
	 * @param string $path 链接目录/路径
	 * @param string $url_type 路径类型：0--相对路径， 1--绝对路径
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
     * 单页内容页路径
	 *
	 * 静态文件存储路径为： /静态页目录/单页分类目录/单页名称.静态页扩展名
	 *
	 * @param int $id 模块记录ID
	 * @param string $path 链接目录/路径
	 * @param string $url_type 路径类型：0--相对路径， 1--绝对路径
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
     * 留言反馈页路径
	 *
	 * 静态文件存储路径为： /feedback.静态页扩展名
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
     * 文章分类按年份分页
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
     * 文章分页记录起始链接参数格式
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
