--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS gender;

CREATE TABLE gender(
	value INT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO gender (value, property) VALUES (1, 'Male');
INSERT INTO gender (value, property) VALUES (2, 'Female');
