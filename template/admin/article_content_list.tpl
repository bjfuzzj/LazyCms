<%{include file='header.tpl'}%>


<div id="main">

    <div class="nav">
	<div class="nav_title" style="float:left;">
	    文章<%{if $t eq 'recycle'}%>[回收站]<%{/if}%>列表
	    <%{if $t eq 'recycle'}%>
		<input type="hidden" name="t" value="<%{$t}%>" />
	    <%{/if}%>
	</div>

	<div class="searchform" style="width:300px; overflow:hidden; float:right;">
		<form class="searchform" method="POST" action="?c=article_content&t=<%{$t}%>&cate_id=<%{$cate_id}%>">
			<select name="field">
				<option value="title" <%{if $field eq 'title'}%>selected<%{/if}%> >标题</option>
				<option value="tags" <%{if $field eq 'tags'}%>selected<%{/if}%> >标签</option>
				<option value="id" <%{if $field eq 'vid'}%>selected<%{/if}%> >视频ID</option>
			</select>
			<input type="text" name="keyword" class="keyword" maxlength="50" value="<%{$keyword}%>">
			<input type="submit" value=" 搜索视频 " class="submit">
		</form>
	</div> <!-- /searchform -->
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=article_content" method="post">

	<div class="box-header">
		<div class="cate-select">
		        <select name="cate_id" class="selectlist" onchange="document.listform.submit();">
			<option value=0>所有分类</option>
			    <%{foreach from=$article_category item=v key=k}%>
			        <option value='<%{$v.cate_id}%>' <%{if $v.cate_id eq $cate_id}%> selected<%{/if}%> ><%{$v.cate_name}%></option>
			    <%{/foreach}%>
			</select>
		</div>

		<%{if $pages}%>
		<div class="pages">
		    <%{if $pages.prev gt -1}%>
		    <a href="<%{$page_url}%>&start=<%{$pages.prev}%>">上一页</a>
		    <%{else}%>
		    <span class="nextprev">上一页</span>
		    <%{/if}%>
		    <%{foreach from=$pages key=k item=i}%>
			<%{if $k ne 'prev' && $k ne 'next'}%>
			    <%{if $k eq 'omitf' || $k eq 'omita'}%>
			    <span>…</span>
			    <%{else}%>
				<%{if $i gt -1}%>
				<a href="<%{$page_url}%>&start=<%{$i}%>"><%{$k}%></a>
				<%{else}%>
				<span class="current"><%{$k}%></span>
				<%{/if}%>
			    <%{/if}%>
			<%{/if}%>
		    <%{/foreach}%>
		    <%{if $pages.next gt -1}%>
		    <a href="<%{$page_url}%>&start=<%{$pages.next}%>">下一页</a>
		    <%{else}%>
		    <span class="nextprev">下一页</span>
		    <%{/if}%>
		</div>
		<%{/if}%>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="30">选择</td>
		<td width="50">ID</td>
		<td width="120">归属栏目</td>
		<td >标题</td>
		<td width="130">更新时间</td>
		<td width="50">点击量</td>
		<td width="40">审核</td>
		<td width="100">操作</td>
	    </tr>

            <%{foreach from=$data item=v key=k}%>
	    <tr>
		<td><input type='checkbox' rel='del' name='id[]' value='<%{$v.article_id}%>' /></td>
		<td><%{$v.article_id}%></td>
		<td><a href="?c=article_content&cate_id=<%{$v.cate_id}%>"><%{$v.cate_name}%></a></td>
		<td><a href="?c=article_content&a=edit&t=modify&id=<%{$v.article_id}%>"><%{$v.title}%></a></td>
		<td><%{$v.update_time|date_format:$date_format}%></td>
		<td><%{$v.hits}%></td>
		<td><%{if $v.passed eq 1}%>√<%{else}%><font color='red' size='5'>×</font><%{/if}%></td>
		<td>
		    <%{if $t eq 'recycle'}%>
			    <a href="?c=article_content&a=restore&id=<%{$v.article_id}%>">还原</a>
			    <a href="?c=article_content&a=clear&id=<%{$v.article_id}%>"  onClick="return confirm('确定要删除此文章记录吗？删除后不可恢复！');" >彻底删除</a>
		    <%{else}%>
			    <a href="?c=article_content&a=edit&t=modify&id=<%{$v.article_id}%>">修改</a>
			    <a href="?c=article_content&a=del&id=<%{$v.article_id}%>"  onClick="return confirm('确定要删除此文章记录吗？');" >删除</a>
		    <%{/if}%>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="9">
		<div class="action-item">
			<a href="javascript:function(){void();}" onClick="CheckControl(1);">全选</a> -
			<a href="javascript:function(){void();}" onClick="CheckControl(3);">反选</a> -
			<a href="javascript:function(){void();}" onClick="CheckControl(2);">无</a>
		</div>
		<div class="action-item">
		<input type='hidden' name='a' value=''>&nbsp;&nbsp;
		    <%{if $t eq 'recycle'}%>
			<input type='submit' value=' 批量还原 ' onClick="document.listform.a.value='restore';">&nbsp;
			<input type='submit' value=' 彻底删除 ' onClick="document.listform.a.value='clear';return confirm('确定要删除选中的记录吗？删除后不可恢复！');">&nbsp;
			<input type='submit' value=' 清空回收站 ' onClick="document.listform.a.value='clear_all';return confirm('确定要清空回收站吗？该操作不可撤销！');">
		    <%{else}%>
			<input type='submit' value=' 通过审核 ' onClick="document.listform.a.value='passed';">&nbsp;
			<input type='submit' value=' 取消审核 ' onClick="document.listform.a.value='nopass';">&nbsp;
			<input type='submit' value=' 批量删除 ' onClick="document.listform.a.value='del';return confirm('确定要删除选中的记录吗？');">&nbsp;
		    <%{/if}%>
		</div>
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
	    </div>


		<%{if $pages}%>
		<div class="pages">
		    <%{if $pages.prev gt -1}%>
		    <a href="<%{$page_url}%>&start=<%{$pages.prev}%>">上一页</a>
		    <%{else}%>
		    <span class="nextprev">上一页</span>
		    <%{/if}%>
		    <%{foreach from=$pages key=k item=i}%>
			<%{if $k ne 'prev' && $k ne 'next'}%>
			    <%{if $k eq 'omitf' || $k eq 'omita'}%>
			    <span>…</span>
			    <%{else}%>
				<%{if $i gt -1}%>
				<a href="<%{$page_url}%>&start=<%{$i}%>"><%{$k}%></a>
				<%{else}%>
				<span class="current"><%{$k}%></span>
				<%{/if}%>
			    <%{/if}%>
			<%{/if}%>
		    <%{/foreach}%>
		    <%{if $pages.next gt -1}%>
		    <a href="<%{$page_url}%>&start=<%{$pages.next}%>">下一页</a>
		    <%{else}%>
		    <span class="nextprev">下一页</span>
		    <%{/if}%>
		</div>
		<%{/if}%>
	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->

<script type="text/javascript" src="plugin/jquery/jquery.js"></script>
<script type="text/javascript">
var list = $("#listform").find("input[type='checkbox']").filter("[rel='del']");
function CheckControl(selectType){
	for(var i = 0, len = list.length; i < len; i++){
		switch(selectType){
			case 1:	//全选
				list[i].checked = true;
				break;
			case 2:	//不选
				list[i].checked = false;
				break;
			case 3:	//反选
				list[i].checked = !list[i].checked;
				break;
		}
	}
}
</script>

<%{include file='footer.tpl'}%>
