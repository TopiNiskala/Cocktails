<?php
	require "builder.php";
	require "validator.php";
	require "processor.php";
	$default_ingredients = array();
	$glass = array(
			'Cocktail Glass' => 'Cocktail Glass',
			'Old Fashioned Glass' => 'Old Fashioned Glass',
			'Highball Glass' => 'Highball Glass',
			'Collins Glass' => 'Collins Glass',
			'Shot Glass' => 'Shot Glass',
			'Champagne Flute' => 'Champagne Flute',
			'Irish Coffee Mug' => 'Irish Coffee Mug',
			'Wine Glass' => 'Wine Glass',
			'Margarita Glass' => 'Margarita Glass',
			'Copper Mug' => 'Copper Mug',
			'Poco' => 'Poco',
			'Hurricane Glass' => 'Hurricane Glass'
	);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($form_errors = validate_form()) {
			$this_site = "create";
			build_header($this_site);
			$defaults = $_POST;
			if (isset($_POST['ct_ingredients'])) {
				$ingredients = $_POST['ct_ingredients'];
				foreach ($ingredients as $value) {
					$ing_array = explode(",",$value);
					if ($ing_array[2] == "cl") {
						$value2 = $ing_array[0] . " " . $ing_array[1] . $ing_array[2];
					} else {
						$value2 = $ing_array[0] . " " . $ing_array[1] . " " . $ing_array[2];
					}
					$default_ingredients[$value] = $value2;
				}
			}
		} else {
			$defaults = $_POST;
			process_form();
		}
	} else {
		$this_site = "create";
		build_header($this_site);
		$form_errors = array();
		$defaults = array (
			'ct_name' => '',
			'ct_glass' => '',
			'ct_garnish' => '',
			'ct_image' => '',
			'ct_preparation' => ''
		);
	}
?>
			<div class="container.fluid">
				<h3>Insert your own cocktails to the list</h3>
				<p>Here you can fill in the basic info of your new cocktail recepy.<br><br></p>
				<form class="form-horizontal" method="POST" action="" style="margin-right:30%">
					<div class="form-group">
						<label class="control-label col-sm-2" for="ct_name">Name: </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="ct_name" name="ct_name" minlength="3" maxlength="35" placeholder='Name of the cocktail (min. 3, max. 35 letters)' value=<?php print "'" . htmlentities($defaults['ct_name']) . "'" ?>>
							<div style="color:red;">
							<?php
								if (array_key_exists("name_not_valid", $form_errors)) {
									print $form_errors["name_not_valid"];
								}
							?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ct_glass">Glass: </label>
						<div class="col-sm-10">
							<select name="ct_glass" class="form-control">
								<?php
									foreach ($glass as $option => $label) {
										print "\t\t\t\t\t\t\t\t\t<option value='" . $option . "'";
										if ($option == $defaults['ct_glass']) {
											print " selected";
										}
										print "> $label</option>\n";
									}
								?>
							</select>
							<div style="color:red;">
							<?php
								if (array_key_exists("glass_not_on_list", $form_errors)) {
									print $form_errors["glass_not_on_list"];
								}
							?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ct_garnish">Garnish: </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="ct_garnish" name="ct_garnish" minlength="3" maxlength="35" placeholder='Garnish for the cocktail (min. 3, max. 35 letters)' value=<?php print "'" . htmlentities($defaults['ct_garnish']) . "'" ?>>
							<div style="color:red;">
							<?php
								if (array_key_exists("garnish_not_valid", $form_errors)) {
									print $form_errors["garnish_not_valid"];
								}
							?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ct_image">Image URL (Not mandatory): </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="ct_image" name="ct_image" placeholder='URL to the image of your cocktail.' value=<?php print "'" . htmlentities($defaults['ct_image']) . "'" ?>>
							<div style="color:red;">
							<?php
								if (array_key_exists("image_not_valid", $form_errors)) {
									print $form_errors["image_not_valid"];
								}
							?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ct_preparation">Preparation: </label>
						<div class="col-sm-10">
							<textarea class="form-control" id="ct_preparation" name="ct_preparation" minlength="3" maxlength="255" placeholder='Preparation instructions (min. 3, max. 255 letters)'><?php print htmlentities($defaults['ct_preparation']) ?></textarea>
							<div style="color:red;">
							<?php
								if (array_key_exists("preparation_not_valid", $form_errors)) {
									print $form_errors["preparation_not_valid"];
								}
							?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ingredient_list">List of Ingredients (Add with the second form below):</label>
						<div class="col-sm-10">
							<select name="ct_ingredients[]" id="ct_ingredients" multiple>
								<?php
									foreach ($default_ingredients as $option => $label) {
										print "\t\t\t\t\t\t\t\t\t<option value='" . $option . "'>" . $label . "</option>\n";	
									}
								?>
							</select>
							<div style="color:red;">
							<?php
								$a = 0;
								if (array_key_exists("ingredient_name_not_valid", $form_errors)) {
									print $form_errors["ingredient_name_not_valid"];
									$a++;
								}
								if (array_key_exists("ingredient_amount_not_valid", $form_errors) && $a == 0) {
									print $form_errors["ingredient_amount_not_valid"];
									$a++;
								} else if (array_key_exists("ingredient_amount_not_valid", $form_errors) && $a > 0) {
									print "<br>" . $form_errors["ingredient_amount_not_valid"];
									$a++;
								}
								if (array_key_exists("ingredient_unit_not_valid", $form_errors) && $a == 0) {
									print $form_errors["ingredient_amount_not_valid"];
								} else if (array_key_exists("ingredient_unit_not_valid", $form_errors) && $a > 0) {
									print "<br>" . $form_errors["ingredient_amount_not_valid"];
								}
								if (array_key_exists("no_ingredients", $form_errors)) {
									print $form_errors["no_ingredients"];
								}
							?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="submit"></label>
						<div class="col-sm-10">
							<input type="submit" name="submit" value="Submit">
						</div>
					</div>
				</form>
				<br><hr><br>
				<p>Here you can add ingredients to the 'List of Ingredients' above. Don't worry if you make mistakes, you can add as many ingredients to the list as you 
				want and pick the ones you want from them as you finally submit your recepy to the list.<br><br></p>
				<div class="form-horizontal" style="margin-right:30%">
					<div class="form-group">
						<label class="control-label col-sm-2" for="ingredient_name">Ingredient name: </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ingredient_name" id="ingredient_name" minlength="3" maxlength="35" placeholder="Name of the ingredient (min. 3, max. 35 letters)">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ingredient_amount">Amount: </label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="ingredient_amount" id="ingredient_amount" min="0" max="100" placeholder="The amount of the ingredient (Max. 100 units)">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ingredient_unit">Unit: </label>
						<div class="col-sm-10">
							<select name="ingredient_unit" class="form-control" id="ingredient_unit">
								<option value="cl">Centiliter (cl)</option>
								<option value="Dashes">Dash</option>
								<option value="Splashes">Splash</option>
								<option value="Whole">Whole (ex. Eggwhite)</option>
								<option value="Drops">Drop</option>
								<option value="Teaspoons">Teaspoon</option>
							</select>
						</div>
					</div>
				</div>
				<button name="add_ingredient" onclick="ingredient()">Add Ingredient</button>
<?php
	build_footer();
?>

<script>
	function ingredient() {
		var name = document.getElementById("ingredient_name").value;
		var amount1 = document.getElementById("ingredient_amount").value;
		var select = document.getElementById("ingredient_unit");
		var amount2 = select.options[select.selectedIndex].value;
		var amount;
		if (amount2 == "cl") {
			amount = amount1 + amount2;
		} else {
			amount = amount1 + " " + amount2;
		}
		var opt = document.createElement("OPTION");
		opt.value=name + "," + amount1 + "," + amount2;
		opt.innerHTML = name + " " + amount;
		document.getElementById("ct_ingredients").appendChild(opt);
	}
</script>
