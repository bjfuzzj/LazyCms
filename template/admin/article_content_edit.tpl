<%{include file='header.tpl'}%>

<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">


<div id="main">

    <div class="nav">
    文章内容管理(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=article_content&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value="确认保存" />
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">归属栏目：</th>
		    <td>
		        <select name="article[cate_id]" class="selectlist">
				<option value='0' >未指定分类</option>
			    <%{foreach from=$article_category item=v key=k}%>
			        <option value='<%{$v.cate_id}%>' <%{if $v.cate_id eq $article.cate_id}%> selected<%{/if}%> ><%{$v.cate_name}%></option>
			    <%{/foreach}%>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>标题：</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="article[title]" value="<%{$article.title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><span class="tips">*</span>
			<%{*
			<br>
		        完整标题：<input type="text" class="textinput auto-w" name="article[com_title]" value="<%{$article.com_title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><br>
		        副 标 题：<input type="text" class="textinput auto-w" name="article[sub_title]" value="<%{$article.sub_title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			*}%>
		    </td>
		</tr>
		<tr>
		    <th>作者：</th>
		    <td><input type="text" class="textinput auto-w" name="article[author]" value="<%{$article.author}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>来源：</th>
		    <td><input type="text" class="textinput auto-w" name="article[copyfrom]" value="<%{$article.copyfrom}%>"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>默认图片：</th>
		    <td>
			<input type="text" class="textinput auto-w" id="default_pic" name="article[default_pic]" value="<%{$article.default_pic}%>"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<iframe src="?c=upload&type=images&id=default_pic" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">内容简介：</th>
		    <td><textarea class="textarea auto-w min-h" name="article[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$article.intro}%></textarea></td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">正文内容：</th>
		    <td>
            <script id="myEditor" name="article[content]" type="text/plain" style="width:1024px;height:500px;"><%{$article.content}%></script>
		    </td>
		</tr>
		<tr>
		    <th>标签：</th>
		    <td><input type="text" class="textinput auto-w" name="article[tags]" value="<%{$article.tags}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>更新时间：</th>
		    <td>
		        <input type="text" class="textinput w240" name="article[update_time]" value="<%{$article.update_time|date_format:$date_format}%>"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th>审核：</th>
		    <td>
		        <input type="checkbox" name="article[passed]" value="1" <%{if $article.passed}%>checked<%{/if}%>  /> 通过
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a>
		<input type="submit" value="确认保存" />
		<input type="hidden" name="article[article_id]" value="<%{$article.article_id}%>" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->

</div><!-- /main -->
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('myEditor');
</script>

<%{include file='footer.tpl'}%>
