<%{include file='header.tpl'}%>


<div id="main">
    
    <div class="nav">
    ҳ�������
    </div> <!-- /nav -->

    <div class="box">
        <form action="?c=plate_category" method="post">

	<div class="box-header">
		<div class="left-item">
			&nbsp;<a href="?c=plate_category&a=edit&t=add">��Ӱ��</a>
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
		<td width="50">ID</td>
		<td width="150">����ʶ</td>
		<td width="260">�������</td>
		<td width="50">����</td>
		<td >��ע</td>
		<td width="220">����</td>
	    </tr>

	    <%{foreach from=$plate_category item=v key=k}%>
	    <tr>
	        <td><%{$v.id}%></td>
	        <td><a href='?c=plate_category&a=edit&t=modify&id=<%{$v.id}%>'><%{$v.plate_ab}%></a></td>
	        <td align="left"><a href="?c=plate_content&plate_id=<%{$v.id}%>"><%{$v.plate_name}%></a></td>
	        <td><%{$v.type}%></td>
	        <td align="left"><%{$v.intro}%></td>
	        <td>
		    <a href='?c=plate_content&plate_id=<%{$v.id}%>'>�����б�</a> | 
		    <a href='?c=plate_content&a=edit&t=add&plate_id=<%{$v.id}%>'>�������</a> | 
		    <a href='?c=plate_category&a=edit&t=modify&id=<%{$v.id}%>'>�༭</a> | 
		    <a href='?c=plate_category&a=del&id=<%{$v.id}%>' >ɾ��</a>
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


<%{include file='footer.tpl'}%>
