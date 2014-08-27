<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    ���·������(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=article_category&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">��Ŀ���ƣ�</th>
		    <td>
		    <input type="text" class="textinput w560" name="article_category[cate_name]" maxlength="250" value="<%{$article_category.cate_name}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> <span class="alert">*</span>
		    </td>
		</tr>
		<tr>
		    <th>������д��</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[cate_ab]" maxlength="30" value="<%{$article_category.cate_ab}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  <%{if $t eq 'modify'}%> readonly<%{/if}%>  /> 
		    <span class="alert">*����󲻿��޸ġ�</span>
		    <span class="tips">30���ַ����ڣ�Ӣ�ĺ����ֵ���ϣ������ִ�Сд��</span>
		    </td>
		</tr>
		<tr>
		    <th>����ҳ��ģ��·����</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[cate_tpl]" maxlength="250" value="<%{$article_category.cate_tpl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/article_list.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th>��������ҳģ��·����</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[detail_tpl]" maxlength="250" value="<%{$article_category.detail_tpl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
			<br><span class="tips">��Ը�Ŀ¼·��������/template/default/article_detail.tpl��Ϊ��ʱʹ�����õ�Ĭ��·����</span>
		    </td>
		</tr>
		<tr>
		    <th>ÿҳ��¼����</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[page_num]" maxlength="5" value="<%{$article_category.page_num}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th>ҳ��ؼ��֣�</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[keywords]" maxlength="250" value="<%{$article_category.keywords}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th>ҳ��������</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[description]" maxlength="250" value="<%{$article_category.description}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">��ע��</th>
		    <td><textarea class="textarea auto-w min-h" name="article_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$article_category.intro}%></textarea></td>
		</tr>
		<tr>
		    <th>��Ŀ����</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[order_id]" maxlength="5" value="<%{$article_category.order_id}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    <span class="tips">����ֵ��Ϊ��ʱ�Զ��ŵ������β����</span>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value="ȷ�ϱ���" />
		<input type="hidden" name="article_category[cate_id]" value="<%{$article_category.cate_id}%>" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
