<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: page_category.php 2012-5-12  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class page_category
{
	
    /**
     * ��ȡ���·����б�
	 * 
	 * @return array
     */
	public static function get_list()
	{
		
		// ��¼��ѯ
		$data = array();
		$sql = "SELECT * FROM `slcms_page_category` ORDER BY order_id ASC ";
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				$value['url'] = url::page_category($value['cate_id'], $value['cate_ab']);
				$data[] = $value;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ��ID�����·�����Ϣ
	 *
	 * @param int $id ���·���ID
	 * @return array
     */
	public static function get_byid($id)
	{
		$id = intval($id);

		db::query("SELECT * FROM `slcms_page_category` WHERE cate_id={$id} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['cate_id']) )  return false;
		$rs['url'] = url::page_category($rs['cate_id'], $rs['cate_ab'], 0);

		return $rs;
	}


    /**
     * ��ȡָ��������д�����·�����Ϣ
	 *
	 * @param string $name ���·�������
	 * @return array
     */
	public static function get_byname($name)
	{
		$name = strip($name);

		db::query("SELECT * FROM `slcms_page_category` WHERE cate_name='{$name}' LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['cate_id']) )  return false;
		$rs['url'] = url::page_category($rs['cate_id'], $rs['cate_ab'], 0);

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
			$page_cate = array();
			$page_cate['cate_id'] = intval($data['cate_id']);
			$page_cate['cate_name'] = htmlspecialchars(trim($data['cate_name']));
			$page_cate['cate_ab'] = htmlspecialchars(trim($data['cate_ab']));
			$page_cate['order_id'] = intval($data['order_id']);
			$page_cate['cate_tpl'] = htmlspecialchars(trim($data['cate_tpl']));
			$page_cate['detail_tpl'] = htmlspecialchars(trim($data['detail_tpl']));
			$page_cate['intro'] = htmlspecialchars(trim($data['intro']));

			if (empty($page_cate['cate_name'])) throw new Exception("����д��������.");

			// ��������ʱ��֤����
			if ( 1 == $type )
			{
				if (empty($page_cate['cate_ab']))  throw new Exception("����д����������д.");
				if (!preg_match('`^([a-zA-Z0-9_-]){1,30}$`', $page_cate['cate_ab']))  throw new Exception("����������дֻ����ΪӢ�ĺ����ֵ���ϣ��ҳ�����30λ����.");
				$page_cate['cate_ab'] = strtolower($page_cate['cate_ab']);

				// ������д������֤
				$data = db::query("SELECT count(*) AS sum FROM `slcms_page_category` WHERE cate_ab='". $page_cate['cate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("�˷���������д�Ѵ���,����������.");
				// Ҳ���������·�����д����
				db::query("SELECT count(*) AS sum FROM `slcms_article_category` WHERE cate_ab='". $page_cate['cate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("�˷���������д�Ѵ���,����������.");
			}

			// ��������ֵΪ��ʱ����������㣬�����ύ��ֵ���д洢
			$page_cate['order_id'] = 0;
			if (empty($data['order_id']))
			{
				db::query("SELECT MAX(order_id) AS mo FROM `slcms_page_category` ");
				$rs = db::fetch_one();
				$max_order = $rs['mo'];

				db::query("SELECT COUNT(*) AS sum FROM `slcms_page_category` ");
				$rs = db::fetch_one();
				$sum_order = $rs['sum'];

				$page_cate['order_id'] = ( ($max_order >= $sum_order) ? $max_order : $sum_order ) + 1;
			} else {
				$page_cate['order_id'] = $data['order_id'];
			}

			// ���ݲ���
			if ( 1 == $type ) {
				// �����¼
				$sql = "INSERT INTO `slcms_page_category` (cate_name, cate_ab, order_id, cate_tpl, detail_tpl, intro) VALUES('". $page_cate['cate_name'] ."', '". $page_cate['cate_ab'] ."', '". $page_cate['order_id'] ."', '". $page_cate['cate_tpl'] ."', '". $page_cate['detail_tpl'] ."', '". $page_cate['intro'] ."') ";
				db::query($sql);

				//$id = db::insert_id();
				//make_static::page_category('write', $id);
				return true;
			}
			if ( 2 == $type )
			{
				// ���¼�¼
				$sql = "UPDATE `slcms_page_category` SET cate_name='". $page_cate['cate_name'] ."', cate_ab='". $page_cate['cate_ab'] ."', order_id='". $page_cate['order_id'] ."', cate_tpl='". $page_cate['cate_tpl'] ."', detail_tpl='". $page_cate['detail_tpl'] ."', intro='". $page_cate['intro'] ."' WHERE cate_id='".$page_cate['cate_id']."' ";
				db::query($sql);

				make_static::page_category('write', $page_cate['cate_id']);
				return true;
			}
		}
		return false;
	}


	/**
	 * ��շ����µ����м�¼
	 *
	 * @param int	$cate_id	����ID
	 */
	public static function clear($cate_id)
	{
		if (! is_numeric($cate_id) ) throw new Exception("��������.");
		// ɾ�������ɵ��ļ�
		$makestatic = intval(config::get_one('makestatic'));
		if ($makestatic > 0)
		{
			db::query("SELECT page_id FROM `slcms_page_content` WHERE cate_id={$cate_id}");
			$list = db::fetch_all();
			if ( is_array($list) )
			{
				foreach ($list as $v)
				{
					make_static::page_content('del', $v['page_id']);
				}
			}
		}
		db::query("DELETE FROM `slcms_page_content` WHERE cate_id={$cate_id} ");
	}
	
	
	/**
	 * ɾ�������¼
	 * �����´������ݼ�¼ʱ������ɾ�����µ����ݷ���ɾ�������¼
	 *
	 * @param int	$cate_id	����ID
	 */
	public static function del($cate_id)
	{
		if (! is_numeric($cate_id) ) throw new Exception("��������.");

		db::query("SELECT count(*) AS sum FROM `slcms_page_content` WHERE cate_id={$cate_id} ");
		$rs = db::fetch_one();
		if ($rs['sum']>0) throw new Exception("�÷����´������ݣ�������÷����µ��������ݷ���ɾ�������¼.");

		make_static::page_category('del', $cate_id);
		db::query("DELETE FROM `slcms_page_category` WHERE cate_id={$cate_id} ");
	}

}