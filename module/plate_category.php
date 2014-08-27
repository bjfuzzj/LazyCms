<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: plate_category.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class plate_category
{
	private static $plate_types = array(0=>'δ����', 1=>'�ı�', 2=>'ͼƬ'); // ��ǩ��������

    /**
     * ��ȡָ�������ļ�¼
	 *
	 * @param int	$start		�ӵڼ�����¼��ʼ������$get_totalʱ�ò�����������
	 * @param boolen	$get_total	�Ƿ�ֻ��ȡ��ҳ������
	 * @param int	$page_rows	��ҳ��
	 * @return array
     */
	public static function page_list($start = 0, $get_total = false, $page_rows = PAGE_ROWS)
	{
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);

		// ��ѯ���������ļ�¼����
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_plate_category` ";
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];

		// ��Ϊ��ѯ�ܼ�¼��ʱ����
		if ($get_total) return $total;
		if ($total<1) return false;

		// ��ҳ��ѯ�趨
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// ��¼��ѯ
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
     * ��ȡָ��ID�����Ϣ
	 *
	 * @param string $id ���ID
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
     * ��ȡָ��ID�����Ϣ
	 *
	 * @param string $plate_ab ��飨��д����ʶ
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
			$plate_cate = array();
			$plate_cate['id'] = intval($data['id']);
			$plate_cate['plate_ab'] = htmlspecialchars(trim($data['plate_ab']));
			$plate_cate['plate_name'] = htmlspecialchars(trim($data['plate_name']));
			$plate_cate['plate_type'] = intval($data['plate_type']);
			$plate_cate['intro'] = htmlspecialchars(trim($data['intro']));

			if (empty($plate_cate['plate_name'])) throw new Exception("����д�������.");

			// ��ǩ��ʶ��ID����֤
			if (empty($plate_cate['plate_ab']))  throw new Exception("����д����ʶ.");
			if (!preg_match('`^([a-zA-Z0-9_-]){1,30}$`', $plate_cate['plate_ab']))  throw new Exception("����ʶֻ����ΪӢ�ĺ����ֵ���ϣ��ҳ�����30λ����.");
			$plate_cate['plate_ab'] = strtolower($plate_cate['plate_ab']);

			// ���ݲ���
			if ( 1 == $type ) {
				// ������д������֤
				$data = db::query("SELECT count(*) AS sum FROM `slcms_plate_category` WHERE plate_ab='". $plate_cate['plate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("�˰���ʶ�Ѵ���,����������.");

				// �����¼
				$sql = "INSERT INTO `slcms_plate_category` (plate_ab, plate_name, plate_type, intro) VALUES('". $plate_cate['plate_ab'] ."', '". $plate_cate['plate_name'] ."', '". $plate_cate['plate_type'] ."', '". $plate_cate['intro'] ."') ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type && $plate_cate['id'])
			{
				// Ҳ���������е�������д����
				db::query("SELECT count(*) AS sum FROM `slcms_plate_category` WHERE id<>". $plate_cate['id'] ." AND plate_ab='". $plate_cate['plate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("���°���ʶ�Ѵ���,����������.");

				// ���¼�¼
				$sql = "UPDATE `slcms_plate_category` SET plate_ab='". $plate_cate['plate_ab'] ."', plate_name='". $plate_cate['plate_name'] ."', plate_type='". $plate_cate['plate_type'] ."', intro='". $plate_cate['intro'] ."' WHERE id='".$plate_cate['id']."' ";
				db::query($sql);

				return true;
			}
		}
		return false;
	}


	/**
	 * ɾ�������¼�����µ���������
	 *
	 * @param int	$id	����ID
	 */
	public static function del($id)
	{
		if (! is_numeric($id) ) throw new Exception("��������.");

		db::query("DELETE FROM `slcms_plate_content` WHERE plate_id={$id} ");
		db::query("DELETE FROM `slcms_plate_category` WHERE id={$id} ");
	}


	/**
	 * ��ȡ��ǩ��������
	 *
	 * @param int	$classid	���ͱ��
	 */
	public static function get_plate_type($typeid = 0)
	{
		$typeid = intval($typeid);
		return self::$plate_types[$typeid];
	}

}