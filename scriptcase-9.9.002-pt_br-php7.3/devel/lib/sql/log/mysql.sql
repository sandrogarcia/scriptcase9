CREATE TABLE `tabela_log` (
	id int(8) NOT NULL AUTO_INCREMENT,
	inserted_date datetime,
	username varchar(90) NOT NULL,
	application varchar(255) NOT NULL,
	creator varchar(30) NOT NULL,
	ip_user varchar(255) NOT NULL,
	action varchar(30) NOT NULL,
	description TEXT,
	PRIMARY KEY (id)
)
