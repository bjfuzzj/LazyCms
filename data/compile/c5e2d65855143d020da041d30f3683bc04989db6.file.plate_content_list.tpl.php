<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:25:59
         compiled from "D:/worklocal/newCms/template/admin\plate_content_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2734953991dc71eb473-59201546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5e2d65855143d020da041d30f3683bc04989db6' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\plate_content_list.tpl',
      1 => 1337261784,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2734953991dc71eb473-59201546',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\worklocal\newCms\plugin\smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>


<div id="main">

    <div class="nav">
	    �����б����
	    <?php if ($_smarty_tpl->getVariable('plate_category')->value['id']!=''){?>
	    [���: <?php echo $_smarty_tpl->getVariable('plate_category')->value['plate_name'];?>
] 
	    <?php }?>
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=plate_content" method="post">
	<div class="left-item">	
	    &nbsp;<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
	    <?php if ($_smarty_tpl->getVariable('plate_category')->value['id']!=''){?>
	    &nbsp;<a href="?c=plate_content&a=edit&t=add&plate_id=<?php echo $_smarty_tpl->getVariable('plate_category')->value['id'];?>
">��Ӱ������</a>
	    <?php }?>
	</div>

	<div class="box-header">
		<?php if ($_smarty_tpl->getVariable('pages')->value){?>
		<div class="pages">
		    <?php if ($_smarty_tpl->getVariable('pages')->value['prev']>-1){?>                            
		    <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->getVariable('pages')->value['prev'];?>
">��һҳ</a>
		    <?php }else{ ?>
		    <span class="nextprev">��һҳ</span>
		    <?php }?>
		    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
			<?php if ($_smarty_tpl->tpl_vars['k']->value!='prev'&&$_smarty_tpl->tpl_vars['k']->value!='next'){?>
			    <?php if ($_smarty_tpl->tpl_vars['k']->value=='omitf'||$_smarty_tpl->tpl_vars['k']->value=='omita'){?>
			    <span>��</span>
			    <?php }else{ ?>
				<?php if ($_smarty_tpl->tpl_vars['i']->value>-1){?>
				<a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a>
				<?php }else{ ?>
				<span class="current"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</span>                                        
				<?php }?>
			    <?php }?>   
			<?php }?>                             
		    <?php }} ?>
		    <?php if ($_smarty_tpl->getVariable('pages')->value['next']>-1){?>                            
		    <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->getVariable('pages')->value['next'];?>
">��һҳ</a>
		    <?php }else{ ?>
		    <span class="nextprev">��һҳ</span>
		    <?php }?>
		</div>
		<?php }?>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="40">ѡ��</td>
		<td width="50">ID</td>
		<td width="50">����</td>
		<td >����</td>
		<td width="50">����</td>
		<td width="130">����ʱ��</td>
		<td width="130">����</td>
	    </tr>

	    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('plate_content')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	    <tr>
		<td><input type='checkbox' rel='del' name='id[]' value='<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
' /></td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
	        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['type'];?>
</td>
		<td align="left"><a href="?c=plate_content&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></td>
		<td><?php if ($_smarty_tpl->tpl_vars['v']->value['used']==1){?>��<?php }else{ ?><font color='red' size='5'>��</font><?php }?></td>
		<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['update_time'],$_smarty_tpl->getVariable('date_format')->value);?>
&nbsp;</td>
		<td>
		    <?php if ($_smarty_tpl->tpl_vars['v']->value['used']==1){?>
			<a href="?c=plate_content&a=unable&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">����</a> | 
		    <?php }else{ ?>
			<a href="?c=plate_content&a=used&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">����</a> | 
		    <?php }?>
		    <a href="?c=plate_content&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">�༭</a> | 
		    <a href="?c=plate_content&a=del&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" onClick="return confirm('ȷ��Ҫɾ���ð��������ɾ���󲻿ɻָ���');" >ɾ��</a>
		</td>
	    </tr>
	    <?php }} ?>

	    <tr class="tb-footer">
		<td colspan="7">
		<div class="action-item">
		    <a href="javascript:function(){void();}" onClick="CheckControl(1);">ȫѡ</a> - 
		    <a href="javascript:function(){void();}" onClick="CheckControl(3);">��ѡ</a> - 
		    <a href="javascript:function(){void();}" onClick="CheckControl(2);">��</a>
		</div>
		<div class="action-item">
		    <input type='hidden' name='a' value=''>&nbsp;&nbsp;
		    <input type='submit' value=' �������� ' onClick="document.listform.a.value='used';">&nbsp;
		    <input type='submit' value=' �������� ' onClick="document.listform.a.value='unable';">&nbsp;
		    <input type='submit' value=' ����ɾ�� ' onClick="document.listform.a.value='del';return confirm('ȷ��Ҫɾ��ѡ���İ��������ɾ���󲻿ɻָ���');">
		</div>
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	    <div class="left-item">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
	    </div>

		<?php if ($_smarty_tpl->getVariable('pages')->value){?>
		<div class="pages">
		    <?php if ($_smarty_tpl->getVariable('pages')->value['prev']>-1){?>                            
		    <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->getVariable('pages')->value['prev'];?>
">��һҳ</a>
		    <?php }else{ ?>
		    <span class="nextprev">��һҳ</span>
		    <?php }?>
		    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
			<?php if ($_smarty_tpl->tpl_vars['k']->value!='prev'&&$_smarty_tpl->tpl_vars['k']->value!='next'){?>
			    <?php if ($_smarty_tpl->tpl_vars['k']->value=='omitf'||$_smarty_tpl->tpl_vars['k']->value=='omita'){?>
			    <span>��</span>
			    <?php }else{ ?>
				<?php if ($_smarty_tpl->tpl_vars['i']->value>-1){?>
				<a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a>
				<?php }else{ ?>
				<span class="current"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</span>                                        
				<?php }?>
			    <?php }?>   
			<?php }?>                             
		    <?php }} ?>
		    <?php if ($_smarty_tpl->getVariable('pages')->value['next']>-1){?>                            
		    <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->getVariable('pages')->value['next'];?>
">��һҳ</a>
		    <?php }else{ ?>
		    <span class="nextprev">��һҳ</span>
		    <?php }?>
		</div>
		<?php }?>

	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->

<script type="text/javascript" src="plugin/jquery/jquery.js"></script>
<script type="text/javascript">
var list = $("#listform").find("input[type='checkbox']").filter("[rel='del']");
function CheckControl(selectType){
	for(var i = 0, len = list.length; i < len; i++){
		switch(selectType){
			case 1:	//ȫѡ
				list[i].checked = true;
				break;
			case 2:	//��ѡ
				list[i].checked = false;
				break;
			case 3:	//��ѡ
				list[i].checked = !list[i].checked;
				break;
		}
	}
}
</script>


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
