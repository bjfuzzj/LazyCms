<%{include file='header.tpl'}%>



<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--�����ֶ��������ԣ�������ie����ʱ��Ϊ��������ʧ�ܵ��±༭������ʧ��-->
<!--������ص������ļ��Ḳ������������Ŀ����ӵ��������ͣ���������������Ŀ�����õ���Ӣ�ģ�������ص����ģ�������������-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">




<div id="main">

    <div class="nav">
    ��ҳ���ݹ���(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=page_content&a=edit&t=<%{$t}%>">

	<div class="box-header">
		<div class="tb-title">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
		<input type="submit" value="ȷ�ϱ���" />
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">�������ࣺ</th>
		    <td>
		        <select name="page_content[cate_id]" class="selectlist">
			    <%{foreach from=$page_category item=v key=k}%>
			        <option value='<%{$v.cate_id}%>' <%{if $v.cate_id eq $article.cate_id}%> selected<%{/if}%> ><%{$v.cate_name}%></option>
			    <%{/foreach}%>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>ҳ����⣺</th>
		    <td>
		        <input type="text" class="textinput auto-w" name="page_content[title]" value="<%{$page_content.title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th>�ļ����ƣ�</th>
		    <td>
		        <input type="text" class="textinput w240" name="page_content[page_name]" value="<%{$page_content.page_name}%>" maxlength="50" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
			<span class="tips">����,��ĸ���»�����ϣ�������չ����50���ַ����ڡ�</span>
		    </td>
		</tr>
		<tr>
		    <th>Ĭ��ͼƬ��</th>
		    <td>
			<input type="text" class="textinput auto-w" id="default_pic" name="page_content[default_pic]" value="<%{$page_content.default_pic}%>"  maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><br>
			<iframe src="?c=upload&type=images&id=default_pic" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">ҳ���飺</th>
		    <td><textarea  class="textarea auto-w min-h" name="page_content[intro]" onfocus="inputFocus(this)" onblur="inputBlur(this)"><%{$page_content.intro}%></textarea></td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">ҳ�����ģ�</th>
		    <td>

            <script id="myEditor" name="page_content[content]" type="text/plain" style="width:1024px;height:500px;"><%{$page_content.content}%></script>
		    </td>
		</tr>
		<tr>
		    <th>ͬ������</th>
		    <td>
		        <input type="text" class="textinput w120" name="page_content[order_id]" value="<%{$page_content.order_id}%>"  onfocus="inputFocus(this)" onblur="inputBlur(this)" />
			<span class="tips"> �ƶ�����ʱ���Զ����㡣 </span>
		    </td>
		</tr>
		<tr>
		    <th>��ˣ�</th>
		    <td>
		        <input type="checkbox" name="page_content[passed]" value="1" <%{if $page_content.passed}%>checked<%{/if}%>  /> ͨ��
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
		<input type="submit" value="ȷ�ϱ���" />
		<input type="hidden" name='page_content[page_id]' value="<%{$page_content.page_id}%>" />
	    </div>
	</div>
	</form>
    </div><!-- /box -->

</div><!-- /main -->

<script type="text/javascript">

    //ʵ�����༭��
    //����ʹ�ù�������getEditor���������ñ༭��ʵ���������ĳ���հ������øñ༭����ֱ�ӵ���UE.getEditor('editor')�����õ���ص�ʵ��
    var ue = UE.getEditor('myEditor');


    
</script>

<%{include file='footer.tpl'}%>
