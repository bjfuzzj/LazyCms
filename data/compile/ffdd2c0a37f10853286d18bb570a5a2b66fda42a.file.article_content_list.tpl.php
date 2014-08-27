<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:21:47
         compiled from "D:/worklocal/newCms/template/admin\article_content_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1172853991ccb66d8b6-81742429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffdd2c0a37f10853286d18bb570a5a2b66fda42a' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\article_content_list.tpl',
      1 => 1347281790,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1172853991ccb66d8b6-81742429',
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
	<div class="nav_title" style="float:left;">
	    文章<?php if ($_smarty_tpl->getVariable('t')->value=='recycle'){?>[回收站]<?php }?>列表
	    <?php if ($_smarty_tpl->getVariable('t')->value=='recycle'){?>
		<input type="hidden" name="t" value="<?php echo $_smarty_tpl->getVariable('t')->value;?>
" />
	    <?php }?>
	</div>

	<div class="searchform" style="width:300px; overflow:hidden; float:right;">
		<form class="searchform" method="POST" action="?c=article_content&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
&cate_id=<?php echo $_smarty_tpl->getVariable('cate_id')->value;?>
">
			<select name="field">
				<option value="title" <?php if ($_smarty_tpl->getVariable('field')->value=='title'){?>selected<?php }?> >标题</option>
				<option value="tags" <?php if ($_smarty_tpl->getVariable('field')->value=='tags'){?>selected<?php }?> >标签</option>
				<option value="id" <?php if ($_smarty_tpl->getVariable('field')->value=='vid'){?>selected<?php }?> >视频ID</option>
			</select>
			<input type="text" name="keyword" class="keyword" maxlength="50" value="<?php echo $_smarty_tpl->getVariable('keyword')->value;?>
">
			<input type="submit" value=" 搜索视频 " class="submit">
		</form>
	</div> <!-- /searchform -->
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=article_content" method="post">

	<div class="box-header">
		<div class="cate-select">
		        <select name="cate_id" class="selectlist" onchange="document.listform.submit();">
			<option value=0>所有分类</option>
			    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('article_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			        <option value='<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
' <?php if ($_smarty_tpl->tpl_vars['v']->value['cate_id']==$_smarty_tpl->getVariable('cate_id')->value){?> selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['v']->value['cate_name'];?>
</option>
			    <?php }} ?>
			</select>
		</div>

		<?php if ($_smarty_tpl->getVariable('pages')->value){?>
		<div class="pages">
		    <?php if ($_smarty_tpl->getVariable('pages')->value['prev']>-1){?>
		    <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->getVariable('pages')->value['prev'];?>
">上一页</a>
		    <?php }else{ ?>
		    <span class="nextprev">上一页</span>
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
">下一页</a>
		    <?php }else{ ?>
		    <span class="nextprev">下一页</span>
		    <?php }?>
		</div>
		<?php }?>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="30">选择</td>
		<td width="50">ID</td>
		<td width="120">归属栏目</td>
		<td >标题</td>
		<td width="130">更新时间</td>
		<td width="50">点击量</td>
		<td width="40">审核</td>
		<td width="100">操作</td>
	    </tr>

            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	    <tr>
		<td><input type='checkbox' rel='del' name='id[]' value='<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
' /></td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
</td>
		<td><a href="?c=article_content&cate_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['cate_name'];?>
</a></td>
		<td><a href="?c=article_content&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></td>
		<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['update_time'],$_smarty_tpl->getVariable('date_format')->value);?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['hits'];?>
</td>
		<td><?php if ($_smarty_tpl->tpl_vars['v']->value['passed']==1){?>√<?php }else{ ?><font color='red' size='5'>×</font><?php }?></td>
		<td>
		    <?php if ($_smarty_tpl->getVariable('t')->value=='recycle'){?>
			    <a href="?c=article_content&a=restore&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
">还原</a>
			    <a href="?c=article_content&a=clear&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
"  onClick="return confirm('确定要删除此文章记录吗？删除后不可恢复！');" >彻底删除</a>
		    <?php }else{ ?>
			    <a href="?c=article_content&a=edit&t=modify&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
">修改</a>
			    <a href="?c=article_content&a=del&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
"  onClick="return confirm('确定要删除此文章记录吗？');" >删除</a>
		    <?php }?>
		</td>
	    </tr>
	    <?php }} ?>

	    <tr class="tb-footer">
		<td colspan="9">
		<div class="action-item">
			<a href="javascript:function(){void();}" onClick="CheckControl(1);">全选</a> -
			<a href="javascript:function(){void();}" onClick="CheckControl(3);">反选</a> -
			<a href="javascript:function(){void();}" onClick="CheckControl(2);">无</a>
		</div>
		<div class="action-item">
		<input type='hidden' name='a' value=''>&nbsp;&nbsp;
		    <?php if ($_smarty_tpl->getVariable('t')->value=='recycle'){?>
			<input type='submit' value=' 批量还原 ' onClick="document.listform.a.value='restore';">&nbsp;
			<input type='submit' value=' 彻底删除 ' onClick="document.listform.a.value='clear';return confirm('确定要删除选中的记录吗？删除后不可恢复！');">&nbsp;
			<input type='submit' value=' 清空回收站 ' onClick="document.listform.a.value='clear_all';return confirm('确定要清空回收站吗？该操作不可撤销！');">
		    <?php }else{ ?>
			<input type='submit' value=' 通过审核 ' onClick="document.listform.a.value='passed';">&nbsp;
			<input type='submit' value=' 取消审核 ' onClick="document.listform.a.value='nopass';">&nbsp;
			<input type='submit' value=' 批量删除 ' onClick="document.listform.a.value='del';return confirm('确定要删除选中的记录吗？');">&nbsp;
		    <?php }?>
		</div>
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
	    </div>


		<?php if ($_smarty_tpl->getVariable('pages')->value){?>
		<div class="pages">
		    <?php if ($_smarty_tpl->getVariable('pages')->value['prev']>-1){?>
		    <a href="<?php echo $_smarty_tpl->getVariable('page_url')->value;?>
&start=<?php echo $_smarty_tpl->getVariable('pages')->value['prev'];?>
">上一页</a>
		    <?php }else{ ?>
		    <span class="nextprev">上一页</span>
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
">下一页</a>
		    <?php }else{ ?>
		    <span class="nextprev">下一页</span>
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
			case 1:	//全选
				list[i].checked = true;
				break;
			case 2:	//不选
				list[i].checked = false;
				break;
			case 3:	//反选
				list[i].checked = !list[i].checked;
				break;
		}
	}
}
</script>

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
