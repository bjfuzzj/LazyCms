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
   ��ҳ�������(<?php echo $_smarty_tpl->getVariable('t')->value;?>
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
		    <th class="w120">�������ƣ�</th>
		    <td>
		        <input type="text" class="textinput w560" name="page_category[cate_name]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_name'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>����Ŀ¼��</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[cate_ab]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_ab'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  <?php if ($_smarty_tpl->getVariable('t')->value=='modify'){?> readonly<?php }?> />
		    <span class="alert">*����󲻿��޸ġ�</span>
		    <span class="tips">30���ַ����ڣ�Ӣ�ĺ����ֵ���ϣ������ִ�Сд��</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">�����б�ҳģ��·����</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[cate_tpl]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_tpl'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/page_list.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">��������ҳģ��·����</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[detail_tpl]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['detail_tpl'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/page_detail.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">��ע��</th>
		    <td><textarea class="textarea auto-w min-h" name="page_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><?php echo $_smarty_tpl->getVariable('page_category')->value['intro'];?>
</textarea></td>
		</tr>
		<tr>
		    <th>��������</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[order_id]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['order_id'];?>
"  maxlength="10" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">����ֵ��Ϊ��ʱ�Զ��ŵ������β����</span>
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
	        <input type="hidden" name="page_category[cate_id]" value="<?php echo $_smarty_tpl->getVariable('page_category')->value['cate_id'];?>
" />
		<input type="submit" value="ȷ�ϱ���" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
