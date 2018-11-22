<?php

//****************
//*Cocktail class*
//****************

class User {

	//Variables
	public $usr_id;
	public $usr_name;
	public $usr_password;
	public $usr_email;

	//Constructor. Everything defaults to 0 or "" unless set as parameter in the call.
	public function __construct($usr_id = 0, $usr_name = "", $usr_password = "", $usr_email = "") {
		$this->usr_id = $usr_id;
		$this->usr_name = $usr_name;
		$this->usr_password = $usr_password;
		$this->usr_email = $usr_email;
	}

	//No getters or setters as at least for no I have no use for them thanks to ->
}
?>
