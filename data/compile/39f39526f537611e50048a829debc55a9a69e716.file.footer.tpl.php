<?php /* Smarty version Smarty-3.0.7, created on 2014-06-16 18:36:06
         compiled from "D:/worklocal/newCms/template/default\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8636539ec896df6426-24050622%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39f39526f537611e50048a829debc55a9a69e716' => 
    array (
      0 => 'D:/worklocal/newCms/template/default\\footer.tpl',
      1 => 1402914840,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8636539ec896df6426-24050622',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<!--底部链接 --> 
<footer>
  <ul class="navLink clearfix" style="height:110px;">
      <li>
       <dl>
         <dt>常用业务</dt>
         <dd><a href="http://s.96335.com/user/jsp/forget.jsp" title="找回密码" target="_blank">找回密码</a></dd>
         <dd><a href="http://s.96335.com/index.jsp?hover=index" title="充值缴费" target="_blank">充值缴费</a></dd>
         <dd><a href="http://s.96335.com/business/jsp/showUserInfoList.action" title="业务查询" target="_blank">业务查询</a></dd>
       </dl>
      </li>
      <li>
       <dl>
         <dt>业务专区</dt>
         <dd><a href="http://www.96335.com/hitv/huikan.html" target="_blank">HiTV专区</a></dd>
         <dd><a href="http://www.96335.com/#" title="资费专区" target="_blank">资费专区</a></dd>
         <dd><a href="http://www.96335.com/#" title="省钱秘笈互动问答区" target="_blank">省钱秘笈互动问答区</a></dd>
       </dl>
      </li>
      <li>
       <dl>
         <dt>服务渠道</dt>
         <dd><a href="http://s.96335.com/index.jsp" title="网上营业厅" target="_blank">网上营业厅</a></dd>
         <dd><a href="http://www.96335.com/#" title="96335服务" target="_blank">96335服务</a></dd>
       </dl>
      </li>
      <li>
       <dl>
         <dt><a style="color:#007bc7" href="http://www.96335.com/showpage.asp?id=10" target="_blank">关于我们</a></dt>
         <dd><a href="http://www.96335.com/hitv/huikan.html" title="品牌介绍" target="_blank">品牌介绍</a></dd>
         <dd><a href="http://www.96335.com/mail/index.html" title="企业邮箱" target="_blank">企业邮箱</a></dd>
       </dl>
      </li>
      <li>
       <dl>
         <dt>联系我们</dt>
         <dd><a href="http://s.96335.com/wforder/order/showOrder.jsp?hover=service#" title="网上客服" target="_blank">网上客服</a></dd>
         <dd><a href="http://s.96335.com/wforder/order/onLineComplainOrSuggest.action?orderType=1" title="投诉建议" target="_blank">投诉建议</a></dd>
       </dl>
      </li>
      <li>
       <dl>
         <dt>友情链接</dt>
         <dd><a href="http://www.sarft.gov.cn/" title="国家广播电影电视总局" target="_blank">国家广播电影电视总局</a></dd>
         <dd><a href="http://www.gxrft.gov.cn/" title="广西广播电影电视局" target="_blank">广西广播电影电视局</a></dd>
       </dl>
      </li>
  </ul>
</footer>
<div style="margin-top:15px;"><span class="beiAn">Copyright &#169; 1996-2013 GUANGXI RADIO &amp; TV NETWORK Corporation, All Rights Reserved<br>
广西广播电视信息网络股份有限公司版权所有 市场营销中心内容集成部编辑制作<br>
电话：96335 地址：中国广西南宁市云景路景晖巷8号(530028)<br> 
E-mail：webadmin@96335.com<br>
桂ICP备07004855号 <br>
信息网络传播视听节目许可证号：2003023<br>
广西网警备案号：45010302000152<br>
<a href="http://www.gxjubao.org/" target="_blank"><img src="/template/default/static/images/2014010711594842.gif"></a><br>
<a href="http://www.gx.cyberpolice.cn/AlarmInfo/getTishi.do?icon=gangting&checkCode=5ec2f94742c2192a512198dd8cc9c297" target="_blank"><img src="/template/default/static/images/2014010711553930.gif"></a></span>
</div>
<div id="_gx_l" style="position:absolute;left:10px; top:300;"><a id="_gx_jingjing" href="http://www.gx.cyberpolice.cn/AlarmInfo/getTishi.do?icon=jingcha&checkCode=221ee7859f9ba44683c5a9e16b88ec04" target="_blank"><img src="/template/default/static/images/2014010815122277.gif" border="0"></a></div> 
<div id="_gx_r" style="position:absolute;right:10px;top:300;"><a id="_gx_chacha" href="http://www.gx.cyberpolice.cn/AlarmInfo/getTishi.do?icon=jingcha&checkCode=221ee7859f9ba44683c5a9e16b88ec04" target="_blank"><img src="/template/default/static/images/2014010815125051.gif" border="0"></a></div> 
<!--	警警察察代码结束	-->

<!--
<script src="/plugin/jquery/jquery.js" language="JavaScript"></script>
<script language="javascript">
$(function(){
     var len  = $(".num > li").length;
     var index = 0;
     var adTimer;
     $(".num li").mouseover(function(){
        index = $(".num li").index(this);
        showImg(index);
     }).eq(0).mouseover();
     $('.banner-list').hover(function(){
             clearInterval(adTimer);
         },function(){
             adTimer = setInterval(function(){
                showImg(index);
                index++;
                if(index==len){index=0;}
              }, 4000);
     }).trigger("mouseleave");
})

function showImg(index){
    var adHeight = $(".banner").height();
    $(".slider").stop(true,false).animate({top : -adHeight*index}, 500);
    $(".num li").removeClass("on").eq(index).addClass("on");
}
</script>
-->
</body>
</html>