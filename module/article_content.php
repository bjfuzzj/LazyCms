<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: article_content.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class article_content
{

    /**
     * ��ȡ�����б�����ҳ
	 *
	 * @param int	$cate_id	���·���ID
	 * @param int	$num		��ѯ�ļ�¼����100����
	 * @param int	$order_type	��¼�������ͣ�1-����ID����2-����ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
	 * @param int	$show_pic	�Ƿ���ʾͼƬ
     */
	public static function get_list($cate_id = 0, $num, $order_type = 1, $show_pic = 0)
	{
		$cate_id = intval($cate_id);
		$num = intval($num);
		$order_type = intval($order_type);
		$show_pic = (bool)($show_pic);

		// SQL��乹��
		$condition = '';
		if ($cate_id>0)
		{
			$rs = article_category::get_byid($cate_id);
			if (!isset($rs['cate_id'])) return false;

			$condition = " WHERE cate_id ={$cate_id} ";
		} else {
			$condition = " WHERE 1=1 ";
		}
		$condition .= " AND passed=1 AND deleted=0 ";
		if ($show_pic) $condition .= " AND default_pic<>'' ";

		// ����ʽ
		switch ($order_type)
		{
			case 1 :
				$condition .= ' ORDER BY article_id DESC ';
				break;
			case 2 :
				$condition .= ' ORDER BY article_id ASC ';
				break;
			case 3 :
				$condition .= ' ORDER BY update_time DESC, article_id DESC ';
				break;
			case 4 :
				$condition .= ' ORDER BY update_time ASC, article_id ASC ';
				break;
			case 5 :
				$condition .= ' ORDER BY hits DESC, article_id DESC ';
				break;
			case 6 :
				$condition .= ' ORDER BY hits ASC, article_id ASC ';
				break;
			default :
				$condition .= ' ORDER BY article_id DESC ';
				break;
		}

		// ��ѯ��¼��Ŀ�趨
		if ( $num < 1 || $num >100 ) $num = 10;
		$condition .= " LIMIT {$num} ";
		$sql = "SELECT article_id, cate_id, title, com_title, sub_title, author, copyfrom, tags, default_pic, intro, create_time, update_time, hits FROM `slcms_article_content` " . $condition;

		// ��¼��ѯ
		$data = array();
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $v)
			{
				if (empty($v['default_pic'])) $v['default_pic'] = PATH_UPFILE .'/nopic.gif';
				if (empty($v['create_time'])) $v['create_time'] = $v['update_time'];
				$v['url'] = url::article($v['article_id'], $v['create_time'], 0);
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
	 * @param int	$deleted	����״̬��0-δ���գ�1-�ѻ���
	 * @param int	$search		�����Ĺؼ���
	 * @param int	$search_field	������Ŀ
	 * @return array
     */
	public static function page_list($cate_id = 0, $order_type = 1, $start = 0, $get_total = false, $page_rows = PAGE_ROWS, $passed = 1, $deleted = 0, $search = '', $search_field = 0)
	{
		$cate_id = intval($cate_id);
		$order_type = intval($order_type);
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);
		$passed = (empty($passed)) ? 0 : 1;
		$deleted = (empty($deleted)) ? 0 : 1;
		$keyword = trim($search);
		$field = intval($search_field);

		// SQL��乹��
		$condition = '';
		if ($cate_id > 0)
		{
			$condition = " WHERE A.cate_id={$cate_id} ";
		} else {
			$condition = " WHERE 1=1 ";
		}

		// �ؼ��ʹ���
		if (!empty($keyword))
		{
			$keyword = strip(trim($search));
			$s_key = array("\\",'&',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','--','%','$','^','��');
			foreach ($s_key as $value)
			{
				$keyword = str_replace($value, '', $keyword);
			}

			if (empty($keyword)) return false;
			$keywords = preg_split("/[\s,+]+/", $keyword);

			switch ($field)
			{
				case 1:
					$keyword = implode('|', $keywords);
					$condition .= " AND A.title REGEXP '{$keyword}' ";
					break;
				case 2:
					$keyword = implode('|', $keywords);
					$condition .= " AND A.tags REGEXP '{$keyword}' ";
					break;
				case 3:
					$keyword = implode(',', $keywords);
					$condition .= " AND A.article_id IN({$keyword}) ";
					break;
				default:
					break;
			}
		}

		if ( $passed > -1) $condition .= " AND A.passed={$passed} ";
		if ( $deleted > -1) $condition .= " AND A.deleted={$deleted} ";

		// ��ѯ���������ļ�¼����
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_article_content` AS A ". $condition;
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
				$condition .= ' ORDER BY A.article_id DESC ';
				break;
			case 2 :
				$condition .= ' ORDER BY A.article_id ASC ';
				break;
			case 3 :
				$condition .= ' ORDER BY A.update_time DESC, A.article_id DESC ';
				break;
			case 4 :
				$condition .= ' ORDER BY A.update_time ASC, A.article_id ASC ';
				break;
			case 5 :
				$condition .= ' ORDER BY A.hits DESC, A.article_id DESC ';
				break;
			case 6 :
				$condition .= ' ORDER BY A.hits ASC, A.article_id ASC ';
				break;
			default :
				$condition .= ' ORDER BY A.article_id DESC ';
				break;
		}

		// ��ҳ��ѯ�趨
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// SQL
		$sql = "SELECT A.*, C.cate_name FROM `slcms_article_content` AS A LEFT JOIN `slcms_article_category` AS C ON A.cate_id=C.cate_id ".$condition;

		// ��¼��ѯ
		$data = array();
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $v)
			{
				if (empty($v['default_pic'])) $v['default_pic'] = PATH_UPFILE .'/nopic.gif';
				$v['url'] = url::article($v['article_id'], $v['create_time'], 0);
				$data[] = $v;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ����ݵļ�¼
	 *
	 * @param int	$cate_id	����ID
	 * @param int	$year		���
	 * @param int	$order_type	��¼�������ͣ�1-ID����2-ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
	 * @return array
     */
	public static function page_year($cate_id = 0, $year, $order_type = 1)
	{
		$cate_id = intval($cate_id);
		$year = intval($year);
		$order_type = intval($order_type);

		// SQL��乹��
		$condition = '';
		if ($cate_id > 0)
		{
			$condition = " WHERE cate_id={$cate_id} ";
		} else {
			$condition = " WHERE 1=1 ";
		}

		$base_year = config::get_one('startyear');
		$base_year = ( empty($base_year) ) ? 1970 : intval($base_year);
		if ($year < $base_year || $year > intval(date('Y'))) $year = intval(date('Y'));;

		$begin_time = mktime(0, 0, 0, 1, 1, $year);
		$end_time = mktime(0, 0, 0, 1, 1, $year+1);

		$condition .= " AND update_time BETWEEN {$begin_time} AND {$end_time} ";
		$condition .= " AND passed=1 AND deleted=0 ";

		// ����ʽ
		switch ($order_type)
		{
			case 1 :
				$condition .= ' ORDER BY article_id DESC ';
				break;
			case 2 :
				$condition .= ' ORDER BY article_id ASC ';
				break;
			case 3 :
				$condition .= ' ORDER BY update_time DESC, article_id DESC ';
				break;
			case 4 :
				$condition .= ' ORDER BY update_time ASC, article_id ASC ';
				break;
			case 5 :
				$condition .= ' ORDER BY hits DESC, article_id DESC ';
				break;
			case 6 :
				$condition .= ' ORDER BY hits ASC, article_id ASC ';
				break;
			default :
				$condition .= ' ORDER BY article_id DESC ';
				break;
		}


		// SQL
		$sql = "SELECT article_id, cate_id, title, com_title, sub_title, author, copyfrom, default_pic, intro, create_time, update_time, tags, editor, hits FROM `slcms_article_content` ".$condition;

		// ��¼��ѯ
		$data = array();
		db::query($sql);
		$rs = db::fetch_all();
		if (is_array($rs))
		{
			foreach ($rs as $v)
			{
				if (empty($v['default_pic'])) $v['default_pic'] = PATH_UPFILE .'/nopic.gif';
				$v['url'] = url::article($v['article_id'], $v['create_time'], 0);
				$data[] = $v;
			}
		}

		return (empty($data)) ? false : $data;
	}


    /**
     * ��ȡָ��ID��������Ϣ
	 *
	 * @param int $article_id ����ID
	 * @return array
     */
	public static function get_one($article_id)
	{
		$article_id = intval($article_id);

		db::query("SELECT * FROM `slcms_article_content` WHERE article_id={$article_id} LIMIT 1");
		$rs = db::fetch_one();
		if ( ! isset($rs['article_id']) )  return false;
		$rs['url'] = url::article($rs['article_id'], $rs['create_time'], 0);

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
			$article = array();
			$article['article_id'] = intval($data['article_id']);
			$article['cate_id'] = intval($data['cate_id']);
			$article['title'] = htmlspecialchars(trim($data['title']));
			$article['com_title'] = htmlspecialchars(trim($data['com_title']));
			$article['sub_title'] = htmlspecialchars(trim($data['sub_title']));
			$article['author'] = htmlspecialchars(trim($data['author']));
			$article['copyfrom'] = htmlspecialchars(trim($data['copyfrom']));
			$article['default_pic'] = htmlspecialchars(trim($data['default_pic']));
			$article['intro'] = trim($data['intro']);
			$article['content'] = trim($data['content']);
			$article['tags'] = htmlspecialchars(trim($data['tags']));
			$article['passed'] = (bool)(trim($data['passed']));
			$article['update_time'] = strtotime(trim($data['update_time']));

			if ($article['cate_id'] < 0) throw new Exception("��ѡ���������.");
			if (empty($article['title'])) throw new Exception("����д���±���.");
			if (empty($article['content'])) throw new Exception("����д��������.");

			if ( 1 == $type )
			{
				$article['create_time'] = $article['update_time'];
				$article['editor'] = $_COOKIE['user_id'];

				// �����¼
				$sql = "INSERT INTO `slcms_article_content` (cate_id, title, com_title, sub_title, author, copyfrom, default_pic, intro, content, create_time, update_time, tags, editor, hits, passed, ontop, elite, deleted) VALUES('". $article['cate_id'] ."', '". $article['title'] ."', '". $article['com_title'] ."', '". $article['sub_title'] ."', '". $article['author'] ."', '". $article['copyfrom'] ."', '". $article['default_pic'] ."', '". $article['intro'] ."', '". $article['content'] ."', '". $article['create_time'] ."', '". $article['update_time'] ."', '". $article['tags'] ."', '". $article['editor'] ."', 0, '". $article['passed'] ."', 0, 0, 0) ";
				db::query($sql);

				$id = db::insert_id();
				make_static::article_content('write', $id);
                make_static::make_index();
				return true;
			}
			if ( 2 == $type && $article['article_id'])
			{
				// ���¼�¼
				$sql = "UPDATE `slcms_article_content` SET cate_id='". $article['cate_id'] ."', title='". $article['title'] ."', com_title='". $article['com_title'] ."', sub_title='". $article['sub_title'] ."', author='". $article['author'] ."', copyfrom='". $article['copyfrom'] ."', default_pic='". $article['default_pic'] ."', intro='". $article['intro'] ."', content='". $article['content'] ."', update_time='". $article['update_time'] ."', tags='". $article['tags'] ."', passed='". $article['passed'] ."' WHERE article_id='".$article['article_id']."' ";
				db::query($sql);

				if ( $article['passed'] )
				{
					make_static::article_content('write', $article['article_id']);
                    make_static::make_index();
				} else {
					make_static::article_content('del', $article['article_id']);
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
				$sql = "UPDATE `slcms_article_content` SET passed=1 WHERE article_id IN($id_list) ";
				$write = 1;
				break;
			case 'nopass' :
				$sql = "UPDATE `slcms_article_content` SET passed=0 WHERE article_id IN($id_list) ";
				$write = 0;
				break;
			case 'del' :
				$sql = "UPDATE `slcms_article_content` SET deleted=1 WHERE article_id IN($id_list) ";
				$write = 0;
				break;
			case 'restore' :
				$sql = "UPDATE `slcms_article_content` SET deleted=0 WHERE article_id IN($id_list) ";
				$write = 1;
				break;
			case 'clear' :
				$sql = "DELETE FROM `slcms_article_content` WHERE article_id IN($id_list)  AND deleted=1 ";
				$write = 0;
				break;
			default :
				return false;
				break;
		}

		// �ļ�����
		$makestatic = intval(config::get_one('makestatic'));
		if ($makestatic >= 3)
		{
			if(is_array($id))
			{
				foreach ($id as $v)
				{
					if ($write)
					{
						make_static::article_content('write', $v);
					} else {
						make_static::article_content('del', $v);
					}
				}
			} else {
				$id = intval($id);
				if ($write)
				{
					make_static::article_content('write', $id);
				} else {
					make_static::article_content('del', $id);
				}
			}
		}
		db::query($sql);

		return true;
	}


	/**
	 * ��ջ���վ
	 *
	 */
	public static function clear_all()
	{
		// ɾ�������ɵ��ļ�
		$makestatic = intval(config::get_one('makestatic'));
		if ($makestatic >= 3)
		{
			db::query("SELECT article_id FROM `slcms_article_content` WHERE deleted=1");
			$list = db::fetch_all();
			if ( is_array($list) )
			{
				foreach ($list as $v)
				{
					make_static::article_content('del', $v['article_id']);
				}
			}
		}
		db::query("DELETE FROM `slcms_article_content` WHERE deleted=1 ");
		return true;
	}


    /**
     * ��¼�������
	 *
	 * @param int	$id	��¼ID
     */
	public static function update_hits($id)
	{
		$id = intval($id);
		if ($id < 1) return false;

		$sql = "UPDATE `slcms_article_content` SET hits=hits+1 WHERE article_id={$id} ";
		db::query($sql);

		return true;
	}

}