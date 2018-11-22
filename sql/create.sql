CREATE TABLE cocktail (
	ct_id int NOT NULL auto_increment,
	ct_name varchar(35) NOT NULL,
	ct_glass varchar(35),
	ct_garnish varchar(35),
	ct_image varchar(2083),
	ct_preparation varchar(255),
	ct_ingredients varchar(500),
	PRIMARY KEY (ct_id)
) ENGINE=INNODB;

CREATE TABLE user (
	usr_id int NOT NULL auto_increment,
	usr_name varchar(35) NOT NULL,
	usr_email varchar(35) NOT NULL,
	usr_password varchar(35) NOT NULL,
	PRIMARY KEY (usr_id)
) ENGINE=INNODB;

CREATE TABLE users_cocktail (
	ct_id int NOT NULL,
	usr_id int NOT NULL,
	PRIMARY KEY (ct_id, usr_id),
	FOREIGN KEY (ct_id) REFERENCES cocktail(ct_id),
	FOREIGN KEY (usr_id) REFERENCES user(usr_id)
) ENGINE=INNODB;
