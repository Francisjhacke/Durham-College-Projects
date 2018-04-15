--Name:  Francis Hackenberger
--Course Code: WEDE 3201
--Date: 2015-12-02

DROP TABLE IF EXISTS offensives;

CREATE TABLE offensives(
	reported_by VARCHAR(20) NOT NULL,
	offensive_user VARCHAR(20) NOT NULL,
	time_stamp DATE NOT NULL,
	status CHAR(1) NOT NULL,
	FOREIGN KEY (reported_by) REFERENCES users(user_id),
	FOREIGN KEY (offensive_user) REFERENCES users(user_id)
);