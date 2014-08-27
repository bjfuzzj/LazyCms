<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 16:52:31
         compiled from "D:/worklocal/newCms/template/admin\member_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3135953996a4fce6675-11405645%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc2e44123adacb8dc875acf59c26cb9be4d8c3d5' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\member_list.tpl',
      1 => 1336568756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3135953996a4fce6675-11405645',
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
    管理员列表
    </div> <!-- /nav -->

    <div class="box">
        <form action="?c=member" method="post">

	<div class="box-header">
	    <div class="left-item"><a href="?c=member&a=edit&t=add">添加管理员</a></div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="150">登录名</td>
		<td>昵称</td>
		<td width="150">最后登录IP</td>
		<td width="150">最后登录时间</td>
		<td width="80">状态</td>
		<td width="200">操作</td>
	    </tr>

            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('member')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	    <tr>
		<td><a href="?c=member&a=edit&t=modify&user_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
</a></td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['nickname'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['last_ip'];?>
&nbsp;</td>
		<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['last_time'],$_smarty_tpl->getVariable('date_format')->value);?>
&nbsp;</td>
		<td><?php if ($_smarty_tpl->tpl_vars['v']->value['locked']==0){?>&nbsp;<?php }else{ ?><font color='red'>锁定</font><?php }?></td>
		<td>
		    <a href="?c=member&a=edit&t=modify&user_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
">修改密码</a> | 
		    <a href="?c=member&a=edit_purviews&user_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
">修改权限</a> | 
		    <a href="?c=member&a=del&user_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
" onClick="return confirm('确定要删除此帐号吗？删除后不可恢复！');" >删除</a>
		</td>
	    </tr>
	    <?php }} ?>

	    <tr class="tb-footer">
		<td colspan="7">
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
