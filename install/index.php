<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('memory_limit', '128M');
set_time_limit(300);

header('Content-Type: text/html; charset=gbk');

defined('HOST') || define('HOST', 'http://' . $_SERVER['HTTP_HOST']);
$path_info = pathinfo($_SERVER['PHP_SELF']);
$path_x = rtrim(strtr(dirname($path_info['dirname']), array('\\' => '/')), '/');
defined('URL') || define('URL', 'http://' . $_SERVER['HTTP_HOST'] . $path_x);
defined('PATH_ROOT') || define('PATH_ROOT', rtrim(strtr(__FILE__, array('\\' => '/' , '/install/index.php' => '' , '\install\index.php' => '', '//' => '/')), '/'));
define('PATH_INSTALL', PATH_ROOT . '/install');



defined('PATH_LIB') || define('PATH_LIB', PATH_ROOT . '/lib');
defined('PATH_MODULE') || define('PATH_MODULE', PATH_ROOT . '/module');
defined('PATH_CONTROLLER') || define('PATH_CONTROLLER', PATH_ROOT . '/controller');
defined('PATH_DATA') || define('PATH_DATA', PATH_ROOT . '/data');
defined('PATH_PLUGIN') || define('PATH_PLUGIN', PATH_ROOT . '/plugin');
defined('PATH_UPFILE') || define('PATH_UPFILE', '/uploadfile');
defined('PATH_UPLOAD') || define('PATH_UPLOAD', PATH_ROOT . PATH_UPFILE);

defined('PATH_TPLS') || define('PATH_TPLS', PATH_ROOT . '/template');
defined('PATH_TPLS_COMPILE') || define('PATH_TPLS_COMPILE', PATH_ROOT . '/data/compile');
defined('PATH_TPLS_CACHE') || define('PATH_TPLS_CACHE', PATH_ROOT . '/data/cache');
defined('PATH_TPLS_ADMIN') || define('PATH_TPLS_ADMIN', PATH_TPLS . '/admin');
defined('PATH_TPLS_MAIN') || define('PATH_TPLS_MAIN', PATH_TPLS . '/default');
defined('PATH_COOKIE') || define('PATH_COOKIE',  '/');

defined('PAGE_ROWS') || define('PAGE_ROWS', 30);
defined('PAGE_ROWS_ADMIN') || define('PAGE_ROWS_ADMIN', 30);

defined('CUR_VERSION') || define('CUR_VERSION', '2.1');
defined('SOURCE_URL') || define('SOURCE_URL', 'http://www.96335.com/');

$dbconffile = PATH_ROOT . '/lib/database.php';
$dbclassfile = PATH_INSTALL . '/db.php';
$installsqlfile = PATH_INSTALL . '/data/install.sql';
$updatesqlfile = PATH_INSTALL . '/data/update.sql';
$basename = 'index.php';


//处理输入数据
foreach(array('_COOKIE', '_POST', '_GET') as $_request)
{
	foreach($$_request as $_key => $_value)
	{
		$_key{0} != '_' && $$_key = Add_S($_value);
	}
}


//添加默认数据
if(empty($dbhost)) $dbhost='localhost';
if(empty($dbuser)) $dbuser='';
if(empty($dbpw)) $dbpw='';
if(empty($dbname)) $dbname='GoCMSSQL';
if(empty($dbpre)) $dbpre='slcms_';
if(empty($manager)) $manager='admin';



//数据库链接
if(isset($step) && $step > 3 && $step < 6)
{
    if(file_exists($dbconffile))
    {
        include_once($dbconffile);
    }
    if(file_exists($dbclassfile))
    {
        include_once($dbclassfile);
        db::query("SET character_set_connection=gbk, character_set_results=gbk");
        db::query("SET NAMES gbk");
    }
}


if(empty($step)) //环境检测及安装协议
{
    $check = 1;
    if (PHP_VERSION < '5.0.0')
    {
        $check = 0;
        $error_txt = "很抱歉，您的php版本太低，请升级至5.0以上版本。";
    }
}
elseif($step==1) //输入库配置文件可写检测
{
    $w_check = array(
        $dbconffile,
    );
    $check = 1;
    foreach ($w_check as $key => $value)
    {
        if (!file_exists($value) && !@touch($value))
        {
            $w_check[$key] .= "文件不存且无权限建立,请设置目录写权限或手动上传此文件";
            $check = 0;
        } elseif (!is_writable($value))
        {
            $w_check[$key] .= "<font color='red'> 777属性检测不通过</font>";
            $check = 0;
        } else
        {
            $w_check[$key] .= "<font color='#00CC00'> 可写<b>√</b></font>";
            $step = 2;
        }
    }
}
elseif($step==2) //填写配置信息
{
}
elseif($step==3) //输入处理和目录权限检测
{
    $check = 1;

	if(!$manager || !$password || $password != $password_check)
	{
		$error_password = 1;//密码错误,显示
		$step=3;
		$check=0;
	}
	if(!$dbuser || $dbpw != $dbpw_check)
	{
		$error_password = 2;//数据库密码错误,显示
		$step=3;
		$check=0;
	}
	else
	{
		$manager_pwd = md5(md5($password));
		$writetofile = <<<EOT
<?php
!defined('PATH_ROOT') && exit('Forbidden');

\$GLOBALS ['database'] ['db_user'] = '$dbuser';
\$GLOBALS ['database'] ['db_pass'] = '$dbpw';
\$GLOBALS ['database'] ['db_name'] = '$dbname';
\$GLOBALS ['database'] ['db_charset'] = 'gbk';
\$GLOBALS ['database'] ['table_prefix'] = '$dbpre';
\$GLOBALS ['database'] ['db_host'] = '$dbhost';
\$GLOBALS ['database'] ['manager'] = '$manager';
\$GLOBALS ['database'] ['managerpw'] = '$manager_pwd';

EOT;
		file_put_contents($dbconffile, $writetofile);
	}

	//权限检测.
	$file_check_result = check_attr();
	$file_check_error = $file_check_result[0];
	$file_check_report = $file_check_result[1];
	if($file_check_error)//文件权限检测错误,显示
	{
		$check = 0;
	}
}
elseif($step==4) //数据导入
{
	$error = 0;
	$error_txt = '';
	$dbcharset=$GLOBALS['database']['db_charset'];
	$dbname=$GLOBALS['database']['db_name'];

	if (!@db::select_db($dbname))
	{
		$sql = "CREATE DATABASE $dbname".((db::server_info() >= '4.1' && $dbcharset) ? " DEFAULT CHARACTER SET $dbcharset" : '');
		if(!db::query($sql))
		{
			$error = 1;
			$error_txt = "指定的数据库不存在,且您无权限建立,请联系服务器管理员!";
		}
		else
		{
			@db::select_db($dbname);
		}
	}

	if(!$error)
	{
		$sql = file_get_contents($installsqlfile);
		$tblpre = $GLOBALS ['database'] ['table_prefix'] ;
		$manager = $GLOBALS ['database'] ['manager'];
        $managerpw = $GLOBALS ['database'] ['managerpw'];

		// 导入执行
		$installinfo = creat_table($sql);
		if (@$update_demo)
		{
			$sql = file_get_contents($updatesqlfile);
			creat_table($sql);
		}

		// 添加创始人账户
		$sql = "INSERT INTO `{$tblpre}member` (`user_id`, `password`, `nickname`, `purviews`, `locked`) VALUES('$manager', '$managerpw', '超级管理员', 'login,admin_all', 0)";
		db::query($sql);
        
        get_static();

	}
}
elseif($step==5) //安装完成
{
}
elseif($step==6) //删除安装目录，转向管理页
{
	@deldir(dirname(__FILE__));
	if(!file_exists(__FILE__))
	{
		header('Location: ../admin.php');
        echo "<script type='text/javascript'>window.location.href='../admin.php';</script>";
		exit;
	}
}


// 获取及显示模版内容
ob_start();
include('index.tpl.htm');
$output = str_replace(array('<!--<!---->', '<!---->', "\r\n","   "), array('','', '',''), ob_get_contents());
ob_end_clean();
echo $output;














//====================================================================
//                            函数定义
//====================================================================


//输入过滤
function Add_S($string, $force = 0)
{
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if (!MAGIC_QUOTES_GPC || $force)
	{
		if (is_array($string))
		{
			foreach($string as $key => $val)
			{
				$string[$key] = Add_S($val, $force);
			}
		}
		else
		{
			$string = addslashes($string);
		}
	}
	return $string;
}


//目录权限检测
function check_attr()
{
	$error = 0 ;
    $result = array();
    if(file_exists('check_list.php'))
    {
        include('check_list.php');
        foreach ($check_list['dir_list'] as $name => $dir)
        {
            if(file_exists($dir))
            {
                if(is_dir($dir) && is_writable($dir))
                {
                    $result[] = array($name . ": " . $dir, 1);
                }
                else
                {
                    $error = 1 ;
                    $result[] = array($name . ": " . $dir, 2);
                }
            }
            else
            {
                if(@mkdir($dir, 0777, true))
                {
                    $result[] = array($name . ": " . $dir, 1);
                }
                else
                {
                    $error = 1 ;
                    $result[] = array($name . ": " . $dir, 3);
                }
            }
        }

        foreach ($check_list['file_list'] as $name => $file)
        {
            if(file_exists($file))
            {
                if(is_writable($file))
                {
                    $result[] = array($name . ": " . $file, 1);
                }
                else
                {
                    $error = 1 ;
                    $result[] = array($name . ": " . $file, 2);
                }
            }
            else
            {
                if(@touch($file))
                {
                    $result[] = array($name . ": " . $file, 1);
                }
                else
                {
                    $error = 1 ;
                    $result[] = array($name . ": " . $file, 3);
                }
            }
        }
    }
    else
    {
    }
	return array($error, $result);
}

//导入表结果和数据
function creat_table($sql)
{
	global $db,$PW,$lang,$charset;
	$installinfo = '';
	$sql = str_replace("\r",'',$sql);
	$sqlarray = array();
	$sqlarray = explode(";\n",$sql);

	foreach ($sqlarray as $key => $query)
	{
		$query = trim(str_replace("\n",'',$query));

		if ($query && strpos($query,'CREATE TABLE') !==false)
		{
			$c_name = trim(substr($query, 13, strpos($query, '(')-13));
			$c_name = str_replace('slcms_', $GLOBALS['database']['table_prefix'], $c_name);
			$installinfo .= "建立数据表 $c_name ... 完成\n";
			//$extra1 = trim(substr(strrchr($query,')'),1));

			//if (db::server_info() >= '4.1')
			//{
			//	$extra2 = "ENGINE=MyISAM DEFAULT CHARSET=gbk COLLATE=gbk_chinese_ci ;" ;
			//}
			//else
			//{
			//	$extra2 = 'TYPE=MyISAM;';
			//}
			//$query = str_replace($extra1,$extra2,$query);
		}
		$query && db::query($query);
	}

	return $installinfo;
}

//目录删除
function deldir($path)
{
	if (file_exists($path))
	{
		if(is_file($path))
		{
			P_unlink($path);
		} else
		{
			$handle = opendir($path);
			while ($file = readdir($handle))
			{
				if (($file!=".") && ($file!="..") && ($file!=""))
				{
					if (is_dir("$path/$file"))
					{
						deldir("$path/$file");
					} else
					{
						P_unlink("$path/$file");
					}
				}
			}
			closedir($handle);
			rmdir($path);
		}
	}
}

//文件删除
function P_unlink($filename)
{
	strpos($filename,'..')!==false && exit('Forbidden');
	return @unlink($filename);
}

//获取整个站的静态页
function get_static()
{

        $classfile = PATH_CONTROLLER . '/admin/ctl_make_static.php';
        $classfile1 = PATH_MODULE . '/make_static.php';
       	require $classfile;
        require $classfile1;
        //静态首页
        make_static::make_index();
        //生成文章分类页
        $rs = article_category::get_list();
		if ( is_array($rs) )
		{
			foreach ($rs as $v)
			{
				make_static::article_category('write', $v['cate_id']);
			}
		}
        //生成内容页
		db::query("SELECT article_id FROM `slcms_article_content` WHERE passed=1 AND deleted=0");
		$rs = db::fetch_all();
		if ( is_array($rs) )
		{
			foreach ($rs as $v)
			{
				make_static::article_content('write', $v['article_id']);
			}
		}
        //生成单页分类页
		$rs = page_category::get_list();
		foreach ($rs as $v)
		{
			make_static::page_category('write', $v['cate_id']);
		}
        //生成单页
		db::query("SELECT page_id FROM `slcms_page_content` WHERE passed=1 ");
		$rs = db::fetch_all();
		if ( is_array($rs) )
		{
			foreach ($rs as $v)
			{
				make_static::page_content('write', $v['page_id']);
			}
		}
        // 生成留言反馈页
        make_static::feedback('write');    
    
}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 自动加载文件
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
if (function_exists('__autoload')) {
  spl_autoload_register('__autoload');
}
//if (!function_exists('__autoload'))
//{
	function __autoload($classname)
	{
		$classfile = PATH_MODULE . '/' . $classname . '.php';
		try
		{
			if (!is_file($classfile) && ! class_exists($classname))
			{
				throw new Exception('找不到模型 ' . $classname);
			}
			else
			{
				require $classfile;
			}
		}
		catch (Exception $e)
		{
    		if (DEBUG_LEVEL === true)
    		{
    			echo '<pre>';
    			echo $e->getMessage() . $e->getTraceAsString();
    			echo '</pre>';
    			exit();
    		}
    		else
    		{
    			header("HTTP/1.1 404 Not Found");
    			exit;
    		}
		}
	}
