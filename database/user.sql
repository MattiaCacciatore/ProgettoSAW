CREATE TABLE user(
    email VARCHAR(100) PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL
    --created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);





-- dati fittizzi
INSERT INTO user (email, firstname, lastname, pwd, is_admin) VALUES
  ('maria.rossi@email.com', 'Maria', 'Rossi', 'password', true),  -- Amministratore
  ('giovanni.bianchi@email.com', 'Giovanni', 'Bianchi', 'password', false),
  ('anna.verdi@email.com', 'Anna', 'Verdi', 'password', false),
  ('marco.gialli@email.com', 'Marco', 'Gialli', 'password', false),
  ('paolo.neri@email.com', 'Paolo', 'Neri', 'password', false);