<?php
	require "builder.php";
	require "processor.php";

	$this_site = "list";
	build_header($this_site);
?>
			<div class="container.fluid">
				<h3>List of saved cocktails</h3>
				<p>Click on the titles of the cocktails to see more info...
<?php
	$cocktails = process_list();
	foreach ($cocktails as $list) {
		print "\t\t\t\t<div class='panel-group'>\n";
		print "\t\t\t\t\t<div class='panel panel-default'>\n";
		print "\t\t\t\t\t\t<div class='panel-heading'>\n";
		print "\t\t\t\t\t\t\t<h4 class='panel-title'>\n";
		print "\t\t\t\t\t\t\t\t<a data-toggle='collapse' href='#collapse" . $list['ct_id'] . "'>" . $list['ct_name'] . "</a>\n";
		print "\t\t\t\t\t\t\t</h4>\n";
		print "\t\t\t\t\t\t</div>\n";
		print "\t\t\t\t\t\t<div id='collapse" . $list['ct_id'] . "' class='panel-collapse collapse'>\n";
		print "\t\t\t\t\t\t\t<div class='panel-body'>\n";
		print "\t\t\t\t\t\t\t\t<ul class='list-group' style='list-style-type:square;'>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item' style='list-style-type:none;'><img src=" . $list['ct_image'] . "></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Name: " . $list['ct_name'] . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Glass: " . $list['ct_glass'] . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Garnish: " . $list['ct_garnish'] . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Ingredient List: </p><ul style='list-style-type:square;'>\n";
		$ingredients = explode("|",$list['ct_ingredients']);
		foreach ($ingredients as $ing) {
			$ingredient = explode(",",$ing);
			if ($ingredient[2] == "cl") {
				print "\t\t\t\t\t\t\t\t\t\t<li><p>" . $ingredient[0] . " " . $ingredient[1] . $ingredient[2] . "</p></li>\n";
			} else {
				print "\t\t\t\t\t\t\t\t\t\t<li><p>" . $ingredient[0] . " " . $ingredient[1] . " " . $ingredient[2] . "</p></li>\n";
			}
		}
		
		print "</ul>\n\t\t\t\t\t\t\t\t\t<li class='list-group-item'><p>Preparation: " . $list['ct_preparation'] . "</p></li>\n";
		print "\t\t\t\t\t\t\t\t</ul>\n";
		print "\t\t\t\t\t\t\t</div>\n";
		print "\t\t\t\t\t\t</div>\n";
		print "\t\t\t\t\t</div>\n";
		print "\t\t\t\t</div>\n";
	}
?>
<?php
	build_footer();
?>
