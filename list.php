<?php
	require "builder.php";
	require "processor.php";
	require __DIR__ . "/object/cocktail.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		process_delete($_POST['ct_id']);
	} else {
		$this_site = "list";
		build_header($this_site);
	}
?>
			<div class="container.fluid">
				<h3>List of saved cocktails</h3>
				<p>Click on the titles of the cocktails to see more info...<br><br>
<?php
	$cocktails = process_list();
	foreach ($cocktails as $list) {
		$cocktail = new Cocktail($list['ct_name'], $list['ct_glass'], $list['ct_garnish'], $list['ct_image'], $list['ct_preparation'], $list['ct_ingredients']);
		print "\t\t\t\t<div class='panel-group'>\n";
		print "\t\t\t\t\t<div class='panel panel-default'>\n";
		print "\t\t\t\t\t\t<div class='panel-heading'>\n";
		print "\t\t\t\t\t\t\t<h4 class='panel-title'>\n";
		print "\t\t\t\t\t\t\t\t<a data-toggle='collapse' href='#collapse" . $cocktail->ct_id . "'>" . $cocktail->ct_name . "</a>\n";
		print "\t\t\t\t\t\t\t</h4>\n";
		print "\t\t\t\t\t\t</div>\n";
		print "\t\t\t\t\t\t<div id='collapse" . $cocktail->ct_id . "' class='panel-collapse collapse'>\n";
		print "\t\t\t\t\t\t\t<div class='panel-body'>\n";
		print "\t\t\t\t\t\t\t\t<ul class='list-group' style='list-style-type:square;'>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item' style='list-style-type:none;'><img alt='Image of a cocktail.' src=" . $cocktail->ct_image . "></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Name: " . $cocktail->ct_name . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Glass: " . $cocktail->ct_glass . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Garnish: " . $cocktail->ct_garnish . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Ingredient List: </p><ul style='list-style-type:square;'>\n";
		$ingredients = explode("|",$cocktail->ct_ingredients);
		foreach ($ingredients as $ing) {
			$ingredient = explode(",",$ing);
			if ($ingredient[2] == "cl") {
				print "\t\t\t\t\t\t\t\t\t\t<li><p>" . $ingredient[0] . " " . $ingredient[1] . $ingredient[2] . "</p></li>\n";
			} else {
				print "\t\t\t\t\t\t\t\t\t\t<li><p>" . $ingredient[0] . " " . $ingredient[1] . " " . $ingredient[2] . "</p></li>\n";
			}
		}
		print "</ul>\n\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Preparation: " . $cocktail->ct_preparation . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t</ul>\n";
		print "\t\t\t\t\t\t\t\t<form class='form-vertical' method='POST'>\n";
		print "\t\t\t\t\t\t\t\t\t<input type='text' style='display:none;' name='ct_id' value='" . $cocktail->ct_id . "'>\n";
		print "\t\t\t\t\t\t\t\t\t<input type='submit' class='btn btn-danger' name='submit' value='Delete'>\n";
		print "\t\t\t\t\t\t\t\t</form>\n";
		print "\t\t\t\t\t\t\t</div>\n";
		print "\t\t\t\t\t\t</div>\n";
		print "\t\t\t\t\t</div>\n";
		print "\t\t\t\t</div>\n";
	}
?>
<?php
	build_footer();
?>
</body>
</html>
