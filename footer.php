<div class="empty-space">
</div>
<script>
    $(document).ready(function(){
        if($.browser.chrome){
            $("#browser").html("Browser: Google Chrome "+$.browser.version);
        }
        else if($.browser.msie){
            $("#browser").html("Browser: Internet Explorer "+$.browser.version);
        }
        else if($.browser.mozilla){
            $("#browser").html("Browser: Firefox "+$.browser.version);
        }

        console.log($.browser);
    });
</script>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-4">
            <span class="sr-only">Toggle navigation</span>
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-4">
            <!-- navbar-text to include a text -->
            <p class="navbar-text text-center navbar-right">Developed by <b>Christian Galea</b></p>
            <p id="screen" class="navbar-text text-center"></p>
            <p id="browser" class="navbar-text text-center"></p>
        </div>
    </div>
</nav>

<script>
	var screenSize = "Screen Resolution: " + screen.width + "*" + screen.height;
	var browserSize = "Browser Resolution: " +window.innerWidth + "*" + window.innerHeight;
	document.getElementById("screen").innerHTML = screenSize;
	// document.getElementById("browser").innerHTML = browserSize;
</script>