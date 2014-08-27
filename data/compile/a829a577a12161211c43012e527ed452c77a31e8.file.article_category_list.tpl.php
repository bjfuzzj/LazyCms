<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 12:04:16
         compiled from "D:/worklocal/newCms/template/admin\article_category_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22578539926c0c9ad85-79420476%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a829a577a12161211c43012e527ed452c77a31e8' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\article_category_list.tpl',
      1 => 1336875782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22578539926c0c9ad85-79420476',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>


<div id="main">
    
    <div class="nav">
    文章分类列表
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=article_category" method="post">

	<div class="box-header">
		<div class="cate-select">
		</div>
		<div class="left-item">
			&nbsp;<a href="?c=article_category&a=edit&t=add">添加文章分类</a>
		</div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="40">ID</td>
		<td width="40">排序</td>
		<td >栏目名称[缩写]</td>
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
		<td><a href="?c=article_category&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['cate_name'];?>
</a> [<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_ab'];?>
]</td>
		<td>
		    <a href="?c=article_category&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
">修改</a>
		    <a href="?c=article_category&a=clear&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
" >清空内容</a>
		    <a href="?c=article_category&a=del&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
"  onClick="return confirm('确定要删除此文章分类吗？删除后不可恢复！');" >删除</a>
		</td>
	    </tr>
	    <?php }} ?>

	    <tr class="tb-footer">
		<td colspan="6">
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
	    </div>
	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
