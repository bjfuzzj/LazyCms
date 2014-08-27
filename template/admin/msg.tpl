<%{include file='header.tpl'}%>

<div id="main">

	<div class="success">
	<img src="/template/admin/static/success.gif" />
		<p><strong><%{$message}%>&nbsp;&nbsp;<span id="seconds" style="color:#f60;">2</span>&nbsp;秒后自动返回</strong></p>
		<p><a href="<%{$url}%>" id="url">如果您的浏览器没有自动跳转，请点击这里！ </a></p>
	</div>

</div><!-- /main -->


<script type="text/javascript">
var i = 2;
var reTime = setInterval(function(){
	i = i-1;
	if(i<0){
		window.location.href= '<%{$url}%>'
		window.clearInterval(reTime);
		return;
	}
	document.getElementById("seconds").innerHTML = i;
},1000);
</script>


<%{include file='footer.tpl'}%>
