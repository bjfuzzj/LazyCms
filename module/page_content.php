<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: page_content.php 2012-5-12  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class page_content
{
    /**
     * ��ȡ��ҳ�б�
	 *
	 * @param int	$cate_id	����ID
     */
	public static function get_list($cate_id = 0)
	{
		$cate_id = intval($cate_id);

		// SQL��乹��
		$condition = '';
		if ( $cate_id > 0) 
		{
			$condition .= " WHERE P.cate_id={$cate_id} AND P.passed=1 ";
		} else {
			$condition .= " WHERE P.passed=1 ";
		}
		$condition .= " ORDER BY P.order_id ASC, P.page_id ASC  ";

		// ��¼��ѯ
		$data = array();
		$sql = "SELECT P.page_id, P.cate_id, P.page_name, P.title, P.default_pic, C.cate_name, C.cate_ab FROM `slcms_page_content` AS P LEFT JOIN `slcms_page_category` AS C ON P.cate_id=C.cate_id ".$condition;
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $v)
			{
				if (empty($value['default_pic'])) $value['default_pic'] = 'nopic.gif';
				$v['url'] = url::page($v['page_id'], $v['cate_ab'], $v['page_name'], 0);
				$data[] = $v;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ�������ļ�¼
	 *
	 * @param int	$cate_id	����ID
	 * @param int	$order_type	��¼�������ͣ�1-ID����2-ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
	 * @param int	$start		�ӵڼ�����¼��ʼ������$get_totalʱ�ò�����������
	 * @param boolen	$get_total	�Ƿ�ֻ��ȡ��ҳ������
	 * @param int	$page_rows	��ҳ��
	 * @param int	$passed		���״̬��0-δ�趨��1-����ˣ� -1 --δ���
	 * @return array
     */
	public static function page_list($cate_id = 0, $order_type = 1, $start = 0, $get_total = false, $page_rows = PAGE_ROWS, $passed = 1)
	{
		$cate_id = intval($cate_id);
		$order_type = intval($order_type);
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);
		$passed = (empty($passed)) ? 0 : 1;

		// SQL��乹��
		$condition = '';
		if ($cate_id > 0)
		{
			$condition = " WHERE P.cate_id={$cate_id} ";
		} else {
			$condition = " WHERE 1=1 ";
		}
		if (1 == $passed) $condition .= " AND P.passed=1 ";

		// ��ѯ���������ļ�¼����
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_page_content` AS P ". $condition;
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];
		// ��Ϊ��ѯ�ܼ�¼��ʱ����
		if ($get_total) return $total;
		if ($total<1) return false;

		// ����ʽ
		switch ($order_type)
		{
			case 1 :
				$condition .= ' ORDER BY P.page_id DESC ';
				break;
			case 2 :
				$condition .= ' ORDER BY P.page_id ASC ';
				break;
			case 3 :
				$condition .= ' ORDER BY P.update_time DESC, P.page_id DESC ';
				break;
			case 4 :
				$condition .= ' ORDER BY P.update_time ASC, P.page_id ASC ';
				break;
			case 5 :
				$condition .= ' ORDER BY P.hits DESC, P.page_id DESC ';
				break;
			case 6 :
				$condition .= ' ORDER BY P.hits ASC, P.page_id ASC ';
				break;
			default :
				$condition .= ' ORDER BY P.page_id DESC ';
				break;
		}

		// ��ҳ��ѯ�趨
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// SQL
		$sql = "SELECT P.page_id, P.cate_id, P.page_name, P.title, P.default_pic, P.create_time, P.update_time, P.order_id, P.passed, C.cate_name, C.cate_ab FROM `slcms_page_content` AS P LEFT JOIN `slcms_page_category` AS C ON P.cate_id=C.cate_id ".$condition;

		// ��¼��ѯ
		$data = array();
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				if (empty($value['default_pic'])) $value['default_pic'] = 'nopic.gif';
				$value['url'] = url::page($value['id'], $value['cate_ab'], $value['create_time'], 0);
				$data[] = $value;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ��ID�ļ�¼��Ϣ
	 *
	 * @param int $page_id ��ҳID
	 * @return array
     */
	public static function get_one($page_id)
	{
		$page_id = intval($page_id);

		db::query("SELECT * FROM `slcms_page_content` WHERE page_id={$page_id} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['page_id']) )  return false;
		//$rs['url'] = url::page($rs['id'], $rs['cate_ab'], $rs['path'], 0);

		return $rs;
	}

    /**
     * ��ȡָ��������д�ļ�¼��Ϣ
	 *
	 * @param string $name ���·�������
	 * @return array
     */
	public static function get_byname($name)
	{
		$name = strip($name);

		db::query("SELECT * FROM `slcms_page_content` WHERE page_name='{$name}' LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['page_id']) )  return false;
		//$rs['url'] = url::page($rs['id'], $rs['cate_ab'], $rs['path'], 0);

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
			$page_content = array();
			$page_content['page_id'] = intval($data['page_id']);
			$page_content['cate_id'] = intval($data['cate_id']);
			$page_content['title'] = htmlspecialchars(trim($data['title']));
			$page_content['page_name'] = htmlspecialchars(trim($data['page_name']));
			$page_content['default_pic'] = htmlspecialchars(trim($data['default_pic']));
			$page_content['intro'] = trim($data['intro']);
			$page_content['content'] = trim($data['content']);
			$page_content['order_id'] = intval($data['order_id']);
			$page_content['passed'] = (bool)(trim($data['passed']));

			if ($page_content['cate_id'] < 1) throw new Exception("��ѡ���������.");
			if (empty($page_content['title'])) throw new Exception("����д���±���.");
			if (empty($page_content['content'])) throw new Exception("����д��������.");

			// ҳ��������֤
			if (empty($page_content['page_name']))  throw new Exception("����д����������д.");
			if (!preg_match('`^([a-zA-Z0-9_-]){1,50}$`', $page_content['page_name']))  throw new Exception("����������дֻ����ΪӢ�ĺ����ֵ���ϣ��ҳ�����50λ����.");
			$page_content['page_name'] = strtolower($page_content['page_name']);

			// ��������ֵΪ��ʱ����������㣬�����ύ��ֵ���д洢
			$art_cate['order_id'] = 0;
			if (empty($data['order_id']))
			{
				db::query("SELECT MAX(order_id) AS mo FROM `slcms_page_content` WHERE cate_id='". $page_content['cate_id'] ."' ");
				$rs = db::fetch_one();
				$max_order = $rs['mo'];

				db::query("SELECT COUNT(*) AS sum FROM `slcms_page_content` WHERE cate_id='". $page_content['cate_id'] ."' ");
				$rs = db::fetch_one();
				$sum_order = $rs['sum'];

				$page_content['order_id'] = ( ($max_order >= $sum_order) ? $max_order : $sum_order ) + 1;
			} else {
				$page_content['order_id'] = $data['order_id'];
			}
			$page_content['update_time'] = time();

			// ���ݲ���
			if ( 1 == $type )
			{
				// ������д������֤
				db::query("SELECT count(*) AS sum FROM `slcms_page_content` WHERE page_name='". $page_content['page_name'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("���ļ������Ѵ���,����������.");

				$page_content['create_time'] = $page_content['update_time'];

				// �����¼
				$sql = "INSERT INTO `slcms_page_content` (cate_id, page_name, title, default_pic, intro, content, order_id, create_time, update_time, passed) VALUES('". $page_content['cate_id'] ."', '". $page_content['page_name'] ."', '". $page_content['title'] ."', '". $page_content['default_pic'] ."', '". $page_content['intro'] ."', '". $page_content['content'] ."', '". $page_content['order_id'] ."', '". $page_content['create_time'] ."', '". $page_content['update_time'] ."', '". $page_content['passed'] ."') ";
				db::query($sql);

				$id = db::insert_id();
				make_static::page_content('write', $id);
				return true;
			}
			if ( 2 == $type && $page_content['page_id'])
			{
				// Ҳ���������е�������д����
				db::query("SELECT count(*) AS sum FROM `slcms_page_content` WHERE page_id<>". $page_content['page_id'] ." AND page_name='". $page_content['page_name'] ."' ");
				$rs = db::fetch_one();
				if ($rs['sum']>0) throw new Exception("�����ļ������Ѵ���,����������.");

				// ���¼�¼
				$sql = "UPDATE `slcms_page_content` SET cate_id='". $page_content['cate_id'] ."', page_name='". $page_content['page_name'] ."', title='". $page_content['title'] ."', default_pic='". $page_content['default_pic'] ."', intro='". $page_content['intro'] ."', content='". $page_content['content'] ."', order_id='". $page_content['order_id'] ."', update_time='". $page_content['update_time'] ."', passed='". $page_content['passed'] ."' WHERE page_id='".$page_content['page_id']."' ";
				db::query($sql);

				if ( $page_content['passed'] )
				{
					make_static::page_content('write', $page_content['page_id']);
				} else {
					make_static::page_content('del', $page_content['page_id']);
				}
				return true;
			}

		}
		return false;
	}



	/**
	 * ���ü�¼����
	 *
	 * @param string $id	������¼
	 * @param string $type	������������
	 * @param string $value	����ֵ
	 */
	public static function set_state($id, $type, $value = 0)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");

		$id_list = array_to_string($id);
		$type = strtolower($type);

		$sql = '';
		$write = 0;
		switch ($type)
		{
			case 'passed' :
				$sql = "UPDATE `slcms_page_content` SET passed=1 WHERE page_id IN($id_list) ";
				$write = 1;
				break;
			case 'nopass' :
				$sql = "UPDATE `slcms_page_content` SET passed=0 WHERE page_id IN($id_list) ";
				$write = 0;
				break;
			case 'del' :
				$sql = "DELETE FROM `slcms_page_content` WHERE page_id IN($id_list) ";
				$write = 0;
				break;
			default :
				return false;
				break;
		}

		// �ļ�����
		$makestatic = intval(config::get_one('makestatic'));
		if ($makestatic > 0)
		{
			if(is_array($id))
			{
				foreach ($id as $v)
				{
					if ($write)
					{
						make_static::page_content('write', $v);
					} else {
						make_static::page_content('del', $v);
					}
				}
			} else {
				$id = intval($id);
				if ($write)
				{
					make_static::page_content('write', $id);
				} else {
					make_static::page_content('del', $id);
				}
			}
		}
		db::query($sql);

		return true;
	}



}