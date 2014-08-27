<%{include file='header.tpl'}%>

<div id="main">
    <div class="nav">
    留言内容查看
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=feedback&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">用户名称：</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[user_name]" value="<%{$feedback.user_name}%>" maxlength="50"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th>电子邮箱：</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[email]" value="<%{$feedback.email}%>" maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th>留言标题：</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[title]" value="<%{$feedback.title}%>" maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">留言内容：</th>
		    <td><textarea class="textarea w720" rows="10" name="feedback[content]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$feedback.content}%></textarea></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value=" 确认保存 " />
		<input type="hidden" name="feedback[fid]" value="<%{$feedback.fid}%>" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->

</div><!-- /main -->

<%{include file='footer.tpl'}%>
