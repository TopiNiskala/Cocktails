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
				recepies should also be listable from the database into html.<br><br>
				I would love to have a picture here, but I'll get to that later.
				Otherwise this is it for the main page. So... yeah, that's it I
				guess. Maybe a youtube link? Sure, why not!<br><br><br><br></p>
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
