<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 11:26:41
         compiled from "D:/worklocal/newCms/template/admin\welcome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3056153991df131dbb4-19483674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4abce1ece2736c2d9d7177478afc073b885b7699' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\welcome.tpl',
      1 => 1402383636,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3056153991df131dbb4-19483674',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">
    <div class="sys_nav">

	<div class="sys_intro">
	    ��ӭ��ʹ�á��������������վ����ϵͳ���� ��ǰϵͳ�汾Ϊ <?php echo @CUR_VERSION;?>
 ��
	</div>

	<div class="cate_item">
		<div class="cate-header">����ҵ��վ����ϵͳ����Ҫģ���У�</div>
		<ul>
		<li class="item">����ģ�飺</li>
		<li class="value">�ɶ�ͼ�����ݽ��з�������硰��˾���š��������Ϸ������ȿ��ø�ģ������ɣ��򵥵�ͼ����ʽ�ġ���Ʒչʾ������ø�ģ��ʵ�֡�</li>
		<li class="item">��ҳģ�飺</li>
		<li class="value">�ɶԶ����Ե����ݽ��й��ࡢ�༭���硰��ҵ���ܡ������������ǡ�������ϵ��ʽ���ȵȿ��ø�ģ������ɡ�</li>

		<li class="item">����ģ�飺</li>
		<li class="value">�ṩ�ÿ������ύ������Ϣ�����ں�̨�鿴��������ݡ�</li>

		<li class="item">���ģ�飺</li>
		<li class="value">����ǰ̨ҳ��������򻮷֣��Ƕ�ǰ̨ģ���һ�ֲ��䡣��ΪHTML�ı���ͼƬ�������ͣ����ں�̨�������ݸ��¡�</li>

		<li class="item">����Աģ�飺</li>
		<li class="value">ֻ�ṩ��̨����Ա�û��������ɾ�������˻��������趨����ϸȨ���</li>

		<li class="item">����ģ�飺</li>
		<li class="value">����ϵͳ���á����ɾ�̬ҳ��ȹ��ܡ�</li>
		</ul>
	</div>

	<div class="menu">
		<ul>
		<li><a href='?c=article_content'>�������ݹ���</a><a href='?c=article_content&a=edit&t=add'>�������</a></li>
		<li><a href='?c=article_category'>���·������</a><a href='?c=article_category&a=edit&t=add'>��ӷ���</a></li>
		<li><a href='?c=feedback'>�鿴����</a></li>
		<li><a href='?c=page_content'>��ҳ�б����</a><a href='?c=page_content&a=edit&t=add'>��ӵ�ҳ</a></li>
		<li><a href='?c=page_category'>��ҳ�������</a><a href='?c=page_category&a=edit&t=add'>��ӷ���</a></li>
		<li><a href='?c=plate_category'>����б����</a><a href='?c=plate_category&a=edit&t=add'>��黮��</a></li>
		<li><a href='?c=plate_content'>������ݹ���</a> </li>
		<li><a href='?c=member'>�û��б����</a><a href='?c=member&a=edit'>����û�</a></li>
		<li><a href='?c=config'>��������</a><a href='?c=make_static'>���ɾ�̬ҳ</a></li>
		</ul>
	</div> <!-- /menu -->

    </div><!--/sys_nav -->
</div> <!-- /main -->

<div style="width:100%px; border-top:#C0C0C0 1px solid; margin:200px auto 10px auto; font:normal 12px/24px 'Courier New';">
		Copyright &copy; 2012 <a href="http://www.96335.com/" target="_blank">Superlin.net</a>
</div> <!-- /main -->


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
