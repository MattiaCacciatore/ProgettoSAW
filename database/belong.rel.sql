CREATE TABLE belong (
  id_corso BIGINT UNSIGNED,
  field_name VARCHAR(100),

  PRIMARY KEY (id_corso, field_name),  

  FOREIGN KEY (id_corso) REFERENCES course(id) ON DELETE CASCADE,
  FOREIGN KEY (field_name) REFERENCES field(field_name) ON DELETE CASCADE
);