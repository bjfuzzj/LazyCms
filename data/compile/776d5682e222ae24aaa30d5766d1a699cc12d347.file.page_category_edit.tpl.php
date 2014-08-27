<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:25:41
         compiled from "D:/worklocal/newCms/template/admin\page_category_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:838353991db51f7d23-96953280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '776d5682e222ae24aaa30d5766d1a699cc12d347' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\page_category_edit.tpl',
      1 => 1336785876,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '838353991db51f7d23-96953280',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">

   <div class="nav">
   单页分类管理(<?php echo $_smarty_tpl->getVariable('t')->value;?>
)
   </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=page_category&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">分类名称：</th>
		    <td>
		        <input type="text" class="textinput w560" name="page_category[cate_name]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_name'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>分类目录：</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[cate_ab]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_ab'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  <?php if ($_smarty_tpl->getVariable('t')->value=='modify'){?> readonly<?php }?> />
		    <span class="alert">*保存后不可修改。</span>
		    <span class="tips">30个字符以内，英文和数字的组合，不区分大小写。</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">分类列表页模板路径：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[cate_tpl]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_tpl'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">相对根目录路径，例：/template/default/page_list.tpl；为空时使用配置的默认路径。</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">分类内容页模板路径：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[detail_tpl]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['detail_tpl'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">相对根目录路径，例：/template/default/page_detail.tpl；为空时使用配置的默认路径。</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">备注：</th>
		    <td><textarea class="textarea auto-w min-h" name="page_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><?php echo $_smarty_tpl->getVariable('page_category')->value['intro'];?>
</textarea></td>
		</tr>
		<tr>
		    <th>分类排序：</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[order_id]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['order_id'];?>
"  maxlength="10" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">整数值；为空时自动排到分类的尾部。</span>
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
	        <input type="hidden" name="page_category[cate_id]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_id'];?>
" />
		<input type="submit" value="确认保存" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
