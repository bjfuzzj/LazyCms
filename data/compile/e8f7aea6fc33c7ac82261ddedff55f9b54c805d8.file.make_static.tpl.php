<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:27:50
         compiled from "D:/worklocal/newCms/template/admin\make_static.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1089153991e36f27ad2-41420219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8f7aea6fc33c7ac82261ddedff55f9b54c805d8' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\make_static.tpl',
      1 => 1337520976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1089153991e36f27ad2-41420219',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">
<?php if ($_smarty_tpl->getVariable('make')->value=='make'){?>
    <div style="font:normal 14px/28px '宋体'; color:red; text-align:left; margin:10px;">
        正在生成页面，请勿刷新……
    </div>
<?php }else{ ?>
    <div class="nav">
    生成静态页面
    </div> <!-- /nav -->

    <div class="box">

	<div class="box-header">
		<div class="tb-title">
			<span style="color:#282828">当前生成设置为： <?php echo $_smarty_tpl->getVariable('static')->value;?>
</span>
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr><td>
		<ul style="margin:0px 20px; font:normal 14px/28px '宋体';">
		<?php if ($_smarty_tpl->getVariable('makestatic')->value>=9){?>
		        <li><a href="?c=make_static&t=all">生成整站</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('makestatic')->value>1){?>
			<li><a href="?c=make_static&t=index">生成首页</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('makestatic')->value>3){?>
			<li><a href="?c=make_static&t=article_category">生成文章分类页</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('makestatic')->value>2){?>
			<li><a href="?c=make_static&t=article_content">生成所有文章页</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('makestatic')->value>0){?>
			<li><a href="?c=make_static&t=page_category">生成单页分类页</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('makestatic')->value>0){?>
			<li><a href="?c=make_static&t=page_content">生成所有单页</a></li>
		<?php }?>
			<li><a href="?c=make_static&t=feedback">生成留言版页面</a></li>
		</ul>
		</td></tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
	    </div>
	</div> <!-- /box-footer -->

    </div><!-- /box -->
<?php }?>
</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
