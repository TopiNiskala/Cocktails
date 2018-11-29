<?php
	ini_set('session.gc_maxlifetime',86400);
	require __DIR__ . "/object/cocktail.php";
	session_start();
	require "builder.php";
	require "validator.php";
	require "processor.php";
	$correct = 0;
	if (isset($_SESSION['usr_name']) && isset($_SESSION['usr_password'])) {
		$correct = checkLogin($_SESSION['usr_name'], $_SESSION['usr_password']);
	}
	if (isset($_COOKIE['usr_name']) && isset($_COOKIE['usr_password'])) {
		$correct = checkLogin($_COOKIE['usr_name'], $_COOKIE['usr_password']);
	}
	if ($correct == 0) {
		header("Location: logout.php");
	}

	$default_ingredients = array();
	$glass = array(
			'Absinthe Glass' => 'Absinthe Glass',
			'Beer Stein' => 'Beer Stein',
			'Chalice' => 'Chalice',
			'Champagne Coupe' => 'Champagne Coupe',
			'Champagne Flute' => 'Champagne Flute',
			'Cocktail Glass' => 'Cocktail Glass',
			'Collins Glass' => 'Collins Glass',
			'Glencairn Whiskey Glass' => 'Glencairn Whiskey Glass',
			'Highball Glass' => 'Highball Glass',
			'Hurricane Glass' => 'Hurricane Glass',
			'Margarita Glass' => 'Margarita Glass',
			'Old Fashioned Glass' => 'Old Fashioned Glass',
			'Pilsner Glass' => 'Pilsner Glass',
			'Pint Glass' => 'Pint Glass',
			'Pony Glass' => 'Pony Glass',
			'Sherry Glass' => 'Sherry Glass',
			'Shot Glass' => 'Shot Glass',
			'Snifter' => 'Snifter',
			'Table Glass' => 'Table Glass',
			'Tankard' => 'Tankard',
			'Wheat Beer Glass' => 'Wheat Beer Glass',
			'Wine Glass' => 'Wine Glass',
			'Yardglass' => 'Yardglass',
			'Special' => 'Special (Define in the preparation)'
	);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['cancel'])) {
			unset($_SESSION['cocktail']);
			$_POST = array();
			header("Location: create.php");
			exit();
		} else {
			unset($_POST['cancel']);
			if ($form_errors = validate_form()) {
				$this_site = "create";
				build_header($this_site);
				if (isset($_POST['ct_ingredients'])) {
					$cocktail = new Cocktail(0, $_POST['ct_name'], $_POST['ct_glass'], $_POST['ct_garnish'], $_POST['ct_image'], $_POST['ct_preparation'], $_POST['ct_ingredients']);
				} else {
					$cocktail = new Cocktail(0, $_POST['ct_name'], $_POST['ct_glass'], $_POST['ct_garnish'], $_POST['ct_image'], $_POST['ct_preparation']);
				}
				$_SESSION['cocktail'] = $cocktail;
				if (isset($cocktail->ct_ingredients)) {
					foreach ($cocktail->ct_ingredients as $value) {
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
				if (isset($_POST['ct_ingredients'])) {
					$cocktail = new Cocktail(0, $_POST['ct_name'], $_POST['ct_glass'], $_POST['ct_garnish'], $_POST['ct_image'], $_POST['ct_preparation'], $_POST['ct_ingredients']);
				} else {
					$cocktail = new Cocktail(0, $_POST['ct_name'], $_POST['ct_glass'], $_POST['ct_garnish'], $_POST['ct_image'], $_POST['ct_preparation']);
				}
				$_SESSION['cocktail'] = $cocktail;
				process_form($cocktail);
			}
		}
	} else {
		unset($_POST['cancel']);
		$this_site = "create";
		build_header($this_site);
		if (isset($_SESSION['cocktail'])) {
			$cocktail = $_SESSION['cocktail'];
			if (isset($cocktail->ct_ingredients)) {
				foreach ($cocktail->ct_ingredients as $value) {
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
			$cocktail = new Cocktail();
			$_SESSION['cocktail'] = $cocktail;
		}
		$form_errors = array();
	}
?>
			<div class="container.fluid">
				<h3>Insert your own cocktails to the list</h3>
				<p>Here you can fill in the basic info of your new cocktail recepy.<br><br></p>
				<form class="form-horizontal" method="POST" style="margin-right:30%">
					<div class="form-group">
						<label class="control-label col-sm-2" for="ct_name">Name: </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="ct_name" name="ct_name" minlength="3" maxlength="35" placeholder='Name of the cocktail (min. 3, max. 35 letters)' value=<?php print "'" . htmlentities($cocktail->ct_name) . "'" ?>>
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
							<select name="ct_glass" class="form-control" id="ct_glass">
								<?php
									foreach ($glass as $option => $label) {
										print "\t\t\t\t\t\t\t\t\t<option value='" . $option . "'";
										if ($option == $cocktail->ct_glass) {
											print " selected";
										}
										print ">" . $label . "</option>\n";
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
							<input type="text" class="form-control" id="ct_garnish" name="ct_garnish" minlength="3" maxlength="35" placeholder='Garnish for the cocktail (min. 3, max. 35 letters)' value=<?php print "'" . htmlentities($cocktail->ct_garnish) . "'" ?>>
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
							<input type="text" class="form-control" id="ct_image" name="ct_image" placeholder='URL to the image of your cocktail.' value=<?php print "'" . htmlentities($cocktail->ct_image) . "'" ?>>
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
							<textarea class="form-control" id="ct_preparation" name="ct_preparation" minlength="3" maxlength="255" placeholder='Preparation instructions (min. 3, max. 255 letters)'><?php print htmlentities($cocktail->ct_preparation) ?></textarea>
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
						<label class="control-label col-sm-2" for="ct_ingredients">List of Ingredients (Add with the second form below):</label>
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
							<input class="btn btn-success" type="submit" name="submit" value="Submit" id="submit">
							<input class="btn btn-danger" type="submit" name="cancel" value="Cancel" id="cancel">
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
				<button class="btn btn-success" name="add_ingredient" onclick="ingredient()">Add Ingredient</button>
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
</body>
</html>
