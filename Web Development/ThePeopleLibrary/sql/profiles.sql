--Name: Daniel Oscar-Few
--Course Code:  WEDE 3201
--Date: 06/10/2015

DROP TABLE IF EXISTS profiles;

CREATE TABLE profiles(
	user_id VARCHAR(20),
	gender SMALLINT NOT NULL,
	gender_sought SMALLINT NOT NULL,
	body_type SMALLINT NOT NULL,
	city INTEGER NOT NULL,
	images SMALLINT NOT NULL DEFAULT 0,
	headline VARCHAR(100) NOT NULL,
	self_description VARCHAR(1000) NOT NULL,
	match_description VARCHAR(1000) NOT NULL,
	age INTEGER NOT NULL,
	age_sought INTEGER NOT NULL,
	music_genre INTEGER NOT NULL,
	movie_genre INTEGER NOT NULL,
	number_of_kids INTEGER NOT NULL,
	kids_wanted INTEGER NOT NULL,
	number_of_siblings INTEGER NOT NULL,
	marital_status INTEGER NOT NULL,
	number_of_pets INTEGER NOT NULL,
	ethnicity INTEGER NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);