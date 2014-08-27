<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: plate_content.php 2012-5-13  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class plate_content
{
    /**
     * 获取指定参数的具体内容
	 *
	 * @param int	$plate_ab	板块标识
	 * @param int	$num		获取记录数目
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

		// 记录查询
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
     * 获取指定参数的记录
	 *
	 * @param int	$cate_id	分类ID
	 * @param int	$start		从第几条记录开始，设置$get_total时该参数不起作用
	 * @param boolen	$get_total	是否只获取分页的总数
	 * @param int	$page_rows	分页数
	 * @return array
     */
	public static function page_list($plate_id = 0, $start = 0, $get_total = false, $page_rows = PAGE_ROWS)
	{
		$plate_id = intval($plate_id);
		$start = intval($start);
		$get_total = (bool)($get_total);
		$page_rows = intval($page_rows);

		// SQL语句构造
		$condition = '';
		if ($plate_id > 0)
		{
			$condition = " WHERE plate_id={$plate_id} ";
		} else {
			$condition = " WHERE 1=1 ";
		}

		// 查询符合条件的记录总数
		$sql = "SELECT COUNT(*) AS sum FROM `slcms_plate_content` ". $condition;
		db::query($sql);
		$rs = db::fetch_one();
		$total = $rs['sum'];

		// 当为查询总记录数时返回
		if ($get_total) return $total;
		if ($total<1) return false;

		$condition .= ' ORDER BY id DESC ';

		// 分页查询设定
		if ($start > -1 && $page_rows > 0)
		{
			$condition .= " LIMIT {$start},{$page_rows} ";
		}

		// 记录查询
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
     * 获取指定ID的记录信息
	 *
	 * @param int $id
	 * @param bool $decode 是否对内容进行解析后的再返回
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
	 * 编辑记录
	 *
	 * @param int $type : 1-新增，2-修改
	 * @param array $data
	 * @return bool
	 */
	public static function edit($type, $data)
	{
		if (! is_numeric($type) ) throw new Exception("参数错误.");
		if (! is_array($data) ) throw new Exception("参数错误.");

		if (!empty($data))
		{
			$plate_content = array();
			$plate_content['id'] = intval($data['id']);
			$plate_content['plate_id'] = intval($data['plate_id']);
			$plate_content['plate_type'] = intval($data['plate_type']);
			$plate_content['title'] = htmlspecialchars(trim($data['title']));
			$plate_content['content'] = trim($data['content']);
			$plate_content['used'] = intval($data['used']);

			// 验证表单各项
			if (empty($plate_content['title'])) throw new Exception("请填写板块内容标题.");
			if (2 == $plate_content['plate_type'])
			{
				// 图片类型时进行内容拼接: 图片地址 + $$$ + 链接地址
				$plate_content['img_src'] = htmlspecialchars(trim($data['img_src']));
				$plate_content['link_url'] = htmlspecialchars(trim($data['link_url']));
				$plate_content['content'] = self::encode($plate_content['img_src'], $plate_content['link_url']);
			}
			if ( empty($plate_content['content']) )  throw new Exception("请填写板块内容.");
			$plate_content['updatetime'] = time();

			// 数据操作
			if ( 1 == $type ) {
				// 插入记录
				$sql = "INSERT INTO `slcms_plate_content` (plate_id, plate_type, title, content, update_time, used) VALUES('". $plate_content['plate_id'] ."', '". $plate_content['plate_type'] ."', '". $plate_content['title'] ."', '". $plate_content['content'] ."', '". $plate_content['update_time'] ."', '". $plate_content['used'] ."') ";
				db::query($sql);

				return true;
			}
			if ( 2 == $type && $plate_content['id'])
			{
				// 更新记录
				$sql = "UPDATE `slcms_plate_content` SET title='". $plate_content['title'] ."', content='". $plate_content['content'] ."', update_time='". $plate_content['update_time'] ."', used='". $plate_content['used'] ."' WHERE id='".$plate_content['id']."' ";
				db::query($sql);

				return true;
			}
		}
	}


	/**
	 * 板块内容编码
	 *
	 * @param string $source_url 素材地址
	 * @param string $source_param 素材参数
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
	 * 板块内容解码
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
	 * 删除板块内容
	 *
	 * @param int $id
	 */
	public static function del($id)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("请选定要操作的记录！");
		$id = array_to_string($id);

		db::query("DELETE FROM `slcms_plate_content` WHERE id IN($id) ");
	}


	/**
	 * 板块内容开关
	 *
	 * @param int $id
	 * @param int $type : 0-关闭，1-启用
	 */
	public function set_used($id, $t = 1)
	{
		$id = (empty($id)) ? 0 : $id;
		if (empty($id)) throw new Exception("请选定要操作的记录！");
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
    	if ( 1 == $plate_type)// HTML文本
    	{
    		return '';
    	} 
    	elseif ( 2 == $plate_type)// 图片
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
