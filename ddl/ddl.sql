CREATE DATABASE umb;

CREATE TABLE UserAccount (
	email VARCHAR(255) PRIMARY KEY NOT NULL,
	hash_pass VARCHAR(255) NOT NULL,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	is_enabled BOOLEAN NOT NULL DEFAULT 1,
	is_admin BOOLEAN NOT NULL DEFAULT 0
);

CREATE TABLE HealthAccount (
	account_number INT NOT NULL PRIMARY KEY,
	account_type CHAR(3) NOT NULL,
	email VARCHAR(255) NOT NULL,
	FOREIGN KEY (email) REFERENCES UserAccount (email) ON DELETE CASCADE
);

CREATE TABLE AccountTransaction (
	transaction_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	amount DECIMAL(65,2) NOT NULL,
	account_number INT NOT NULL,
	date_time_stamp DATETIME NOT NULL DEFAULT NOW(),
	FOREIGN KEY (account_number) REFERENCES HealthAccount (account_number) ON DELETE CASCADE
);

CREATE TABLE Receipt (
	receipt_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(255) NOT NULL,
	image VARCHAR(255) NOT NULL,
	date_time_stamp DATETIME NOT NULL DEFAULT NOW(),
	FOREIGN KEY (email) REFERENCES UserAccount (email) ON DELETE CASCADE
);

CREATE TABLE Reimbursement (
	reimbursement_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	receipt_id INT NOT NULL UNIQUE,
	amount DECIMAL(65,2) NOT NULL,
	account_number INT NOT NULL,
	date_time_stamp DATETIME NOT NULL DEFAULT NOW(),
	FOREIGN KEY (receipt_id) REFERENCES Receipt (receipt_id) ON DELETE CASCADE,
	FOREIGN KEY (account_number) REFERENCES HealthAccount (account_number) ON DELETE CASCADE
);
