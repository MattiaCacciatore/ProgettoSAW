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
/* Vincolo V3. Il codice 09000 indica una eccezione sollevata dall'azione di un trigger. */
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
