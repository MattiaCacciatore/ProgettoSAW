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




-- dati fittizzi
INSERT INTO user (email, firstname, lastname, pwd, is_admin) VALUES
  ('maria.rossi@email.com', 'Maria', 'Rossi', 'password', 1),  /* Amministratore, 1 indica vero. */
  ('giovanni.bianchi@email.com', 'Giovanni', 'Bianchi', 'password', 0),
  ('anna.verdi@email.com', 'Anna', 'Verdi', 'password', 0),
  ('marco.gialli@email.com', 'Marco', 'Gialli', 'password', 0),
  ('paolo.neri@email.com', 'Paolo', 'Neri', 'password', 0);
