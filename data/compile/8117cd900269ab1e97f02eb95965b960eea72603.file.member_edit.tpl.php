<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 16:52:32
         compiled from "D:/worklocal/newCms/template/admin\member_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:263653996a50836607-79840174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8117cd900269ab1e97f02eb95965b960eea72603' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\member_edit.tpl',
      1 => 1336568620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '263653996a50836607-79840174',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">

    <div class="nav">
    ����Ա�ʺŹ���(<?php echo $_smarty_tpl->getVariable('t')->value;?>
)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=member&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">��¼����</th>
		    <td>
		    <?php if ($_smarty_tpl->getVariable('t')->value=='modify'){?>
		    <input type="text" class="textinput w240" name="member[user_id]" value="<?php echo $_smarty_tpl->getVariable('member')->value['user_id'];?>
" readonly/> 
		    <?php }else{ ?>
		    <input type="text" class="textinput w240" name="member[user_id]" maxlength="20" value="<?php echo $_smarty_tpl->getVariable('member')->value['user_id'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    <span class="tips">4~20���ַ����ڡ�</span>
		    <?php }?>
		    </td>
		</tr>
		<tr>
		    <th>�ǳƣ�</th>
		    <td>
		    <input type="text" class="textinput w240" name="member[nickname]" maxlength="20" value="<?php echo $_smarty_tpl->getVariable('member')->value['nickname'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    <span class="tips">4~20���ַ�����</span>
		    </td>
		</tr>
		<tr>
		    <th>��½���룺</th>
		    <td><input type="password" class="textinput w240" name="member[password]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    <?php if ($_smarty_tpl->getVariable('t')->value=='modify'){?><span class="tips">���޸�������.</span><?php }?>
		    <span class="tips">6~20��Ӣ����ĸ��������ϵ��ַ���</span>
		    </td>
		</tr>
		<tr>
		    <th>ȷ�����룺</th>
		    <td><input type="password" class="textinput w240" name="member[chkpwd]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>�û�״̬��</th>
		    <td><input type="checkbox" name="member[locked]" value="1" <?php if ($_smarty_tpl->getVariable('member')->value['locked']){?>checked<?php }?> /> ����</td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value="ȷ�ϱ���" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
