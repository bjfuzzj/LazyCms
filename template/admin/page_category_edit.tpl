<%{include file='header.tpl'}%>

<div id="main">

   <div class="nav">
   ��ҳ�������(<%{$t}%>)
   </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=page_category&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">�������ƣ�</th>
		    <td>
		        <input type="text" class="textinput w560" name="page_category[cate_name]" value="<%{$page_category.cate_name}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>����Ŀ¼��</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[cate_ab]" value="<%{$page_category.cate_ab}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  <%{if $t eq 'modify'}%> readonly<%{/if}%> />
		    <span class="alert">*����󲻿��޸ġ�</span>
		    <span class="tips">30���ַ����ڣ�Ӣ�ĺ����ֵ���ϣ������ִ�Сд��</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">�����б�ҳģ��·����</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[cate_tpl]" value="<%{$page_category.cate_tpl}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/page_list.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">��������ҳģ��·����</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[detail_tpl]" value="<%{$page_category.detail_tpl}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/page_detail.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">��ע��</th>
		    <td><textarea class="textarea auto-w min-h" name="page_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$page_category.intro}%></textarea></td>
		</tr>
		<tr>
		    <th>��������</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[order_id]" value="<%{$page_category.order_id}%>"  maxlength="10" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">����ֵ��Ϊ��ʱ�Զ��ŵ������β����</span>
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
	        <input type="hidden" name="page_category[cate_id]" value="<%{$page_category.cate_id}%>" />
		<input type="submit" value="ȷ�ϱ���" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
