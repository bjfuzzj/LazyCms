<%{include file='header.tpl'}%>


<div id="main">

    <div class="nav">
    ���Թ���
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=feedback" method="post">

	<div class="box-header">
	    <div class="left-item">
		    <a href="?c=feedback&flag=0">����</a> -
		    <a href="?c=feedback&flag=-1">δ��</a> -
		    <a href="?c=feedback&flag=1">����</a> -
		    <a href="?c=feedback&flag=2">�ѻظ�</a>
		    <!-- <a href="?c=feedback&a=edit&t=add">����</a> -->
	    </div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="40">ѡ��</td>
		<td width="250">�û���</td>
		<td >��������</td>
		<td width="130">����ʱ��</td>
		<td width="120">����</td>
	    </tr>

	    <%{foreach from=$feedback item=v key=k}%>
	    <tr>
		<td><input type='checkbox' rel='del' name='fid[]' value='<%{$v.fid}%>' /></td>
		<td><%{if $v.flag eq -1}%><b><%{/if}%><%{$v.user_name}%>&nbsp;&lt;<%{$v.email}%>&gt;<%{if $v.flag eq -1}%></b><%{/if}%></td>
		<td align="left"><%{if $v.flag eq -1}%><b><%{/if}%><a href="?c=feedback&a=edit&t=modify&fid=<%{$v.fid}%>"><%{$v.title}%></a><%{if $v.flag eq -1}%></b><%{/if}%></td>
		<td><%{$v.update_time|date_format:$date_format}%>&nbsp;</td>
		<td>
		    <a href="?c=feedback&a=edit&t=modify&fid=<%{$v.fid}%>">�鿴</a> |
		    <a href="?c=feedback&a=del&fid=<%{$v.fid}%>" onClick="return confirm('ȷ��Ҫɾ������������ɾ���󲻿ɻָ���');" >ɾ��</a>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="6">
		<div class="action-item">
		    <a href="javascript:function(){void();}" onClick="CheckControl(1);">ȫѡ</a> -
		    <a href="javascript:function(){void();}" onClick="CheckControl(3);">��ѡ</a> -
		    <a href="javascript:function(){void();}" onClick="CheckControl(2);">��</a>
		</div>
		<div class="action-item">
		    <input type='hidden' name='a' value=''>&nbsp;
		    <input type='submit' value=' ����ɾ�� ' onClick="document.listform.a.value='del';return confirm('ȷ��Ҫɾ��ѡ����������ɾ���󲻿ɻָ���');">
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