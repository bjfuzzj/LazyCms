<%{include file='header.tpl'}%>

<div id="main">
    <div class="nav">
    页面板块管理(<%{$t}%>)
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
		    <th class="w120">板块名称：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="plate_category[plate_name]" value="<%{$plate_category.plate_name}%>" maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		        <span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>板块标识：</th>
		    <td>
		        <input type="text" class="textinput w240" name="plate_category[plate_ab]" value="<%{$plate_category.plate_ab}%>" maxlength="30"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		        <span class="tips">* 数字,字母和下划线组合，30个字符以内。</span>
		    </td>
		</tr>
		<tr>
		    <th>内容类型：</th>
		    <td>
		        <input type="radio" name="plate_category[plate_type]" value="1" <%{if $plate_category.plate_type eq 1}%>checked<%{/if}%>  /> (HTML)文本 
		        <input type="radio" name="plate_category[plate_type]" value="2" <%{if $plate_category.plate_type eq 2}%>checked<%{/if}%>  /> 图片 
			 <%{if $t eq 'modify'}%> <span class="tips">|板块下有内容时建议不要修改类型。</span> <%{/if}%>
		        <br><span class="tips">前台显示时，除图片类型可以显示多条记录外，其它类型只显示最新一条在用的记录。</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">备注：</th>
		    <td><textarea class="textarea auto-w min-h" name="plate_category[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$plate_category.intro}%></textarea></td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value=" 确认保存 " />
		<input type="hidden" name="plate_category[id]" value="<%{$plate_category.id}%>" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
