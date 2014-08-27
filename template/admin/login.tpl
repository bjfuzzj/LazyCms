<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>广西广电网络网站管理系统 - 后台登录</title>
<link href="template/admin/static/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="loginform">
	<img id="logo" src="template/admin/static/logo.png" />
	<form name="loginform" id="loginform" action="<%{$smarty.server.PHP_SELF}%>?c=login" method="post" target="_parent" >
		<ol>
			<li>
				<div for="login[name]" class="item">用户名：</div>
				<div class="value">
					<input name="login[name]" type="text" id="login[name]" value="<%{$login.name}%>" maxlength="20" class="input" style="width:180px; height:20px;" />
				</div>
			</li>
			<li>
				<div for="login[password]" class="item">密　码：</div>
				<div class="value">
					<input name="login[password]" type="password" id="login[password]" maxlength="20" class="input" style="width:180px; height:20px;" />
				</div>
			</li>
			<li>
				<div for="login[securimage]" class="item">验证码：</div>
				<div class="value">
					<div style="float:left;">
						<input name="login[securimage]" type="text" id="login[securimage]" maxlength="4" size="10"  class="input" style="width:90px;" />
					</div>
					<div style="float:left; margin-left:8px;">
						<a href='javascript:refreshimg();' title="换个验证码">
						<img id="securimage" style="cursor: pointer;" src="?c=securimage" /></a>
					</div>
				</div>
			</li>
			<li>
				<div class="item"></div>
				<div class="value">
					<input type="submit" class="button" value="登 陆">
					<input type="reset" class="button" value="清 空">
				</div>
			</li>
		</ol>
	</form>

</div>
<%{if $error}%>
<div id="message" class="message" >
	<%{$error}%>
</div>
<%{/if}%>

<script language=javascript>
    function refreshimg(){document.getElementById('securimage').src='?c=securimage&date='+Date.parse(new Date());}
</script>

</body>
</html>
