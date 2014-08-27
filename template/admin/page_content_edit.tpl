<%{include file='header.tpl'}%>



<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">




<div id="main">

    <div class="nav">
    单页内容管理(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=page_content&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value="确认保存" />
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">归属分类：</th>
		    <td>
		        <select name="page_content[cate_id]" class="selectlist">
			    <%{foreach from=$page_category item=v key=k}%>
			        <option value='<%{$v.cate_id}%>' <%{if $v.cate_id eq $article.cate_id}%> selected<%{/if}%> ><%{$v.cate_name}%></option>
			    <%{/foreach}%>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>页面标题：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_content[title]" value="<%{$page_content.title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>文件名称：</th>
		    <td>
		        <input type="text" class="textinput w240" name="page_content[page_name]" value="<%{$page_content.page_name}%>" maxlength="50" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<span class="tips">数字,字母和下划线组合，不带扩展名，50个字符以内。</span>
		    </td>
		</tr>
		<tr>
		    <th>默认图片：</th>
		    <td>
			<input type="text" class="textinput auto-w" id="default_pic" name="page_content[default_pic]" value="<%{$page_content.default_pic}%>"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><br>
			<iframe src="?c=upload&type=images&id=default_pic" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">页面简介：</th>
		    <td><textarea  class="textarea auto-w min-h" name="page_content[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$page_content.intro}%></textarea></td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">页面正文：</th>
		    <td>

            <script id="myEditor" name="page_content[content]" type="text/plain" style="width:1024px;height:500px;"><%{$page_content.content}%></script>
		    </td>
		</tr>
		<tr>
		    <th>同级排序：</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_content[order_id]" value="<%{$page_content.order_id}%>"  onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips"> 移动分类时会自动计算。 </span>
		    </td>
		</tr>
		<tr>
		    <th>审核：</th>
		    <td>
		        <input type="checkbox" name="page_content[passed]" value="1" <%{if $page_content.passed}%>checked<%{/if}%>  /> 通过
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value="确认保存" />
		<input type="hidden" name='page_content[page_id]' value="<%{$page_content.page_id}%>" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->

</div><!-- /main -->

<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('myEditor');


    
</script>

<%{include file='footer.tpl'}%>
