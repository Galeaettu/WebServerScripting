<div class="empty-space">
</div>
<div class="row navbar-fixed-bottom">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="text-center">Technical Information</h5>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-sm-4" id="screen"></div>
					<div class="col-xs-12 col-sm-4" id="browser"></div>
					<div class="col-xs-12 col-sm-4"><p class="text-center">Developed by Christian Galea</p></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var screenSize = "<p class=\"text-center\">Screen Resolution: " + screen.width + "*" + screen.height + "</p>";
	var browserSize = "<p class=\"text-center\">Browser Resolution: " +window.innerWidth + "*" + window.innerHeight + "</p>";
	document.getElementById("screen").innerHTML = screenSize;
	document.getElementById("browser").innerHTML = browserSize;
</script>