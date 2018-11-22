<?php

//****************
//*Cocktail class*
//****************

class Cocktail {

	//Variables
	public $ct_id;
	public $ct_name;
	public $ct_glass;
	public $ct_garnish;
	public $ct_image;
	public $ct_preparation;
	public $ct_ingredients;

	//Constructor. Everything defaults to 0 or "" unless set as parameter in the call.
	public function __construct($ct_id = 0, $ct_name = "", $ct_glass = "", $ct_garnish = "", $ct_image = "", $ct_preparation = "", $ct_ingredients = array()) {
		$this->ct_id = $ct_id;
		$this->ct_name = $ct_name;
		$this->ct_glass = $ct_glass;
		$this->ct_garnish = $ct_garnish;
		$this->ct_image = $ct_image;
		$this->ct_preparation = $ct_preparation;
		$this->ct_ingredients = $ct_ingredients;
	}

	//No getters or setters as at least for no I have no use for them thanks to ->
}
?>
