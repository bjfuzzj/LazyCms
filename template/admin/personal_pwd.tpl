<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    �޸�����
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
		    <th class="w120">�û�����</th>
		    <td>
		    <input type="hidden" name="member[user_id]" maxlength="20" value="<%{$member.user_id}%>""/>
		    <%{$member.user_id}%>
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
		    <th>ԭʼ���룺</th>
		    <td><input type="password" class="textinput w240" name="member[oldpwd]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>�����룺</th>
		    <td>
		        <input type="password" class="textinput w240" name="member[password]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">6~20��Ӣ����ĸ��������ϵ��ַ���</span>
		    </td>
		</tr>
		<tr>
		    <th>ȷ�������룺</th>
		    <td><input type="password" class="textinput w240" name="member[chkpwd]" maxlength="20" onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value="�������" />
		<input type="button" value="ȡ��" onclick="javascript:history.back(-1);" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
