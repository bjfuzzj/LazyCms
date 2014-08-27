<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:27:53
         compiled from "D:/worklocal/newCms/template/default\article_list_year.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1047653991e39ef3869-92085499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '648de696cbf004644dc483ee3cf08cc1b83c7cf6' => 
    array (
      0 => 'D:/worklocal/newCms/template/default\\article_list_year.tpl',
      1 => 1337518912,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1047653991e39ef3869-92085499',
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
        <h3><?php echo $_smarty_tpl->getVariable('year')->value;?>
Äê<?php echo $_smarty_tpl->getVariable('cate')->value['cate_name'];?>
</h3>
	<div class="year_list"><?php echo func_get_year_list(array('cate_id'=>$_smarty_tpl->getVariable('id')->value),$_smarty_tpl);?>
</div>
        <ul>
       <?php $_smarty_tpl->smarty->_tag_stack[] = array('block_article_page_year', array('cate_id'=>$_smarty_tpl->getVariable('id')->value,'year'=>$_smarty_tpl->getVariable('year')->value)); $_block_repeat=true; block_get_article_page_year(array('cate_id'=>$_smarty_tpl->getVariable('id')->value,'year'=>$_smarty_tpl->getVariable('year')->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <li>
                <span class="update_time"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('row')->value['update_time'],$_smarty_tpl->getVariable('date_format_ymd')->value);?>
</span>
                <a href="<?php echo $_smarty_tpl->getVariable('row')->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('row')->value['title'];?>
</a>
            </li>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo block_get_article_page_year(array('cate_id'=>$_smarty_tpl->getVariable('id')->value,'year'=>$_smarty_tpl->getVariable('year')->value), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </ul>
    </div> <!-- /list -->

</div> <!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>