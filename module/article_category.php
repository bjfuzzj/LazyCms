<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: article_category.php 2012-5-10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class article_category
{
	
    /**
     * 获取文章分类列表
	 * 
	 * @return array
     */
	public static function get_list()
	{
		
		// 记录查询
		$data = array();
		$sql = "SELECT * FROM `slcms_article_category` ORDER BY order_id ASC ";
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				$value['url'] = url::article_category($value['cate_id'], $value['cate_ab']);
				$data[] = $value;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * 获取指定ID的文章分类信息
	 *
	 * @param int $id 文章分类ID
	 * @return array
     */
	public static function get_byid($id)
	{
		$id = intval($id);

		db::query("SELECT * FROM `slcms_article_category` WHERE cate_id={$id} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['cate_id']) )  return false;
		$rs['url'] = url::article_category($rs['cate_id'], $rs['cate_ab']);

		return $rs;
	}


    /**
     * 获取指定名称缩写的文章分类信息
	 *
	 * @param string $name 文章分类名称
	 * @return array
     */
	public static function get_byname($name)
	{
		$name = strip($name);

		db::query("SELECT * FROM `slcms_article_category` WHERE cate_name={$name} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['cate_id']) )  return false;
		$rs['url'] = url::article_category($rs['cate_id'], $rs['cate_ab']);

		return $rs;
	}


	/**
	 * 编辑记录
	 *
	 * @param int $type : 1-新增，2-修改
	 * @param array $data
	 * @return bool
	 */
	public static function edit($type, $data)
	{
		if (! is_numeric($type) ) throw new Exception("参数错误.");
		if (! is_array($data) ) throw new Exception("参数错误.");

		if (!empty($data))
		{
			$art_cate = array();
			$art_cate['cate_id'] = intval($data['cate_id']);
			$art_cate['cate_name'] = htmlspecialchars(trim($data['cate_name']));
			$art_cate['cate_ab'] = htmlspecialchars(trim($data['cate_ab']));
			$art_cate['keywords'] = htmlspecialchars(trim($data['keywords']));
			$art_cate['description'] = htmlspecialchars(trim($data['description']));
			$art_cate['page_num'] = intval($data['page_num']);
			$art_cate['cate_tpl'] = htmlspecialchars(trim($data['cate_tpl']));
			$art_cate['detail_tpl'] = htmlspecialchars(trim($data['detail_tpl']));
			$art_cate['intro'] = htmlspecialchars(trim($data['intro']));

			if (empty($art_cate['cate_name'])) throw new Exception("请填写分类名称.");
			if ( $art_cate['page_num'] < 1 ) $art_cate['page_num'] = PAGE_ROWS;

			// 新增分类时验证名称
			if ( 1 == $type )
			{
				if (empty($art_cate['cate_ab']))  throw new Exception("请填写分类名称缩写.");
				if (!preg_match('`^([a-zA-Z0-9_-]){1,30}$`', $art_cate['cate_ab']))  throw new Exception("分类名称缩写只允许为英文和数字的组合，且长度在30位以内.");
				$art_cate['cate_ab'] = strtolower($art_cate['cate_ab']);

				// 名称缩写重名验证
				db::query("SELECT count(*) AS sum FROM `slcms_article_category` WHERE cate_ab='". $art_cate['cate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("此分类名称缩写已存在,请重新输入.");
				// 也不可与单页分类缩写重名
				db::query("SELECT count(*) AS sum FROM `slcms_page_category` WHERE cate_ab='". $art_cate['cate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("此分类名称缩写已存在,请重新输入.");
			}

			// 若表单排序值为空时进行排序计算，否则按提交的值进行存储
			$art_cate['order_id'] = 0;
			if (empty($data['order_id']))
			{
				db::query("SELECT MAX(order_id) AS mo FROM `slcms_article_category` ");
				$rs = db::fetch_one();
				$max_order = $rs['mo'];

				db::query("SELECT COUNT(*) AS sum FROM `slcms_article_category` ");
				$rs = db::fetch_one();
				$sum_order = $rs['sum'];

				$art_cate['order_id'] = ( ($max_order >= $sum_order) ? $max_order : $sum_order ) + 1;
			} else {
				$art_cate['order_id'] = $data['order_id'];
			}

			// 数据操作
			if ( 1 == $type ) {
				// 插入记录
				$sql = "INSERT INTO `slcms_article_category` (cate_name, cate_ab, order_id, page_num, cate_tpl, detail_tpl, keywords, description, intro) VALUES('". $art_cate['cate_name'] ."', '". $art_cate['cate_ab'] ."', '". $art_cate['order_id'] ."', '". $art_cate['page_num'] ."', '". $art_cate['cate_tpl'] ."', '". $art_cate['detail_tpl'] ."', '". $art_cate['keywords'] ."', '". $art_cate['description'] ."', '". $art_cate['intro'] ."') ";
				db::query($sql);

				//$id = db::insert_id();
				//make_static::article_category('write', $id);
				return true;
			}
			if ( 2 == $type )
			{
				// 更新记录
				$sql = "UPDATE `slcms_article_category` SET cate_name='". $art_cate['cate_name'] ."', cate_ab='". $art_cate['cate_ab'] ."', order_id='". $art_cate['order_id'] ."', page_num='". $art_cate['page_num'] ."', cate_tpl='". $art_cate['cate_tpl'] ."', detail_tpl='". $art_cate['detail_tpl'] ."', keywords='". $art_cate['keywords'] ."', description='". $art_cate['description'] ."', intro='". $art_cate['intro'] ."' WHERE cate_id='".$art_cate['cate_id']."' ";
				db::query($sql);
				
				make_static::article_category('write', $art_cate['cate_id']);
				return true;
			}
		}
		return false;
	}


	/**
	 * 清空分类下的所有文章记录
	 *
	 * @param int	$cate_id	分类ID
	 */
	public static function clear($cate_id)
	{
		if (! is_numeric($cate_id) ) throw new Exception("参数错误.");

		// 删除已生成的文件
		$makestatic = intval(config::get_one('makestatic'));
		if ($makestatic >= 3)
		{
			db::query("SELECT article_id FROM `slcms_article_content` WHERE cate_id={$cate_id}");
			$list = db::fetch_all();
			if ( is_array($list) )
			{
				foreach ($list as $v)
				{
					make_static::article_content('del', $v['article_id']);
				}
			}
		}
		db::query("DELETE FROM `slcms_article_content` WHERE cate_id={$cate_id} ");
	}
	
	
	/**
	 * 删除分类记录
	 * 分类下存在内容记录时（含回收站记录），需先删除旗下的内容方可删除分类记录
	 *
	 * @param int	$cate_id	分类ID
	 */
	public static function del($cate_id)
	{
		if (! is_numeric($cate_id) ) throw new Exception("参数错误.");

		db::query("SELECT count(*) AS sum FROM `slcms_article_content` WHERE cate_id={$cate_id} ");
		$rs = db::fetch_one();
		if ($rs['sum']>0) throw new Exception("该分类下存在内容，需清除该分类下的所有内容方可删除分类记录.");

		make_static::article_category('del', $cate_id);
		db::query("DELETE FROM `slcms_article_category` WHERE cate_id={$cate_id} ");
	}


	/**
	 * 生成分类按年份查询的链接列表
	 *
	 * @param int	$cate_id	分类ID
	 */
	public static function get_year_list($cate_id)
	{
		$cate_id = intval($cate_id);
		if (empty($cate_id)) return false;
		$cate = self::get_byid($cate_id);
		if ( !isset($cate['cate_id']) ) return false;

		$base_year = config::get_one('startyear');
		$base_year = ( empty($base_year) ) ? 2012 : intval($base_year);
		$this_year = intval(date('Y'));

		$html = '';
		$url = '';
		for ($i = $this_year; $i >= $base_year; $i--)
		{
			$url = url::year($cate_id, $cate['cate_ab'], $i);
			$html .= "<a href='{$url}'>{$i}</a> ";
		}
		return $html;
	}

}