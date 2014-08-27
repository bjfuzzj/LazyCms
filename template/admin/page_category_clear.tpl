<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    确认操作
    </div> <!-- /nav -->

    <div class="box">
    <form id="listform" name="listform" action="?c=page_category&a=clear" method="post">

	<div class="message border" style="text-align:left;">
		<div style="float:left; height:100px; margin-right:10px;"><img src="template/admin/static/alert.gif" /></div>
		<span style="font:normal 16px/32px '宋体';">确认要清空栏目“<%{$data.cate_name}%>”下的所有内容？该操作不可恢复！</span><br><br>
		<input type="checkbox" name="clear_confirm[confirm]" value="1" /><span style="color:red;">&nbsp;确认清除！</span><br><br>
		<input type="submit" value=" 执行操作 " />
		<input type="hidden" name="id" value="<%{$data.cate_id}%>" />
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="?c=page_category">&lt;&lt;返回</a> 
	    </div>
	</div> <!-- /box-footer -->

    </form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
