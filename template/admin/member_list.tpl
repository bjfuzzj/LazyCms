<%{include file='header.tpl'}%>


<div id="main">
    
    <div class="nav">
    管理员列表
    </div> <!-- /nav -->

    <div class="box">
        <form action="?c=member" method="post">

	<div class="box-header">
	    <div class="left-item"><a href="?c=member&a=edit&t=add">添加管理员</a></div>
	</div> <!-- /box-header -->

	<div class="list-box">
	   <table class="list-tb" id="list-tb">
	    <tr class="tb-header">
		<td width="150">登录名</td>
		<td>昵称</td>
		<td width="150">最后登录IP</td>
		<td width="150">最后登录时间</td>
		<td width="80">状态</td>
		<td width="200">操作</td>
	    </tr>

            <%{foreach from=$member item=v key=k}%>
	    <tr>
		<td><a href="?c=member&a=edit&t=modify&user_id=<%{$v.user_id}%>"><%{$v.user_id}%></a></td>
		<td><%{$v.nickname}%></td>
		<td><%{$v.last_ip}%>&nbsp;</td>
		<td><%{$v.last_time|date_format:$date_format}%>&nbsp;</td>
		<td><%{if $v.locked eq 0}%>&nbsp;<%{else}%><font color='red'>锁定</font><%{/if}%></td>
		<td>
		    <a href="?c=member&a=edit&t=modify&user_id=<%{$v.user_id}%>">修改密码</a> | 
		    <a href="?c=member&a=edit_purviews&user_id=<%{$v.user_id}%>">修改权限</a> | 
		    <a href="?c=member&a=del&user_id=<%{$v.user_id}%>" onClick="return confirm('确定要删除此帐号吗？删除后不可恢复！');" >删除</a>
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
