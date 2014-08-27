<?php /* Smarty version Smarty-3.0.7, created on 2014-06-13 10:51:35
         compiled from "D:/worklocal/newCms/template/admin\feedback_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18699539a6737371e40-78730471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f59760eeacd9c9763d0731037e7524c12bb3e04' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\feedback_edit.tpl',
      1 => 1347282474,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18699539a6737371e40-78730471',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">
    <div class="nav">
    留言内容查看
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=feedback&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">用户名称：</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[user_name]" value="<?php echo $_smarty_tpl->getVariable('feedback')->value['user_name'];?>
" maxlength="50"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th>电子邮箱：</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[email]" value="<?php echo $_smarty_tpl->getVariable('feedback')->value['email'];?>
" maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th>留言标题：</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[title]" value="<?php echo $_smarty_tpl->getVariable('feedback')->value['title'];?>
" maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">留言内容：</th>
		    <td><textarea class="textarea w720" rows="10" name="feedback[content]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><?php echo $_smarty_tpl->getVariable('feedback')->value['content'];?>
</textarea></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value=" 确认保存 " />
		<input type="hidden" name="feedback[fid]" value="<?php echo $_smarty_tpl->getVariable('feedback')->value['fid'];?>
" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->

</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
