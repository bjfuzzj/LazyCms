<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>����˵�</title>

<style type="text/css">
*{padding:0px; margin:0px;}
body{margin:0; padding:0; border:none; background:#b3d2f8; text-align:center;}

a {text-decoration: none;}
a:link {color: #000000;text-decoration: none;}
a:visited {color: #000000;text-decoration: none;}
a:hover {color: #ff6600;text-decoration: none;}
a:active {color: #000000;text-decoration: none;}

.nav {height:33px; background:#4a7dbc; font:normal 14px/32px '����'; color:#FFFFFF; border-bottom:#3C3C3C 1px solid;}
.nav a {color:#ffffff; font:normal 20px/32px '����'; }

#menu {width:100%; background:#b3d2f8; text-align:left;}
#menu ul {list-style:none; font-size:12px; border-bottom:#75ADF2 1px solid; padding:5px 0px;}
#menu li {list-style:none; height:25px;}
#menu li a {display:block; height:25px; font:normal 12px/28px '����'; padding:0px 25px; text-align:left;}
#menu li a.active {background:#FFFFFF; }
</style>

</head>
<base target="main">
<body>

<div class="nav">
	<a href='?c=article_content' onclick="Tabmenu(this);">���ݹ���</a> | 
	<a href='?c=article_content&a=edit&t=add' onclick="Tabmenu(this);">���</a>
</div>

<div id="menu">
	<ul>
	<li><a href='?c=article_content' onclick="Tabmenu(this);">�����б�</a></li>
	<li><a href='?c=article_content&a=edit&t=add' onclick="Tabmenu(this);">�������</a></li>
	<li><a href='?c=article_content&t=recycle' onclick="Tabmenu(this);">���»���վ</a></li>
	<li><a href='?c=article_category' onclick="Tabmenu(this);">���ݷ���</a></li>
	<li><a href='?c=article_category&a=edit&t=add' onclick="Tabmenu(this);">��ӷ���</a></li>
	</ul>

	<ul>
	<li><a href='?c=feedback' onclick="Tabmenu(this);">�鿴����</a></li>
	</ul>

	<ul>
	<li><a href='?c=page_content' onclick="Tabmenu(this);">��ҳ�б�</a></li>
	<li><a href='?c=page_content&a=edit&t=add' onclick="Tabmenu(this);">��ӵ�ҳ</a></li>
	<li><a href='?c=page_category' onclick="Tabmenu(this);">��ҳ����</a></li>
	<li><a href='?c=page_category&a=edit&t=add' onclick="Tabmenu(this);">��ӷ���</a></li>
	</ul>

	<ul>
	<li><a href='?c=plate_category' onclick="Tabmenu(this);">����б�</a></li>
	<li><a href='?c=plate_category&a=edit&t=add' onclick="Tabmenu(this);">��Ӱ��</a></li>
	<li><a href='?c=plate_content' onclick="Tabmenu(this);">�������</a> </li>
	</ul>

	<ul>
	<li><a href='?c=config' onclick="Tabmenu(this);">��������</a></li>
	<li><a href='?c=member' onclick="Tabmenu(this);">�û��б�</a></li>
	<li><a href='?c=member&a=edit' onclick="Tabmenu(this);">����û�</a></li>
	<li><a href='?c=make_static' onclick="Tabmenu(this);">���ɾ�̬ҳ</a></li>
	</ul>
</div> <!-- /menu -->

<div style="display:none;">
<script src="http://s15.cnzz.com/stat.php?id=4154285&web_id=4154285" language="JavaScript"></script>
</div>

<script type="text/javascript">
function Tabmenu(obj){
	var Items = document.getElementById("menu").getElementsByTagName("a");
	for(var i= 0,len = Items.length; i<len; ++i){
		if(Items[i].clssName !== ""){
			Items[i].className = "";
		}
		obj.className = "active";
		obj.blur();
	}
};
</script>

</body>
</html>