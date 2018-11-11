<?php
	require "builder.php";

	$this_site = "index";
	build_header($this_site);
?>
			<div class="container.fluid">
				<h3>Cocktail Cookbook</h3>
				<p>This site is built as an example of PHP web programming.
				The idea of the this program is to be able to create cocktail
				recepies with a web form and save those to a SQL database. Those
				recepies should also be listable from the database into a list page.
				The list page should also have buttons for <b>Delete</b> and <br>Update</b>
				functions.<br>
				Later on there should also be user accounts and own cocktail list for each
				user. Login with email and password. The official IBA cocktails should be
				possible to add automatically into users list with a button. On the other
				hand they could be added to each users list automatically and there would
				be a button to hide them.<br><br>
				And since I plant these youtube links to my personal site also, here's absolutely
				awesome alt-rock from former Bauhaus frontman Peter Murphy and brilliant neo-disco-house
				from Sophie Ellis-Bextor.<br><br></p>
				<div class="row">
					<div class="col-sm-6">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/UrfFHzqGBZI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<div class="col-sm-6">
						<iframe src="https://player.vimeo.com/video/246932751" width="560" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				</div>
<?php
	build_footer();
?>
