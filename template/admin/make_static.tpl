<%{include file='header.tpl'}%>

<div id="main">
<%{if $make == 'make'}%>
    <div style="font:normal 14px/28px '宋体'; color:red; text-align:left; margin:10px;">
        正在生成页面，请勿刷新……
    </div>
<%{else}%>
    <div class="nav">
    生成静态页面
    </div> <!-- /nav -->

    <div class="box">

	<div class="box-header">
		<div class="tb-title">
			<span style="color:#282828">当前生成设置为： <%{$static}%></span>
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr><td>
		<ul style="margin:0px 20px; font:normal 14px/28px '宋体';">
		<%{if $makestatic >= 9}%>
		        <li><a href="?c=make_static&t=all">生成整站</a></li>
		<%{/if}%>
		<%{if $makestatic > 1}%>
			<li><a href="?c=make_static&t=index">生成首页</a></li>
		<%{/if}%>
		<%{if $makestatic > 3}%>
			<li><a href="?c=make_static&t=article_category">生成文章分类页</a></li>
		<%{/if}%>
		<%{if $makestatic > 2}%>
			<li><a href="?c=make_static&t=article_content">生成所有文章页</a></li>
		<%{/if}%>
		<%{if $makestatic > 0}%>
			<li><a href="?c=make_static&t=page_category">生成单页分类页</a></li>
		<%{/if}%>
		<%{if $makestatic > 0}%>
			<li><a href="?c=make_static&t=page_content">生成所有单页</a></li>
		<%{/if}%>
			<li><a href="?c=make_static&t=feedback">生成留言版页面</a></li>
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
