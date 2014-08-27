<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<link href="template/admin/static/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="wrap">
    <div class="container">
    
    <%{if $error}%>
        <div class="error">
	<img src="template/admin/static/error.gif" />
        <%{$error}%>
	</div>
    <%{/if}%>
