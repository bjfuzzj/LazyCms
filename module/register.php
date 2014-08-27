<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 */

!defined('PATH_ROOT') && exit('Forbidden');

/**
 * 本文件用于 smarty 3 中 registerPlugin 注册函数和块的目标函数的定义
 * 注册函数的目标函数以 func_ 开头，注册块的目标函数以 block_ 开头
 * 
 * 对于函数标签：
 * 其返回的值的最外层不添加任何HTML元素；返回内容中的各条记录以 <li></li> 包含
 * LI记录中，图片不再外加链接以外的元素，链接中加入记录项对应属性名的样式类
 * 记录项若无链接则以 <span></span> 包含，并加入记录项对应属性名的样式类
 * 
 * 对于块标签：
 * 其返回值为替换块内容后的值
 * 注册块公有属性为 assign ，用于绑定返回值在块内容中记录属性提取，缺省值为 row
 * 块内容的记录属性的访问例如 <%{$row.id}%>, <%{$row.title}%>
 */


/**
 * 函数作用：获取网站配置项值
 * 
 * 标签属性：
 * string name 必填，单一配置项名称
 */
function func_site_config($params, $smarty)
{
	if (empty($params['name'])) return '';

	return config::get_config_one($params['name']);
}


/**
 * 函数作用：获取文章分类列表
 * 
 * 标签属性：
 * 无
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
 * 函数作用：获取文章分类列表
 * 
 * 标签属性：
 * 无

 * 块内标签：
 * cate_id, cate_name, cate_ab, intro, order_id, page_num, keywords, description
 */
function block_article_category($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, article_category::get_list(), $repeat);
}


/**
 * 函数作用：获取文章不分页列表
 * 
 * 标签属性：
 * int	cate_id	必填，文章分类ID
 * int	num		必填，查询的记录数，100以内
 * int	order_type	建议填写，记录排序类型：1-文章ID降序，2-文章ID升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
 * boolen show_pic 建议填写，是否显示默认图片
 * boolen show_intro 建议填写，是否显示简介内容
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
 * 函数作用：获取文章不分页记录列表
 * 
 * 标签属性：
 * int	cate_id	必填，文章分类ID
 * int	num		必填，查询的记录数，100以内
 * int	order_type	建议填写，记录排序类型：1-文章ID降序，2-文章ID升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
 * boolen show_pic 建议填写，是否显示默认图片
 * 
 * 块内标签：
 * article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic, intro, update_time, hits
 */
function block_get_article_list($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, article_content::get_list($params['cate_id'], $params['num'], $params['order_type'], $params['show_pic']), $repeat);
}


/**
 * 函数作用：获取文章分页列表
 * 
 * 标签属性：
 * int	$cate_id	文章分类ID
 * int	$order_type	记录排序类型：1-文章ID降序，2-文章ID升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
 * int	$start		从第几条记录开始
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
 * 函数作用：获取文章分页列表
 * 
 * 标签属性：
 * int	$cate_id	文章分类ID
 * int	$order_type	记录排序类型：1-文章ID降序，2-文章ID升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
 * int	$start		从第几条记录开始

 * 块内标签：
 * article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic, intro, update_time, hits
 */
function block_get_article_page_list($params, $content, $smarty, &$repeat)
{
	$params['page_num'] = intval($params['page_num']);
	if ( empty($params['page_num']) || $params['page_num'] < 1) $params['page_num'] = PAGE_ROWS;

	return template::register_block($params, $content, article_content::page_list($params['cate_id'], $params['order_type'], $params['start'], false, $params['page_num']), $repeat);
}


/**
 * 函数作用：按年份获取文章记录不分页列表
 * 
 * 标签属性：
 * int	$cate_id	文章分类ID
 * int	$year		年份
 * int	$order_type	记录排序类型：1-文章ID降序，2-文章ID升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
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
 * 函数作用：按年份获取文章记录不分页列表
 * 
 * 标签属性：
 * int	$cate_id	必填，文章分类ID
 * int	$year	必填，查询的年份
 * int	$order_type	记录排序类型：1-文章ID降序，2-文章ID升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
 * 
 * 块内标签：
 * article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic, intro, update_time, hits
 */
function block_get_article_page_year($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, article_content::page_year($params['cate_id'], $params['year'], $params['order_type']), $repeat);
}


/**
 * 函数作用：获取单页分类列表
 * 
 * 标签属性：无
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
 * 函数作用：获取单页分类列表
 * 
 * 标签属性：
 * 无

 * 块内标签：
 * cate_id, cate_name, cate_ab, intro, order_id
 */
function block_page_category($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, page_category::get_list(), $repeat);
}



/**
 * 函数作用：获取单页列表
 * 
 * 标签属性：
 * int	cate_id	必填，单页分类ID
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
 * 函数作用：获取单页记录内容数组
 * 
 * 标签属性：
 * int	cate_id	必填，单页分类ID
 * 
 * 块内标签：
 * pageid, cate_id, title, path, default_pic, intro
 */
function block_get_page_list($params, $content, $smarty, &$repeat)
{
	return template::register_block($params, $content, page_content::get_list($params['cate_id']), $repeat);
}


/**
 * 函数作用：获取板块内容
 * 
 * 标签属性：
 * string id 必填，板块标识
 * int num 查询记录数目，仅图片类型有效，文本类限定为1条
 */
function func_get_plate_content($params, $smarty)
{
	$params['id'] = strip($params['id']);
	$params['num'] = intval($params['num']);

	$plate = plate_content::get_content($params['id'], $params['num']);
	if ( !is_array($plate) ) return false;

	$html = '';
	$plate_type = intval($plate[0]['plate_type']);

	if ( 1 == $plate_type)// HTML文本
	{
		if ( empty($plate[0]['content']) ) break;
		$html = html_entity_decode($plate[0]['content']);
	} 
	elseif ( 2 == $plate_type)// 图片
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
 * 函数作用：文章类按年份分页链接列表
 * 
 * 标签属性：
 * int	cate_id	必填，分类ID
 */
function func_get_year_list($params, $smarty)
{
	$params['cate_id'] = strip($params['cate_id']);
	$html = article_category::get_year_list($params['cate_id']);
	return $html;
}




/**
 * 函数作用:得到header中的banner链接 
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
