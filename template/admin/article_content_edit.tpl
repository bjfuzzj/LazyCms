<%{include file='header.tpl'}%>

<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--�����ֶ��������ԣ�������ie����ʱ��Ϊ��������ʧ�ܵ��±༭������ʧ��-->
<!--������ص������ļ��Ḳ������������Ŀ����ӵ��������ͣ���������������Ŀ�����õ���Ӣ�ģ�������ص����ģ�������������-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">


<div id="main">

    <div class="nav">
    �������ݹ���(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=article_content&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
		<input type="submit" value="ȷ�ϱ���" />
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">������Ŀ��</th>
		    <td>
		        <select name="article[cate_id]" class="selectlist">
				<option value='0' >δָ������</option>
			    <%{foreach from=$article_category item=v key=k}%>
			        <option value='<%{$v.cate_id}%>' <%{if $v.cate_id eq $article.cate_id}%> selected<%{/if}%> ><%{$v.cate_name}%></option>
			    <%{/foreach}%>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>���⣺</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="article[title]" value="<%{$article.title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><span class="tips">*</span>
			<%{*
			<br>
		        �������⣺<input type="text" class="textinput auto-w" name="article[com_title]" value="<%{$article.com_title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><br>
		        �� �� �⣺<input type="text" class="textinput auto-w" name="article[sub_title]" value="<%{$article.sub_title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			*}%>
		    </td>
		</tr>
		<tr>
		    <th>���ߣ�</th>
		    <td><input type="text" class="textinput auto-w" name="article[author]" value="<%{$article.author}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>��Դ��</th>
		    <td><input type="text" class="textinput auto-w" name="article[copyfrom]" value="<%{$article.copyfrom}%>"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>Ĭ��ͼƬ��</th>
		    <td>
			<input type="text" class="textinput auto-w" id="default_pic" name="article[default_pic]" value="<%{$article.default_pic}%>"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<iframe src="?c=upload&type=images&id=default_pic" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">���ݼ�飺</th>
		    <td><textarea class="textarea auto-w min-h" name="article[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$article.intro}%></textarea></td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">�������ݣ�</th>
		    <td>
            <script id="myEditor" name="article[content]" type="text/plain" style="width:1024px;height:500px;"><%{$article.content}%></script>
		    </td>
		</tr>
		<tr>
		    <th>��ǩ��</th>
		    <td><input type="text" class="textinput auto-w" name="article[tags]" value="<%{$article.tags}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
		</tr>
		<tr>
		    <th>����ʱ�䣺</th>
		    <td>
		        <input type="text" class="textinput w240" name="article[update_time]" value="<%{$article.update_time|date_format:$date_format}%>"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
		    </td>
		</tr>
		<tr>
		    <th>��ˣ�</th>
		    <td>
		        <input type="checkbox" name="article[passed]" value="1" <%{if $article.passed}%>checked<%{/if}%>  /> ͨ��
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
		<input type="submit" value="ȷ�ϱ���" />
		<input type="hidden" name="article[article_id]" value="<%{$article.article_id}%>" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->

</div><!-- /main -->
<script type="text/javascript">
    //ʵ�����༭��
    //����ʹ�ù�������getEditor���������ñ༭��ʵ���������ĳ���հ������øñ༭����ֱ�ӵ���UE.getEditor('editor')�����õ���ص�ʵ��
    var ue = UE.getEditor('myEditor');
</script>

<%{include file='footer.tpl'}%>
