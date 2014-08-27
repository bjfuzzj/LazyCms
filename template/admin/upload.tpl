<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<link href="template/admin/static/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="plugin/jquery/jquery.js"></script>

<style>
.msg {padding:5px 10px 2px 10px; font:normal 12px/18px '实体';}
a.a-msg {color:#0000CC; text-decoration:underline; }
</style>

</head>

<body>

<div class='box' style="text-align:left; height:30px; overflow:hidden;">
<%{if $msg}%>
	<div class="msg">
	<%{$msg}%>
	<a href='?c=upload&type=<%{$type}%>&id=<%{$id}%>' class='a-msg' target='_self'>重新上传图片</a>
	</div>
<%{else}%>
	<form action="?c=upload&type=<%{$type}%>&id=<%{$id}%>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value='upfile' /> 
		<div style="height:20px; padding-top:5px; overflow:hidden; float:left;">
		    <input type="file" class="textinput" name="<%{$id}%>" />
		</div>
		<div style="height:20px; padding-top:5px; overflow:hidden; float:left; margin-left:5px;">
		    <input type="submit" class="min_btn" value="上传" />
		</div>
	</form>
<%{/if}%>
</div>

</body>
</html>
