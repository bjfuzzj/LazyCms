<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_login.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_login
{
	protected $securimage = null;

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // 后台登陆验证
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function index()
    {
		try
		{
			$auth = auth::instance();

			if(isset($_POST["login"]))
			{
				$data = $_POST["login"];

				$this->securimage = new securimage();
				$userid = trim(array_var($data, "name"));
				$password = trim(array_var($data, "password"));
				$securimage = trim(array_var($data, "securimage"));

				if ($userid == '') throw new Exception('请输入登录帐号！');
				if ($password == '') throw new Exception('请输入登录密码！');
				if ($securimage == '')
				{
					throw new Exception('请输入验证码！');
				} else {
					if (!$this->securimage->check($securimage)) throw new Exception('请输入正确的验证码！');
				}

				if( $auth->authenticate($userid, $password) )
				{
					if( ! $auth->is_login())
					{
						throw new Exception("必须开启cookie.");
					}
					header("location: ?c=frame");
					exit;
				}
				else throw new Exception('账号或密码错误');
			}
		}
		catch (Exception $e)
		{
			template::assign('error', $e->getMessage(), PATH_TPLS_ADMIN);
			template::assign('login', $data, PATH_TPLS_ADMIN);
		}
        template::display('login.tpl', PATH_TPLS_ADMIN);
    }


	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // 注销后台管理
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function logout()
    {
		setcookie('userid', '', time() - 35920000, PATH_COOKIE);
		@session_start();
		$_SESSION = array();
		setcookie(session_name(), '', time()-3600);
		@session_destroy();
        header('location:?c=login');
    }


}
