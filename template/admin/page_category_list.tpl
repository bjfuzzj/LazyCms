<%{include file='header.tpl'}%>


<div id="main">
    
    <div class="nav">
    ��ҳ�����б�
    </div> <!-- /nav -->

    <div class="box">
        <form action="?c=page_category" method="post">

	<div class="box-header">
	    <div class="left-item"><a href="?c=page_category&a=edit&t=add">��ӵ�ҳ����</a></div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb" style="text-align:left;">
	    <tr class="tb-header">
		<td width="50">ID</td>
		<td width="50">����</td>
		<td >��������[Ŀ¼]</td>
		<td width="150">����</td>
	    </tr>

	    <%{foreach from=$data item=v key=k}%>
	    <tr>
		<td><%{$v.cate_id}%></td>
		<td><%{$v.order_id}%></td>
	        <td><a href='?c=page_category&a=edit&t=modify&id=<%{$v.cate_id}%>'><%{$v.cate_name}%></a> [<%{$v.cate_ab}%>]</td>
	        <td>
		    <a href='?c=page_category&a=edit&t=modify&id=<%{$v.cate_id}%>'>�༭</a> | 
		    <a href="?c=page_category&a=clear&id=<%{$v.cate_id}%>" >�������</a>
		    <a href="?c=page_category&a=del&id=<%{$v.cate_id}%>"  onClick="return confirm('ȷ��Ҫɾ���˷�����ɾ���󲻿ɻָ���');" >ɾ��</a>
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
