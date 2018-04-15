--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS kids_wanted;

CREATE TABLE kids_wanted(
	value INT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO kids_wanted (value, property) VALUES (1, '0');
INSERT INTO kids_wanted(value, property) VALUES (2, '1');
INSERT INTO kids_wanted (value, property) VALUES (4, '2');
INSERT INTO kids_wanted (value, property) VALUES (8, '3');
INSERT INTO kids_wanted (value, property) VALUES (16, '4 or More');