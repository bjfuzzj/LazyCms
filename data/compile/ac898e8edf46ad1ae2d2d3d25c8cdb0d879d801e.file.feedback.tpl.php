<?php /* Smarty version Smarty-3.0.7, created on 2014-06-12 18:21:00
         compiled from "D:/worklocal/newCms/template/default\feedback.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2604653997f0c0e2de1-90456216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac898e8edf46ad1ae2d2d3d25c8cdb0d879d801e' => 
    array (
      0 => 'D:/worklocal/newCms/template/default\\feedback.tpl',
      1 => 1402567514,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2604653997f0c0e2de1-90456216',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div class="path">
    <ul>
        <?php echo $_smarty_tpl->getVariable('path')->value;?>

    </ul>
</div> <!-- /path -->

<div class="banner min-banner">
    <img src="/template/default/static/images/bnr_contact.jpg" />
</div> <!-- /banner -->

<div class="main">

<?php if ($_smarty_tpl->getVariable('state')->value==1){?>

    <div class="feedback">
    <form id="feedback-form"  method="post"  action="/index.php?c=feedback">
        <ul>
            <li>
                <p><label for="username">您的昵称：</label></p>
                <input id="user_name" type="text" class="int" onfocus="inputFocus(this)" onblur="inputBlur(this)" name="feedback[user_name]" maxlength="20" value="<?php echo $_smarty_tpl->getVariable('feedback')->value['user_name'];?>
"/>
            </li>
            <li>
                <p>
                <label for="email">联系Email：</label>
                <span id="msg1">为便于我们及时回复您的意见，请填入您的真实Email！</span>
                </p>
                <input id="email" type="text" class="int" onfocus="inputFocus(this)" onblur="inputBlur(this)" name="feedback[email]" maxlength="50" value="<?php echo $_smarty_tpl->getVariable('feedback')->value['email'];?>
" />
            </li>
            <li>
                <p>
                <label for="email">留言主题：</label>
                <span id="msg1"> <strong style="color:#F00">*</strong></span>
                </p>
                <input id="title" type="text" class="int" onfocus="inputFocus(this)" onblur="inputBlur(this)" name="feedback[title]" maxlength="255" value="<?php echo $_smarty_tpl->getVariable('feedback')->value['title'];?>
" />
            </li>
            <li>
                <p>
                <label for="content">意见及建议：</label>
                <span id="msg2">请简要描述您的意见或建议(20-300个汉字)，谢谢！ <strong style="color:#F00">*</strong></span>
                </p>
                <textarea id="content" class="int" onkeyup="displaySpareNumber(this,300)" onchange="displaySpareNumber(this,300)" onfocus="inputFocus(this)" onblur="inputBlur(this)" name="feedback[content]"><?php echo $_smarty_tpl->getVariable('feedback')->value['content'];?>
</textarea>
                <p class="spareNumberBox">还剩<span><input value="300" id="spareNumber" style="border:none; color:red; width:40px; text-align:center; background:none;" readonly="readonly"  /></span> 汉字</p>
            </li>
        </ul>
        <div class="messageBox">
        <?php if ($_smarty_tpl->getVariable('error')->value){?>
            <?php echo $_smarty_tpl->getVariable('error')->value;?>

        <?php }?>
        </div>
        <div class="form-fot">
            <input id="submit-btn" type="submit" class="btn" name="button"  value="提 交" />
        </div>
    </form>
    </div> <!-- /feedback -->

<?php }elseif($_smarty_tpl->getVariable('state')->value==2){?>

    <div class="feedback">
        <div style="font:normal 20px/40px '宋体'; width:100%; height:300px; text-align:center; margin-top:100px;">
		提交成功，感谢您的反馈！<br/>
        <p><span id="seconds" style="color:#f60;">2</span>&nbsp;秒后自动返回</strong></p>
		<p><a href="<?php echo $_smarty_tpl->getVariable('url')->value;?>
" id="url">如果您的浏览器没有自动跳转，请点击这里！ </a></p>
	   </div>
    </div> <!-- /feedback -->
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

<?php }?>

</div> <!-- /main -->

<script type="text/javascript">
function inputFocus(obj){
    obj.style.border = "1px solid #6699dd"
    obj.style.background = "#FFFBE5"
}

function inputBlur(obj){
    obj.style.border = "1px solid #AEAEAE"
    obj.style.background = "#ffffff"
}

function displaySpareNumber(_this,size)
{
    var spareNumber=document.getElementById("spareNumber");    
    var len=_this.value.replace(/[^\x00-\xff]/gi,'xx').length/2;
    var snum=Math.floor(parseInt(size)-len);        
    spareNumber.value=snum;
    if(snum<0)
    {
        if(_this.value.length!=len)
        {
            if((len-_this.value.length)>(size/2))
            {
                _this.value=_this.value.substring(0,size/2);
            }
            else
            {
                _this.value=_this.value.substring(0,size-(len-_this.value.length));
            }
        }
        else
        {
            _this.value=_this.value.substring(0,size);                
        }
        spareNumber.value=0;
        return;            
    }        
}
</script>

<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>