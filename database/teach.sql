-- In this table all users are teachers.
CREATE TABLE teach(
    user VARCHAR(100),
    course BIGINT UNSIGNED,

    PRIMARY KEY (user, course),

    FOREIGN KEY (user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (course) REFERENCES course (id) ON DELETE CASCADE
);


INSERT INTO teach (user, course) VALUES
  ('maria.rossi@email.com', (SELECT id FROM course WHERE name_course = 'Sviluppo web per principianti')),
  ('giovanni.bianchi@email.com', (SELECT id FROM course WHERE name_course = 'Fotografia digitale: da principiante a professionista')),
  ('anna.verdi@email.com', (SELECT id FROM course WHERE name_course = 'Yoga per tutti i livelli')),
  ('marco.gialli@email.com', (SELECT id FROM course WHERE name_course = 'Impara l\'inglese conversazionale')),
  ('paolo.neri@email.com', (SELECT id FROM course WHERE name_course = 'Investire in borsa per principianti'));

