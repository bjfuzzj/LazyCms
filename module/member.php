<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: member.php 2012-5-9  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class member
{

	/**
	 * �����б�
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
	 * ��ȡһ����¼
	 *
	 * @param int $user_id
	 * @return array
	 */
	public static function get_one($user_id)
	{
		if (empty($user_id)) throw new Exception("������ʧ.");

		$sql = "SELECT * FROM `slcms_member` WHERE user_id='{$user_id}' LIMIT 1";
		db::query($sql);
		$rs = db::fetch_one();
		if (empty($rs['user_id']))  return false;

		return $rs;
	}


	/**
	 * �༭һ����¼
	 *
	 * @param int $type : 1-������2-�޸�
	 * @param array $data
	 * @return bool
	 */
	public static function edit($type, $data)
	{
		if (! is_numeric($type) ) throw new Exception("��������.");
		if (! is_array($data) ) throw new Exception("��������.");

		// ���ݴ���
		if (!empty($data))
		{
			$member = array();
			$member['user_id'] = trim($data['user_id']);
			$member['nickname'] = htmlspecialchars(trim($data['nickname']));
			$member['password'] = trim($data['password']);
			$member['chkpwd'] = trim($data['chkpwd']);
			$member['locked'] = intval($data['locked']);

			$S_key = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');

			// �����ʺ�ʱ��֤����
			if ( 1 == $type )
			{
				// ��¼����֤
				if(empty($member['user_id'])) throw new Exception("�������û���.");
				foreach($S_key as $value)
				{
					if (strpos($member['user_id'], $value) !== false) throw new Exception("�û������зǷ��ַ�.");
				}
				$len = strlen($member['user_id']);
				if ($len < 4 || $len > 20) throw new Exception("��¼�������뱣����4-20λ.");

				// ������֤
				$data = db::query("SELECT count(*) AS sum FROM `slcms_member` WHERE user_id='". $member['user_id'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("���û����Ѵ���,�����������û���.");
			} else {
				if ( empty($member['user_id']) ) throw new Exception("��������.");
				if ( strcasecmp($member['user_id'], $GLOBALS['database']['manager']) == 0 ) throw new Exception("��ֹ�༭��ʼ����Ϣ��");
				if ( strcasecmp($member['user_id'], $GLOBALS['database']['manager']) == 0 ) $member['locked'] = 0;
			}

			// ��Ϊ ���� �� �޸������벻Ϊ�� ��ִ��������֤
			$password = '';
			if ( 1 == $type || !empty($member['password']) )
			{
				if(empty($member['password'])) throw new Exception("����������.");
				$len = strlen($member['password']);
				if ($len < 6 || $len > 20) throw new Exception("���볤���뱣����6-20λ.");
				foreach($S_key as $value)
				{
					if (strpos($member['password'], $value)!==false) throw new Exception("���벻�ܰ��������ַ�.");
				}
				if (strcmp($member['password'], $member['chkpwd']) != 0) throw new Exception("������������벻һ�¡�");
				$password = auth::pwd_encode($member['password']);
			}
			
			// �ǳƳ�����֤
			$len = strlen($member['nickname']);
			if ($len < 4 || $len > 20) throw new Exception("�ǳƳ����뱣����4-20λ.");

			if ( 1 == $type ) {
				// �����¼
				$sql = "INSERT INTO `slcms_member` (user_id, nickname, password, locked) VALUES('". $member['user_id'] ."', '". $member['nickname'] ."', '$password', '". $member['locked'] ."') ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type )
			{
				// ���¼�¼
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
	 * ɾ��һ����¼
	 *
	 * @param string $user_id
	 * @return bool
	 */
	public static function del($user_id)
	{
		if ( empty($user_id) ) throw new Exception("������ʧ��");
		if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("��ֹɾ����ʼ���ʺţ�");

		db::query("DELETE FROM `slcms_member` WHERE user_id='{$user_id}' ");
		return true;
	}


 	/**
	 * �����û�
	 *
	 * @param string $user_id
	 * @return bool
	 */
	public static function locked($user_id, $state = 0)
	{
		if ( empty($user_id) ) throw new Exception("������ʧ��");
		if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("��ֹɾ����ʼ���ʺţ�");
		$state = (empty($state)) ? 0 : 1;

		db::query("UPDATE `slcms_member` SET locked={$state} WHERE user_id='{$user_id}' ");
		return true;
	}


 	/**
	 * �޸������ʺ���Ϣ
	 *
	 * @param array $data
	 * @return bool
	 */
	public static function self_edit($data)
	{
		if (! is_array($data) ) throw new Exception("��������.");

		// ���ݴ���
		if (!empty($data))
		{
			$member = array();
			$member['user_id'] = trim($data['user_id']);
			$member['nickname'] = htmlspecialchars(trim($data['nickname']));
			$member['oldpwd'] = trim($data['oldpwd']);
			$member['password'] = trim($data['password']);
			$member['chkpwd'] = trim($data['chkpwd']);

			// ��֤�Ƿ�Ϊ�������
			if(empty($member['user_id'])) throw new Exception("����ʧ��.");
			if(empty($_SESSION['userid'])) throw new Exception("����ʧ��.");
			if ( strcasecmp($member['user_id'], $_SESSION['userid']) )
			{
				echo strcasecmp($member['user_id'], $_SESSION['userid']);
				die();
			}

			// ��֤ԭʼ����
			if (empty($member['oldpwd'])) throw new Exception("��������д����.");
			$member['oldpwd'] = auth::pwd_encode($member['oldpwd']);
			$how = self::get_one($member['user_id']);
			if ( !isset($how['user_id']) ) throw new Exception("����ʧ��.");
			if($member['oldpwd'] != $how['password']) throw new Exception("ԭʼ���벻��ȷ.");

			// ��֤������
			if(empty($member['password'])) throw new Exception("��������д����.");
			$len = strlen($member['password']);
			if ($len < 6 || $len > 20) throw new Exception("���볤���뱣����6-20λ.");
			$S_key = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');
			foreach($S_key as $value)
			{
				if (strpos($member['password'], $value)!==false) throw new Exception("���벻�ܰ��������ַ�.");
			}
			if (strcmp($member['password'], $member['chkpwd']) != 0) throw new Exception("������������벻һ�¡�");
			$password = auth::pwd_encode($member['password']);
			
			// �ǳƳ�����֤
			$len = strlen($member['nickname']);
			if ($len < 4 || $len > 20) throw new Exception("�ǳƳ����뱣����4-20λ.");

			// ���¼�¼
			$sql = "UPDATE `slcms_member` SET nickname='". $member['nickname'] ."', password='{$password}' WHERE user_id='". $member['user_id'] ."' ";
			db::query($sql);

			return true;
		}

		return false;
	}


 	/**
	 * �û�Ȩ��
	 *
	 * @param int $type : 1-��ѯ��2-д��
	 * @param string $user_id
	 * @param array $arr_purviews
	 * @return array/bool
	 */
	public static function purviews($type, $user_id, $arr_purviews = array())
	{
		if (! is_numeric($type) ) throw new Exception("��������.");
		if ( empty($user_id) ) throw new Exception("������ʧ.");
		if ( strcasecmp($user_id, $GLOBALS['database']['manager']) == 0 ) throw new Exception("��ֹ�༭��ʼ��Ȩ�ޣ�");

		db::query("SELECT user_id, purviews FROM `slcms_member` WHERE user_id='{$user_id}' LIMIT 1 ");
		$rs = db::fetch_one();
		if (!isset($rs['user_id'])) throw new Exception("������ʧ.");

		if ( 1 == $type )
		{
			// ��ȡȨ��ֵ������Ϊ��ֵ
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
			// ����Ȩ��ֵ����
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
