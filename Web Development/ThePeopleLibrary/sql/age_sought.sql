--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS age_sought;

CREATE TABLE age_sought(
	value INT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO age_sought (value, property) VALUES (1, '18 - 24');
INSERT INTO age_sought (value, property) VALUES (2, '25 - 31');
INSERT INTO age_sought (value, property) VALUES (4, '32 - 38');
INSERT INTO age_sought (value, property) VALUES (8, '39 - 45');
INSERT INTO age_sought (value, property) VALUES (16, '46 - 52');
INSERT INTO age_sought (value, property) VALUES (32, '53 - 59');
INSERT INTO age_sought (value, property) VALUES (64, '60 - 65');
INSERT INTO age_sought (value, property) VALUES (128, '65+');