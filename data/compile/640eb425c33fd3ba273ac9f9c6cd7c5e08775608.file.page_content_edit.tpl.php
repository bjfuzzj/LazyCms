<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 10:55:33
         compiled from "D:/worklocal/newCms/template/admin\page_content_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17076539916a5c544c7-32560067%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '640eb425c33fd3ba273ac9f9c6cd7c5e08775608' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\page_content_edit.tpl',
      1 => 1402390382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17076539916a5c544c7-32560067',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>



<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--�����ֶ��������ԣ�������ie����ʱ��Ϊ��������ʧ�ܵ��±༭������ʧ��-->
<!--������ص������ļ��Ḳ������������Ŀ����ӵ��������ͣ���������������Ŀ�����õ���Ӣ�ģ�������ص����ģ�������������-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">




<div id="main">

    <div class="nav">
    ��ҳ���ݹ���(<?php echo $_smarty_tpl->getVariable('t')->value;?>
)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=page_content&a=edit&t=<?php echo $_smarty_tpl->getVariable('t')->value;?>
">

	<div class="box-header">
		<div class="tb-title">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
		<input type="submit" value="ȷ�ϱ���" />
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">�������ࣺ</th>
		    <td>
		        <select name="page_content[cate_id]" class="selectlist">
			    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('page_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
		    <th>ҳ����⣺</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_content[title]" value="<?php echo $_smarty_tpl->getVariable('page_content')->value['title'];?>
" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>�ļ����ƣ�</th>
		    <td>
		        <input type="text" class="textinput w240" name="page_content[page_name]" value="<?php echo $_smarty_tpl->getVariable('page_content')->value['page_name'];?>
" maxlength="50" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<span class="tips">����,��ĸ���»�����ϣ�������չ����50���ַ����ڡ�</span>
		    </td>
		</tr>
		<tr>
		    <th>Ĭ��ͼƬ��</th>
		    <td>
			<input type="text" class="textinput auto-w" id="default_pic" name="page_content[default_pic]" value="<?php echo $_smarty_tpl->getVariable('page_content')->value['default_pic'];?>
"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><br>
			<iframe src="?c=upload&type=images&id=default_pic" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">ҳ���飺</th>
		    <td><textarea  class="textarea auto-w min-h" name="page_content[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><?php echo $_smarty_tpl->getVariable('page_content')->value['intro'];?>
</textarea></td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">ҳ�����ģ�</th>
		    <td>

            <script id="myEditor" name="page_content[content]" type="text/plain" style="width:1024px;height:500px;"><?php echo $_smarty_tpl->getVariable('page_content')->value['content'];?>
</script>
		    </td>
		</tr>
		<tr>
		    <th>ͬ������</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_content[order_id]" value="<?php echo $_smarty_tpl->getVariable('page_content')->value['order_id'];?>
"  onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips"> �ƶ�����ʱ���Զ����㡣 </span>
		    </td>
		</tr>
		<tr>
		    <th>��ˣ�</th>
		    <td>
		        <input type="checkbox" name="page_content[passed]" value="1" <?php if ($_smarty_tpl->getVariable('page_content')->value['passed']){?>checked<?php }?>  /> ͨ��
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
		<input type="submit" value="ȷ�ϱ���" />
		<input type="hidden" name='page_content[page_id]' value="<?php echo $_smarty_tpl->getVariable('page_content')->value['page_id'];?>
" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->

</div><!-- /main -->

<script type="text/javascript">

    //ʵ�����༭��
    //����ʹ�ù�������getEditor���������ñ༭��ʵ���������ĳ���հ������øñ༭����ֱ�ӵ���UE.getEditor('editor')�����õ���ص�ʵ��
    var ue = UE.getEditor('myEditor');


    
</script>

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
