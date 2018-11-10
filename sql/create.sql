CREATE TABLE cocktail (
	ct_id int NOT NULL auto_increment,
	ct_name varchar(35) NOT NULL,
	ct_glass varchar(35),
	ct_garnish varchar(35),
	ct_image varchar(2083),
	ct_preparation varchar(255),
	PRIMARY KEY (ct_id)
);

CREATE TABLE ingredient (
	ing_id int NOT NULL auto_increment,
	ing_name varchar(35) NOT NULL,
	ing_amount float(3,2) NOT NULL,
	ing_unit varchar(10) NOT NULL,
	ct_id int,
	PRIMARY KEY (ing_id)
);
