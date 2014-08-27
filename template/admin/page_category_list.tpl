<%{include file='header.tpl'}%>


<div id="main">
    
    <div class="nav">
    单页分类列表
    </div> <!-- /nav -->

    <div class="box">
        <form action="?c=page_category" method="post">

	<div class="box-header">
	    <div class="left-item"><a href="?c=page_category&a=edit&t=add">添加单页分类</a></div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb" style="text-align:left;">
	    <tr class="tb-header">
		<td width="50">ID</td>
		<td width="50">排序</td>
		<td >分类名称[目录]</td>
		<td width="150">操作</td>
	    </tr>

	    <%{foreach from=$data item=v key=k}%>
	    <tr>
		<td><%{$v.cate_id}%></td>
		<td><%{$v.order_id}%></td>
	        <td><a href='?c=page_category&a=edit&t=modify&id=<%{$v.cate_id}%>'><%{$v.cate_name}%></a> [<%{$v.cate_ab}%>]</td>
	        <td>
		    <a href='?c=page_category&a=edit&t=modify&id=<%{$v.cate_id}%>'>编辑</a> | 
		    <a href="?c=page_category&a=clear&id=<%{$v.cate_id}%>" >清空内容</a>
		    <a href="?c=page_category&a=del&id=<%{$v.cate_id}%>"  onClick="return confirm('确定要删除此分类吗？删除后不可恢复！');" >删除</a>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="4">
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	</div>

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<%{include file='footer.tpl'}%>
