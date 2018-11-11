CREATE TABLE cocktail (
	ct_id int NOT NULL auto_increment,
	ct_name varchar(35) NOT NULL,
	ct_glass varchar(35),
	ct_garnish varchar(35),
	ct_image varchar(2083),
	ct_preparation varchar(255),
	ct_ingredients varchar(500),
	PRIMARY KEY (ct_id)
);
