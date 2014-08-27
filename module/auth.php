<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: auth.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class auth
{
	private static $instance;
    protected $user = null;

    private function __construct(){}
    static function instance()
    {
        if ( ! isset (self::$instance ) )
        {
            self::$instance = new self();
        }
        return self::$instance;
	}


    /**
     * 管理员身份认证
	 * 
	 * @param string	$userid		用户ID
	 * @param string	$password	用户密码
	 * @return boolen
     */
	public function authenticate($userid, $password)
	{
		self::instance();
		if(empty($userid)) return false;
		$S_key = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');
		foreach($S_key as $value)
		{
			if (strpos($userid, $value) !== false) return false;
		}
		//if (!preg_match('`^([a-zA-Z0-9._-]){4,20}$`', $userid)) return false;
		$select = "SELECT user_id,password,locked FROM `slcms_member` WHERE `user_id`='$userid'";
		db::query($select);
		$rs = db::fetch_one();

		// 密码匹配则更新登录信息和生成TOKEN
		$password = self::pwd_encode($password);
		if ($password == $rs['password'])
		{
			if ($rs['locked'] != 0) return false;
			$token = self::token($userid);
			$ip = get_client_ip();

			db::query("UPDATE slcms_member SET last_time=this_time, last_ip=this_ip WHERE user_id='{$userid}' ");
			$update = "UPDATE slcms_member SET this_time=". time() .", this_ip='". $ip ."', token='". $token ."' WHERE user_id='{$userid}' ";
			db::query($update);

			$this->user = $userid;
			$_SESSION['userid'] = $userid;
			setcookie('userid', $userid, time() + 3600, PATH_COOKIE);
			return true;
		}

		return false;
	}


	/**
	 * 登陆状态及权限验证
	 * 
	 * @return boolen
	 */
	public function is_login()
	{
		self::instance();
		$userid = $_COOKIE['userid'];
		if (empty($userid))
		{
			$userid = $this->user;
			if (empty($userid)) return false;
		}

		db::query("SELECT purviews, token, locked FROM `slcms_member` WHERE `user_id`='$userid'");
		$rs = db::fetch_one();
		if ( !isset($rs['purviews']) || $rs['locked'] != 0) return false;

		// 已登录验证
		$token = self::token($userid);
		if ( $token == $rs['token'])
		{
			// 更新SESSION活跃时间
			if( ! isset($_SESSION['last_access']) || (time() - $_SESSION['last_access']) > 10 )
			{
				$_SESSION['userid'] = $userid;
				$_SESSION['last_access'] = time();
			}
			setcookie('userid', $userid, time() + 3600, PATH_COOKIE);

			// 操作许可验证
			if ( empty($rs['purviews']) ) return false;
			$purviews = explode(",", $rs['purviews']);

			// 超级管理员则直接通过
			if ( in_array('admin_all', $purviews) ) return true;

			// 普通管理员详细权限验证
			$sys_con = (empty($_GET['c'])) ? 'login' : $_GET['c'];
			if ( $sys_con == 'login' || $sys_con == 'frame' || $sys_con == 'securimage' )
			{
				// 管理基础项直接通过
				return true;
			} else {
				// 模块详细功能项验证
				$if_auth = false;
				if ( in_array($sys_con, $purviews) ) $if_auth = true;
				if ($if_auth)
				{
					return true;
				} else {
					msg::message('没有对应的操作权限', '?c=frame&a=welcome');
					exit();
				}
			}
		}

		return false;
	}


	/**
	 * 获取客户端标识
	 */
    public static function get_user_agent()
    {
        return md5(AUTH_KEY . '_' . $_SERVER ['HTTP_USER_AGENT']);
    }

	/**
	 * 生成TOKEN
	 * 
	 * @param string	$userid	用户ID
	 * @return string	TOKEN值
	 */
    public static function token($userid)
	{
		$auth_key = md5(AUTH_KEY);
		$user_agent = self::get_user_agent();
		$token = session_id . $userid . $auth_key . $user_agent;

		return md5($token);
	}

	/**
	 * 密码加密
	 *
	 * @param string	$pwd	明文字符串
	 * @return char(32)	加密后字符串
	 */
	public static function pwd_encode($pwd)
	{
		return md5(md5($pwd));
	}

}