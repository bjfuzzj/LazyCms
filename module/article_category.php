<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: article_category.php 2012-5-10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class article_category
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
		$sql = "SELECT * FROM `slcms_article_category` ORDER BY order_id ASC ";
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				$value['url'] = url::article_category($value['cate_id'], $value['cate_ab']);
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

		db::query("SELECT * FROM `slcms_article_category` WHERE cate_id={$id} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['cate_id']) )  return false;
		$rs['url'] = url::article_category($rs['cate_id'], $rs['cate_ab']);

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

		db::query("SELECT * FROM `slcms_article_category` WHERE cate_name={$name} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['cate_id']) )  return false;
		$rs['url'] = url::article_category($rs['cate_id'], $rs['cate_ab']);

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
			$art_cate = array();
			$art_cate['cate_id'] = intval($data['cate_id']);
			$art_cate['cate_name'] = htmlspecialchars(trim($data['cate_name']));
			$art_cate['cate_ab'] = htmlspecialchars(trim($data['cate_ab']));
			$art_cate['keywords'] = htmlspecialchars(trim($data['keywords']));
			$art_cate['description'] = htmlspecialchars(trim($data['description']));
			$art_cate['page_num'] = intval($data['page_num']);
			$art_cate['cate_tpl'] = htmlspecialchars(trim($data['cate_tpl']));
			$art_cate['detail_tpl'] = htmlspecialchars(trim($data['detail_tpl']));
			$art_cate['intro'] = htmlspecialchars(trim($data['intro']));

			if (empty($art_cate['cate_name'])) throw new Exception("����д��������.");
			if ( $art_cate['page_num'] < 1 ) $art_cate['page_num'] = PAGE_ROWS;

			// ��������ʱ��֤����
			if ( 1 == $type )
			{
				if (empty($art_cate['cate_ab']))  throw new Exception("����д����������д.");
				if (!preg_match('`^([a-zA-Z0-9_-]){1,30}$`', $art_cate['cate_ab']))  throw new Exception("����������дֻ����ΪӢ�ĺ����ֵ���ϣ��ҳ�����30λ����.");
				$art_cate['cate_ab'] = strtolower($art_cate['cate_ab']);

				// ������д������֤
				db::query("SELECT count(*) AS sum FROM `slcms_article_category` WHERE cate_ab='". $art_cate['cate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("�˷���������д�Ѵ���,����������.");
				// Ҳ�����뵥ҳ������д����
				db::query("SELECT count(*) AS sum FROM `slcms_page_category` WHERE cate_ab='". $art_cate['cate_ab'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("�˷���������д�Ѵ���,����������.");
			}

			// ��������ֵΪ��ʱ����������㣬�����ύ��ֵ���д洢
			$art_cate['order_id'] = 0;
			if (empty($data['order_id']))
			{
				db::query("SELECT MAX(order_id) AS mo FROM `slcms_article_category` ");
				$rs = db::fetch_one();
				$max_order = $rs['mo'];

				db::query("SELECT COUNT(*) AS sum FROM `slcms_article_category` ");
				$rs = db::fetch_one();
				$sum_order = $rs['sum'];

				$art_cate['order_id'] = ( ($max_order >= $sum_order) ? $max_order : $sum_order ) + 1;
			} else {
				$art_cate['order_id'] = $data['order_id'];
			}

			// ���ݲ���
			if ( 1 == $type ) {
				// �����¼
				$sql = "INSERT INTO `slcms_article_category` (cate_name, cate_ab, order_id, page_num, cate_tpl, detail_tpl, keywords, description, intro) VALUES('". $art_cate['cate_name'] ."', '". $art_cate['cate_ab'] ."', '". $art_cate['order_id'] ."', '". $art_cate['page_num'] ."', '". $art_cate['cate_tpl'] ."', '". $art_cate['detail_tpl'] ."', '". $art_cate['keywords'] ."', '". $art_cate['description'] ."', '". $art_cate['intro'] ."') ";
				db::query($sql);

				//$id = db::insert_id();
				//make_static::article_category('write', $id);
				return true;
			}
			if ( 2 == $type )
			{
				// ���¼�¼
				$sql = "UPDATE `slcms_article_category` SET cate_name='". $art_cate['cate_name'] ."', cate_ab='". $art_cate['cate_ab'] ."', order_id='". $art_cate['order_id'] ."', page_num='". $art_cate['page_num'] ."', cate_tpl='". $art_cate['cate_tpl'] ."', detail_tpl='". $art_cate['detail_tpl'] ."', keywords='". $art_cate['keywords'] ."', description='". $art_cate['description'] ."', intro='". $art_cate['intro'] ."' WHERE cate_id='".$art_cate['cate_id']."' ";
				db::query($sql);
				
				make_static::article_category('write', $art_cate['cate_id']);
				return true;
			}
		}
		return false;
	}


	/**
	 * ��շ����µ��������¼�¼
	 *
	 * @param int	$cate_id	����ID
	 */
	public static function clear($cate_id)
	{
		if (! is_numeric($cate_id) ) throw new Exception("��������.");

		// ɾ�������ɵ��ļ�
		$makestatic = intval(config::get_one('makestatic'));
		if ($makestatic >= 3)
		{
			db::query("SELECT article_id FROM `slcms_article_content` WHERE cate_id={$cate_id}");
			$list = db::fetch_all();
			if ( is_array($list) )
			{
				foreach ($list as $v)
				{
					make_static::article_content('del', $v['article_id']);
				}
			}
		}
		db::query("DELETE FROM `slcms_article_content` WHERE cate_id={$cate_id} ");
	}
	
	
	/**
	 * ɾ�������¼
	 * �����´������ݼ�¼ʱ��������վ��¼��������ɾ�����µ����ݷ���ɾ�������¼
	 *
	 * @param int	$cate_id	����ID
	 */
	public static function del($cate_id)
	{
		if (! is_numeric($cate_id) ) throw new Exception("��������.");

		db::query("SELECT count(*) AS sum FROM `slcms_article_content` WHERE cate_id={$cate_id} ");
		$rs = db::fetch_one();
		if ($rs['sum']>0) throw new Exception("�÷����´������ݣ�������÷����µ��������ݷ���ɾ�������¼.");

		make_static::article_category('del', $cate_id);
		db::query("DELETE FROM `slcms_article_category` WHERE cate_id={$cate_id} ");
	}


	/**
	 * ���ɷ��ఴ��ݲ�ѯ�������б�
	 *
	 * @param int	$cate_id	����ID
	 */
	public static function get_year_list($cate_id)
	{
		$cate_id = intval($cate_id);
		if (empty($cate_id)) return false;
		$cate = self::get_byid($cate_id);
		if ( !isset($cate['cate_id']) ) return false;

		$base_year = config::get_one('startyear');
		$base_year = ( empty($base_year) ) ? 2012 : intval($base_year);
		$this_year = intval(date('Y'));

		$html = '';
		$url = '';
		for ($i = $this_year; $i >= $base_year; $i--)
		{
			$url = url::year($cate_id, $cate['cate_ab'], $i);
			$html .= "<a href='{$url}'>{$i}</a> ";
		}
		return $html;
	}

}