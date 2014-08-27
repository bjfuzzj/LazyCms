<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    系统基本设置
    </div> <!-- /nav -->

    <div class="box">
	<form method="post" action="?c=config">

	<div class="box-header">
		<div class="tb-title">
		</div>
	</div> <!-- /box-header -->

	<div class="box-content">
	    <table class="box-table">
		<tr>
		    <th class="w120">系统名称：</th>
		    <td><input type="text" class="textinput auto-w" name="config[sysname]" value="<%{$config.sysname}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>网站标题：</th>
		    <td><input type="text" class="textinput auto-w" name="config[title]" value="<%{$config.title}%>"  onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>网站地址：</th>
		    <td><input type="text" class="textinput auto-w" name="config[sysurl]" value="<%{$config.sysurl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>管理员邮箱：</th>
		    <td><input type="text" class="textinput auto-w" name="config[ceoemail]" value="<%{$config.ceoemail}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>ICP备案信息：</th>
		    <td><input type="text" class="textinput auto-w" name="config[icp]" value="<%{$config.icp}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>ICP备案链接地址：</th>
		    <td><input type="text" class="textinput auto-w" name="config[icpurl]" value="<%{$config.icpurl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>keywords：</th>
		    <td><input type="text" class="textinput auto-w" name="config[metakeyword]" value="<%{$config.metakeyword}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">description：</th>
		    <td><textarea class="textarea auto-w min-h" name="config[metadescrip]" onfocus="inputFocus(this)" onblur="inputBlur(this)" ><%{$config.metadescrip}%></textarea></td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">生成静态页面：</th>
		    <td>
		        <select name="config[makestatic]"  class="selectlist">
			<option value="0" <%{if $config.makestatic == 0}%> selected <%{/if}%>>不生成静态页面</option>
			<option value="1" <%{if $config.makestatic == 1}%> selected <%{/if}%>>只生成单页模块页面</option>
			<option value="2" <%{if $config.makestatic == 2}%> selected <%{/if}%>>只生成网站首页、单页模块页面</option>
			<option value="3" <%{if $config.makestatic == 3}%> selected <%{/if}%>>只生成网站首页、单页模块、详细内容页页面</option>
			<option value="9" <%{if $config.makestatic == 9}%> selected <%{/if}%>>生成整站页面</option>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>生成文件扩展名：</th>
		    <td>
			<input type="radio" name="config[statictype]" value="1" <%{if $config.statictype == 1}%> checked <%{/if}%>>.html
			<input type="radio" name="config[statictype]" value="2" <%{if $config.statictype == 2}%> checked <%{/if}%>>.htm
			<input type="radio" name="config[statictype]" value="3" <%{if $config.statictype == 3}%> checked <%{/if}%>>.shtml
			<input type="radio" name="config[statictype]" value="4" <%{if $config.statictype == 4}%> checked <%{/if}%>>.shtm
			<input type="radio" name="config[statictype]" value="0" <%{if $config.statictype == 0}%> checked <%{/if}%>>.php
			<span class="tips">扩展名类型更改后请手动将原生成文件删除。</span>
		    </td>
		</tr>
		<tr>
		    <th>生成文件存储目录：</th>
		    <td><input type="text" class="textinput w120" name="config[staticfolder]" value="<%{$config.staticfolder}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  />
		    <span class="tips">相对网站根目录路径，以"/"开头，例： /html 。 目录更改后请手动将原生成文件删除。</span>
		    </td>
		</tr>
		<tr>
		    <th>数据起始年份：</th>
		    <td>
		        <input type="text" class="textinput w120" name="config[startyear]" value="<%{$config.startyear}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  />
			<span class="tips">4位数字年份。</span>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;返回</a> 
		<input type="submit" value="保存更改" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
