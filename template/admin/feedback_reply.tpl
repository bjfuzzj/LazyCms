<%{include file='header.tpl'}%>

<div id="main">
    <div class="nav">
    ���Իظ�
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=feedback&a=reply">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">�û����ƣ�</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[user_name]" value="<%{$feedback.user_name}%>" maxlength="50"  readonly/>
		    </td>
		</tr>
		<tr>
		    <th>�������䣺</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[email]" value="<%{$feedback.email}%>" maxlength="255"  readonly/>
		    </td>
		</tr>
		<tr>
		    <th>���Ա��⣺</th>
		    <td>
		        <input type="text" class="textinput w720" name="feedback[title]" value="<%{$feedback.title}%>" maxlength="255" readonly/>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">�������ݣ�</th>
		    <td><textarea class="textarea w720" rows="7" name="feedback[content]" readonly><%{$feedback.content}%></textarea></td>
		</tr>
		<tr>
		    <th>����ʱ�䣺</th>
		    <td>
		        <input type="text" class="textinput w240" name="feedback[update_time]" value="<%{$feedback.update_time|date_format:$date_format}%>" maxlength="255" readonly/>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;"><b>�ظ�����</b>��</th>
		    <td><textarea class="textarea w720" rows="7" name="feedback[reply_content]"><%{$feedback.reply_content}%></textarea></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value=" ȷ�ϱ��� " />
		<input type="hidden" name="feedback[fid]" value="<%{$feedback.fid}%>" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
