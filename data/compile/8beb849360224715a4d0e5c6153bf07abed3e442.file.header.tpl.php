<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 10:55:03
         compiled from "D:/worklocal/newCms/template/admin\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28508539916874769a9-47828193%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8beb849360224715a4d0e5c6153bf07abed3e442' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\header.tpl',
      1 => 1336485032,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28508539916874769a9-47828193',
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
    <div class="container">
    
    <?php if ($_smarty_tpl->getVariable('error')->value){?>
        <div class="error">
	<img src="template/admin/static/error.gif" />
        <?php echo $_smarty_tpl->getVariable('error')->value;?>

	</div>
    <?php }?>
