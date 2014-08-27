<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    文章分类管理(<%{$t}%>)
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
		    <th class="w120">栏目名称：</th>
		    <td>
		    <input type="text" class="textinput w560" name="article_category[cate_name]" maxlength="250" value="<%{$article_category.cate_name}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> <span class="alert">*</span>
		    </td>
		</tr>
		<tr>
		    <th>名称缩写：</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[cate_ab]" maxlength="30" value="<%{$article_category.cate_ab}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  <%{if $t eq 'modify'}%> readonly<%{/if}%>  /> 
		    <span class="alert">*保存后不可修改。</span>
		    <span class="tips">30个字符以内，英文和数字的组合，不区分大小写。</span>
		    </td>
		</tr>
		<tr>
		    <th>分类页面模版路径：</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[cate_tpl]" maxlength="250" value="<%{$article_category.cate_tpl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
			<br><span class="tips">相对根目录路径，例：/template/default/article_list.tpl；为空时使用配置的默认路径。</span>
		    </td>
		</tr>
		<tr>
		    <th>分类内容页模版路径：</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[detail_tpl]" maxlength="250" value="<%{$article_category.detail_tpl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
			<br><span class="tips">相对根目录路径，例：/template/default/article_detail.tpl；为空时使用配置的默认路径。</span>
		    </td>
		</tr>
		<tr>
		    <th>每页记录数：</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[page_num]" maxlength="5" value="<%{$article_category.page_num}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th>页面关键字：</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[keywords]" maxlength="250" value="<%{$article_category.keywords}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th>页面描述：</th>
		    <td>
		    <input type="text" class="textinput auto-w" name="article_category[description]" maxlength="250" value="<%{$article_category.description}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    </td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">备注：</th>
		    <td><textarea class="textarea auto-w min-h" name="article_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$article_category.intro}%></textarea></td>
		</tr>
		<tr>
		    <th>栏目排序：</th>
		    <td>
		    <input type="text" class="textinput w120" name="article_category[order_id]" maxlength="5" value="<%{$article_category.order_id}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"/> 
		    <span class="tips">整数值；为空时自动排到分类的尾部。</span>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value="确认保存" />
		<input type="hidden" name="article_category[cate_id]" value="<%{$article_category.cate_id}%>" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
