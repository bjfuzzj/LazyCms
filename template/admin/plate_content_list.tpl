<%{include file='header.tpl'}%>


<div id="main">

    <div class="nav">
	    �����б����
	    <%{if $plate_category.id != ''}%>
	    [���: <%{$plate_category.plate_name}%>] 
	    <%{/if}%>
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=plate_content" method="post">
	<div class="left-item">	
	    &nbsp;<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
	    <%{if $plate_category.id != ''}%>
	    &nbsp;<a href="?c=plate_content&a=edit&t=add&plate_id=<%{$plate_category.id}%>">��Ӱ������</a>
	    <%{/if}%>
	</div>

	<div class="box-header">
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
		<td >����</td>
		<td width="50">����</td>
		<td width="130">����ʱ��</td>
		<td width="130">����</td>
	    </tr>

	    <%{foreach from=$plate_content item=v key=k}%>
	    <tr>
		<td><input type='checkbox' rel='del' name='id[]' value='<%{$v.id}%>' /></td>
		<td><%{$v.id}%></td>
	        <td><%{$v.type}%></td>
		<td align="left"><a href="?c=plate_content&a=edit&t=modify&id=<%{$v.id}%>"><%{$v.title}%></a></td>
		<td><%{if $v.used eq 1}%>��<%{else}%><font color='red' size='5'>��</font><%{/if}%></td>
		<td><%{$v.update_time|date_format:$date_format}%>&nbsp;</td>
		<td>
		    <%{if $v.used eq 1}%>
			<a href="?c=plate_content&a=unable&id=<%{$v.id}%>">����</a> | 
		    <%{else}%>
			<a href="?c=plate_content&a=used&id=<%{$v.id}%>">����</a> | 
		    <%{/if}%>
		    <a href="?c=plate_content&a=edit&t=modify&id=<%{$v.id}%>">�༭</a> | 
		    <a href="?c=plate_content&a=del&id=<%{$v.id}%>" onClick="return confirm('ȷ��Ҫɾ���ð��������ɾ���󲻿ɻָ���');" >ɾ��</a>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="7">
		<div class="action-item">
		    <a href="javascript:function(){void();}" onClick="CheckControl(1);">ȫѡ</a> - 
		    <a href="javascript:function(){void();}" onClick="CheckControl(3);">��ѡ</a> - 
		    <a href="javascript:function(){void();}" onClick="CheckControl(2);">��</a>
		</div>
		<div class="action-item">
		    <input type='hidden' name='a' value=''>&nbsp;&nbsp;
		    <input type='submit' value=' �������� ' onClick="document.listform.a.value='used';">&nbsp;
		    <input type='submit' value=' �������� ' onClick="document.listform.a.value='unable';">&nbsp;
		    <input type='submit' value=' ����ɾ�� ' onClick="document.listform.a.value='del';return confirm('ȷ��Ҫɾ��ѡ���İ��������ɾ���󲻿ɻָ���');">
		</div>
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	    <div class="left-item">
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
