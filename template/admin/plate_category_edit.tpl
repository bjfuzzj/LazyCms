<%{include file='header.tpl'}%>

<div id="main">
    <div class="nav">
    ҳ�������(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=plate_category&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">������ƣ�</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="plate_category[plate_name]" value="<%{$plate_category.plate_name}%>" maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		        <span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>����ʶ��</th>
		    <td>
		        <input type="text" class="textinput w240" name="plate_category[plate_ab]" value="<%{$plate_category.plate_ab}%>" maxlength="30"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		        <span class="tips">* ����,��ĸ���»�����ϣ�30���ַ����ڡ�</span>
		    </td>
		</tr>
		<tr>
		    <th>�������ͣ�</th>
		    <td>
		        <input type="radio" name="plate_category[plate_type]" value="1" <%{if $plate_category.plate_type eq 1}%>checked<%{/if}%>  /> (HTML)�ı� 
		        <input type="radio" name="plate_category[plate_type]" value="2" <%{if $plate_category.plate_type eq 2}%>checked<%{/if}%>  /> ͼƬ 
			 <%{if $t eq 'modify'}%> <span class="tips">|�����������ʱ���鲻Ҫ�޸����͡�</span> <%{/if}%>
		        <br><span class="tips">ǰ̨��ʾʱ����ͼƬ���Ϳ�����ʾ������¼�⣬��������ֻ��ʾ����һ�����õļ�¼��</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">��ע��</th>
		    <td><textarea class="textarea auto-w min-h" name="plate_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$plate_category.intro}%></textarea></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value=" ȷ�ϱ��� " />
		<input type="hidden" name="plate_category[id]" value="<%{$plate_category.id}%>" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
