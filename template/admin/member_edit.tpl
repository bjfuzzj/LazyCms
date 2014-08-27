<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    管理员帐号管理(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=member&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">登录名：</th>
		    <td>
		    <%{if $t eq 'modify'}%>
		    <input type="text" class="textinput w240" name="member[user_id]" value="<%{$member.user_id}%>" readonly/> 
		    <%{else}%>
		    <input type="text" class="textinput w240" name="member[user_id]" maxlength="20" value="<%{$member.user_id}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    <span class="tips">4~20个字符以内。</span>
		    <%{/if}%>
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
		    <th>登陆密码：</th>
		    <td><input type="password" class="textinput w240" name="member[password]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    <%{if $t eq 'modify'}%><span class="tips">不修改请留空.</span><%{/if}%>
		    <span class="tips">6~20个英文字母和数字组合的字符串</span>
		    </td>
		</tr>
		<tr>
		    <th>确认密码：</th>
		    <td><input type="password" class="textinput w240" name="member[chkpwd]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>用户状态：</th>
		    <td><input type="checkbox" name="member[locked]" value="1" <%{if $member.locked}%>checked<%{/if}%> /> 锁定</td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value="确认保存" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
