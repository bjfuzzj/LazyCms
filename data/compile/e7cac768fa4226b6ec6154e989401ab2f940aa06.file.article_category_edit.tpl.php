<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 12:04:20
         compiled from "D:/worklocal/newCms/template/admin\article_category_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31107539926c4a7d143-74152122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7cac768fa4226b6ec6154e989401ab2f940aa06' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\article_category_edit.tpl',
      1 => 1336785610,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31107539926c4a7d143-74152122',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">

    <div class="nav">
    ���·������(<?php echo $_smarty_tpl->getVariable('t')->value;?>
)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=article_category&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">��Ŀ���ƣ�</th>
		    <td>
		    <input type="text" class="textinput w560" name="article_category[cate_name]" maxlength="250" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['cate_name'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> <span class="alert">*</span>
		    </td>
		</tr>
		<tr>
		    <th>������д��</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[cate_ab]" maxlength="30" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['cate_ab'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  <?php if ($_smarty_tpl->getVariable('t')->value=='modify'){?> readonly<?php }?>  /> 
		    <span class="alert">*����󲻿��޸ġ�</span>
		    <span class="tips">30���ַ����ڣ�Ӣ�ĺ����ֵ���ϣ������ִ�Сд��</span>
		    </td>
		</tr>
		<tr>
		    <th>����ҳ��ģ��·����</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[cate_tpl]" maxlength="250" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['cate_tpl'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/article_list.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th>��������ҳģ��·����</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[detail_tpl]" maxlength="250" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['detail_tpl'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/article_detail.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th>ÿҳ��¼����</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[page_num]" maxlength="5" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['page_num'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th>ҳ��ؼ��֣�</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[keywords]" maxlength="250" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['keywords'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th>ҳ��������</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[description]" maxlength="250" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['description'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">��ע��</th>
		    <td><textarea class="textarea auto-w min-h" name="article_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><?php echo $_smarty_tpl->getVariable('article_category')->value['intro'];?>
</textarea></td>
		</tr>
		<tr>
		    <th>��Ŀ����</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[order_id]" maxlength="5" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['order_id'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    <span class="tips">����ֵ��Ϊ��ʱ�Զ��ŵ������β����</span>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value="ȷ�ϱ���" />
		<input type="hidden" name="article_category[cate_id]" value="<?php echo $_smarty_tpl->getVariable('article_category')->value['cate_id'];?>
" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
