<%{include file='header.tpl'}%>

<div id="main">

   <div class="nav">
   单页分类管理(<%{$t}%>)
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
		    <th class="w120">分类名称：</th>
		    <td>
		        <input type="text" class="textinput w560" name="page_category[cate_name]" value="<%{$page_category.cate_name}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>分类目录：</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[cate_ab]" value="<%{$page_category.cate_ab}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  <%{if $t eq 'modify'}%> readonly<%{/if}%> />
		    <span class="alert">*保存后不可修改。</span>
		    <span class="tips">30个字符以内，英文和数字的组合，不区分大小写。</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">分类列表页模板路径：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[cate_tpl]" value="<%{$page_category.cate_tpl}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">相对根目录路径，例：/template/default/page_list.tpl；为空时使用配置的默认路径。</span>
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">分类内容页模板路径：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_category[detail_tpl]" value="<%{$page_category.detail_tpl}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<br><span class="tips">相对根目录路径，例：/template/default/page_detail.tpl；为空时使用配置的默认路径。</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">备注：</th>
		    <td><textarea class="textarea auto-w min-h" name="page_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$page_category.intro}%></textarea></td>
		</tr>
		<tr>
		    <th>分类排序：</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_category[order_id]" value="<%{$page_category.order_id}%>"  maxlength="10" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips">整数值；为空时自动排到分类的尾部。</span>
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
	        <input type="hidden" name="page_category[cate_id]" value="<%{$page_category.cate_id}%>" />
		<input type="submit" value="确认保存" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
