CREATE TABLE course(
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(1500) NOT NULL,
  duration INT UNSIGNED NOT NULL, --numero di ore.
  price DECIMAL(4,2) UNSIGNED NOT NULL,
  average_evaluation DECIMAL(2,1) UNSIGNED NOT NULL CHECK (average_evaluation <= 5.0) /* trigger da implementare. */
);


--- dati

INSERT INTO course (name, description, duration, price, average_evaluation) VALUES
  ('Sviluppo web per principianti', 'Impara i fondamenti dello sviluppo web in questo corso completo per principianti. Copriremo HTML, CSS e JavaScript per aiutarti a costruire siti web reattivi e moderni.', 30, 49.99, 4.8),
  ('Fotografia digitale: da principiante a professionista', 'Migliora le tue abilità fotografiche con questo corso completo di fotografia digitale. Imparerai composizioni, tecniche di illuminazione, editing e altro ancora.', 50, 79.99, 4.3),
  ('Yoga per tutti i livelli', 'Impara le basi dello yoga o migliora la tua pratica esistente con questo corso adatto a tutti i livelli. Migliorerai la tua flessibilità, forza e benessere generale.', 20, 29.99, 4.9),
  ('Impara linglese conversazionale', 'Migliora le tue capacità di conversazione in inglese con questo corso pratico. Imparerai frasi e vocabolario comune per situazioni di tutti i giorni.', 40, 39.99, 4.5),
  ('Investire in borsa per principianti', 'Impara i concetti fondamentali dell investimento azionario in questo corso per principianti. Scoprirai come valutare le azioni, costruire un portafoglio e altro ancora.', 25, 69.99, 4.2);
