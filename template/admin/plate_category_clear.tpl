<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    确认操作
    </div> <!-- /nav -->

    <div class="box">
    <form id="listform" name="listform" action="?c=plate_category&a=del" method="post">

	<div class="message border" style="text-align:left;">
		<div style="float:left; height:100px; margin-right:10px;"><img src="template/admin/static/alert.gif" /></div>
		<span style="font:normal 16px/32px '宋体';">请确认要执行的操作，该操作不可恢复！</span><br><br>
		<input type="checkbox" name="clear_confirm[confirm]" value="1" />
		<span style="color:red; font-size:14px;">&nbsp;确定要删除板块 “<%{$data.plate_name}%>” 及其下的所有内容！</span><br><br>
		<input type="submit" value=" 执行操作 " />
		<input type="hidden" name="id" value="<%{$data.id}%>" />
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="?c=plate_category">&lt;&lt;返回</a> 
	    </div>
	</div> <!-- /box-footer -->

    </form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
