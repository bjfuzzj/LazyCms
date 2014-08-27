<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
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
     * ����Ա�����֤
	 * 
	 * @param string	$userid		�û�ID
	 * @param string	$password	�û�����
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

		// ����ƥ������µ�¼��Ϣ������TOKEN
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
	 * ��½״̬��Ȩ����֤
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

		// �ѵ�¼��֤
		$token = self::token($userid);
		if ( $token == $rs['token'])
		{
			// ����SESSION��Ծʱ��
			if( ! isset($_SESSION['last_access']) || (time() - $_SESSION['last_access']) > 10 )
			{
				$_SESSION['userid'] = $userid;
				$_SESSION['last_access'] = time();
			}
			setcookie('userid', $userid, time() + 3600, PATH_COOKIE);

			// ���������֤
			if ( empty($rs['purviews']) ) return false;
			$purviews = explode(",", $rs['purviews']);

			// ��������Ա��ֱ��ͨ��
			if ( in_array('admin_all', $purviews) ) return true;

			// ��ͨ����Ա��ϸȨ����֤
			$sys_con = (empty($_GET['c'])) ? 'login' : $_GET['c'];
			if ( $sys_con == 'login' || $sys_con == 'frame' || $sys_con == 'securimage' )
			{
				// ���������ֱ��ͨ��
				return true;
			} else {
				// ģ����ϸ��������֤
				$if_auth = false;
				if ( in_array($sys_con, $purviews) ) $if_auth = true;
				if ($if_auth)
				{
					return true;
				} else {
					msg::message('û�ж�Ӧ�Ĳ���Ȩ��', '?c=frame&a=welcome');
					exit();
				}
			}
		}

		return false;
	}


	/**
	 * ��ȡ�ͻ��˱�ʶ
	 */
    public static function get_user_agent()
    {
        return md5(AUTH_KEY . '_' . $_SERVER ['HTTP_USER_AGENT']);
    }

	/**
	 * ����TOKEN
	 * 
	 * @param string	$userid	�û�ID
	 * @return string	TOKENֵ
	 */
    public static function token($userid)
	{
		$auth_key = md5(AUTH_KEY);
		$user_agent = self::get_user_agent();
		$token = session_id . $userid . $auth_key . $user_agent;

		return md5($token);
	}

	/**
	 * �������
	 *
	 * @param string	$pwd	�����ַ���
	 * @return char(32)	���ܺ��ַ���
	 */
	public static function pwd_encode($pwd)
	{
		return md5(md5($pwd));
	}

}