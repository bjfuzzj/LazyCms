<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 10:55:06
         compiled from "D:/worklocal/newCms/template/admin\config.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69705399168aa84f72-60993285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00f057dcab71f82d76a17d8f3d39c72701e0a627' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\config.tpl',
      1 => 1336576042,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69705399168aa84f72-60993285',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">

    <div class="nav">
    系统基本设置
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=config">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">系统名称：</th>
		    <td><input type="text" class="textinput auto-w" name="config[sysname]" value="<?php echo $_smarty_tpl->getVariable('config')->value['sysname'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>网站标题：</th>
		    <td><input type="text" class="textinput auto-w" name="config[title]" value="<?php echo $_smarty_tpl->getVariable('config')->value['title'];?>
"  onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>网站地址：</th>
		    <td><input type="text" class="textinput auto-w" name="config[sysurl]" value="<?php echo $_smarty_tpl->getVariable('config')->value['sysurl'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>管理员邮箱：</th>
		    <td><input type="text" class="textinput auto-w" name="config[ceoemail]" value="<?php echo $_smarty_tpl->getVariable('config')->value['ceoemail'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>ICP备案信息：</th>
		    <td><input type="text" class="textinput auto-w" name="config[icp]" value="<?php echo $_smarty_tpl->getVariable('config')->value['icp'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>ICP备案链接地址：</th>
		    <td><input type="text" class="textinput auto-w" name="config[icpurl]" value="<?php echo $_smarty_tpl->getVariable('config')->value['icpurl'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>keywords：</th>
		    <td><input type="text" class="textinput auto-w" name="config[metakeyword]" value="<?php echo $_smarty_tpl->getVariable('config')->value['metakeyword'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">description：</th>
		    <td><textarea class="textarea auto-w min-h" name="config[metadescrip]" onfocus="inputFocus(this)" onblur="inputBlur(this)" ><?php echo $_smarty_tpl->getVariable('config')->value['metadescrip'];?>
</textarea></td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">生成静态页面：</th>
		    <td>
		        <select name="config[makestatic]"  class="selectlist">
			<option value="0" <?php if ($_smarty_tpl->getVariable('config')->value['makestatic']==0){?> selected <?php }?>>不生成静态页面</option>
			<option value="1" <?php if ($_smarty_tpl->getVariable('config')->value['makestatic']==1){?> selected <?php }?>>只生成单页模块页面</option>
			<option value="2" <?php if ($_smarty_tpl->getVariable('config')->value['makestatic']==2){?> selected <?php }?>>只生成网站首页、单页模块页面</option>
			<option value="3" <?php if ($_smarty_tpl->getVariable('config')->value['makestatic']==3){?> selected <?php }?>>只生成网站首页、单页模块、详细内容页页面</option>
			<option value="9" <?php if ($_smarty_tpl->getVariable('config')->value['makestatic']==9){?> selected <?php }?>>生成整站页面</option>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>生成文件扩展名：</th>
		    <td>
			<input type="radio" name="config[statictype]" value="1" <?php if ($_smarty_tpl->getVariable('config')->value['statictype']==1){?> checked <?php }?>>.html
			<input type="radio" name="config[statictype]" value="2" <?php if ($_smarty_tpl->getVariable('config')->value['statictype']==2){?> checked <?php }?>>.htm
			<input type="radio" name="config[statictype]" value="3" <?php if ($_smarty_tpl->getVariable('config')->value['statictype']==3){?> checked <?php }?>>.shtml
			<input type="radio" name="config[statictype]" value="4" <?php if ($_smarty_tpl->getVariable('config')->value['statictype']==4){?> checked <?php }?>>.shtm
			<input type="radio" name="config[statictype]" value="0" <?php if ($_smarty_tpl->getVariable('config')->value['statictype']==0){?> checked <?php }?>>.php
			<span class="tips">扩展名类型更改后请手动将原生成文件删除。</span>
		    </td>
		</tr>
		<tr>
		    <th>生成文件存储目录：</th>
		    <td><input type="text" class="textinput w120" name="config[staticfolder]" value="<?php echo $_smarty_tpl->getVariable('config')->value['staticfolder'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  />
		    <span class="tips">相对网站根目录路径，以"/"开头，例： /html 。 目录更改后请手动将原生成文件删除。</span>
		    </td>
		</tr>
		<tr>
		    <th>数据起始年份：</th>
		    <td>
		        <input type="text" class="textinput w120" name="config[startyear]" value="<?php echo $_smarty_tpl->getVariable('config')->value['startyear'];?>
" onfocus="inputFocus(this)" onblur="inputBlur(this)"  />
			<span class="tips">4位数字年份。</span>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value="保存更改" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
