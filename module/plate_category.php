<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: plate_category.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class plate_category
{
	private static $plate_types = array(0=>'未定义', 1=>'文本', 2=>'图片'); // 标签类型名称

    /**
     * 获取指定参数的记录
	 *
	 * @param int	$start		从第几条记录开始，设置$get_total时该参数不起作用
	 * @param boolen	$get_total	是否只获取分页的总数
	 * @param int	$page_rows	分页数
	 * @return array
     */
	public static function page_list($start = 0, $get_total = false, $page_rows = PAGE_ROWS)
	{
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);

		// 查询符合条件的记录总数
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_plate_category` ";
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];

		// 当为查询总记录数时返回
		if ($get_total) return $total;
		if ($total<1) return false;

		// 分页查询设定
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// 记录查询
		$sql = "SELECT id, plate_ab, plate_name, plate_type, intro FROM `slcms_plate_category` ".$condition;
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				$value['type'] = self::get_plate_type($value['plate_type']);
				$data[] = $value;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * 获取指定ID板块信息
	 *
	 * @param string $id 板块ID
	 * @return array
     */
	public static function get_one($id)
	{
		$id = intval($id);

		db::query("SELECT * FROM `slcms_plate_category` WHERE id={$id} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['id']) )  return false;

		return $rs;
	}


    /**
     * 获取指定ID板块信息
	 *
	 * @param string $plate_ab 板块（缩写）标识
	 * @return array
     */
	public static function get_byab($plate_ab)
	{
		$plate_ab = strip($plate_ab);

		db::query("SELECT * FROM `slcms_plate_category` WHERE plate_ab='{$plate_ab}' LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['id']) )  return false;

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
			$plate_cate = array();
			$plate_cate['id'] = intval($data['id']);
			$plate_cate['plate_ab'] = htmlspecialchars(trim($data['plate_ab']));
			$plate_cate['plate_name'] = htmlspecialchars(trim($data['plate_name']));
			$plate_cate['plate_type'] = intval($data['plate_type']);
			$plate_cate['intro'] = htmlspecialchars(trim($data['intro']));

			if (empty($plate_cate['plate_name'])) throw new Exception("请填写板块名称.");

			// 标签标识（ID）验证
			if (empty($plate_cate['plate_ab']))  throw new Exception("请填写板块标识.");
			if (!preg_match('`^([a-zA-Z0-9_-]){1,30}$`', $plate_cate['plate_ab']))  throw new Exception("板块标识只允许为英文和数字的组合，且长度在30位以内.");
			$plate_cate['plate_ab'] = strtolower($plate_cate['plate_ab']);

			// 数据操作
			if ( 1 == $type ) {
				// 名称缩写重名验证
				$data = db::query("SELECT count(*) AS sum FROM `slcms_plate_category` WHERE plate_ab='". $plate_cate['plate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("此板块标识已存在,请重新输入.");

				// 插入记录
				$sql = "INSERT INTO `slcms_plate_category` (plate_ab, plate_name, plate_type, intro) VALUES('". $plate_cate['plate_ab'] ."', '". $plate_cate['plate_name'] ."', '". $plate_cate['plate_type'] ."', '". $plate_cate['intro'] ."') ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type && $plate_cate['id'])
			{
				// 也不可与已有的名称缩写重名
				db::query("SELECT count(*) AS sum FROM `slcms_plate_category` WHERE id<>". $plate_cate['id'] ." AND plate_ab='". $plate_cate['plate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("此新板块标识已存在,请重新输入.");

				// 更新记录
				$sql = "UPDATE `slcms_plate_category` SET plate_ab='". $plate_cate['plate_ab'] ."', plate_name='". $plate_cate['plate_name'] ."', plate_type='". $plate_cate['plate_type'] ."', intro='". $plate_cate['intro'] ."' WHERE id='".$plate_cate['id']."' ";
				db::query($sql);

				return true;
			}
		}
		return false;
	}


	/**
	 * 删除分类记录及旗下的所有内容
	 *
	 * @param int	$id	分类ID
	 */
	public static function del($id)
	{
		if (! is_numeric($id) ) throw new Exception("参数错误.");

		db::query("DELETE FROM `slcms_plate_content` WHERE plate_id={$id} ");
		db::query("DELETE FROM `slcms_plate_category` WHERE id={$id} ");
	}


	/**
	 * 获取标签类型名称
	 *
	 * @param int	$classid	类型编号
	 */
	public static function get_plate_type($typeid = 0)
	{
		$typeid = intval($typeid);
		return self::$plate_types[$typeid];
	}

}