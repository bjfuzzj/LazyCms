<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    ����Ա�ʺŹ���(<%{$t}%>)
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
		    <th class="w120">��¼����</th>
		    <td>
		    <%{if $t eq 'modify'}%>
		    <input type="text" class="textinput w240" name="member[user_id]" value="<%{$member.user_id}%>" readonly/> 
		    <%{else}%>
		    <input type="text" class="textinput w240" name="member[user_id]" maxlength="20" value="<%{$member.user_id}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    <span class="tips">4~20���ַ����ڡ�</span>
		    <%{/if}%>
		    </td>
		</tr>
		<tr>
		    <th>�ǳƣ�</th>
		    <td>
		    <input type="text" class="textinput w240" name="member[nickname]" maxlength="20" value="<%{$member.nickname}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    <span class="tips">4~20���ַ�����</span>
		    </td>
		</tr>
		<tr>
		    <th>��½���룺</th>
		    <td><input type="password" class="textinput w240" name="member[password]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    <%{if $t eq 'modify'}%><span class="tips">���޸�������.</span><%{/if}%>
		    <span class="tips">6~20��Ӣ����ĸ��������ϵ��ַ���</span>
		    </td>
		</tr>
		<tr>
		    <th>ȷ�����룺</th>
		    <td><input type="password" class="textinput w240" name="member[chkpwd]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>�û�״̬��</th>
		    <td><input type="checkbox" name="member[locked]" value="1" <%{if $member.locked}%>checked<%{/if}%> /> ����</td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value="ȷ�ϱ���" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
