<?php
//BUILD THE HEADER AND TOP OF THE PAGE
function build_header($this_site) {
	if ($this_site == "index") {
		$index = " class='active'";
		$list = "";
		$create = "";
	} else if ($this_site == "list") {
		$index = "";
		$list = " class='active'";
		$create = "";
	} else if ($this_site == "create") {
		$index = "";
		$list = "";
		$create = " class='active'";
	}

	print "<!DOCTYPE html>\n";
	print "<html lang='en'>\n";
	print "<head>\n";
	print "\t<title>Cocktail Cookbook</title>\n";
	print "\t<meta charset='utf-8'>\n";
	print "\t<meta name='description' content='Cocktail Cookbook'>\n";
	print "\t<meta name='author' content='Topi Niskala'>\n";
	print "\t<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
	print "\t<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>\n";
	print "\t<link rel='stylesheet' type='text/css' href='css/style.css'>\n";
	print "\t<script src='js/jquery-3.3.1.min.js'></script>\n";
	print "\t<script src='js/bootstrap.min.js'></script>\n";
	print "</head>\n";
	print "<body style='background-color:#000000'>\n";
	print "\t<div class='container' style='background-color:white;'>\n";
	print "\t\t<div class='page-header, jumbotron' style='margin-bottom:0; background-color:lightgreen;'>\n";
	print "\t\t\t<h1>Cocktail Cookbook</h1>\n";
	print "\t\t</div>\n";
	print "\t\t<nav class='navbar navbar-inverse'>\n";
	print "\t\t\t<div class='container-fluid'>\n";
	print "\t\t\t\t<ul class='nav navbar-nav'>\n";
	print "\t\t\t\t\t<li" . $index  .  "><a href='index.php'>Home</a></li>\n";
	print "\t\t\t\t\t<li" . $list . "><a href='list.php'>List</a></li>\n";
	print "\t\t\t\t\t<li" . $create . "><a href='create.php'>Create</a></li>\n";
	print "\t\t\t\t</ul>\n";
	print "\t\t\t</div>\n";
	print "\t\t</nav>\n";
	print "\t\t<div class='container.fluid'>\n";
}

//BUILD THE FOOTER AND THE BOTTOM OF THE PAGE
function build_footer() {
	print "\t\t\t</div>\n";
	print "\t\t\t<br><br>\n";
	print "\t\t</div>\n";
	print "\t\t<footer class='footer jumbotron' id='footerMain' style='margin-bottom:0;'>\n";
	print "\t\t\t<div class='container'>\n";
	print "\t\t\t\t<div class='text-muted'>Links:\n";
	print "\t\t\t\t\t<ul>\n";
	print "\t\t\t\t\t\t<li>GitHub: <a href='https://github.com/TopiNiskala'>https://github.com/TopiNiskala</a></li>\n";
	print "\t\t\t\t\t\t<li>Mixcloud: <a href='https://www.mixcloud.com/shangfu/'>https://www.mixcloud.com/shangfu/</a></li>\n";
	print "\t\t\t\t\t</ul>\n";
	print "\t\t\t\t</div>\n";
	print "\t\t\t</div>\n";
	print "\t\t</footer>\n";
	print "\t</div>\n";
	print "<button onclick='topFunction()' id='myBtn' title='Go to top'>Top</button>\n";
	print "<script src='js/top.js'></script>\n";
	print "</body>\n";
	print "</html>";
}
?>
