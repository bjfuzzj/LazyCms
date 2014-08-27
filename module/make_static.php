<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: make_static.php 2012/9/10  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class make_static
{
	/**
	 * makestatic:
	 * 0 - �����ɾ�̬ҳ��
	 * 1 - ֻ���ɵ�ҳģ��ҳ��
	 * 2 - ֻ������վ��ҳ����ҳģ��ҳ��
	 * 3 - ֻ������վ��ҳ����ҳģ�顢��ϸ����ҳҳ��
	 * 9 - ������վҳ��
	 *
	 * statictype:
	 * 1 - .html, 2 - .htm, 3 - .shtml, 4 - .shtm, 0 - .php
	 */
	private static $instance;
    private static $makestatic = null; //���ɾ�̬ҳ����Ŀ����
	private static $statictype = '.php'; //��̬ҳ���׺��
	private static $statictypes = array(0=>'.php', 1=>'.html', 2=>'.htm', 3=>'.shtml', 4=>'.shtm', 5=>'.php');
	private static $staticfolder = null;

    public static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new make_static();
			self::$makestatic = intval(config::get_one('makestatic'));
			self::$staticfolder = config::get_one('staticfolder');
			if ('/' == self::$staticfolder) self::$staticfolder = '';
			self::$statictype = self::statictype();
        }
        return self::$instance;
	}


	/**
     * ��ȡ��̬�ļ���չ��
	 */
	public static function statictype()
	{
		$ftype = intval(config::get_one('statictype'));
		return self::$statictypes[$ftype];
	}


	/**
     * ������վ��ҳ
	 * ��··��Ϊ�� /index.��̬ҳ��չ��
	 */
	public static function make_index()
	{
		self::instance();
		if (self::$makestatic != 9) return false;

		// ���ɸ�Ŀ¼�µ��ļ�
		if ('.php' == self::$statictype)
		{
			$path = PATH_ROOT .'/default.php';
		}
		else
		{
			$path = PATH_ROOT .'/index'. self::$statictype;
		}
		$url = "/index.php?c=index";
		self::filewrite($path, $url, "wb+", 0);

		// ���ɾ�̬�ļ��洢Ŀ¼�µ��ļ�
		if ( (!empty(self::$staticfolder)) && ('.php' != self::$statictype) )
		{
			$path = PATH_ROOT . self::$staticfolder .'/index'. self::$statictype;
			self::filewrite($path, $url, "wb+", 0);
		}
	}


	/**
     * ���������б�ҳ
	 *
	 * ������ҳ�洢·��Ϊ�� /��̬ҳĿ¼/��ǰ����Ŀ¼/index.��̬ҳ��չ��
	 * ���ఴ��¼��ҳ�洢·��Ϊ�� /��̬ҳĿ¼/��ǰ����Ŀ¼/index_X.��̬ҳ��չ��
	 * ���ఴ��ݷ�ҳ�洢·��Ϊ�� /��̬ҳĿ¼/��ǰ����Ŀ¼/YYYY.��̬ҳ��չ��
	 *
	 * @param string $method ��������: write, del
	 * @param int $id
     */
	public static function article_category($method, $id)
	{
		self::instance();
		// ����������֤
		if (self::$makestatic != 9) return false;
		if (empty($method)) return false;

		// ��ȡ��ҳ������Ϣ
		$id = intval($id);
		$rs = article_category::get_byid($id);
		if (!isset($rs['cate_id'])) return false;

		// ����Ŀ¼·��
		$base_path = PATH_ROOT . self::$staticfolder .'/'. $rs['cate_ab'];
		$base_url = "/index.php?c=category&id={$id}";

		// �ļ�����
		$method = strtolower($method);
		if ($method == 'write')
		{
			// ���ɷ���Ĭ����ҳ
			$path = $base_path .'/index'. self::$statictype;
			self::filewrite($path, $base_url, "wb+", 0);

			// 1. ����¼����ҳʱ���ɵ��ļ�
				// A: ��ȡ�ܼ�¼��:
				$total = article_content::page_list($id, 1, 0, true);

				// B: ȡ�÷�ҳ��Ŀ
				if (empty($rs['page_num']) || $rs['page_num'] < 1) $rs['page_num'] = PAGE_ROWS;
				$pages = ceil($total/$rs['page_num']);

				// C: ѭ�����ɷ�ҳ��ҳ����1��ʼ����
				for ($i = 0; $i < $pages; $i++)
				{
					$path = $base_path .'/index_'. ($i+1) . self::$statictype;
					$url = $base_url .'&start='. $i*$rs['page_num'];
					if (false == self::filewrite($path, $url, "wb+", 0)) break;
				}

			// 2. ����ݷ�ҳʱ���ɵ��ļ�
				// A: ȡ��������ʼ���
				$startyear = intval(config::get_one('startyear'));
				$year = intval(date('Y'));
				if ($startyear < 1970 || $startyear > $year ) $startyear = $year;

				// B: ѭ�����ɸ���ݷ�ҳ
				for ($startyear; $startyear <= $year; $startyear++)
				{
					$path = $base_path .'/'. $startyear . self::$statictype;
					$url = $base_url .'&year='. $startyear;
					if (false == self::filewrite($path, $url, "wb+", 0)) break;
				}

			return true;
		}
		elseif ($method == 'del')
		{
			// ɾ������ҳ��ʱֱ��ɾ�������ļ���
			return file_helper::rm_recurse($base_path);
		}
		return false;
	}


	/**
     * ��������ҳ��
	 *
	 * �ļ��洢·��Ϊ�� /��̬ҳĿ¼/detail/YYYYMM/ID.��̬ҳ��չ��
	 *
	 * @param string $method ��������: write, del
	 * @param int $id
     */
	public static function article_content($method, $id)
	{
		self::instance();
		// ����������֤
		if (self::$makestatic < 3) return false;
		if (empty($method)) return false;

		// ��ȡ��������
		$id = empty($id) ? 0 : intval($id);
		$rs = article_content::get_one($id);
		if (!isset($rs['article_id'])) return false;
		$create_time = (empty($rs['create_time'])) ? $rs['update_time'] : $rs['create_time'];

		// �����ļ�·��
		$path = PATH_ROOT . self::$staticfolder .'/detail/'. date('Ym', $create_time) .'/'. $id . self::$statictype;
		$url = "/index.php?c=article&id={$id}";

		// �ļ�����
		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm($path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * ���ɵ�ҳ�б�ҳ
	 *
	 * �ļ��洢·��Ϊ�� /��̬ҳĿ¼/��ҳ����Ŀ¼/index.��̬ҳ��չ��
	 *
	 * @param string $method ��������: write, del
	 * @param int $id
     */
	public static function page_category($method, $id)
	{
		self::instance();
		// ����������֤
		if (self::$makestatic < 1) return false;
		if (empty($method)) return false;

		// ��ȡ��ҳ������Ϣ
		$rs = page_category::get_byid($id);
		if (!isset($rs['cate_id'])) return false;

		// �����ļ�·��
		$base_path = PATH_ROOT . self::$staticfolder .'/'. $rs['cate_ab'];
		$path = $base_path .'/index'. self::$statictype;
		$url = "/index.php?c=page_cate&id={$id}";

		// �ļ�����
		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm_recurse($base_path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * ���ɵ�ҳ����ҳ
	 *
	 * �ļ��洢·��Ϊ�� /��̬ҳĿ¼/��ҳ����Ŀ¼/��ҳ����.��̬ҳ��չ��
	 *
	 * @param string $method ��������: write, del
	 * @param int $id
     */
	public static function page_content($method, $id)
	{
		self::instance();
		// ����������֤
		if (self::$makestatic < 1) return false;
		if (empty($method)) return false;

		// ��ȡ��ҳ��Ϣ
		$rs = page_content::get_one($id);
		if (!isset($rs['page_id'])) return false;

		$cate = page_category::get_byid($rs['cate_id']);
		if (!isset($cate['cate_id'])) return false;

		// �����ļ�·��
		$path = PATH_ROOT . self::$staticfolder .'/'. $cate['cate_ab'] .'/'. $rs['page_name'] . self::$statictype;
		$url = "/index.php?c=page&id={$id}";

		// �ļ�����
		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm($path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * �������Է���ҳ
	 *
	 * �ļ��洢·��Ϊ�� /��̬ҳĿ¼/feedback.��̬ҳ��չ��
	 *
	 * @param string $method ��������: write, del
	 * @param int $id
     */
	public static function feedback($method)
	{
		self::instance();

		$path = PATH_ROOT . self::$staticfolder .'/feedback'. self::$statictype;
		$url = "/index.php?c=feedback";

		$method = strtolower($method);
		switch($method)
		{
			case 'write' :
				return self::filewrite($path, $url, "wb+", 0);
				break;
			case 'del' :
				return file_helper::rm($path);
				break;
			default :
				return false;
				break;
		}
	}


	/**
     * ���ɾ�̬�ļ�
	 *
	 * @param string $output_path ���·��
	 * @param string $source_path ����Դ��ַ
     */
	public static function filewrite($output_path, $source_path, $method = 'wb+', $iflock = 1, $check = 1, $chmod = 1)
	{
		$handle = fopen(HOST . $source_path, 'rb');
		$data = stream_get_contents($handle);
		fclose($handle);
		return file_helper::write($output_path, $data, $method, $iflock, $check, $chmod);
	}

}
