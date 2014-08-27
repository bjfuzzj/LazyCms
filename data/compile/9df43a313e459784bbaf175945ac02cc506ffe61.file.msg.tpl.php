<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 10:55:03
         compiled from "D:/worklocal/newCms/template/admin\msg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2511539916872aeff8-52008410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9df43a313e459784bbaf175945ac02cc506ffe61' => 
    array (
      0 => 'D:/worklocal/newCms/template/admin\\msg.tpl',
      1 => 1402392703,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2511539916872aeff8-52008410',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="main">

	<div class="success">
	<img src="/template/admin/static/success.gif" />
		<p><strong><?php echo $_smarty_tpl->getVariable('message')->value;?>
&nbsp;&nbsp;<span id="seconds" style="color:#f60;">2</span>&nbsp;秒后自动返回</strong></p>
		<p><a href="<?php echo $_smarty_tpl->getVariable('url')->value;?>
" id="url">如果您的浏览器没有自动跳转，请点击这里！ </a></p>
	</div>

</div><!-- /main -->


<script type="text/javascript">
var i = 2;
var reTime = setInterval(function(){
	i = i-1;
	if(i<0){
		window.location.href= '<?php echo $_smarty_tpl->getVariable('url')->value;?>
'
		window.clearInterval(reTime);
		return;
	}
	document.getElementById("seconds").innerHTML = i;
},1000);
</script>


<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
