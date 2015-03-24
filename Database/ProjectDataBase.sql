-- SQL for CS Capstone Project
-- Road Trip Planner

-- General user's information table
DROP TABLE IF EXISTS usersInformation;
CREATE TABLE usersInformation (
	user_id SERIAL NOT NULL,
	user_first_name VARCHAR(45) NOT NULL,
	user_last_name VARCHAR(45) NOT NULL,
  	user_email VARCHAR(45) NOT NULL,
  	user_name VARCHAR(45) NOT NULL.
  	user_phone  VARCHAR(15) NULL,
  	user_salt VARCHAR(45) NOT NULL,
  	user_hashed_password VARCHAR(45) NOT NULL,
  	PRIMARY KEY (user_id)
);

-- Users' activities tracking table
-- Such as register, login log out, creat, delete or update something
DROP TABLE IF EXISTS userLogging;
CREATE TABLE userLogging (
	log_id SERIAL NOT NULL,
	log_userid INT NOT NULL,
	log_ip VARCHAR(45) NOT NULL,
	log_timestamp TIMESTAMP NOT NULL,
	log_activity VARCHAR(45) NOT NULL,
	PRIMARY KEY (log_id)
);

-- User's trip plan table
DROP TABLE IF EXISTS tripPlan;
CREATE TABLE tripPlan (
	trip_id SERIAL NOT NULL,
	trip_userid INT NOT NULL,
	trip_start_address VARCHAR(100) NOT NULL,
	trip_end_address VARCHAR(100) NOT NULL,
	trip_detail_id INT NULL,
	PRIMARY KEY (trip_id)
);

-- This table is used for storing trip plan's way-points if they have
-- If user's trip only has start and end address, then tripDetail will not be created for that trip.
-- Way-point could be default. And only 8 positions.
DROP TABLE IF EXISTS tripDetail;
CREATE TABLE tripDetail (
	detail_id SERIAL NOT NULL,
	detail_tripid INT NOT NULL,
	detail_waypoint1_address VARCHAR(100) NULL,
	detail_waypoint2_address VARCHAR(100) NULL,
	detail_waypoint3_address VARCHAR(100) NULL,
	detail_waypoint4_address VARCHAR(100) NULL,
	detail_waypoint5_address VARCHAR(100) NULL,
	detail_waypoint6_address VARCHAR(100) NULL,
	detail_waypoint7_address VARCHAR(100) NULL,
	detail_waypoint8_address VARCHAR(100) NULL,
	PRIMARY KEY (detail_id)
);


DROP TABLE IF EXISTS question;
CREATE TABLE question (
	question_id SERIAL NOT NULL,
	question_userid INT NOT NULL,
	question_text VARCHAR(1024) NOT NULL,
	question_timestamp TIMESTAMP NOT NULL,
	PRIMARY KEY (question_id)
);


DROP TABLE IF EXISTS answer;
CREATE TABLE answer (
	answer_id SERIAL NOT NULL,
	answer_userid INT NOT NULL,
	answer_text VARCHAR(1024) NOT NULL,
	answer_timestamp TIMESTAMP NOT NULL,
	PRIMARY KEY (answer_id)
);

DROP TABLE IF EXISTS travelJournal;
CREATE TABLE travelJournal (
	journal_id SERIAL NOT NULL,
	journal_userid INT NOT NULL,
	journal_content TEXT NOT NULL,
	PRIMARY KEY (journal_id)
);

DROP TABLE IF EXISTS travelJournalComment;
CREATE TABLE travelJournalComment (
	comment_id SERIAL NOT NULL,
	comment_userid INT NOT NULL,
	comment_text VARCHAR(512) NOT NULL,
	PRIMARY KEY (comment_id)
);