<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    修改密码
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=personal&a=pwd">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">用户名：</th>
		    <td>
		    <input type="hidden" name="member[user_id]" maxlength="20" value="<%{$member.user_id}%>""/>
		    <%{$member.user_id}%>
		    </td>
		</tr>
		<tr>
		    <th>昵称：</th>
		    <td>
		    <input type="text" class="textinput w240" name="member[nickname]" maxlength="20" value="<%{$member.nickname}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    <span class="tips">4~20个字符以内</span>
		    </td>
		</tr>
		<tr>
		    <th>原始密码：</th>
		    <td><input type="password" class="textinput w240" name="member[oldpwd]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>新密码：</th>
		    <td>
		        <input type="password" class="textinput w240" name="member[password]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">6~20个英文字母和数字组合的字符串</span>
		    </td>
		</tr>
		<tr>
		    <th>确定新密码：</th>
		    <td><input type="password" class="textinput w240" name="member[chkpwd]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value="保存更改" />
		<input type="button" value="取消" onclick="javascript:history.back(-1);" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
