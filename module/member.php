<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: member.php 2012-5-9  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class member
{

	/**
	 * 返回列表
	 *
	 * @return array
	 */
	public static function get_list()
	{
		$sql = "SELECT user_id, nickname, locked, last_time, last_ip FROM `slcms_member` ";
		db::query($sql);
		$data = db::fetch_all();

		return (empty($data)) ? false : $data;
	}


	/**
	 * 获取一条记录
	 *
	 * @param int $user_id
	 * @return array
	 */
	public static function get_one($user_id)
	{
		if (empty($user_id)) throw new Exception("参数丢失.");

		$sql = "SELECT * FROM `slcms_member` WHERE user_id='{$user_id}' LIMIT 1";
		db::query($sql);
		$rs = db::fetch_one();
		if (empty($rs['user_id']))  return false;

		return $rs;
	}


	/**
	 * 编辑一条记录
	 *
	 * @param int $type : 1-新增，2-修改
	 * @param array $data
	 * @return bool
	 */
	public static function edit($type, $data)
	{
		if (! is_numeric($type) ) throw new Exception("参数错误.");
		if (! is_array($data) ) throw new Exception("参数错误.");

		// 数据处理
		if (!empty($data))
		{
			$member = array();
			$member['user_id'] = trim($data['user_id']);
			$member['nickname'] = htmlspecialchars(trim($data['nickname']));
			$member['password'] = trim($data['password']);
			$member['chkpwd'] = trim($data['chkpwd']);
			$member['locked'] = intval($data['locked']);

			$S_key = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');

			// 新增帐号时验证名称
			if ( 1 == $type )
			{
				// 登录名验证
				if(empty($member['user_id'])) throw new Exception("请输入用户名.");
				foreach($S_key as $value)
				{
					if (strpos($member['user_id'], $value) !== false) throw new Exception("用户名含有非法字符.");
				}
				$len = strlen($member['user_id']);
				if ($len < 4 || $len > 20) throw new Exception("登录名长度请保持在4-20位.");

				// 重名验证
				$data = db::query("SELECT count(*) AS sum FROM `slcms_member` WHERE user_id='". $member['user_id'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("此用户名已存在,请重新输入用户名.");
			} else {
				if ( empty($member['user_id']) ) throw new Exception("参数错误.");
				if ( strcasecmp($member['user_id'], $GLOBALS['database']['manager']) == 0 ) throw new Exception("禁止编辑创始人信息！");
				if ( strcasecmp($member['user_id'], $GLOBALS['database']['manager']) == 0 ) $member['locked'] = 0;
			}

			// 当为 新增 或 修改且密码不为空 则执行密码验证
			$password = '';
			if ( 1 == $type || !empty($member['password']) )
			{
				if(empty($member['password'])) throw new Exception("请输入密码.");
				$len = strlen($member['password']);
				if ($len < 6 || $len > 20) throw new Exception("密码长度请保持在6-20位.");
				foreach($S_key as $value)
				{
					if (strpos($member['password'], $value)!==false) throw new Exception("密码不能包含特殊字符.");
				}
				if (strcmp($member['password'], $member['chkpwd']) != 0) throw new Exception("两次输入的密码不一致。");
				$password = auth::pwd_encode($member['password']);
			}
			
			// 昵称长度验证
			$len = strlen($member['nickname']);
			if ($len < 4 || $len > 20) throw new Exception("昵称长度请保持在4-20位.");

			if ( 1 == $type ) {
				// 插入记录
				$sql = "INSERT INTO `slcms_member` (user_id, nickname, password, locked) VALUES('". $member['user_id'] ."', '". $member['nickname'] ."', '$password', '". $member['locked'] ."') ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type )
			{
				// 更新记录
				$sql = "UPDATE `slcms_member` SET nickname='". $member['nickname'] ."', locked='". $member['locked'] ."' ";
				if (!empty($password)) $sql .= ", password='{$password}' ";
				$sql .= " WHERE user_id='". $member['user_id'] ."' ";
				db::query($sql);

				return true;
			}
		}

		return false;
	}


 	/**
	 * 删除一条记录
	 *
	 * @param string $user_id
	 * @return bool
	 */
	public static function del($user_id)
	{
		if ( empty($user_id) ) throw new Exception("参数丢失！");
		if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("禁止删除创始人帐号！");

		db::query("DELETE FROM `slcms_member` WHERE user_id='{$user_id}' ");
		return true;
	}


 	/**
	 * 锁定用户
	 *
	 * @param string $user_id
	 * @return bool
	 */
	public static function locked($user_id, $state = 0)
	{
		if ( empty($user_id) ) throw new Exception("参数丢失！");
		if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("禁止删除创始人帐号！");
		$state = (empty($state)) ? 0 : 1;

		db::query("UPDATE `slcms_member` SET locked={$state} WHERE user_id='{$user_id}' ");
		return true;
	}


 	/**
	 * 修改自身帐号信息
	 *
	 * @param array $data
	 * @return bool
	 */
	public static function self_edit($data)
	{
		if (! is_array($data) ) throw new Exception("参数错误.");

		// 数据处理
		if (!empty($data))
		{
			$member = array();
			$member['user_id'] = trim($data['user_id']);
			$member['nickname'] = htmlspecialchars(trim($data['nickname']));
			$member['oldpwd'] = trim($data['oldpwd']);
			$member['password'] = trim($data['password']);
			$member['chkpwd'] = trim($data['chkpwd']);

			// 验证是否为自身操作
			if(empty($member['user_id'])) throw new Exception("操作失败.");
			if(empty($_SESSION['userid'])) throw new Exception("操作失败.");
			if ( strcasecmp($member['user_id'], $_SESSION['userid']) )
			{
				echo strcasecmp($member['user_id'], $_SESSION['userid']);
				die();
			}

			// 验证原始密码
			if (empty($member['oldpwd'])) throw new Exception("请完整填写各项.");
			$member['oldpwd'] = auth::pwd_encode($member['oldpwd']);
			$how = self::get_one($member['user_id']);
			if ( !isset($how['user_id']) ) throw new Exception("操作失败.");
			if($member['oldpwd'] != $how['password']) throw new Exception("原始密码不正确.");

			// 验证新密码
			if(empty($member['password'])) throw new Exception("请完整填写各项.");
			$len = strlen($member['password']);
			if ($len < 6 || $len > 20) throw new Exception("密码长度请保持在6-20位.");
			$S_key = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');
			foreach($S_key as $value)
			{
				if (strpos($member['password'], $value)!==false) throw new Exception("密码不能包含特殊字符.");
			}
			if (strcmp($member['password'], $member['chkpwd']) != 0) throw new Exception("两次输入的密码不一致。");
			$password = auth::pwd_encode($member['password']);
			
			// 昵称长度验证
			$len = strlen($member['nickname']);
			if ($len < 4 || $len > 20) throw new Exception("昵称长度请保持在4-20位.");

			// 更新记录
			$sql = "UPDATE `slcms_member` SET nickname='". $member['nickname'] ."', password='{$password}' WHERE user_id='". $member['user_id'] ."' ";
			db::query($sql);

			return true;
		}

		return false;
	}


 	/**
	 * 用户权限
	 *
	 * @param int $type : 1-查询，2-写入
	 * @param string $user_id
	 * @param array $arr_purviews
	 * @return array/bool
	 */
	public static function purviews($type, $user_id, $arr_purviews = array())
	{
		if (! is_numeric($type) ) throw new Exception("参数错误.");
		if ( empty($user_id) ) throw new Exception("参数丢失.");
		if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("禁止编辑创始人权限！");

		db::query("SELECT user_id, purviews FROM `slcms_member` WHERE user_id='{$user_id}' LIMIT 1 ");
		$rs = db::fetch_one();
		if (!isset($rs['user_id'])) throw new Exception("参数丢失.");

		if ( 1 == $type )
		{
			// 读取权限值并解析为数值
			$purviews = array();
			if (!is_null($rs['purviews']) || !empty($rs['purviews']))
			{
				$purviews = array_flip(explode(",", $rs['purviews']));
				if (is_array($purviews)) 
				{
					foreach ($purviews as $k => $v)
					{
						$purviews[$k] = 1;
					}
				}
			}
			return $purviews;

		} 
		elseif( 2 == $type) 
		{
			// 保存权限值数据
			$purviews = 'login';
			if ( is_array($arr_purviews) )
			{
				foreach ($arr_purviews as $k => $v)
				{
					if ($v == 1)
					{
						$purviews .= ',' . $k;
					}
				}
				$sql = "UPDATE `slcms_member` SET purviews='{$purviews}' WHERE user_id='{$user_id}' ";
				db::query($sql);
				return true;
			}

		}

		return false;
	}




}
