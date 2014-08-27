<%{include file='header.tpl'}%>


<div id="main">

    <div class="nav">
    �û�Ȩ������
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=member&a=edit_purviews">

	<div class="box-header">
		<div class="tb-title">
		��ǰ�û��� <%{$user_id}%>
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">Ȩ�����ͣ�</th>
		    <td>
		        <input type="checkbox" name="purview[admin_all]" value="1" <%{if $purview.admin_all eq 1}%>checked<%{/if}%> />��������Ա
			<span >��ͨ����Ա������������ϸȨ���</span>
		    </td>
		</tr>
		<tr id="PurviewDetail">
		    <th style="vertical-align:top;">��ϸȨ���</th>
		    <td >
			<table class="list-tb" id="list-tb">
			<tr class="tb-header">
			    <td width="150">ϵͳģ��</td>
			    <td >��ϸȨ����</td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="0" onClick="checkSameRel(this);" /><b>ϵͳ����</b></td>
			    <td>
				<dt><input type="checkbox" rel="0" name="purview[config]" value="1" <%{if $purview.config}%>checked<%{/if}%> />ϵͳ������Ϣ����</dt>
				<dt><input type="checkbox" rel="0" name="purview[member]" value="1" <%{if $purview.member}%>checked<%{/if}%> />�û�����</dt>
				<dt><input type="checkbox" rel="0" name="purview[make_static]" value="1" <%{if $purview.make_static}%>checked<%{/if}%> />���ɾ�̬ҳ</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="1" onClick="checkSameRel(this);" /><b>����ģ��</b></td>
			    <td>
				<dt><input type="checkbox" rel="1" name="purview[article_category]" value="1" <%{if $purview.article_category}%>checked<%{/if}%> />���·������</dt>
				<dt><input type="checkbox" rel="1" name="purview[article_content]" value="1" <%{if $purview.article_content}%>checked<%{/if}%> />�������ݹ���</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="2" onClick="checkSameRel(this);" /><b>��ҳģ��</b></td>
			    <td>
				<dt><input type="checkbox" rel="2" name="purview[page_category]" value="1" <%{if $purview.page_category}%>checked<%{/if}%> />��ҳ�������</dt>
				<dt><input type="checkbox" rel="2" name="purview[page_content]" value="1" <%{if $purview.page_content}%>checked<%{/if}%> />��ҳ���ݹ���</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="3" onClick="checkSameRel(this);" /><b>ҳ����</b></td>
			    <td>
				<dt><input type="checkbox" rel="3" name="purview[plate_category]" value="1" <%{if $purview.plate_category}%>checked<%{/if}%> />��黮��</dt>
				<dt><input type="checkbox" rel="3" name="purview[plate_content]" value="1" <%{if $purview.plate_content}%>checked<%{/if}%> />������ݹ���</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="4" onClick="checkSameRel(this);" /><b>��������</b></td>
			    <td>
				<dt><input type="checkbox" rel="4" name="purview[feedback]" value="1" <%{if $purview.feedback}%>checked<%{/if}%> />���Թ���</dt>
				<dt><input type="checkbox" rel="4" name="purview[upload]" value="1" <%{if $purview.upload}%>checked<%{/if}%> />�ϴ�����</dt>
				<dt><input type="checkbox" rel="4" name="purview[personal]" value="1" <%{if $purview.personal}%>checked<%{/if}%> />�޸���������</dt>
			    </td>
			</tr>
			</table>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value=" ȷ�ϱ��� " />
		<input type="hidden" name="user_id" value="<%{$user_id}%>" />
	    </div>
	</div>

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<script type="text/javascript" src="plugin/jquery/jquery.js"></script>
<script type="text/javascript">
    var checkSameRel = function(ele){
        $(".list-tb").find("input[rel='"+$(ele).attr("rel")+"']").each(function(i){
	    this.checked = ele.checked;
	});
    }
</script>

<%{include file='footer.tpl'}%>
