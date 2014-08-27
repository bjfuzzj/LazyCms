<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: feedback.php 2012-5-16  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class feedback
{
	

    /**
     * ��ȡָ�������ļ�¼
	 *
	 * @param int	$flag		�������ͣ�0-���У�-1 - δ���ģ�1-���ģ�2-�ѻظ�
	 * @param int	$start		�ӵڼ�����¼��ʼ������$get_totalʱ�ò�����������
	 * @param boolen	$get_total	�Ƿ�ֻ��ȡ��ҳ������
	 * @param int	$page_rows	��ҳ��
	 * @return array
     */
	public static function page_list($flag = 0, $start = 0, $get_total = false, $page_rows = PAGE_ROWS)
	{
		$flag = intval($flag);
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);

		// SQL��乹��
		$condition = '';
		if ($flag)
		{
			$condition = " WHERE flag={$flag} ";
		} else {
			$condition = " WHERE 1=1 ";
		}

		// ��ѯ���������ļ�¼����
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_feedback` ". $condition;;
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];

		// ��Ϊ��ѯ�ܼ�¼��ʱ����
		if ($get_total) return $total;
		if ($total<1) return false;

		$condition .= ' ORDER BY fid DESC ';

		// ��ҳ��ѯ�趨
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// ��¼��ѯ
		$sql = "SELECT fid, user_name, email, title, update_time, flag FROM `slcms_feedback` ".$condition;
		db::query($sql);
		$data = db::fetch_all();

		return (empty($data)) ? false : $data;
	}


	/**
     * ��ȡ�б�
	 * 
	 * @return array
     */
	public static function get_list()
	{
		
		// ��¼��ѯ
		$data = array();
		$sql = "SELECT * FROM `slcms_feedback` ORDER BY fid DESC ";
		db::query($sql);
		$data = db::fetch_all();

		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ��ID�����Ϣ
	 *
	 * @param string $id ���ID
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
	 * �༭��¼
	 *
	 * @param int $type : 1-������2-�޸�
	 * @param array $data
	 * @return bool
	 */
	public static function edit($type, $data)
	{
		if (! is_numeric($type) ) throw new Exception("��������.");
		if (! is_array($data) ) throw new Exception("��������.");

		if (!empty($data))
		{
			$f = array();
			$f['fid'] = intval($data['fid']);
			$f['user_name'] = htmlspecialchars(trim($data['user_name']));
			$f['email'] = htmlspecialchars(trim($data['email']));
			$f['title'] = htmlspecialchars(trim($data['title']));
			$f['content'] = htmlspecialchars(trim($data['content']));

			if (empty($f['user_name'])) throw new Exception("����д�����û���.");
			if (empty($f['email'])) throw new Exception("����д����EMail��ַ.");
			if (empty($f['title'])) throw new Exception("����д���Ա���.");
			if (empty($f['content'])) throw new Exception("����д��������.");
			$f['update_time'] = time();

			// ���ݲ���
			if ( 1 == $type ) {
				// �����¼
				$sql = "INSERT INTO `slcms_feedback` (user_name, email, title, content, update_time, flag) VALUES('". $f['user_name'] ."', '". $f['email'] ."', '". $f['title'] ."', '". $f['content'] ."', '". $f['update_time'] ."', -1) ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type && $f['fid'])
			{
				// ���¼�¼
				$sql = "UPDATE `slcms_feedback` SET user_name='". $f['user_name'] ."', email='". $f['email'] ."', title='". $f['title'] ."', content='". $f['content'] ."', update_time='". $f['update_time'] ."' WHERE fid='".$f['fid']."' ";
				db::query($sql);

				return true;
			}
		}
		return false;
	}


	/**
	 * �������Լ�¼
	 *
	 * @param array $data
	 * @return bool
	 */
	public static function addnew($data)
	{
		if (! is_array($data) ) throw new Exception("������д������Ϣ�����ύ.");

		if (!empty($data))
		{
			$f = array();
			$f['user_name'] = (empty($data['user_name'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['user_name']))));
			$f['email'] = (empty($data['email'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['email']))));
			$f['title'] = (empty($data['title'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['title']))));
			$f['content'] = (empty($data['content'])) ? '' : addslashes(htmlspecialchars(trim(strip_tags($data['content']))));

			if (!empty($f['user_name'])) $f['user_name'] = substr($f['user_name'], 0, 20);
			if (!empty($f['email'])) $f['email'] = substr($f['email'], 0, 50);

			if (empty($f['title'])) throw new Exception('����д�������⡣');
			if (empty($f['content'])) throw new Exception('����д������顣');
			if (strlen($f['content']) > 600 || strlen($f['content']) < 40) throw new Exception('�뽫�������������� 20 - 300 �֣��������������ִ��ύ��');

			$f['update_time'] = time();

			// �����¼
			$sql = "INSERT INTO `slcms_feedback` (user_name, email, title, content, update_time, flag) VALUES('". $f['user_name'] ."', '". $f['email'] ."', '". $f['title'] ."', '". $f['content'] ."', '". $f['update_time'] ."', -1) ";
			db::query($sql);

			return true;
		}
		return false;
	}


	/**
	 * ɾ����¼
	 *
	 * @param int	$id
	 */
	public static function del($id)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");

		$id = array_to_string($id);
		db::query("DELETE FROM `slcms_feedback` WHERE fid IN($id) ");
	}


	/**
	 * �������Ա�־
	 *
	 * @param int	$id
	 */
	public static function set_flag($id, $state = 0)
	{
		$id = (empty($id)) ? 0 : intval($id);
		if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");
		$state = intval($state);

		$rs = self::get_one($id);
		if ($rs['flag']<0)
		{
			db::query("UPDATE `slcms_feedback` SET flag={$state} WHERE fid={$id} ");
		}
	}


	/**
	 * ���Իظ�
	 *
	 * @param array	$date
	 */
	public static function reply($data)
	{
		if (! is_array($data) ) throw new Exception("��������A.");

		if (!empty($data))
		{
			$f = array();
			$f['fid'] = intval($data['fid']);
			$f['reply_content'] = htmlspecialchars(trim($data['reply_content']));

			if (empty($f['fid'])) throw new Exception("��������B.");
			if (empty($f['reply_content'])) throw new Exception("����д�ظ�����.");
			$f['reply_time'] = time();

			// ���¼�¼
			$sql = "UPDATE `slcms_feedback` SET reply_content='". $f['reply_content'] ."', reply_time='". $f['reply_time'] ."', flag=2 WHERE fid='".$f['fid']."' ";
			db::query($sql);

			return true;
		}
		return false;
	}

}