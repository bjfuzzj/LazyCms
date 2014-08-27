<%{include file='header.tpl'}%>


<div id="main">

    <div class="nav">
    ��ҳ�б����
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=page_content" method="post">

	<div class="box-header">
		<div class="cate-select">
		        <select name="cate_id"  class="selectlist" onchange="document.listform.submit();">
			<option value=0>���з���</option>
			    <%{foreach from=$page_category item=v key=k}%>
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
		<td width="40">ѡ��</td>
		<td width="50">ID</td>
		<td width="50">����</td>
		<td>ҳ�����</td>
		<td width="300">�ļ�����</td>
		<td width="130">����ʱ��</td>
		<td width="50">����</td>
		<td width="80">����</td>
	    </tr>

	    <%{foreach from=$page_content item=v key=k}%>
	    <tr>
		<td><input type='checkbox' rel='del' name='id[]' value='<%{$v.page_id}%>' /></td>
		<td><%{$v.page_id}%></td>
		<td><%{$v.order_id}%></td>
		<td align="left"><a href="?c=page_content&a=edit&t=modify&id=<%{$v.page_id}%>"><%{$v.title}%></a></td>
		<td><%{$v.page_name}%></td>
		<td><%{$v.update_time|date_format:$date_format}%>&nbsp;</td>
		<td><%{if $v.passed eq 1}%>��<%{else}%><font color='red' size='5'>��</font><%{/if}%></td>
		<td>
		    <a href="?c=page_content&a=edit&t=modify&id=<%{$v.page_id}%>">�༭</a> | 
		    <a href="?c=page_content&a=del&id=<%{$v.page_id}%>" onClick="return confirm('ȷ��Ҫɾ����ƪ��ҳ��¼��ɾ���󲻿ɻָ���');" >ɾ��</a>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="8"> 
		<div class="action-item">
		    <a href="javascript:function(){void();}" onClick="CheckControl(1);">ȫѡ</a> - 
		    <a href="javascript:function(){void();}" onClick="CheckControl(3);">��ѡ</a> - 
		    <a href="javascript:function(){void();}" onClick="CheckControl(2);">��</a>
		</div>
		<div class="action-item">
		    <input type='hidden' name='a' value=''>&nbsp;&nbsp;
		    <input type='submit' value=' ͨ����� ' onClick="document.listform.a.value='passed';">&nbsp;
		    <input type='submit' value=' ȡ����� ' onClick="document.listform.a.value='nopass';">&nbsp;
		    <input type='submit' value=' ����ɾ�� ' onClick="document.listform.a.value='del';return confirm('ȷ��Ҫɾ��ѡ���ĵ�ҳ��¼��ɾ���󲻿ɻָ���');">
		</div>
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">

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
