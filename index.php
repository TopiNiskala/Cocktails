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
				The list page should also have buttons for <b>Delete</b> and <b>Update</b>
				functions.<br>
				Later on there should also be user accounts and own cocktail list for each
				user. Login with email and password. The official IBA cocktails should be
				possible to add automatically into users list with a button. On the other
				hand they could be added to each users list automatically and there would
				be a button to hide them.<br><br>
				<h5>List of finished parts: </h5>
				<ul>
					<li class='list-group-item'>Basic webpage layout and style.</li>
					<li class='list-group-item'>Fully functional form and a validator for the form.</li>
					<li class='list-group-item'>Possibility to save (validated) data from the form to a database (MariaDB).</li>
					<li class='list-group-item'>Listpage where you can list cocktails from the database.</li>
					<li class='list-group-item'>Possibility to delete cocktails from the list.</li>
					<li class='list-group-item'>SESSION implemented and basic cocktail glass added next to cocktail-pdo class.</li>
				</ul>
				<h5>List of to-do parts: </h5>
				<ul>
					<li class='list-group-item'>Cancel button for new cocktails.</li>
					<li class='list-group-item'>New page for editing/updating cocktail data. (and move delete button there)</li>
					<li class='list-group-item'>Login, register, cookies. Possibly with pure PHP or with a framework like PHP-Auth.</li>
					<li class='list-group-item'>Separate database for each user with possibility to add IBA official list to user accounts database.</li>
					<li class='list-group-item'>Possibility for users to save their own pictures of cocktails to system.</li>
				</ul><br><br>
				And since I plant these youtube links to my personal site also, here's absolutely
				awesome alt-rock from former Bauhaus frontman Peter Murphy and brilliant neo-disco-house
				from Sophie Ellis-Bextor.<br><br></p>
				<div class="row">
					<div class="col-sm-6">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/UrfFHzqGBZI" allowfullscreen></iframe>
					</div>
					<div class="col-sm-6">
						<iframe src="https://player.vimeo.com/video/246932751" width="560" height="315" allowfullscreen></iframe>
					</div>
				</div>
<?php
	build_footer();
?>
</body>
</html>
