DELIMITER //
CREATE TRIGGER check_follower
BEFORE INSERT ON evaluate
FOR EACH ROW
BEGIN
	IF NEW.user IN (SELECT follow.user FROM follow WHERE NEW.course = follow.course) THEN
    	INSERT INTO evaluate (user, course, vote, feedback) VALUES(NEW.user, NEW.course, NEW.vote, NEW.feedback);
	ELSE
    	SIGNAL SQLSTATE '09000' SET MESSAGE_TEXT = 'this user cannot cast his/her vote on this course because (s)he did not follow it';
	END IF;
END;
//
-- Messo in pratica il vincolo V3 (vedere specifica su docs.google.com)
-- Il codice 09000 indica una eccezione sollevata dall'azione di un trigger.