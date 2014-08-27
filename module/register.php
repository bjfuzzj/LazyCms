<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 */

!defined('PATH_ROOT') && exit('Forbidden');

/**
 * ���ļ����� smarty 3 �� registerPlugin ע�ắ���Ϳ��Ŀ�꺯���Ķ���
 * ע�ắ����Ŀ�꺯���� func_ ��ͷ��ע����Ŀ�꺯���� block_ ��ͷ
 * 
 * ���ں�����ǩ��
 * �䷵�ص�ֵ������㲻����κ�HTMLԪ�أ����������еĸ�����¼�� <li></li> ����
 * LI��¼�У�ͼƬ����������������Ԫ�أ������м����¼���Ӧ����������ʽ��
 * ��¼�������������� <span></span> �������������¼���Ӧ����������ʽ��
 * 
 * ���ڿ��ǩ��
 * �䷵��ֵΪ�滻�����ݺ��ֵ
 * ע��鹫������Ϊ assign �����ڰ󶨷���ֵ�ڿ������м�¼������ȡ��ȱʡֵΪ row
 * �����ݵļ�¼���Եķ������� <%{$row.id}%>, <%{$row.title}%>
 */


/**
 * �������ã���ȡ��վ������ֵ
 * 
 * ��ǩ���ԣ�
 * string name �����һ����������
 */
function func_site_config($params, $smarty)
{
	if (empty($params['name'])) return '';

	return config::get_config_one($params['name']);
}


/**
 * �������ã���ȡ���·����б�
 * 
 * ��ǩ���ԣ�
 * ��
 */
function func_article_category($params, $smarty)
{
	$category = article_category::get_list();
	if (empty($category)) return false;

	$rs = '';
	foreach ($category as $v)
	{
		$rs .= "<li><a href='". $v['url'] ."'>". $v['cate_name'] ."</a></li>\r\n";
	}

	return $rs;
}


/**
 * �������ã���ȡ���·����б�
 * 
 * ��ǩ���ԣ�
 * ��

 * ���ڱ�ǩ��
 * cate_id, cate_name, cate_ab, intro, order_id, page_num, keywords, description
 */
function block_article_category($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, article_category::get_list(), $repeat);
}


/**
 * �������ã���ȡ���²���ҳ�б�
 * 
 * ��ǩ���ԣ�
 * int	cate_id	������·���ID
 * int	num		�����ѯ�ļ�¼����100����
 * int	order_type	������д����¼�������ͣ�1-����ID����2-����ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
 * boolen show_pic ������д���Ƿ���ʾĬ��ͼƬ
 * boolen show_intro ������д���Ƿ���ʾ�������
 */
function func_get_article_list($params, $smarty)
{
	$params['cate_id'] = intval($params['cate_id']);
	$params['num'] = intval($params['num']);
	$params['order_type'] = intval($params['order_type']);
	$params['show_pic'] = (bool)($params['show_pic']);
	$params['show_intro'] = (bool)($params['show_intro']);

	if ( $params['num'] < 0 || $params['num'] >100 ) $params['num'] = 10;

	$list = article_content::get_list($params['cate_id'], $params['num'], $params['order_type'], $params['show_pic']);
	if (!is_array($list)) return false;

	$rs = '';
	foreach ($list as $v)
	{
		$rs .= '<li>';
		if ($params['show_pic']) $rs .= "<a href='".$v['url']."' class='default_pic' target='_blank'><img src='".$v['default_pic']."'></a>";
		$rs .= "<a href='".$v['url']."' class='title' target='_blank'>".$v['title']."</a>";
		if ($params['show_intro']) $rs .= "<span class='intro'>".$v['intro']."</span>";
		$rs .= "<span class='update_time'>". date('Y-m-d',$v['update_time']) ."</span>";
		$rs .= "</li>\r\n";
	}

	return $rs;
}


/**
 * �������ã���ȡ���²���ҳ��¼�б�
 * 
 * ��ǩ���ԣ�
 * int	cate_id	������·���ID
 * int	num		�����ѯ�ļ�¼����100����
 * int	order_type	������д����¼�������ͣ�1-����ID����2-����ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
 * boolen show_pic ������д���Ƿ���ʾĬ��ͼƬ
 * 
 * ���ڱ�ǩ��
 * article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic, intro, update_time, hits
 */
function block_get_article_list($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, article_content::get_list($params['cate_id'], $params['num'], $params['order_type'], $params['show_pic']), $repeat);
}


/**
 * �������ã���ȡ���·�ҳ�б�
 * 
 * ��ǩ���ԣ�
 * int	$cate_id	���·���ID
 * int	$order_type	��¼�������ͣ�1-����ID����2-����ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
 * int	$start		�ӵڼ�����¼��ʼ
 */
function func_get_article_page_list($params, $smarty)
{
	$params['cate_id'] = intval($params['cate_id']);
	$params['order_type'] = intval($params['order_type']);
	$params['start'] = intval($params['start']);
	$params['page_num'] = intval($params['page_num']);

	if ( empty($params['page_num']) || $params['page_num'] < 1) $params['page_num'] = PAGE_ROWS;

	$list = article_content::page_list($params['cate_id'], $params['order_type'], $params['start'], false, $params['page_num']);
	if (!is_array($list)) return false;

	$rs = '';
	foreach ($list as $v)
	{
		$rs .= '<li>';
		$rs .= "<a href='".$v['url']."' class='title' target='_blank'>".$v['title']."</a>";
		$rs .= "<span class='update_time'>".date('Y-m-d',$v['update_time'])."</span>";
		$rs .= "</li>\r\n";
	}

	return $rs;
}


/**
 * �������ã���ȡ���·�ҳ�б�
 * 
 * ��ǩ���ԣ�
 * int	$cate_id	���·���ID
 * int	$order_type	��¼�������ͣ�1-����ID����2-����ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
 * int	$start		�ӵڼ�����¼��ʼ

 * ���ڱ�ǩ��
 * article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic, intro, update_time, hits
 */
function block_get_article_page_list($params, $content, $smarty, &$repeat)
{
	$params['page_num'] = intval($params['page_num']);
	if ( empty($params['page_num']) || $params['page_num'] < 1) $params['page_num'] = PAGE_ROWS;

	return template::register_block($params, $content, article_content::page_list($params['cate_id'], $params['order_type'], $params['start'], false, $params['page_num']), $repeat);
}


/**
 * �������ã�����ݻ�ȡ���¼�¼����ҳ�б�
 * 
 * ��ǩ���ԣ�
 * int	$cate_id	���·���ID
 * int	$year		���
 * int	$order_type	��¼�������ͣ�1-����ID����2-����ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
 */
function func_get_article_page_year($params, $smarty)
{
	$params['cate_id'] = intval($params['cate_id']);
	$params['year'] = intval($params['year']);
	$params['order_type'] = intval($params['order_type']);

	$list = article_content::page_year($params['cate_id'], $params['year'], $params['order_type']);
	if (!is_array($list)) return false;

	$rs = '';
	foreach ($list as $v)
	{
		$rs .= '<li>';
		$rs .= "<a href='".$v['url']."' class='title' target='_blank'>".$v['title']."</a>";
		$rs .= "<span class='update_time'>".date('Y-m-d',$v['update_time'])."</span>";
		$rs .= "</li>\r\n";
	}

	return $rs;
}


/**
 * �������ã�����ݻ�ȡ���¼�¼����ҳ�б�
 * 
 * ��ǩ���ԣ�
 * int	$cate_id	������·���ID
 * int	$year	�����ѯ�����
 * int	$order_type	��¼�������ͣ�1-����ID����2-����ID����3-����ʱ�併��4-����ʱ������5-���������6-���������
 * 
 * ���ڱ�ǩ��
 * article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic, intro, update_time, hits
 */
function block_get_article_page_year($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, article_content::page_year($params['cate_id'], $params['year'], $params['order_type']), $repeat);
}


/**
 * �������ã���ȡ��ҳ�����б�
 * 
 * ��ǩ���ԣ���
 */
function func_page_category($params, $smarty)
{
	$list = page_category::get_list();
	if (empty($list)) return false;

	$rs = '';
	foreach ($list as $v)
	{
		$rs .= "<li><a href='". $v['url'] ."'>". $v['cate_name'] ."</a></li>\r\n";
	}

	return $rs;
}


/**
 * �������ã���ȡ��ҳ�����б�
 * 
 * ��ǩ���ԣ�
 * ��

 * ���ڱ�ǩ��
 * cate_id, cate_name, cate_ab, intro, order_id
 */
function block_page_category($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, page_category::get_list(), $repeat);
}



/**
 * �������ã���ȡ��ҳ�б�
 * 
 * ��ǩ���ԣ�
 * int	cate_id	�����ҳ����ID
 */
function func_get_page_list($params, $smarty)
{
	$params['cate_id'] = intval($params['cate_id']);

	$list = page_content::get_list($params['cate_id']);
	if (!is_array($list)) return false;

	$rs = '';
	foreach ($list as $v)
	{
		$rs .= "<li><a href='".$v['url']."' class='title'>".$v['title']."</a></li>\r\n";
	}

	return $rs;
}


/**
 * �������ã���ȡ��ҳ��¼��������
 * 
 * ��ǩ���ԣ�
 * int	cate_id	�����ҳ����ID
 * 
 * ���ڱ�ǩ��
 * pageid, cate_id, title, path, default_pic, intro
 */
function block_get_page_list($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, page_content::get_list($params['cate_id']), $repeat);
}


/**
 * �������ã���ȡ�������
 * 
 * ��ǩ���ԣ�
 * string id �������ʶ
 * int num ��ѯ��¼��Ŀ����ͼƬ������Ч���ı����޶�Ϊ1��
 */
function func_get_plate_content($params, $smarty)
{
	$params['id'] = strip($params['id']);
	$params['num'] = intval($params['num']);

	$plate = plate_content::get_content($params['id'], $params['num']);
	if ( !is_array($plate) ) return false;

	$html = '';
	$plate_type = intval($plate[0]['plate_type']);

	if ( 1 == $plate_type)// HTML�ı�
	{
		if ( empty($plate[0]['content']) ) break;
		$html = html_entity_decode($plate[0]['content']);
	} 
	elseif ( 2 == $plate_type)// ͼƬ
	{
		foreach ($plate as $v)
		{
			$content = plate_content::decode($v['content']);
			if (empty($content['link_url']))
			{
				$html .= "<li><img src='". $content['img_src'] ."'></li>\r\n";
			} else {
				$html .= "<li><a href='". $content['link_url'] ."' target='_blank'><img src='". $content['img_src'] ."'></a></li>\r\n";
			}
		}
	}
	return $html;
}



/**
 * �������ã������ఴ��ݷ�ҳ�����б�
 * 
 * ��ǩ���ԣ�
 * int	cate_id	�������ID
 */
function func_get_year_list($params, $smarty)
{
	$params['cate_id'] = strip($params['cate_id']);
	$html = article_category::get_year_list($params['cate_id']);
	return $html;
}




/**
 * ��������:�õ�header�е�banner���� 
 * 
*/
function func_get_banner_link($params,$smarty)
{
    $type=$params['type'];
    if($type=='single_page'){
       $cate_id = intval($params['cate_id']);
	   $cate = page_category::get_byid($cate_id);
       return $cate['url'];       
    }
    
}
