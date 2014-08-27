<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:33:13
         compiled from "D:/worklocal/newCms/template/admin\plate_content_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2582453991f79db32f0-82884409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5896f036c1ab30bb9b90bed9d01b34ced523b962' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\plate_content_edit.tpl',
      1 => 1402477681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2582453991f79db32f0-82884409',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<!--
<script type="text/javascript" src="plugin/ueditor/editor_config.js"></script>
<script type="text/javascript" src="plugin/ueditor/editor_all_min.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/ueditor.css">
-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">

<div id="main">

    <div class="nav">
    板块内容管理(<?php echo $_smarty_tpl->getVariable('t')->value;?>
)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=plate_content&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">
	<div class="box-header">
		<div class="tb-title">
		&nbsp;<a href='?c=plate_content&plate_id=<?php echo $_smarty_tpl->getVariable('plate_category')->value['id'];?>
'>归属板块: <?php echo $_smarty_tpl->getVariable('plate_category')->value['plate_name'];?>
 </a>
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">内容名称：</th>
		    <td>
		        <input type="hidden" name="plate_content[plate_id]" value="<?php echo $_smarty_tpl->getVariable('plate_content')->value['plate_id'];?>
" />
		        <input type="hidden" name="plate_content[plate_type]" value="<?php echo $_smarty_tpl->getVariable('plate_content')->value['plate_type'];?>
" />
		        <input type="text" class="textinput auto-w" name="plate_content[title]" value="<?php echo $_smarty_tpl->getVariable('plate_content')->value['title'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">板块内容：</th>
		    <td>
		<?php if ($_smarty_tpl->getVariable('plate_content')->value['plate_type']==1){?>  
            
            <script id="myEditor" name="plate_content[content]" type="text/plain" style="width:1024px;height:500px;" ><?php echo $_smarty_tpl->getVariable('plate_content')->value['content'];?>
</script>

		<?php }elseif($_smarty_tpl->getVariable('plate_content')->value['plate_type']==2){?>  

			<table width="w720">
			    <tr><th>图片地址：</th>
			        <td><input type="text" class="textinput auto-w" id="img_src" name="plate_content[img_src]" value="<?php echo $_smarty_tpl->getVariable('plate_content')->value['img_src'];?>
"  maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
			    </tr>
			    <tr><th></th>
			        <td><iframe src="?c=upload&type=images&id=img_src" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe></td>
			    </tr>
			    <tr><th>链接地址：</th>
			        <td><input type="text" class="textinput auto-w" name="plate_content[link_url]" value="<?php echo $_smarty_tpl->getVariable('plate_content')->value['link_url'];?>
"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
			    </tr>
			</table>

		<?php }else{ ?>  

            <script id="myEditor" name="plate_content[content]" type="text/plain" style="width:1024px;height:500px;" ><?php echo $_smarty_tpl->getVariable('plate_content')->value['content'];?>
</script>
		<?php }?>
		    </td>
		</tr>
		<tr>
		    <th>是否启用：</th>
		    <td>
		        <input type="checkbox" name="plate_content[used]" value="1" <?php if ($_smarty_tpl->getVariable('plate_content')->value['used']){?>checked<?php }?>  /> 启用
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="hidden" name="plate_content[id]" value="<?php echo $_smarty_tpl->getVariable('plate_content')->value['id'];?>
" />
		<input type="submit" value=" 确认保存 " />
	    </div>
	</div>
	</form>
    </div><!-- /box -->

</div><!-- /main -->

<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('myEditor');
</script>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
