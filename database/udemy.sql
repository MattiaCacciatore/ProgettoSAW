/* TABELLE. */
CREATE TABLE user(
    email VARCHAR(100) PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL,
    id_cookie TEXT DEFAULT NULL,
    expire DATETIME DEFAULT NULL,
    UNIQUE KEY (`id_cookie`)
);

CREATE TABLE course(
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(1500) NOT NULL,
  duration INT UNSIGNED NOT NULL,
  price DECIMAL(4,2) UNSIGNED NOT NULL,
  average_evaluation DECIMAL(1,1) UNSIGNED NOT NULL CHECK (average_evaluation <= 5.0) /* trigger da implementare. */
);

CREATE TABLE video(
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  duration INT UNSIGNED NOT NULL, /* in minuti. */
  type VARCHAR(50) NOT NULL, /* tipologia? */
  file VARCHAR(255) NOT NULL, /* link? */
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
    user VARCHAR(100),
    course BIGINT UNSIGNED,
    feedback VARCHAR(1500),
    vote TINYINT UNSIGNED NOT NULL CHECK (vote <= 5),

    PRIMARY KEY (user, course),

    FOREIGN KEY (user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (course) REFERENCES course (id) ON DELETE CASCADE
);

CREATE TABLE follow(
    user VARCHAR(100),
    course BIGINT UNSIGNED,

    PRIMARY KEY (user, course),

    FOREIGN KEY (user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (course) REFERENCES course (id) ON DELETE CASCADE
);

CREATE TABLE teach(
    user VARCHAR(100),
    course BIGINT UNSIGNED,

    PRIMARY KEY (user, course),

    FOREIGN KEY (user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (course) REFERENCES course (id) ON DELETE CASCADE
);

/* TRIGGERS. -----------------------------------------------------------------------------------------------*/
/* Vincolo V1. */
DELIMITER //
CREATE OR REPLACE TRIGGER update_average_evaluation
AFTER INSERT ON evaluate
FOR EACH ROW
BEGIN
	DECLARE new_average_eval DECIMAL(1,1) UNSIGNED;

	SELECT AVG(evaluate.vote) INTO new_average_eval FROM evaluate WHERE evaluate.course = NEW.course;

    	UPDATE course SET course.average_evaluation = new_average_eval WHERE course.id = NEW.course;
END;
//
/* Vincolo V3. */
DELIMITER //
CREATE OR REPLACE TRIGGER check_follower
BEFORE INSERT ON evaluate
FOR EACH ROW
BEGIN
	IF NEW.user IN (SELECT follow.user FROM follow WHERE NEW.course = follow.course) THEN
    		INSERT INTO evaluate (user, course, vote, feedback) VALUES(NEW.user, NEW.course, NEW.vote, NEW.feedback);
	ELSE
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