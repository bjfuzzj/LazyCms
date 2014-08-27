<?php /* Smarty version Smarty-3.0.7, created on 2014-06-17 16:32:06
         compiled from "D:/worklocal/newCms/template/default\article_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17397539ffd06b84382-04788277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31b7d3d60805bfe4357e8fd86c225169169c061d' => 
    array (
      0 => 'D:/worklocal/newCms/template/default\\article_detail.tpl',
      1 => 1402993923,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17397539ffd06b84382-04788277',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\worklocal\newCms\plugin\smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<link rel="stylesheet" href="/template/default/static/images/detail.css">

<style>
    html{ font-size:12px;}
	body {
	text-decoration:none;
	font-size:12px;
	text-align:center;
	word-break:break-all;
	margin:0;
	padding:0;
	font-family:Arial,Helvetica,sans-serif,宋体;
	}
	a {
	text-decoration:none
    }
    a:hover {
	color:#007bc7;
	text-decoration:underline
    }
	iframe,img {
	border:0
}
li {
	list-style:none
}
.an_con {
	width:954px;
	height:29px;
	line-height:29px;
	border-top:#e3e3e3 1px solid;
	border-bottom:#e3e3e3 1px solid;
	float:left
}
.an_con li {
	padding-right:35px;
	padding-left:10px;
	float:left;
	background:url(/template/default/static/images/bg_header.gif) 3px -403px no-repeat
}
.an_con h5 {
	padding:0 10px 0 20px;
	background:url(/template/default/static/images/bg_header.gif) 3px -102px no-repeat;
	float:left;
	font-weight:normal;
	color:#d53c00
}
.an_con ul {
	width:850px;
	height:29px;
	float:left;
	overflow:hidden
}
.an_con span.more {
	width:45px;
	float:right
}
.an_left {
	width:3px;
	height:31px;
	float:left;
	background:url(/template/default/static/images/bg_header.gif) -426px -84px no-repeat
}
.an_right {
	width:3px;
	height:31px;
	float:right;
	background:url(/template/default/static/images/bg_header.gif) -430px -84px no-repeat
}
footer {
	display:block;
	border-top:#dfdfdf 1px solid;
	border-bottom:#dfdfdf 1px solid;
	background:#f9f9f9;
	text-align:left;
	margin-top:20px;
	
}
.navLink {
	width:950px;
	margin:0 auto;
	color:#999;
	padding-left:40px
}
.navLink a {
	color:#999
}
.navLink a:hover {
	color:#007bc7;
	text-decoration:underline
}
.navLink li {
	width:140px;
	float:left;
	padding:15px 0 0 10px;
}
.navLink dt {
	font-size:14px;
	font-weight:bold;
	color:#007bc7;
	line-height:30px
}
.navLink dd {
	line-height:18px;
	background:url(/template/default/static/images/bg_header.gif) 3px -408px no-repeat;
	padding-left:10px
}
.navLink dd.more {
	text-align:right;
	padding-right:20px;
	background:0
}
.navLink dd.more a {
	color:#999
}
.navLink dd.more a:hover {
	color:#007bc7
}
.beiAn {
	width:100%;
	display:block;
	margin-top:0;
	margin-right:auto;
	margin-bottom:0;
	margin-left:auto;
	text-align:center;
}
.beiAn,.beiAn a {
	color:#bbb
}
.beiAn a:hover {
	color:#007bc7
}
.beiAnLink {
	background:url(/template/default/static/images/bg_header.gif) no-repeat -419px -57px;
	padding:2px 0 2px 20px
}
.quickNav {
	position:absolute;
	border:1px solid #577ca9;
	width:130px;
	top:183px;
	left:-132px;
	text-align:left;
	padding:10px 0 0;
	background:#fff
}
.jiuban {
	position:absolute;
	border:none;
	top:183px;
	right:0px;
	text-align:left;
	padding-top: 0px;
	padding-right: 0;
	padding-bottom: 0;
	padding-left: 0;
	z-index:960;
}
.quickNav h3 {
	border-bottom:1px dotted #e5e5e5;
	height:27px;
	line-height:27px;
	font-weight:normal;
	padding-left:20px
}
.quickNav h3 a,.quickNav h3 a:visited {
	color:#454545
}
.quickNav h3 a.orange,.quickNav h3 a.orange:visited {
	color:#d53c00
}
.quickNav dl {
	border-bottom:1px dotted #e5e5e5;
	padding-bottom:5px
}
.quickNav dt {
	font-weight:bold;
	height:33px;
	line-height:33px;
	color:#454545;
	padding-left:13px;
	font-size:12px
}
.quickNav dd {
	height:24px;
	line-height:24px;
	padding-left:19px;
	font-size:12px
}
.quickNav dd a,.quickNav dd a:visited {
	color:#24669a
}
.quickNav b,.quickNav b.close {
	display:inline-block;
	text-align:center;
	color:#fff;
	width:35px;
	height:110px;
	border:0;
	border-left:none;
	right:-36px;
	font-size:14px;
	top:10px;
	position:absolute;
	line-height:18px;
	padding-top:10px;
	cursor:pointer;
	font-family:'宋体';
	background:url(/template/default/static/images/bg_quickNav.gif) 0 0 no-repeat
}
.quickNav b.close {
	background:url(/template/default/static/images/bg_quickNav.gif) -37px 0 no-repeat
}
table{ margin: 0 auto; border:1px solid #000000 ;} 
table td{border:1px solid #000000;} 
</style>


<div style="margin:auto; width:960px;">
  <div style="position:relative; margin:0 0 0 3px;z-index:0; float:left; height:255px;"> 
<embed src="/template/default/static/article.swf" width="955px" height="250px" wmode="transparent"></embed>
  </div>
</div>


<div style="margin:auto; width:960px;">
    <div style="margin:auto; width:960px; text-align:center;" id="content">
<!--列表开始-->
<DIV class=PE_width_R>
<DL class=PE_Path><!--路径显示-->
  <DT>
  <DIV class=right><IMG src="/template/default/static/images/path_right.gif"></DIV>
  您现在的位置：&nbsp;<a class='LinkPath' href=''>广西广电网络</a>&nbsp;>>&nbsp;<a class='LinkPath' href=''>最新动态</a>&nbsp;>>&nbsp;<a class='LinkPath' href=''>新闻动态</a>&nbsp;>>&nbsp;正文&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </DT>
</DL>
<DL><!--可插入广告--></DL>
<DL class=Conlist>
  <DT class=top>
  <DT class=CL>
          <!-- 主体内容开始 -->
          <!-- 标题 -->
          <div class="contitle">
          <span><h1><?php echo $_smarty_tpl->getVariable('article')->value['title'];?>
</h1></span>
          <span></span>
          </div>
          <!-- 正文 -->
          <div class="contenttext">
              <!-- 作者 -->
               <div class="conAuthor">
                  <div class="content_editor">
                  来源：<?php echo $_smarty_tpl->getVariable('article')->value['copyfrom'];?>
 　作者：佚名　时间：<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('article')->value['update_time'],$_smarty_tpl->getVariable('date_format_ymd')->value);?>
　人气：<?php echo $_smarty_tpl->getVariable('article')->value['hits'];?>
 
                  </div>
                </div>
                
              <div class="contenttext_overflow" id="fontzoom">
              <div class="intro"><?php echo $_smarty_tpl->getVariable('article')->value['intro'];?>
</div><br />
                        <?php echo $_smarty_tpl->getVariable('article')->value['content'];?>

              </div>
          </div>
          <!-- 主体内容结束 -->
  <DIV class=clearbox></DIV>
  </DT>
  <DT class=bottom></DT>
</DL>
<!--声明-->
      <dl class="Conlist">
        <dt class="top"></dt>
        <dt class="CL">
          <font class="gray_a">声明：广西广电网络已尽力确保本页面内容的准确性，但因市场发展和产品开发的需要，有关内容可能会根据实际情况随时更新或修改，恕不另行通知，不便之处敬请谅解。</font>
          <div class="clearbox"></div>
        </dt>
        <dt class="bottom"></dt>
      </dl>
</DIV>
<!--列表结束-->

    </div>
    </div>
    </div>
    <div style="HEIGHT: 10px; CLEAR: both"></div>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>