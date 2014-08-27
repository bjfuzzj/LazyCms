<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: plate_content.php 2012-5-13  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class plate_content
{
    /**
     * ��ȡָ�������ľ�������
	 *
	 * @param int	$plate_ab	����ʶ
	 * @param int	$num		��ȡ��¼��Ŀ
	 * @return array
     */
	public static function get_content($plate_ab, $num = 1)
	{
		$plate_ab = strip($plate_ab);
		$num = (empty($num)) ? 1 : intval($num);

		if ( empty($plate_ab) ) return false;
		$plate_cate = plate_category::get_byab($plate_ab);
		if ( !isset($plate_cate['id']) ) return false;

		$condition = " WHERE plate_id=". $plate_cate['id'] ." AND used=1 ORDER BY id DESC ";
		if ($num > 0) $condition .= " LIMIT {$num} ";

		// SQL
		$sql = "SELECT plate_type, content FROM `slcms_plate_content` ".$condition;

		// ��¼��ѯ
		$data = array();
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				$data[] = $value;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ�������ļ�¼
	 *
	 * @param int	$cate_id	����ID
	 * @param int	$start		�ӵڼ�����¼��ʼ������$get_totalʱ�ò�����������
	 * @param boolen	$get_total	�Ƿ�ֻ��ȡ��ҳ������
	 * @param int	$page_rows	��ҳ��
	 * @return array
     */
	public static function page_list($plate_id = 0, $start = 0, $get_total = false, $page_rows = PAGE_ROWS)
	{
		$plate_id = intval($plate_id);
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);

		// SQL��乹��
		$condition = '';
		if ($plate_id > 0)
		{
			$condition = " WHERE plate_id={$plate_id} ";
		} else {
			$condition = " WHERE 1=1 ";
		}

		// ��ѯ���������ļ�¼����
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_plate_content` ". $condition;
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];

		// ��Ϊ��ѯ�ܼ�¼��ʱ����
		if ($get_total) return $total;
		if ($total<1) return false;

		$condition .= ' ORDER BY id DESC ';

		// ��ҳ��ѯ�趨
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// ��¼��ѯ
		$sql = "SELECT id, plate_id, plate_type, title, content, update_time, used FROM `slcms_plate_content` ".$condition;
		$data = array();
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $value)
			{
				$value['type'] = plate_category::get_plate_type($value['plate_type']);
				$data[] = $value;
			}
		}


		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ��ID�ļ�¼��Ϣ
	 *
	 * @param int $id
	 * @param bool $decode �Ƿ�����ݽ��н�������ٷ���
	 * @return array
     */
	public static function get_one($id)
	{
		$id = intval($id);

		db::query("SELECT * FROM `slcms_plate_content` WHERE id={$id} LIMIT 1");
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
			$plate_content = array();
			$plate_content['id'] = intval($data['id']);
			$plate_content['plate_id'] = intval($data['plate_id']);
			$plate_content['plate_type'] = intval($data['plate_type']);
			$plate_content['title'] = htmlspecialchars(trim($data['title']));
			$plate_content['content'] = trim($data['content']);
			$plate_content['used'] = intval($data['used']);

			// ��֤������
			if (empty($plate_content['title'])) throw new Exception("����д������ݱ���.");
			if (2 == $plate_content['plate_type'])
			{
				// ͼƬ����ʱ��������ƴ��: ͼƬ��ַ + $$$ + ���ӵ�ַ
				$plate_content['img_src'] = htmlspecialchars(trim($data['img_src']));
				$plate_content['link_url'] = htmlspecialchars(trim($data['link_url']));
				$plate_content['content'] = self::encode($plate_content['img_src'], $plate_content['link_url']);
			}
			if ( empty($plate_content['content']) )  throw new Exception("����д�������.");
			$plate_content['updatetime'] = time();

			// ���ݲ���
			if ( 1 == $type ) {
				// �����¼
				$sql = "INSERT INTO `slcms_plate_content` (plate_id, plate_type, title, content, update_time, used) VALUES('". $plate_content['plate_id'] ."', '". $plate_content['plate_type'] ."', '". $plate_content['title'] ."', '". $plate_content['content'] ."', '". $plate_content['update_time'] ."', '". $plate_content['used'] ."') ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type && $plate_content['id'])
			{
				// ���¼�¼
				$sql = "UPDATE `slcms_plate_content` SET title='". $plate_content['title'] ."', content='". $plate_content['content'] ."', update_time='". $plate_content['update_time'] ."', used='". $plate_content['used'] ."' WHERE id='".$plate_content['id']."' ";
				db::query($sql);

				return true;
			}
		}
	}


	/**
	 * ������ݱ���
	 *
	 * @param string $source_url �زĵ�ַ
	 * @param string $source_param �زĲ���
	 * @return string
	 */
	public static function encode($source_url, $source_param = '')
	{
		if (empty($source_url)) return false;
		$source_url = htmlspecialchars(trim($source_url));
		if ( ! empty($source_param) ) $source_param = htmlspecialchars(trim($source_param));
		$result = $source_url .'$$$'. $source_param;
		return $result;
	}


	/**
	 * ������ݽ���
	 *
	 * @param string $content
	 * @return array
	 */
	public static function decode($content)
	{
		if (empty($content)) return false;
		$arr = explode('$$$', $content);
		$rs['img_src'] = $arr[0];
		$rs['link_url'] = $arr[1];
		return $rs;
	}


	/**
	 * ɾ���������
	 *
	 * @param int $id
	 */
	public static function del($id)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");
		$id = array_to_string($id);

		db::query("DELETE FROM `slcms_plate_content` WHERE id IN($id) ");
	}


	/**
	 * ������ݿ���
	 *
	 * @param int $id
	 * @param int $type : 0-�رգ�1-����
	 */
	public function set_used($id, $t = 1)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("��ѡ��Ҫ�����ļ�¼��");
		$id = array_to_string($id);
		$t = intval($t);

		if ($t>0)
		{
			db::query("UPDATE `slcms_plate_content` SET used=1 WHERE id IN($id) ");
		} else {
			db::query("UPDATE `slcms_plate_content` SET used=0 WHERE id IN($id) ");
		}
	}
    
    
    public static function get_banners()
    {
    	
    	$plate = plate_content::get_content('index_banner', 5);
    	if ( !is_array($plate) ) return false;
    	$html = '';
    	$plate_type = intval($plate[0]['plate_type']);
        $result=array();
    	if ( 1 == $plate_type)// HTML�ı�
    	{
    		return '';
    	} 
    	elseif ( 2 == $plate_type)// ͼƬ
    	{
    		foreach ($plate as $v)
    		{
    			$content = plate_content::decode($v['content']);
                $result[]=$content;
    		}
    	}
    	return $result;     
    }

}
