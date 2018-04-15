--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS movie_genre;

CREATE TABLE movie_genre(
	value INT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO movie_genre (value, property) VALUES (1, 'Comedy');
INSERT INTO movie_genre (value, property) VALUES (2, 'Horror');
INSERT INTO movie_genre (value, property) VALUES (4, 'Action');
INSERT INTO movie_genre (value, property) VALUES (8, 'Thriller');
INSERT INTO movie_genre (value, property) VALUES (16, 'Family');