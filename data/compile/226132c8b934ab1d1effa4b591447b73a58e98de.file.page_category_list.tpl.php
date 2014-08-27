<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:25:37
         compiled from "D:/worklocal/newCms/template/admin\page_category_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2633453991db1bec568-41521490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '226132c8b934ab1d1effa4b591447b73a58e98de' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\page_category_list.tpl',
      1 => 1336875832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2633453991db1bec568-41521490',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>


<div id="main">
    
    <div class="nav">
    单页分类列表
    </div> <!-- /nav -->

    <div class="box">
        <form action="?c=page_category" method="post">

	<div class="box-header">
	    <div class="left-item"><a href="?c=page_category&a=edit&t=add">添加单页分类</a></div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb" style="text-align:left;">
	    <tr class="tb-header">
		<td width="50">ID</td>
		<td width="50">排序</td>
		<td >分类名称[目录]</td>
		<td width="150">操作</td>
	    </tr>

	    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	    <tr>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['order_id'];?>
</td>
	        <td><a href='?c=page_category&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
'><?php echo $_smarty_tpl->tpl_vars['v']->value['cate_name'];?>
</a> [<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_ab'];?>
]</td>
	        <td>
		    <a href='?c=page_category&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
'>编辑</a> | 
		    <a href="?c=page_category&a=clear&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
" >清空内容</a>
		    <a href="?c=page_category&a=del&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
"  onClick="return confirm('确定要删除此分类吗？删除后不可恢复！');" >删除</a>
		</td>
	    </tr>
	    <?php }} ?>

	    <tr class="tb-footer">
		<td colspan="4">
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	</div>

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
