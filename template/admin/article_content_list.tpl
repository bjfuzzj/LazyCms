<%{include file='header.tpl'}%>


<div id="main">

    <div class="nav">
	<div class="nav_title" style="float:left;">
	    ����<%{if $t eq 'recycle'}%>[����վ]<%{/if}%>�б�
	    <%{if $t eq 'recycle'}%>
		<input type="hidden" name="t" value="<%{$t}%>" />
	    <%{/if}%>
	</div>

	<div class="searchform" style="width:300px; overflow:hidden; float:right;">
		<form class="searchform" method="POST" action="?c=article_content&t=<%{$t}%>&cate_id=<%{$cate_id}%>">
			<select name="field">
				<option value="title" <%{if $field eq 'title'}%>selected<%{/if}%> >����</option>
				<option value="tags" <%{if $field eq 'tags'}%>selected<%{/if}%> >��ǩ</option>
				<option value="id" <%{if $field eq 'vid'}%>selected<%{/if}%> >��ƵID</option>
			</select>
			<input type="text" name="keyword" class="keyword" maxlength="50" value="<%{$keyword}%>">
			<input type="submit" value=" ������Ƶ " class="submit">
		</form>
	</div> <!-- /searchform -->
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=article_content" method="post">

	<div class="box-header">
		<div class="cate-select">
		        <select name="cate_id" class="selectlist" onchange="document.listform.submit();">
			<option value=0>���з���</option>
			    <%{foreach from=$article_category item=v key=k}%>
			        <option value='<%{$v.cate_id}%>' <%{if $v.cate_id eq $cate_id}%> selected<%{/if}%> ><%{$v.cate_name}%></option>
			    <%{/foreach}%>
			</select>
		</div>

		<%{if $pages}%>
		<div class="pages">
		    <%{if $pages.prev gt -1}%>
		    <a href="<%{$page_url}%>&start=<%{$pages.prev}%>">��һҳ</a>
		    <%{else}%>
		    <span class="nextprev">��һҳ</span>
		    <%{/if}%>
		    <%{foreach from=$pages key=k item=i}%>
			<%{if $k ne 'prev' && $k ne 'next'}%>
			    <%{if $k eq 'omitf' || $k eq 'omita'}%>
			    <span>��</span>
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
		    <a href="<%{$page_url}%>&start=<%{$pages.next}%>">��һҳ</a>
		    <%{else}%>
		    <span class="nextprev">��һҳ</span>
		    <%{/if}%>
		</div>
		<%{/if}%>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="30">ѡ��</td>
		<td width="50">ID</td>
		<td width="120">������Ŀ</td>
		<td >����</td>
		<td width="130">����ʱ��</td>
		<td width="50">�����</td>
		<td width="40">���</td>
		<td width="100">����</td>
	    </tr>

            <%{foreach from=$data item=v key=k}%>
	    <tr>
		<td><input type='checkbox' rel='del' name='id[]' value='<%{$v.article_id}%>' /></td>
		<td><%{$v.article_id}%></td>
		<td><a href="?c=article_content&cate_id=<%{$v.cate_id}%>"><%{$v.cate_name}%></a></td>
		<td><a href="?c=article_content&a=edit&t=modify&id=<%{$v.article_id}%>"><%{$v.title}%></a></td>
		<td><%{$v.update_time|date_format:$date_format}%></td>
		<td><%{$v.hits}%></td>
		<td><%{if $v.passed eq 1}%>��<%{else}%><font color='red' size='5'>��</font><%{/if}%></td>
		<td>
		    <%{if $t eq 'recycle'}%>
			    <a href="?c=article_content&a=restore&id=<%{$v.article_id}%>">��ԭ</a>
			    <a href="?c=article_content&a=clear&id=<%{$v.article_id}%>"  onClick="return confirm('ȷ��Ҫɾ�������¼�¼��ɾ���󲻿ɻָ���');" >����ɾ��</a>
		    <%{else}%>
			    <a href="?c=article_content&a=edit&t=modify&id=<%{$v.article_id}%>">�޸�</a>
			    <a href="?c=article_content&a=del&id=<%{$v.article_id}%>"  onClick="return confirm('ȷ��Ҫɾ�������¼�¼��');" >ɾ��</a>
		    <%{/if}%>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="9">
		<div class="action-item">
			<a href="javascript:function(){void();}" onClick="CheckControl(1);">ȫѡ</a> -
			<a href="javascript:function(){void();}" onClick="CheckControl(3);">��ѡ</a> -
			<a href="javascript:function(){void();}" onClick="CheckControl(2);">��</a>
		</div>
		<div class="action-item">
		<input type='hidden' name='a' value=''>&nbsp;&nbsp;
		    <%{if $t eq 'recycle'}%>
			<input type='submit' value=' ������ԭ ' onClick="document.listform.a.value='restore';">&nbsp;
			<input type='submit' value=' ����ɾ�� ' onClick="document.listform.a.value='clear';return confirm('ȷ��Ҫɾ��ѡ�еļ�¼��ɾ���󲻿ɻָ���');">&nbsp;
			<input type='submit' value=' ��ջ���վ ' onClick="document.listform.a.value='clear_all';return confirm('ȷ��Ҫ��ջ���վ�𣿸ò������ɳ�����');">
		    <%{else}%>
			<input type='submit' value=' ͨ����� ' onClick="document.listform.a.value='passed';">&nbsp;
			<input type='submit' value=' ȡ����� ' onClick="document.listform.a.value='nopass';">&nbsp;
			<input type='submit' value=' ����ɾ�� ' onClick="document.listform.a.value='del';return confirm('ȷ��Ҫɾ��ѡ�еļ�¼��');">&nbsp;
		    <%{/if}%>
		</div>
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
	    </div>


		<%{if $pages}%>
		<div class="pages">
		    <%{if $pages.prev gt -1}%>
		    <a href="<%{$page_url}%>&start=<%{$pages.prev}%>">��һҳ</a>
		    <%{else}%>
		    <span class="nextprev">��һҳ</span>
		    <%{/if}%>
		    <%{foreach from=$pages key=k item=i}%>
			<%{if $k ne 'prev' && $k ne 'next'}%>
			    <%{if $k eq 'omitf' || $k eq 'omita'}%>
			    <span>��</span>
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
		    <a href="<%{$page_url}%>&start=<%{$pages.next}%>">��һҳ</a>
		    <%{else}%>
		    <span class="nextprev">��һҳ</span>
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
			case 1:	//ȫѡ
				list[i].checked = true;
				break;
			case 2:	//��ѡ
				list[i].checked = false;
				break;
			case 3:	//��ѡ
				list[i].checked = !list[i].checked;
				break;
		}
	}
}
</script>

<%{include file='footer.tpl'}%>
