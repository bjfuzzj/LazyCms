<%{include file='header.tpl'}%>

<div id="main">
<%{if $make == 'make'}%>
    <div style="font:normal 14px/28px '����'; color:red; text-align:left; margin:10px;">
        ��������ҳ�棬����ˢ�¡���
    </div>
<%{else}%>
    <div class="nav">
    ���ɾ�̬ҳ��
    </div> <!-- /nav -->

    <div class="box">

	<div class="box-header">
		<div class="tb-title">
			<span style="color:#282828">��ǰ��������Ϊ�� <%{$static}%></span>
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr><td>
		<ul style="margin:0px 20px; font:normal 14px/28px '����';">
		<%{if $makestatic >= 9}%>
		        <li><a href="?c=make_static&t=all">������վ</a></li>
		<%{/if}%>
		<%{if $makestatic > 1}%>
			<li><a href="?c=make_static&t=index">������ҳ</a></li>
		<%{/if}%>
		<%{if $makestatic > 3}%>
			<li><a href="?c=make_static&t=article_category">�������·���ҳ</a></li>
		<%{/if}%>
		<%{if $makestatic > 2}%>
			<li><a href="?c=make_static&t=article_content">������������ҳ</a></li>
		<%{/if}%>
		<%{if $makestatic > 0}%>
			<li><a href="?c=make_static&t=page_category">���ɵ�ҳ����ҳ</a></li>
		<%{/if}%>
		<%{if $makestatic > 0}%>
			<li><a href="?c=make_static&t=page_content">�������е�ҳ</a></li>
		<%{/if}%>
			<li><a href="?c=make_static&t=feedback">�������԰�ҳ��</a></li>
		</ul>
		</td></tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
	    </div>
	</div> <!-- /box-footer -->

    </div><!-- /box -->
<%{/if}%>
</div><!-- /main -->

<%{include file='footer.tpl'}%>
