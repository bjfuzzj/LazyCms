<?php /* Smarty version Smarty-3.0.7, created on 2014-06-13 11:14:20
         compiled from "D:/worklocal/newCms/template/default\page_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25055539a6c8cc8f200-19623721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11dbe170fca328343dc3c9002aaf8c6c2fff4a51' => 
    array (
      0 => 'D:/worklocal/newCms/template/default\\page_detail.tpl',
      1 => 1402627447,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25055539a6c8cc8f200-19623721',
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
            <?php echo func_get_page_list(array('cate_id'=>$_smarty_tpl->getVariable('page')->value[$_smarty_tpl->getVariable('cate_id')->value]),$_smarty_tpl);?>

        </ul>
    </div> <!-- /category -->

    <div class="list">
        <h3><?php echo $_smarty_tpl->getVariable('page')->value['title'];?>
</h3>
        <div class="content">
        <?php echo $_smarty_tpl->getVariable('page')->value['content'];?>

        </div>
    </div> <!-- /list -->
    
</div> <!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>