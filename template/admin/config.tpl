<%{include file='header.tpl'}%>

<div id="main">

    <div class="nav">
    ϵͳ��������
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
		    <th class="w120">ϵͳ���ƣ�</th>
		    <td><input type="text" class="textinput auto-w" name="config[sysname]" value="<%{$config.sysname}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>��վ���⣺</th>
		    <td><input type="text" class="textinput auto-w" name="config[title]" value="<%{$config.title}%>"  onfocus="inputFocus(this)" onblur="inputBlur(this)" /></td>
		</tr>
		<tr>
		    <th>��վ��ַ��</th>
		    <td><input type="text" class="textinput auto-w" name="config[sysurl]" value="<%{$config.sysurl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>����Ա���䣺</th>
		    <td><input type="text" class="textinput auto-w" name="config[ceoemail]" value="<%{$config.ceoemail}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>ICP������Ϣ��</th>
		    <td><input type="text" class="textinput auto-w" name="config[icp]" value="<%{$config.icp}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>ICP�������ӵ�ַ��</th>
		    <td><input type="text" class="textinput auto-w" name="config[icpurl]" value="<%{$config.icpurl}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th>keywords��</th>
		    <td><input type="text" class="textinput auto-w" name="config[metakeyword]" value="<%{$config.metakeyword}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  /></td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">description��</th>
		    <td><textarea class="textarea auto-w min-h" name="config[metadescrip]" onfocus="inputFocus(this)" onblur="inputBlur(this)" ><%{$config.metadescrip}%></textarea></td>
		</tr>
		<tr>
		    <th style="vertical-align:top;">���ɾ�̬ҳ�棺</th>
		    <td>
		        <select name="config[makestatic]"  class="selectlist">
			<option value="0" <%{if $config.makestatic == 0}%> selected <%{/if}%>>�����ɾ�̬ҳ��</option>
			<option value="1" <%{if $config.makestatic == 1}%> selected <%{/if}%>>ֻ���ɵ�ҳģ��ҳ��</option>
			<option value="2" <%{if $config.makestatic == 2}%> selected <%{/if}%>>ֻ������վ��ҳ����ҳģ��ҳ��</option>
			<option value="3" <%{if $config.makestatic == 3}%> selected <%{/if}%>>ֻ������վ��ҳ����ҳģ�顢��ϸ����ҳҳ��</option>
			<option value="9" <%{if $config.makestatic == 9}%> selected <%{/if}%>>������վҳ��</option>
			</select>
		    </td>
		</tr>
		<tr>
		    <th>�����ļ���չ����</th>
		    <td>
			<input type="radio" name="config[statictype]" value="1" <%{if $config.statictype == 1}%> checked <%{/if}%>>.html
			<input type="radio" name="config[statictype]" value="2" <%{if $config.statictype == 2}%> checked <%{/if}%>>.htm
			<input type="radio" name="config[statictype]" value="3" <%{if $config.statictype == 3}%> checked <%{/if}%>>.shtml
			<input type="radio" name="config[statictype]" value="4" <%{if $config.statictype == 4}%> checked <%{/if}%>>.shtm
			<input type="radio" name="config[statictype]" value="0" <%{if $config.statictype == 0}%> checked <%{/if}%>>.php
			<span class="tips">��չ�����͸��ĺ����ֶ���ԭ�����ļ�ɾ����</span>
		    </td>
		</tr>
		<tr>
		    <th>�����ļ��洢Ŀ¼��</th>
		    <td><input type="text" class="textinput w120" name="config[staticfolder]" value="<%{$config.staticfolder}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  />
		    <span class="tips">�����վ��Ŀ¼·������"/"��ͷ������ /html �� Ŀ¼���ĺ����ֶ���ԭ�����ļ�ɾ����</span>
		    </td>
		</tr>
		<tr>
		    <th>������ʼ��ݣ�</th>
		    <td>
		        <input type="text" class="textinput w120" name="config[startyear]" value="<%{$config.startyear}%>" onfocus="inputFocus(this)" onblur="inputBlur(this)"  />
			<span class="tips">4λ������ݡ�</span>
		    </td>
		</tr>
	    </table>
	</div> <!-- /box-content -->

	<div class="box-footer">
	    <div class="tb-submit">
		<a href="javascript:history.back(-1);">&lt;&lt;����</a> 
		<input type="submit" value="�������" />
	    </div>
	</div> <!-- /box-footer -->

	</form>
    </div><!-- /box -->
    
</div><!-- /main -->

<%{include file='footer.tpl'}%>
