--Name:  Daniel Oscar-Few
--Course Code: WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS music_genre;

CREATE TABLE music_genre(
	value INT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);

INSERT INTO music_genre (value, property) VALUES (1, 'Pop');
INSERT INTO music_genre (value, property) VALUES (2, 'R&B');
INSERT INTO music_genre (value, property) VALUES (4, 'Rock');
INSERT INTO music_genre (value, property) VALUES (8, 'Metal');
INSERT INTO music_genre (value, property) VALUES (16, 'Country');
INSERT INTO music_genre (value, property) VALUES (32, 'Rap');
INSERT INTO music_genre (value, property) VALUES (64, 'Techno');
INSERT INTO music_genre (value, property) VALUES (128, 'Hip Hop');