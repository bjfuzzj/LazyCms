<%{include file='header.tpl'}%>

<!--
<script type="text/javascript" src="plugin/ueditor/editor_config.js"></script>
<script type="text/javascript" src="plugin/ueditor/editor_all_min.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/ueditor.css">
-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="gbk" src="plugin/ueditor/ueditor.all.min.js"> </script>
<!--�����ֶ��������ԣ�������ie����ʱ��Ϊ��������ʧ�ܵ��±༭������ʧ��-->
<!--������ص������ļ��Ḳ������������Ŀ����ӵ��������ͣ���������������Ŀ�����õ���Ӣ�ģ�������ص����ģ�������������-->
<script type="text/javascript" charset="gbk" src="plugin/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="plugin/ueditor/themes/default/css/ueditor.css">

<div id="main">

    <div class="nav">
    ������ݹ���(<%{$t}%>)
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=plate_content&a=edit&t=<%{$t}%>">
	<div class="box-header">
		<div class="tb-title">
		&nbsp;<a href='?c=plate_content&plate_id=<%{$plate_category.id}%>'>�������: <%{$plate_category.plate_name}%> </a>
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">�������ƣ�</th>
		    <td>
		        <input type="hidden" name="plate_content[plate_id]" value="<%{$plate_content.plate_id}%>" />
		        <input type="hidden" name="plate_content[plate_type]" value="<%{$plate_content.plate_type}%>" />
		        <input type="text" class="textinput auto-w" name="plate_content[title]" value="<%{$plate_content.title}%>" maxlength="255" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><span class="tips">*</span>
		    </td>
		</tr>
		<tr>
		    <th  style="vertical-align:top;">������ݣ�</th>
		    <td>
		<%{if $plate_content.plate_type == 1}%>  <%{* �ı� *}%>
            
            <script id="myEditor" name="plate_content[content]" type="text/plain" style="width:1024px;height:500px;" ><%{$plate_content.content}%></script>

		<%{elseif $plate_content.plate_type == 2}%>  <%{* ͼƬ *}%>

			<table width="w720">
			    <tr><th>ͼƬ��ַ��</th>
			        <td><input type="text" class="textinput auto-w" id="img_src" name="plate_content[img_src]" value="<%{$plate_content.img_src}%>"  maxlength="255"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
			    </tr>
			    <tr><th></th>
			        <td><iframe src="?c=upload&type=images&id=img_src" name="upfile" width="580" height="30" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe></td>
			    </tr>
			    <tr><th>���ӵ�ַ��</th>
			        <td><input type="text" class="textinput auto-w" name="plate_content[link_url]" value="<%{$plate_content.link_url}%>"  onfocus="inputFocus(this)" onblur="inputBlur(this)"/></td>
			    </tr>
			</table>

		<%{else}%>  <%{* Ĭ��,�ı� *}%>

            <script id="myEditor" name="plate_content[content]" type="text/plain" style="width:1024px;height:500px;" ><%{$plate_content.content}%></script>
		<%{/if}%>
		    </td>
		</tr>
		<tr>
		    <th>�Ƿ����ã�</th>
		    <td>
		        <input type="checkbox" name="plate_content[used]" value="1" <%{if $plate_content.used}%>checked<%{/if}%>  /> ����
		    </td>
		</tr>
	    </table>
	</div>

	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a>
		<input type="hidden" name="plate_content[id]" value="<%{$plate_content.id}%>" />
		<input type="submit" value=" ȷ�ϱ��� " />
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
