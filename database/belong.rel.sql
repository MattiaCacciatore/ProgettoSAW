CREATE TABLE belong (
  id_corso BIGINT,
  field_name BIGINT,

  PRIMARY KEY (id_corso, field_name),  

  FOREIGN KEY (id_corso) REFERENCES course(id),
  FOREIGN KEY (field_name) REFERENCES field(field_name)
);