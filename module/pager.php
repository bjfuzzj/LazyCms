<?php
!defined('PATH_ROOT') && exit('Forbidden');

class pager
{
	// ����ҳ��βҳʱ����ǰҳ����������ʾ��ҳ��
	private static $default_pages = 11;

	/**
	 * ��ȡҳ���б�
	 * ��̬ҳ�Լ�¼ID��ʼΪ��ҳ����0����
	 * ��̬ҳ��ҳ���1����
	 *
	 * @param int $total ��¼����
	 * @param int $start �ӵڼ�����¼��ʼ
	 * @param int $page_rows ÿҳ��ʾ��¼��
	 * @param bool $static �Ƿ񷵻ؾ�̬����
	 * @param string $statictype ��̬ҳ������
	 * @return array
	 */
	public static function get_page_number_list($total, $start, $page_rows = PAGE_ROWS, $static = false, $statictype = '.php')
	{
		if ($total < 1 || $start < 0 || $page_rows < 1) return false;

		// ����ҳ��βҳʱ����ǰҳ����������ʾ��ҳ��
		$least = (self::$default_pages - 5) / 2;

		if ($start < $page_rows) $start = 0;
		if ($start >= $total) $start = $total - 1;
		$page_num = ceil($total/$page_rows);

		$current_page = ceil($start/$page_rows);
		if ($start%$page_rows == 0) $current_page++;
		if ($current_page < 1) $current_page = 1;
		$output = array();
		$static_op = array();

		// ���С����ʾĬ����ʾҳ��
		if ($page_num <= self::$default_pages) {
			// ��һҳ
			$prev = $current_page - 2;
			if ($prev < 0)
			{
				$prev = 0;
				$static_op['prev'] = ''. $statictype;
			}
			if ($start > 0)
			{
				$output['prev'] = $prev * $page_rows;
				$static_op['prev'] = '_'. ($prev+1) . $statictype;
			}
			for ($i=0; $i<$page_num; ++$i) {
				$tmp = $i * $page_rows;
				$t = $i + 1;
				if ($t == $current_page)
				{
					$output[$t] = -1;
					$static_op[$t] = -1;
				}
				else
				{
					$output[$t] = $tmp;
					$static_op[$t] = '_'. ($i+1) . $statictype;
				}
			}
			// ��һҳ
			$next = $current_page * $page_rows;
			if ($next < $total)
			{
				$output['next'] = $next;
				$static_op['next'] = '_'. ($current_page+1) . $statictype;
			}
		}
		else
		{
			// �����Ҫʡ��ĳЩҳ
			if ($current_page - $least - 1 > 1 || $current_page + $least + 1 < $page_num) {
				// ��һҳ
				$prev = $current_page - 2;
				if ($prev < 0)
				{
					$prev = 0;
					$static_op['prev'] = ''. $statictype;
				}
				if ($start > 0)
				{
					$output['prev'] = $prev * $page_rows;
					$static_op['prev'] = '_'. ($prev+1) . $statictype;
				}
				for ($i = 0; $i < $page_num; ++$i) {
					$tmp = $i * $page_rows;
					$t = $i + 1;
					if ($t < $current_page - $least && $page_num - self::$default_pages + 2 > $t && $t != 1) {
						$output['omitf'] = true;
						$static_op['omitf'] = true;
						continue;
					}
					if ($t > $current_page + $least && $t > self::$default_pages - 1 && $t != $page_num) {
						$output['omita'] = true;
						$static_op['omitf'] = true;
						continue;
					}
					if ($t == $current_page)
					{
						$output[$t] = -1;
						$static_op[$t] = -1;
					}
					else
					{
						$output[$t] = $tmp;
						$static_op[$t] = '_'. ($i+1) . $statictype;
					}
				}
				// ��һҳ
				$next = $current_page * $page_rows;
				if ($next < $total) 
				{
					$output['next'] = $next;
					$static_op['next'] = '_'. ($current_page+1) . $statictype;
				}
			} else {
				// ��һҳ
				$prev = ($current_page-2) * $page_rows;
				if ($prev < 0)
				{
					$prev = 0;
					$static_op['prev'] = ''. $statictype;
				}
				if ($start > 0)
				{
					$output['prev'] = $prev * $page_rows;
					$static_op['prev'] = '_'. ($prev+1) . $statictype;
				}
				for ($i=0; $i<$page_num; ++$i) {
					$tmp = $i * $page_rows;
					$t = $i + 1;
					if ($t == $current_page)
					{
						$output[$t] = -1;
						$static_op[$t] = -1;
					}
					else
					{
						$output[$t] = $tmp;
						$static_op[$t] = '_'. ($i+1) . $statictype;
					}
				}
				// ��һҳ
				$next = $current_page * $page_rows;
				if ($next < $total)
				{
					$output['next'] = $next;
					$static_op['next'] = '_'. ($current_page+1) . $statictype;
				}
			}
		}

		if (true == $static) return $static_op;
		else return $output;
	}

}
