<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: page_content.php 2012-5-12  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class page_content
{
    /**
     * 获取单页列表
	 *
	 * @param int	$cate_id	分类ID
     */
	public static function get_list($cate_id = 0)
	{
		$cate_id = intval($cate_id);

		// SQL语句构造
		$condition = '';
		if ( $cate_id > 0) 
		{
			$condition .= " WHERE P.cate_id={$cate_id} AND P.passed=1 ";
		} else {
			$condition .= " WHERE P.passed=1 ";
		}
		$condition .= " ORDER BY P.order_id ASC, P.page_id ASC  ";

		// 记录查询
		$data = array();
		$sql = "SELECT P.page_id, P.cate_id, P.page_name, P.title, P.default_pic, C.cate_name, C.cate_ab FROM `slcms_page_content` AS P LEFT JOIN `slcms_page_category` AS C ON P.cate_id=C.cate_id ".$condition;
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $v)
			{
				if (empty($value['default_pic'])) $value['default_pic'] = 'nopic.gif';
				$v['url'] = url::page($v['page_id'], $v['cate_ab'], $v['page_name'], 0);
				$data[] = $v;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * 获取指定参数的记录
	 *
	 * @param int	$cate_id	分类ID
	 * @param int	$order_type	记录排序类型：1-ID降序，2-ID升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
	 * @param int	$start		从第几条记录开始，设置$get_total时该参数不起作用
	 * @param boolen	$get_total	是否只获取分页的总数
	 * @param int	$page_rows	分页数
	 * @param int	$passed		审核状态：0-未设定，1-已审核， -1 --未审核
	 * @return array
     */
	public static function page_list($cate_id = 0, $order_type = 1, $start = 0, $get_total = false, $page_rows = PAGE_ROWS, $passed = 1)
	{
		$cate_id = intval($cate_id);
		$order_type = intval($order_type);
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);
		$passed = (empty($passed)) ? 0 : 1;

		// SQL语句构造
		$condition = '';
		if ($cate_id > 0)
		{
			$condition = " WHERE P.cate_id={$cate_id} ";
		} else {
			$condition = " WHERE 1=1 ";
		}
		if (1 == $passed) $condition .= " AND P.passed=1 ";

		// 查询符合条件的记录总数
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_page_content` AS P ". $condition;
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];
		// 当为查询总记录数时返回
		if ($get_total) return $total;
		if ($total<1) return false;

		// 排序方式
		switch ($order_type)
		{
			case 1 :
				$condition .= ' ORDER BY P.page_id DESC ';
				break;
			case 2 :
				$condition .= ' ORDER BY P.page_id ASC ';
				break;
			case 3 :
				$condition .= ' ORDER BY P.update_time DESC, P.page_id DESC ';
				break;
			case 4 :
				$condition .= ' ORDER BY P.update_time ASC, P.page_id ASC ';
				break;
			case 5 :
				$condition .= ' ORDER BY P.hits DESC, P.page_id DESC ';
				break;
			case 6 :
				$condition .= ' ORDER BY P.hits ASC, P.page_id ASC ';
				break;
			default :
				$condition .= ' ORDER BY P.page_id DESC ';
				break;
		}

		// 分页查询设定
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// SQL
		$sql = "SELECT P.page_id, P.cate_id, P.page_name, P.title, P.default_pic, P.create_time, P.update_time, P.order_id, P.passed, C.cate_name, C.cate_ab FROM `slcms_page_content` AS P LEFT JOIN `slcms_page_category` AS C ON P.cate_id=C.cate_id ".$condition;

		// 记录查询
		$data = array();
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				if (empty($value['default_pic'])) $value['default_pic'] = 'nopic.gif';
				$value['url'] = url::page($value['id'], $value['cate_ab'], $value['create_time'], 0);
				$data[] = $value;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * 获取指定ID的记录信息
	 *
	 * @param int $page_id 单页ID
	 * @return array
     */
	public static function get_one($page_id)
	{
		$page_id = intval($page_id);

		db::query("SELECT * FROM `slcms_page_content` WHERE page_id={$page_id} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['page_id']) )  return false;
		//$rs['url'] = url::page($rs['id'], $rs['cate_ab'], $rs['path'], 0);

		return $rs;
	}

    /**
     * 获取指定名称缩写的记录信息
	 *
	 * @param string $name 文章分类名称
	 * @return array
     */
	public static function get_byname($name)
	{
		$name = strip($name);

		db::query("SELECT * FROM `slcms_page_content` WHERE page_name='{$name}' LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['page_id']) )  return false;
		//$rs['url'] = url::page($rs['id'], $rs['cate_ab'], $rs['path'], 0);

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
			$page_content = array();
			$page_content['page_id'] = intval($data['page_id']);
			$page_content['cate_id'] = intval($data['cate_id']);
			$page_content['title'] = htmlspecialchars(trim($data['title']));
			$page_content['page_name'] = htmlspecialchars(trim($data['page_name']));
			$page_content['default_pic'] = htmlspecialchars(trim($data['default_pic']));
			$page_content['intro'] = trim($data['intro']);
			$page_content['content'] = trim($data['content']);
			$page_content['order_id'] = intval($data['order_id']);
			$page_content['passed'] = (bool)(trim($data['passed']));

			if ($page_content['cate_id'] < 1) throw new Exception("请选择归属分类.");
			if (empty($page_content['title'])) throw new Exception("请填写文章标题.");
			if (empty($page_content['content'])) throw new Exception("请填写正文内容.");

			// 页面名称验证
			if (empty($page_content['page_name']))  throw new Exception("请填写分类名称缩写.");
			if (!preg_match('`^([a-zA-Z0-9_-]){1,50}$`', $page_content['page_name']))  throw new Exception("分类名称缩写只允许为英文和数字的组合，且长度在50位以内.");
			$page_content['page_name'] = strtolower($page_content['page_name']);

			// 若表单排序值为空时进行排序计算，否则按提交的值进行存储
			$art_cate['order_id'] = 0;
			if (empty($data['order_id']))
			{
				db::query("SELECT MAX(order_id) AS mo FROM `slcms_page_content` WHERE cate_id='". $page_content['cate_id'] ."' ");
				$rs = db::fetch_one();
				$max_order = $rs['mo'];

				db::query("SELECT COUNT(*) AS sum FROM `slcms_page_content` WHERE cate_id='". $page_content['cate_id'] ."' ");
				$rs = db::fetch_one();
				$sum_order = $rs['sum'];

				$page_content['order_id'] = ( ($max_order >= $sum_order) ? $max_order : $sum_order ) + 1;
			} else {
				$page_content['order_id'] = $data['order_id'];
			}
			$page_content['update_time'] = time();

			// 数据操作
			if ( 1 == $type )
			{
				// 名称缩写重名验证
				db::query("SELECT count(*) AS sum FROM `slcms_page_content` WHERE page_name='". $page_content['page_name'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("此文件名称已存在,请重新输入.");

				$page_content['create_time'] = $page_content['update_time'];

				// 插入记录
				$sql = "INSERT INTO `slcms_page_content` (cate_id, page_name, title, default_pic, intro, content, order_id, create_time, update_time, passed) VALUES('". $page_content['cate_id'] ."', '". $page_content['page_name'] ."', '". $page_content['title'] ."', '". $page_content['default_pic'] ."', '". $page_content['intro'] ."', '". $page_content['content'] ."', '". $page_content['order_id'] ."', '". $page_content['create_time'] ."', '". $page_content['update_time'] ."', '". $page_content['passed'] ."') ";
				db::query($sql);

				$id = db::insert_id();
				make_static::page_content('write', $id);
				return true;
			}
			if ( 2 == $type && $page_content['page_id'])
			{
				// 也不可与已有的名称缩写重名
				db::query("SELECT count(*) AS sum FROM `slcms_page_content` WHERE page_id<>". $page_content['page_id'] ." AND page_name='". $page_content['page_name'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("此新文件名称已存在,请重新输入.");

				// 更新记录
				$sql = "UPDATE `slcms_page_content` SET cate_id='". $page_content['cate_id'] ."', page_name='". $page_content['page_name'] ."', title='". $page_content['title'] ."', default_pic='". $page_content['default_pic'] ."', intro='". $page_content['intro'] ."', content='". $page_content['content'] ."', order_id='". $page_content['order_id'] ."', update_time='". $page_content['update_time'] ."', passed='". $page_content['passed'] ."' WHERE page_id='".$page_content['page_id']."' ";
				db::query($sql);

				if ( $page_content['passed'] )
				{
					make_static::page_content('write', $page_content['page_id']);
				} else {
					make_static::page_content('del', $page_content['page_id']);
				}
				return true;
			}

		}
		return false;
	}



	/**
	 * 设置记录属性
	 *
	 * @param string $id	操作记录
	 * @param string $type	属性设置类型
	 * @param string $value	属性值
	 */
	public static function set_state($id, $type, $value = 0)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("请选定要操作的记录！");

		$id_list = array_to_string($id);
		$type = strtolower($type);

		$sql = '';
		$write = 0;
		switch ($type)
		{
			case 'passed' :
				$sql = "UPDATE `slcms_page_content` SET passed=1 WHERE page_id IN($id_list) ";
				$write = 1;
				break;
			case 'nopass' :
				$sql = "UPDATE `slcms_page_content` SET passed=0 WHERE page_id IN($id_list) ";
				$write = 0;
				break;
			case 'del' :
				$sql = "DELETE FROM `slcms_page_content` WHERE page_id IN($id_list) ";
				$write = 0;
				break;
			default :
				return false;
				break;
		}

		// 文件操作
		$makestatic = intval(config::get_one('makestatic'));
		if ($makestatic > 0)
		{
			if(is_array($id))
			{
				foreach ($id as $v)
				{
					if ($write)
					{
						make_static::page_content('write', $v);
					} else {
						make_static::page_content('del', $v);
					}
				}
			} else {
				$id = intval($id);
				if ($write)
				{
					make_static::page_content('write', $id);
				} else {
					make_static::page_content('del', $id);
				}
			}
		}
		db::query($sql);

		return true;
	}



}