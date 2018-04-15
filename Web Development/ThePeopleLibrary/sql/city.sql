--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS city;

CREATE TABLE city(
	value INT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO city (value, property) VALUES (1, 'Oshawa');
INSERT INTO city (value, property) VALUES (2, 'Whitby');
INSERT INTO city (value, property) VALUES (4, 'Bowmanville');
INSERT INTO city (value, property) VALUES (8, 'Ajax');
INSERT INTO city (value, property) VALUES (16, 'Pickering');
INSERT INTO city (value, property) VALUES (32, 'Uxbridge');
INSERT INTO city (value, property) VALUES (64, 'Port Perry');
INSERT INTO city (value, property) VALUES (128, 'Toronto');
