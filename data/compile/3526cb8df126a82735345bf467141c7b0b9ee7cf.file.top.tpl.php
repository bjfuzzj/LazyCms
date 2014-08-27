<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:26:41
         compiled from "D:/worklocal/newCms/template/admin\top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2101853991df11a59d7-85505048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3526cb8df126a82735345bf467141c7b0b9ee7cf' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\top.tpl',
      1 => 1402385313,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2101853991df11a59d7-85505048',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<link href="template/admin/static/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="wrap">
	<div id="header">

	    <div id="logo">
		<a href="http://www.96335.com/" title="广西广电网络网站管理系统" target="_blank"><img src="template/admin/static/logo.png" /></a>
	    </div> <!-- /logo -->

	    <div id="tool">
		<a href="index.php" target="_blank" >网站首页</a> |
		<a href="?c=frame&a=welcome" target="main" >管理首页</a> |
		<a href="?c=personal&a=pwd&userid=<?php echo $_smarty_tpl->getVariable('userid')->value;?>
" target='main'>修改密码</a> |
		<a href="?c=login&a=logout" target="_parent">退出</a>
	    </div>

	</div> <!-- /header -->
</div> <!-- /wrap -->


</body>
</html>