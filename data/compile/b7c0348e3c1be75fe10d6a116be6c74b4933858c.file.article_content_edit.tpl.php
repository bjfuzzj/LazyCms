<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:21:49
         compiled from "D:/worklocal/newCms/template/admin\article_content_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:455353991ccd6e0e41-49938901%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7c0348e3c1be75fe10d6a116be6c74b4933858c' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\article_content_edit.tpl',
      1 => 1402390771,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '455353991ccd6e0e41-49938901',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\worklocal\newCms\plugin\smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">


<div id="main">

    <div class="nav">
    文章内容管理(<?php echo $_smarty_tpl->getVariable('t')->value;?>
)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=article_content&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">

	<div class="box-header">
		<div class="tb-title">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value="确认保存" />
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">归属栏目：</th>
		    <td>
		        <select name="article[cate_id]" class="selectlist">
				<option value='0' >未指定分类</option>
			    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('article_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			        <option value='<?php echo $_smarty_tpl->tpl_vars['v']->value['cate_id'];?>
' <?php if ($_smarty_tpl->tpl_vars['v']->value['cate_id']==$_smarty_tpl->getVariable('article')->value['cate_id']){?> selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['v']->value['cate_name'];?>
</option>
			    <?php }} ?>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>标题：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="article[title]" value="<?php echo $_smarty_tpl->getVariable('article')->value['title'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>作者：</th>
		    <td><input type="text" class="textinput auto-w" name="article[author]" value="<?php echo $_smarty_tpl->getVariable('article')->value['author'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>来源：</th>
		    <td><input type="text" class="textinput auto-w" name="article[copyfrom]" value="<?php echo $_smarty_tpl->getVariable('article')->value['copyfrom'];?>
"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>默认图片：</th>
		    <td>
			<input type="text" class="textinput auto-w" id="default_pic" name="article[default_pic]" value="<?php echo $_smarty_tpl->getVariable('article')->value['default_pic'];?>
"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<iframe src="?c=upload&type=images&id=default_pic" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">内容简介：</th>
		    <td><textarea class="textarea auto-w min-h" name="article[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><?php echo $_smarty_tpl->getVariable('article')->value['intro'];?>
</textarea></td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">正文内容：</th>
		    <td>
            <script id="myEditor" name="article[content]" type="text/plain" style="width:1024px;height:500px;"><?php echo $_smarty_tpl->getVariable('article')->value['content'];?>
</script>
		    </td>
		</tr>
		<tr>
		    <th>标签：</th>
		    <td><input type="text" class="textinput auto-w" name="article[tags]" value="<?php echo $_smarty_tpl->getVariable('article')->value['tags'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>更新时间：</th>
		    <td>
		        <input type="text" class="textinput w240" name="article[update_time]" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('article')->value['update_time'],$_smarty_tpl->getVariable('date_format')->value);?>
"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th>审核：</th>
		    <td>
		        <input type="checkbox" name="article[passed]" value="1" <?php if ($_smarty_tpl->getVariable('article')->value['passed']){?>checked<?php }?>  /> 通过
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value="确认保存" />
		<input type="hidden" name="article[article_id]" value="<?php echo $_smarty_tpl->getVariable('article')->value['article_id'];?>
" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->

</div><!-- /main -->
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('myEditor');
</script>

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
