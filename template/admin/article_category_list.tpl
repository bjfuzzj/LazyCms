<%{include file='header.tpl'}%>


<div id="main">
    
    <div class="nav">
    ���·����б�
    </div> <!-- /nav -->

    <div class="box">
        <form id="listform" name="listform" action="?c=article_category" method="post">

	<div class="box-header">
		<div class="cate-select">
		</div>
		<div class="left-item">
			&nbsp;<a href="?c=article_category&a=edit&t=add">������·���</a>
		</div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="40">ID</td>
		<td width="40">����</td>
		<td >��Ŀ����[��д]</td>
		<td width="150">����</td>
	    </tr>

            <%{foreach from=$data item=v key=k}%>
	    <tr>
		<td><%{$v.cate_id}%></td>
		<td><%{$v.order_id}%></td>
		<td><a href="?c=article_category&a=edit&t=modify&id=<%{$v.cate_id}%>"><%{$v.cate_name}%></a> [<%{$v.cate_ab}%>]</td>
		<td>
		    <a href="?c=article_category&a=edit&t=modify&id=<%{$v.cate_id}%>">�޸�</a>
		    <a href="?c=article_category&a=clear&id=<%{$v.cate_id}%>" >�������</a>
		    <a href="?c=article_category&a=del&id=<%{$v.cate_id}%>"  onClick="return confirm('ȷ��Ҫɾ�������·�����ɾ���󲻿ɻָ���');" >ɾ��</a>
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
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
	    </div>
	</div> <!-- /box-footer -->

    </form>
    </div><!--/box -->

</div> <!-- /main -->


<%{include file='footer.tpl'}%>
