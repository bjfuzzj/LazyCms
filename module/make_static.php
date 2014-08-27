<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: make_static.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class make_static
{
	/**
	 * makestatic:
	 * 0 - 不生成静态页面
	 * 1 - 只生成单页模块页面
	 * 2 - 只生成网站首页、单页模块页面
	 * 3 - 只生成网站首页、单页模块、详细内容页页面
	 * 9 - 生成整站页面
	 *
	 * statictype:
	 * 1 - .html, 2 - .htm, 3 - .shtml, 4 - .shtm, 0 - .php
	 */
	private static $instance;
    private static $makestatic = null; //生成静态页面项目数组
	private static $statictype = '.php'; //静态页面后缀名
	private static $statictypes = array(0=>'.php', 1=>'.html', 2=>'.htm', 3=>'.shtml', 4=>'.shtm', 5=>'.php');
	private static $staticfolder = null;

    public static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new make_static();
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
     * 生成网站首页
	 * 储路路径为： /index.静态页扩展名
	 */
	public static function make_index()
	{
		self::instance();
		if (self::$makestatic != 9) return false;

		// 生成根目录下的文件
		if ('.php' == self::$statictype)
		{
			$path = PATH_ROOT .'/default.php';
		}
		else
		{
			$path = PATH_ROOT .'/index'. self::$statictype;
		}
		$url = "/index.php?c=index";
		self::filewrite($path, $url, "wb+", 0);

		// 生成静态文件存储目录下的文件
		if ( (!empty(self::$staticfolder)) && ('.php' != self::$statictype) )
		{
			$path = PATH_ROOT . self::$staticfolder .'/index'. self::$statictype;
			self::filewrite($path, $url, "wb+", 0);
		}
	}


	/**
     * 生成文章列表页
	 *
	 * 分类首页存储路径为： /静态页目录/当前分类目录/index.静态页扩展名
	 * 分类按记录分页存储路径为： /静态页目录/当前分类目录/index_X.静态页扩展名
	 * 分类按年份分页存储路径为： /静态页目录/当前分类目录/YYYY.静态页扩展名
	 *
	 * @param string $method 操作类型: write, del
	 * @param int $id
     */
	public static function article_category($method, $id)
	{
		self::instance();
		// 生成需求验证
		if (self::$makestatic != 9) return false;
		if (empty($method)) return false;

		// 获取单页分类信息
		$id = intval($id);
		$rs = article_category::get_byid($id);
		if (!isset($rs['cate_id'])) return false;

		// 分类目录路径
		$base_path = PATH_ROOT . self::$staticfolder .'/'. $rs['cate_ab'];
		$base_url = "/index.php?c=category&id={$id}";

		// 文件操作
		$method = strtolower($method);
		if ($method == 'write')
		{
			// 生成分类默认首页
			$path = $base_path .'/index'. self::$statictype;
			self::filewrite($path, $base_url, "wb+", 0);

			// 1. 按记录数分页时生成的文件
				// A: 获取总记录数:
				$total = article_content::page_list($id, 1, 0, true);

				// B: 取得分页数目
				if (empty($rs['page_num']) || $rs['page_num'] < 1) $rs['page_num'] = PAGE_ROWS;
				$pages = ceil($total/$rs['page_num']);

				// C: 循环生成分页，页数从1开始计算
				for ($i = 0; $i < $pages; $i++)
				{
					$path = $base_path .'/index_'. ($i+1) . self::$statictype;
					$url = $base_url .'&start='. $i*$rs['page_num'];
					if (false == self::filewrite($path, $url, "wb+", 0)) break;
				}

			// 2. 按年份分页时生成的文件
				// A: 取得数据起始年份
				$startyear = intval(config::get_one('startyear'));
				$year = intval(date('Y'));
				if ($startyear < 1970 || $startyear > $year ) $startyear = $year;

				// B: 循环生成各年份分页
				for ($startyear; $startyear <= $year; $startyear++)
				{
					$path = $base_path .'/'. $startyear . self::$statictype;
					$url = $base_url .'&year='. $startyear;
					if (false == self::filewrite($path, $url, "wb+", 0)) break;
				}

			return true;
		}
		elseif ($method == 'del')
		{
			// 删除分类页面时直接删除分类文件夹
			return file_helper::rm_recurse($base_path);
		}
		return false;
	}


	/**
     * 生成文章页面
	 *
	 * 文件存储路径为： /静态页目录/detail/YYYYMM/ID.静态页扩展名
	 *
	 * @param string $method 操作类型: write, del
	 * @param int $id
     */
	public static function article_content($method, $id)
	{
		self::instance();
		// 生成需求验证
		if (self::$makestatic < 3) return false;
		if (empty($method)) return false;

		// 获取文章内容
		$id = empty($id) ? 0 : intval($id);
		$rs = article_content::get_one($id);
		if (!isset($rs['article_id'])) return false;
		$create_time = (empty($rs['create_time'])) ? $rs['update_time'] : $rs['create_time'];

		// 生成文件路径
		$path = PATH_ROOT . self::$staticfolder .'/detail/'. date('Ym', $create_time) .'/'. $id . self::$statictype;
		$url = "/index.php?c=article&id={$id}";

		// 文件操作
		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm($path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * 生成单页列表页
	 *
	 * 文件存储路径为： /静态页目录/单页分类目录/index.静态页扩展名
	 *
	 * @param string $method 操作类型: write, del
	 * @param int $id
     */
	public static function page_category($method, $id)
	{
		self::instance();
		// 生成需求验证
		if (self::$makestatic < 1) return false;
		if (empty($method)) return false;

		// 获取单页分类信息
		$rs = page_category::get_byid($id);
		if (!isset($rs['cate_id'])) return false;

		// 生成文件路径
		$base_path = PATH_ROOT . self::$staticfolder .'/'. $rs['cate_ab'];
		$path = $base_path .'/index'. self::$statictype;
		$url = "/index.php?c=page_cate&id={$id}";

		// 文件操作
		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm_recurse($base_path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * 生成单页内容页
	 *
	 * 文件存储路径为： /静态页目录/单页分类目录/单页名称.静态页扩展名
	 *
	 * @param string $method 操作类型: write, del
	 * @param int $id
     */
	public static function page_content($method, $id)
	{
		self::instance();
		// 生成需求验证
		if (self::$makestatic < 1) return false;
		if (empty($method)) return false;

		// 获取单页信息
		$rs = page_content::get_one($id);
		if (!isset($rs['page_id'])) return false;

		$cate = page_category::get_byid($rs['cate_id']);
		if (!isset($cate['cate_id'])) return false;

		// 生成文件路径
		$path = PATH_ROOT . self::$staticfolder .'/'. $cate['cate_ab'] .'/'. $rs['page_name'] . self::$statictype;
		$url = "/index.php?c=page&id={$id}";

		// 文件操作
		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm($path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * 生成留言反馈页
	 *
	 * 文件存储路径为： /静态页目录/feedback.静态页扩展名
	 *
	 * @param string $method 操作类型: write, del
	 * @param int $id
     */
	public static function feedback($method)
	{
		self::instance();

		$path = PATH_ROOT . self::$staticfolder .'/feedback'. self::$statictype;
		$url = "/index.php?c=feedback";

		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm($path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * 生成静态文件
	 *
	 * @param string $output_path 输出路径
	 * @param string $source_path 数据源地址
     */
	public static function filewrite($output_path, $source_path, $method = 'wb+', $iflock = 1, $check = 1, $chmod = 1)
	{
		$handle = fopen(HOST . $source_path, 'rb');
		$data = stream_get_contents($handle);
		fclose($handle);
		return file_helper::write($output_path, $data, $method, $iflock, $check, $chmod);
	}

}
