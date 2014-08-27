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
	    欢迎您使用《广西广电网络网站管理系统》， 当前系统版本为 <?php echo @CUR_VERSION;?>
 。
	</div>

	<div class="cate_item">
		<div class="cate-header">本企业网站管理系统的主要模块有：</div>
		<ul>
		<li class="item">文章模块：</li>
		<li class="value">可对图文内容进行分类管理，如“公司新闻”、“资料发布”等可用该模块来完成，简单的图文形式的“产品展示”亦可用该模块实现。</li>
		<li class="item">单页模块：</li>
		<li class="value">可对独立性的内容进行归类、编辑，如“企业介绍”、“关于我们”、“联系方式”等等可用该模块来完成。</li>

		<li class="item">留言模块：</li>
		<li class="value">提供访客在线提交反馈信息，可在后台查看具体的内容。</li>

		<li class="item">板块模块：</li>
		<li class="value">即对前台页面进行区域划分，是对前台模板的一种补充。分为HTML文本和图片两种类型，可在后台进行内容更新。</li>

		<li class="item">管理员模块：</li>
		<li class="value">只提供后台管理员用户；可添加删除管理账户，并可设定其详细权限项。</li>

		<li class="item">其他模块：</li>
		<li class="value">包含系统设置、生成静态页面等功能。</li>
		</ul>
	</div>

	<div class="menu">
		<ul>
		<li><a href='?c=article_content'>文章内容管理</a><a href='?c=article_content&a=edit&t=add'>添加文章</a></li>
		<li><a href='?c=article_category'>文章分类管理</a><a href='?c=article_category&a=edit&t=add'>添加分类</a></li>
		<li><a href='?c=feedback'>查看留言</a></li>
		<li><a href='?c=page_content'>单页列表管理</a><a href='?c=page_content&a=edit&t=add'>添加单页</a></li>
		<li><a href='?c=page_category'>单页分类管理</a><a href='?c=page_category&a=edit&t=add'>添加分类</a></li>
		<li><a href='?c=plate_category'>板块列表管理</a><a href='?c=plate_category&a=edit&t=add'>板块划分</a></li>
		<li><a href='?c=plate_content'>板块内容管理</a> </li>
		<li><a href='?c=member'>用户列表管理</a><a href='?c=member&a=edit'>添加用户</a></li>
		<li><a href='?c=config'>基本设置</a><a href='?c=make_static'>生成静态页</a></li>
		</ul>
	</div> <!-- /menu -->

    </div><!--/sys_nav -->
</div> <!-- /main -->

<div style="width:100%px; border-top:#C0C0C0 1px solid; margin:200px auto 10px auto; font:normal 12px/24px 'Courier New';">
		Copyright &copy; 2012 <a href="http://www.96335.com/" target="_blank">Superlin.net</a>
</div> <!-- /main -->


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
