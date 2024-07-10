-- Tutti gli utenti in questa tabella sono docenti.
CREATE TABLE teach(
    email_user VARCHAR(100),
    id_course BIGINT UNSIGNED,

    PRIMARY KEY (email_user, id_course),

    FOREIGN KEY (email_user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (id_course) REFERENCES course (id) ON DELETE CASCADE
);


INSERT INTO teach (email_user, id_course) VALUES
  ('maria.rossi@email.com', (SELECT id FROM course WHERE name = 'Sviluppo web per principianti')),
  ('giovanni.bianchi@email.com', (SELECT id FROM course WHERE name = 'Fotografia digitale: da principiante a professionista')),
  ('anna.verdi@email.com', (SELECT id FROM course WHERE name = 'Yoga per tutti i livelli')),
  ('marco.gialli@email.com', (SELECT id FROM course WHERE name = 'Impara l\'inglese conversazionale')),
  ('paolo.neri@email.com', (SELECT id FROM course WHERE name = 'Investire in borsa per principianti'));

