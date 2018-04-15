--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS body_type;

CREATE TABLE body_type(
	value SMALLINT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO body_type (value, property) VALUES (1, 'Thin');
INSERT INTO body_type (value, property) VALUES (2, 'Average');
INSERT INTO body_type (value, property) VALUES (4, 'Athletic');
INSERT INTO body_type (value, property) VALUES (8, 'Large');
INSERT INTO body_type (value, property) VALUES (16, 'Curvy');
