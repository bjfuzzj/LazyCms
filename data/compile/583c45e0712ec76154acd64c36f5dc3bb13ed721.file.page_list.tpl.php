<?php /* Smarty version Smarty-3.0.7, created on 2014-06-13 10:42:15
         compiled from "D:/worklocal/newCms/template/default\page_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21461539a6507b4c492-25743142%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '583c45e0712ec76154acd64c36f5dc3bb13ed721' => 
    array (
      0 => 'D:/worklocal/newCms/template/default\\page_list.tpl',
      1 => 1402627314,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21461539a6507b4c492-25743142',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div class="path">
    <ul>
        <?php echo $_smarty_tpl->getVariable('path')->value;?>

    </ul>
</div> <!-- /path -->

<div class="banner min-banner">
    <img src="/template/default/static/images/bnr_product.jpg" />
</div> <!-- /banner -->

<div class="main">

    <div class="category">
        <ul>
            <?php echo func_get_page_list(array('cate_id'=>$_smarty_tpl->getVariable('cate')->value[$_smarty_tpl->getVariable('cate_id')->value]),$_smarty_tpl);?>

        </ul>
    </div> <!-- /category -->

    <div class="detail">

    <h2><?php echo $_smarty_tpl->getVariable('cate')->value['cate_name'];?>
</h2>
    <p><?php echo $_smarty_tpl->getVariable('cate')->value['intro'];?>
</p>
    <ul class="page_list">
        <?php echo func_get_page_list(array('cate_id'=>$_smarty_tpl->getVariable('id')->value),$_smarty_tpl);?>

    </ul>
    </div> <!-- /detail -->
</div> <!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>