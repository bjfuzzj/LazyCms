<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 14:42:11
         compiled from "D:/worklocal/newCms/template/admin\plate_category_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1525453994bc3b48580-01057922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '150d7b19043816b85e2cfc2d3ac54febc631e34f' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\plate_category_edit.tpl',
      1 => 1337261582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1525453994bc3b48580-01057922',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">
    <div class="nav">
    页面板块管理(<?php echo $_smarty_tpl->getVariable('t')->value;?>
)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=plate_category&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">板块名称：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="plate_category[plate_name]" value="<?php echo $_smarty_tpl->getVariable('plate_category')->value['plate_name'];?>
" maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		        <span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>板块标识：</th>
		    <td>
		        <input type="text" class="textinput w240" name="plate_category[plate_ab]" value="<?php echo $_smarty_tpl->getVariable('plate_category')->value['plate_ab'];?>
" maxlength="30"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		        <span class="tips">* 数字,字母和下划线组合，30个字符以内。</span>
		    </td>
		</tr>
		<tr>
		    <th>内容类型：</th>
		    <td>
		        <input type="radio" name="plate_category[plate_type]" value="1" <?php if ($_smarty_tpl->getVariable('plate_category')->value['plate_type']==1){?>checked<?php }?>  /> (HTML)文本 
		        <input type="radio" name="plate_category[plate_type]" value="2" <?php if ($_smarty_tpl->getVariable('plate_category')->value['plate_type']==2){?>checked<?php }?>  /> 图片 
			 <?php if ($_smarty_tpl->getVariable('t')->value=='modify'){?> <span class="tips">|板块下有内容时建议不要修改类型。</span> <?php }?>
		        <br><span class="tips">前台显示时，除图片类型可以显示多条记录外，其它类型只显示最新一条在用的记录。</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">备注：</th>
		    <td><textarea class="textarea auto-w min-h" name="plate_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><?php echo $_smarty_tpl->getVariable('plate_category')->value['intro'];?>
</textarea></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value=" 确认保存 " />
		<input type="hidden" name="plate_category[id]" value="<?php echo $_smarty_tpl->getVariable('plate_category')->value['id'];?>
" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
