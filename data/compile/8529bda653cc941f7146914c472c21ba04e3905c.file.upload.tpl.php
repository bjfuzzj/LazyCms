<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 10:55:34
         compiled from "D:/worklocal/newCms/template/admin\upload.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15152539916a62393d9-86907399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8529bda653cc941f7146914c472c21ba04e3905c' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\upload.tpl',
      1 => 1336909128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15152539916a62393d9-86907399',
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
<script type="text/javascript" src="plugin/jquery/jquery.js"></script>

<style>
.msg {padding:5px 10px 2px 10px; font:normal 12px/18px '实体';}
a.a-msg {color:#0000CC; text-decoration:underline; }
</style>

</head>

<body>

<div class='box' style="text-align:left; height:30px; overflow:hidden;">
<?php if ($_smarty_tpl->getVariable('msg')->value){?>
	<div class="msg">
	<?php echo $_smarty_tpl->getVariable('msg')->value;?>

	<a href='?c=upload&type=<?php echo $_smarty_tpl->getVariable('type')->value;?>
&id=<?php echo $_smarty_tpl->getVariable('id')->value;?>
' class='a-msg' target='_self'>重新上传图片</a>
	</div>
<?php }else{ ?>
	<form action="?c=upload&type=<?php echo $_smarty_tpl->getVariable('type')->value;?>
&id=<?php echo $_smarty_tpl->getVariable('id')->value;?>
" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value='upfile' /> 
		<div style="height:20px; padding-top:5px; overflow:hidden; float:left;">
		    <input type="file" class="textinput" name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
		</div>
		<div style="height:20px; padding-top:5px; overflow:hidden; float:left; margin-left:5px;">
		    <input type="submit" class="min_btn" value="上传" />
		</div>
	</form>
<?php }?>
</div>

</body>
</html>
