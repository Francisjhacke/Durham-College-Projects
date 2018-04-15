--Name:  Francis Hackenberger
--Course Code: WEDE 3201
--Date: 2015-12-02

DROP TABLE IF EXISTS interests;

CREATE TABLE interests(
	user_id VARCHAR(20),
	interest_id VARCHAR(20),
	time_stamp DATE NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	FOREIGN KEY (interest_id) REFERENCES users(user_id)
);
