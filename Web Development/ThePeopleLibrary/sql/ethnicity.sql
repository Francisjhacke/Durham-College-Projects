--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS ethnicity;

CREATE TABLE ethnicity(
	value SMALLINT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO ethnicity (value, property) VALUES (1, 'Caucasian');
INSERT INTO ethnicity (value, property) VALUES (2, 'Asian');
INSERT INTO ethnicity (value, property) VALUES (4, 'Black');
INSERT INTO ethnicity (value, property) VALUES (8, 'Middle-Eastern');
INSERT INTO ethnicity (value, property) VALUES (16, 'Indian');
INSERT INTO ethnicity (value, property) VALUES (32, 'Other');
