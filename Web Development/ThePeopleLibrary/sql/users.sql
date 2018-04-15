--           Name:  Daniel Oscar-Few
--             Date:  17/09/2015
--Course Code:  WEDE 3201

DROP TABLE IF EXISTS users;

CREATE TABLE users(
	user_id VARCHAR(20) PRIMARY KEY,
	password VARCHAR(32) NOT NULL,
	user_type CHAR(1) NOT NULL,
	email_address VARCHAR(256) NOT NULL,
	first_name VARCHAR(128) NOT NULL,
    last_name VARCHAR(128) NOT NULL,
    birth_date DATE NOT NULL,
	enrol_date DATE NOT NULL,
	last_access DATE NOT NULL
);

INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) VALUES(
	'jdoe',
	'testpass',
	'i',
	'jdoe@durhamcollege.ca',
	'John',
	'Doe',
	'1990-01-01',
	'2015-09-17',
	'2014-09-17');
	
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) VALUES(
	'doscarfew',
	'password1',
	'a',
	'danieloscarfew@durhamcollege.ca',
	'Daniel',
	'Oscar-Few',
	'1994-12-05',
	'2015-09-17',
	'2014-09-17');
	
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) VALUES(
	'schard',
	'password2',
	'a',
	'blank1@durhamcollege.ca',
	'Sam',
	'Chard',
	'1990-01-01',
	'2015-09-17',
	'2014-09-17');
	
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) VALUES(
	'fhackenberger',
	'password3',
	'a',
	'blank2@durhamcollege.ca',
	'Francis',
	'Hackenberger',
	'1990-01-01',
	'2015-09-17',
	'2014-09-17');
	
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) VALUES(
	'afranca',
	'password4',
	'a',
	'blank3@durhamcollege.ca',
	'Antonio',
	'Franca',
	'1990-01-01',
	'2015-09-17',
	'2014-09-17');

	INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) VALUES(
	'elee',
	'password5',
	'a',
	'blank4@durhamcollege.ca',
	'Evan',
	'Lee',
	'1990-01-01',
	'2015-09-17',
	'2014-09-17');
	
SELECT * FROM users;