<?php /* Smarty version Smarty-3.0.7, created on 2014-06-13 15:33:24
         compiled from "D:/worklocal/newCms/template/admin\member_purviews.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23807539aa944277cc2-94148711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19812900dd3461c3461ef27a5ae793c06a0ed46a' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\member_purviews.tpl',
      1 => 1337611270,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23807539aa944277cc2-94148711',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>


<div id="main">

    <div class="nav">
    �û�Ȩ������
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=member&a=edit_purviews">

	<div class="box-header">
		<div class="tb-title">
		��ǰ�û��� <?php echo $_smarty_tpl->getVariable('user_id')->value;?>

		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">Ȩ�����ͣ�</th>
		    <td>
		        <input type="checkbox" name="purview[admin_all]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['admin_all']==1){?>checked<?php }?> />��������Ա
			<span >��ͨ����Ա������������ϸȨ���</span>
		    </td>
		</tr>
		<tr id="PurviewDetail">
		    <th style="vertical-align:top;">��ϸȨ���</th>
		    <td >
			<table class="list-tb" id="list-tb">
			<tr class="tb-header">
			    <td width="150">ϵͳģ��</td>
			    <td >��ϸȨ����</td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="0" onClick="checkSameRel(this);" /><b>ϵͳ����</b></td>
			    <td>
				<dt><input type="checkbox" rel="0" name="purview[config]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['config']){?>checked<?php }?> />ϵͳ������Ϣ����</dt>
				<dt><input type="checkbox" rel="0" name="purview[member]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['member']){?>checked<?php }?> />�û�����</dt>
				<dt><input type="checkbox" rel="0" name="purview[make_static]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['make_static']){?>checked<?php }?> />���ɾ�̬ҳ</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="1" onClick="checkSameRel(this);" /><b>����ģ��</b></td>
			    <td>
				<dt><input type="checkbox" rel="1" name="purview[article_category]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['article_category']){?>checked<?php }?> />���·������</dt>
				<dt><input type="checkbox" rel="1" name="purview[article_content]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['article_content']){?>checked<?php }?> />�������ݹ���</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="2" onClick="checkSameRel(this);" /><b>��ҳģ��</b></td>
			    <td>
				<dt><input type="checkbox" rel="2" name="purview[page_category]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['page_category']){?>checked<?php }?> />��ҳ�������</dt>
				<dt><input type="checkbox" rel="2" name="purview[page_content]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['page_content']){?>checked<?php }?> />��ҳ���ݹ���</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="3" onClick="checkSameRel(this);" /><b>ҳ����</b></td>
			    <td>
				<dt><input type="checkbox" rel="3" name="purview[plate_category]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['plate_category']){?>checked<?php }?> />��黮��</dt>
				<dt><input type="checkbox" rel="3" name="purview[plate_content]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['plate_content']){?>checked<?php }?> />������ݹ���</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="4" onClick="checkSameRel(this);" /><b>��������</b></td>
			    <td>
				<dt><input type="checkbox" rel="4" name="purview[feedback]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['feedback']){?>checked<?php }?> />���Թ���</dt>
				<dt><input type="checkbox" rel="4" name="purview[upload]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['upload']){?>checked<?php }?> />�ϴ�����</dt>
				<dt><input type="checkbox" rel="4" name="purview[personal]" value="1" <?php if ($_smarty_tpl->getVariable('purview')->value['personal']){?>checked<?php }?> />�޸���������</dt>
			    </td>
			</tr>
			</table>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value=" ȷ�ϱ��� " />
		<input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->getVariable('user_id')->value;?>
" />
	    </div>
	</div>

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<script type="text/javascript" src="plugin/jquery/jquery.js"></script>
<script type="text/javascript">
    var checkSameRel = function(ele){
        $(".list-tb").find("input[rel='"+$(ele).attr("rel")+"']").each(function(i){
	    this.checked = ele.checked;
	});
    }
</script>

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
