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
    ���·����б�
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=article_category" method="post">

	<div class="box-header">
		<div class="cate-select">
		</div>
		<div class="left-item">
			&nbsp;<a href="?c=article_category&a=edit&t=add">������·���</a>
		</div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="40">ID</td>
		<td width="40">����</td>
		<td >��Ŀ����[��д]</td>
		<td width="150">����</td>
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
">�޸�</a>
		    <a href="?c=article_category&a=clear&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
" >�������</a>
		    <a href="?c=article_category&a=del&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
"  onClick="return confirm('ȷ��Ҫɾ�������·�����ɾ���󲻿ɻָ���');" >ɾ��</a>
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
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
	    </div>
	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
