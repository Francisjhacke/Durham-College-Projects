--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS marital_status;

CREATE TABLE marital_status(
	value INT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO marital_status (value, property) VALUES (1, 'Single');
INSERT INTO marital_status (value, property) VALUES (2, 'Married');
INSERT INTO marital_status (value, property) VALUES (4, 'Complicated');
INSERT INTO marital_status (value, property) VALUES (8, 'Divorced');
INSERT INTO marital_status (value, property) VALUES (16, 'Widowed');
INSERT INTO marital_status (value, property) VALUES (32, 'Rather Not Say');