<%{include file='header.tpl'}%>


<div id="main">
    
    <div class="nav">
    文章分类列表
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=article_category" method="post">

	<div class="box-header">
		<div class="cate-select">
		</div>
		<div class="left-item">
			&nbsp;<a href="?c=article_category&a=edit&t=add">添加文章分类</a>
		</div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="40">ID</td>
		<td width="40">排序</td>
		<td >栏目名称[缩写]</td>
		<td width="150">操作</td>
	    </tr>

            <%{foreach from=$data item=v key=k}%>
	    <tr>
		<td><%{$v.cate_id}%></td>
		<td><%{$v.order_id}%></td>
		<td><a href="?c=article_category&a=edit&t=modify&id=<%{$v.cate_id}%>"><%{$v.cate_name}%></a> [<%{$v.cate_ab}%>]</td>
		<td>
		    <a href="?c=article_category&a=edit&t=modify&id=<%{$v.cate_id}%>">修改</a>
		    <a href="?c=article_category&a=clear&id=<%{$v.cate_id}%>" >清空内容</a>
		    <a href="?c=article_category&a=del&id=<%{$v.cate_id}%>"  onClick="return confirm('确定要删除此文章分类吗？删除后不可恢复！');" >删除</a>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="6">
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
	    </div>
	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<%{include file='footer.tpl'}%>
