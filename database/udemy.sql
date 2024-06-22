/* TABELLE. */
CREATE TABLE user(
    email VARCHAR(100) PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT 0, /* di base è false. */
    is_banned BOOLEAN NOT NULL DEFAULT 0,
    id_cookie VARCHAR(768) DEFAULT NULL, /* 768 perchè base64_encode espande la byte-string di 512 byte di circa il 33% */
    expire DATETIME DEFAULT NULL,
    UNIQUE KEY (`id_cookie`)
);

CREATE TABLE course(
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(1500) NOT NULL,
  duration INT UNSIGNED NOT NULL,
  price DECIMAL(4,2) UNSIGNED NOT NULL,
  average_evaluation DECIMAL(2,1) UNSIGNED NOT NULL CHECK (average_evaluation <= 5.0)
);

CREATE TABLE video(
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  duration INT UNSIGNED NOT NULL, /* in minuti. */
  type VARCHAR(50) NOT NULL, /* tipo MIME del video (es. mp4). */
  filename VARCHAR(255) NOT NULL, /* nome del file video. */
  id_course BIGINT UNSIGNED NOT NULL, /* sostituisce la relazione course_video. */
  FOREIGN KEY (id_course) REFERENCES course(id) ON DELETE CASCADE
);

CREATE TABLE field(
    field_name VARCHAR(100) PRIMARY KEY
);

/* RELAZIONI. */
CREATE TABLE belong(
  id_course BIGINT UNSIGNED,
  field_name VARCHAR(100),

  PRIMARY KEY (id_course, field_name),  

  FOREIGN KEY (id_course) REFERENCES course(id) ON DELETE CASCADE,
  FOREIGN KEY (field_name) REFERENCES field(field_name) ON DELETE CASCADE
);

CREATE TABLE evaluate(
    email_user VARCHAR(100),
    id_course BIGINT UNSIGNED,
    vote DECIMAL(2,1) UNSIGNED NOT NULL CHECK (vote <= 5.0),
    feedback VARCHAR(1500),

    PRIMARY KEY (email_user, id_course),

    FOREIGN KEY (email_user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (id_course) REFERENCES course (id) ON DELETE CASCADE
);

CREATE TABLE follow(
    email_user VARCHAR(100),
    id_course BIGINT UNSIGNED,

    PRIMARY KEY (email_user, id_course),

    FOREIGN KEY (email_user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (id_course) REFERENCES course (id) ON DELETE CASCADE
);

CREATE TABLE teach(
    email_user VARCHAR(100),
    id_course BIGINT UNSIGNED,

    PRIMARY KEY (email_user, id_course),

    FOREIGN KEY (email_user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (id_course) REFERENCES course (id) ON DELETE CASCADE
);
/* --------------------------------------------------------------------------------------------------------- */
/* TRIGGERS. */
/* --------------------------------------------------------------------------------------------------------- */
/* Vincolo V1. */
DELIMITER //
CREATE OR REPLACE TRIGGER update_average_evaluation
AFTER INSERT ON evaluate
FOR EACH ROW
BEGIN
	DECLARE new_average_eval DECIMAL(2,1) UNSIGNED;

	SELECT AVG(evaluate.vote) INTO new_average_eval FROM evaluate WHERE evaluate.id_course = NEW.id_course;

    	UPDATE course SET course.average_evaluation = new_average_eval WHERE course.id = NEW.id_course;
END;
//
/* Vincolo V3. */
DELIMITER //
CREATE OR REPLACE TRIGGER check_follower
BEFORE INSERT ON evaluate
FOR EACH ROW
BEGIN
	IF NEW.email_user NOT IN (SELECT follow.email_user FROM follow WHERE NEW.id_course = follow.id_course) THEN
    		SIGNAL SQLSTATE '09000' SET MESSAGE_TEXT = 'This user cannot evaluate this course because has not followed it';
	END IF;
END;
//
/* Vincolo durata in ore dei video di un corso. */
DELIMITER //
CREATE OR REPLACE TRIGGER update_duration
BEFORE INSERT ON video
FOR EACH ROW
BEGIN
    	UPDATE course SET course.duration = course.duration + (NEW.duration / 60) WHERE course.id = NEW.id_course;
END;
//
