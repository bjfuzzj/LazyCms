<%{include file='header.tpl'}%>


<div id="main">

    <div class="nav">
    用户权限设置
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=member&a=edit_purviews">

	<div class="box-header">
		<div class="tb-title">
		当前用户： <%{$user_id}%>
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">权限类型：</th>
		    <td>
		        <input type="checkbox" name="purview[admin_all]" value="1" <%{if $purview.admin_all eq 1}%>checked<%{/if}%> />超级管理员
			<span >普通管理员请设置下列详细权限项。</span>
		    </td>
		</tr>
		<tr id="PurviewDetail">
		    <th style="vertical-align:top;">详细权限项：</th>
		    <td >
			<table class="list-tb" id="list-tb">
			<tr class="tb-header">
			    <td width="150">系统模块</td>
			    <td >详细权限项</td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="0" onClick="checkSameRel(this);" /><b>系统管理</b></td>
			    <td>
				<dt><input type="checkbox" rel="0" name="purview[config]" value="1" <%{if $purview.config}%>checked<%{/if}%> />系统基本信息配置</dt>
				<dt><input type="checkbox" rel="0" name="purview[member]" value="1" <%{if $purview.member}%>checked<%{/if}%> />用户管理</dt>
				<dt><input type="checkbox" rel="0" name="purview[make_static]" value="1" <%{if $purview.make_static}%>checked<%{/if}%> />生成静态页</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="1" onClick="checkSameRel(this);" /><b>文章模块</b></td>
			    <td>
				<dt><input type="checkbox" rel="1" name="purview[article_category]" value="1" <%{if $purview.article_category}%>checked<%{/if}%> />文章分类管理</dt>
				<dt><input type="checkbox" rel="1" name="purview[article_content]" value="1" <%{if $purview.article_content}%>checked<%{/if}%> />文章内容管理</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="2" onClick="checkSameRel(this);" /><b>单页模块</b></td>
			    <td>
				<dt><input type="checkbox" rel="2" name="purview[page_category]" value="1" <%{if $purview.page_category}%>checked<%{/if}%> />单页分类管理</dt>
				<dt><input type="checkbox" rel="2" name="purview[page_content]" value="1" <%{if $purview.page_content}%>checked<%{/if}%> />单页内容管理</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="3" onClick="checkSameRel(this);" /><b>页面板块</b></td>
			    <td>
				<dt><input type="checkbox" rel="3" name="purview[plate_category]" value="1" <%{if $purview.plate_category}%>checked<%{/if}%> />板块划分</dt>
				<dt><input type="checkbox" rel="3" name="purview[plate_content]" value="1" <%{if $purview.plate_content}%>checked<%{/if}%> />板块内容管理</dt>
			    </td>
			</tr>
			<tr>
			    <td><input type="checkbox" rel="4" onClick="checkSameRel(this);" /><b>其他功能</b></td>
			    <td>
				<dt><input type="checkbox" rel="4" name="purview[feedback]" value="1" <%{if $purview.feedback}%>checked<%{/if}%> />留言管理</dt>
				<dt><input type="checkbox" rel="4" name="purview[upload]" value="1" <%{if $purview.upload}%>checked<%{/if}%> />上传附件</dt>
				<dt><input type="checkbox" rel="4" name="purview[personal]" value="1" <%{if $purview.personal}%>checked<%{/if}%> />修改自身密码</dt>
			    </td>
			</tr>
			</table>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value=" 确认保存 " />
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
