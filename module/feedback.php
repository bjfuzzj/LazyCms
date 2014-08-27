<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: feedback.php 2012-5-16  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class feedback
{
	

    /**
     * 获取指定参数的记录
	 *
	 * @param int	$flag		留言类型：0-所有，-1 - 未查阅，1-已阅，2-已回复
	 * @param int	$start		从第几条记录开始，设置$get_total时该参数不起作用
	 * @param boolen	$get_total	是否只获取分页的总数
	 * @param int	$page_rows	分页数
	 * @return array
     */
	public static function page_list($flag = 0, $start = 0, $get_total = false, $page_rows = PAGE_ROWS)
	{
		$flag = intval($flag);
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);

		// SQL语句构造
		$condition = '';
		if ($flag)
		{
			$condition = " WHERE flag={$flag} ";
		} else {
			$condition = " WHERE 1=1 ";
		}

		// 查询符合条件的记录总数
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_feedback` ". $condition;;
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];

		// 当为查询总记录数时返回
		if ($get_total) return $total;
		if ($total<1) return false;

		$condition .= ' ORDER BY fid DESC ';

		// 分页查询设定
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// 记录查询
		$sql = "SELECT fid, user_name, email, title, update_time, flag FROM `slcms_feedback` ".$condition;
		db::query($sql);
		$data = db::fetch_all();

		return (empty($data)) ? false : $data;
	}


	/**
     * 获取列表
	 * 
	 * @return array
     */
	public static function get_list()
	{
		
		// 记录查询
		$data = array();
		$sql = "SELECT * FROM `slcms_feedback` ORDER BY fid DESC ";
		db::query($sql);
		$data = db::fetch_all();

		return (empty($data)) ? false : $data;
	}


    /**
     * 获取指定ID板块信息
	 *
	 * @param string $id 板块ID
	 * @return array
     */
	public static function get_one($fid)
	{
		$fid = intval($fid);

		db::query("SELECT * FROM `slcms_feedback` WHERE fid={$fid} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['fid']) )  return false;

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
			$f = array();
			$f['fid'] = intval($data['fid']);
			$f['user_name'] = htmlspecialchars(trim($data['user_name']));
			$f['email'] = htmlspecialchars(trim($data['email']));
			$f['title'] = htmlspecialchars(trim($data['title']));
			$f['content'] = htmlspecialchars(trim($data['content']));

			if (empty($f['user_name'])) throw new Exception("请填写您的用户名.");
			if (empty($f['email'])) throw new Exception("请填写您的EMail地址.");
			if (empty($f['title'])) throw new Exception("请填写留言标题.");
			if (empty($f['content'])) throw new Exception("请填写留言内容.");
			$f['update_time'] = time();

			// 数据操作
			if ( 1 == $type ) {
				// 插入记录
				$sql = "INSERT INTO `slcms_feedback` (user_name, email, title, content, update_time, flag) VALUES('". $f['user_name'] ."', '". $f['email'] ."', '". $f['title'] ."', '". $f['content'] ."', '". $f['update_time'] ."', -1) ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type && $f['fid'])
			{
				// 更新记录
				$sql = "UPDATE `slcms_feedback` SET user_name='". $f['user_name'] ."', email='". $f['email'] ."', title='". $f['title'] ."', content='". $f['content'] ."', update_time='". $f['update_time'] ."' WHERE fid='".$f['fid']."' ";
				db::query($sql);

				return true;
			}
		}
		return false;
	}


	/**
	 * 新增留言记录
	 *
	 * @param array $data
	 * @return bool
	 */
	public static function addnew($data)
	{
		if (! is_array($data) ) throw new Exception("请先填写留言信息后再提交.");

		if (!empty($data))
		{
			$f = array();
			$f['user_name'] = (empty($data['user_name'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['user_name']))));
			$f['email'] = (empty($data['email'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['email']))));
			$f['title'] = (empty($data['title'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['title']))));
			$f['content'] = (empty($data['content'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['content']))));

			if (!empty($f['user_name'])) $f['user_name'] = substr($f['user_name'], 0, 20);
			if (!empty($f['email'])) $f['email'] = substr($f['email'], 0, 50);

			if (empty($f['title'])) throw new Exception('请填写留言主题。');
			if (empty($f['content'])) throw new Exception('请填写意见或建议。');
			if (strlen($f['content']) > 600 || strlen($f['content']) < 40) throw new Exception('请将您的描述控制在 20 - 300 字，更多内容请您分次提交。');

			$f['update_time'] = time();

			// 插入记录
			$sql = "INSERT INTO `slcms_feedback` (user_name, email, title, content, update_time, flag) VALUES('". $f['user_name'] ."', '". $f['email'] ."', '". $f['title'] ."', '". $f['content'] ."', '". $f['update_time'] ."', -1) ";
			db::query($sql);

			return true;
		}
		return false;
	}


	/**
	 * 删除记录
	 *
	 * @param int	$id
	 */
	public static function del($id)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("请选定要操作的记录！");

		$id = array_to_string($id);
		db::query("DELETE FROM `slcms_feedback` WHERE fid IN($id) ");
	}


	/**
	 * 更改留言标志
	 *
	 * @param int	$id
	 */
	public static function set_flag($id, $state = 0)
	{
		$id = (empty($id)) ? 0 : intval($id);
		if (empty($id)) throw new Exception("请选定要操作的记录！");
		$state = intval($state);

		$rs = self::get_one($id);
		if ($rs['flag']<0)
		{
			db::query("UPDATE `slcms_feedback` SET flag={$state} WHERE fid={$id} ");
		}
	}


	/**
	 * 留言回复
	 *
	 * @param array	$date
	 */
	public static function reply($data)
	{
		if (! is_array($data) ) throw new Exception("参数错误A.");

		if (!empty($data))
		{
			$f = array();
			$f['fid'] = intval($data['fid']);
			$f['reply_content'] = htmlspecialchars(trim($data['reply_content']));

			if (empty($f['fid'])) throw new Exception("参数错误B.");
			if (empty($f['reply_content'])) throw new Exception("请填写回复内容.");
			$f['reply_time'] = time();

			// 更新记录
			$sql = "UPDATE `slcms_feedback` SET reply_content='". $f['reply_content'] ."', reply_time='". $f['reply_time'] ."', flag=2 WHERE fid='".$f['fid']."' ";
			db::query($sql);

			return true;
		}
		return false;
	}

}