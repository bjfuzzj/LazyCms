<%{include file='header.tpl'}%>


<div id="main">
    
    <div class="nav">
    ����Ա�б�
    </div> <!-- /nav -->

    <div class="box">
        <form action="?c=member" method="post">

	<div class="box-header">
	    <div class="left-item"><a href="?c=member&a=edit&t=add">��ӹ���Ա</a></div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="150">��¼��</td>
		<td>�ǳ�</td>
		<td width="150">����¼IP</td>
		<td width="150">����¼ʱ��</td>
		<td width="80">״̬</td>
		<td width="200">����</td>
	    </tr>

            <%{foreach from=$member item=v key=k}%>
	    <tr>
		<td><a href="?c=member&a=edit&t=modify&user_id=<%{$v.user_id}%>"><%{$v.user_id}%></a></td>
		<td><%{$v.nickname}%></td>
		<td><%{$v.last_ip}%>&nbsp;</td>
		<td><%{$v.last_time|date_format:$date_format}%>&nbsp;</td>
		<td><%{if $v.locked eq 0}%>&nbsp;<%{else}%><font color='red'>����</font><%{/if}%></td>
		<td>
		    <a href="?c=member&a=edit&t=modify&user_id=<%{$v.user_id}%>">�޸�����</a> | 
		    <a href="?c=member&a=edit_purviews&user_id=<%{$v.user_id}%>">�޸�Ȩ��</a> | 
		    <a href="?c=member&a=del&user_id=<%{$v.user_id}%>" onClick="return confirm('ȷ��Ҫɾ�����ʺ���ɾ���󲻿ɻָ���');" >ɾ��</a>
		</td>
	    </tr>
	    <%{/foreach}%>

	    <tr class="tb-footer">
		<td colspan="7">
		</td>
            </tr>

	    </table>
	</div> <!-- /list-box -->

	<div class="box-footer">
	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<%{include file='footer.tpl'}%>
