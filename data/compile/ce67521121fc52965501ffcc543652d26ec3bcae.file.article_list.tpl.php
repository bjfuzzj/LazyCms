<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:00:58
         compiled from "D:/worklocal/newCms/template/default\article_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17599539917ea572ac7-71044018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce67521121fc52965501ffcc543652d26ec3bcae' => 
    array (
      0 => 'D:/worklocal/newCms/template/default\\article_list.tpl',
      1 => 1337518904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17599539917ea572ac7-71044018',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\worklocal\newCms\plugin\smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div class="path">
    <ul>
        <?php echo $_smarty_tpl->getVariable('path')->value;?>

    </ul>
</div> <!-- /path -->

<div class="banner min-banner">
    <img src="/template/default/static/images/bnr_news.jpg" />
</div> <!-- /banner -->

<div class="main">

    <div class="category">
        <ul>
            <?php echo func_article_category(array(),$_smarty_tpl);?>

        </ul>
    </div> <!-- /category -->

    <div class="list">
        <h3><?php echo $_smarty_tpl->getVariable('cate')->value['cate_name'];?>
</h3>
	<div class="year_list"><?php echo func_get_year_list(array('cate_id'=>$_smarty_tpl->getVariable('id')->value),$_smarty_tpl);?>
</div>
        <ul>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('block_article_page_list', array('cate_id'=>$_smarty_tpl->getVariable('id')->value,'order_type'=>1,'start'=>$_smarty_tpl->getVariable('start')->value,'page_num'=>$_smarty_tpl->getVariable('cate')->value['page_num'])); $_block_repeat=true; block_get_article_page_list(array('cate_id'=>$_smarty_tpl->getVariable('id')->value,'order_type'=>1,'start'=>$_smarty_tpl->getVariable('start')->value,'page_num'=>$_smarty_tpl->getVariable('cate')->value['page_num']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <li>
                <span class="update_time"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('row')->value['update_time'],$_smarty_tpl->getVariable('date_format_ymd')->value);?>
</span>
                <a href="<?php echo $_smarty_tpl->getVariable('row')->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('row')->value['title'];?>
</a>
            </li>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo block_get_article_page_list(array('cate_id'=>$_smarty_tpl->getVariable('id')->value,'order_type'=>1,'start'=>$_smarty_tpl->getVariable('start')->value,'page_num'=>$_smarty_tpl->getVariable('cate')->value['page_num']), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </ul>

        <?php if ($_smarty_tpl->getVariable('pages')->value){?>
        <div class="pages">
            <?php if ($_smarty_tpl->getVariable('pages')->value['prev']>-1){?>
            <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
<?php echo $_smarty_tpl->getVariable('start_param')->value;?>
<?php echo $_smarty_tpl->getVariable('pages')->value['prev'];?>
"  class="nextprev">上一页</a>
            <?php }else{ ?>
            <span>上一页</span>
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
                <span>…</span>
                <?php }else{ ?>
                <?php if ($_smarty_tpl->tpl_vars['i']->value>-1){?>
                <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
<?php echo $_smarty_tpl->getVariable('start_param')->value;?>
<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
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
<?php echo $_smarty_tpl->getVariable('start_param')->value;?>
<?php echo $_smarty_tpl->getVariable('pages')->value['next'];?>
" class="nextprev">下一页</a>
            <?php }else{ ?>
            <span>下一页</span>
            <?php }?>
        </div>
        <?php }?>
    </div> <!-- /list -->

</div> <!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>