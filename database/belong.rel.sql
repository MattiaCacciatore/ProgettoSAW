CREATE TABLE belong(
  id_course BIGINT UNSIGNED,
  field_name VARCHAR(100),

  PRIMARY KEY (id_course, field_name),  

  FOREIGN KEY (id_course) REFERENCES course(id) ON DELETE CASCADE,
  FOREIGN KEY (field_name) REFERENCES field(field_name) ON DELETE CASCADE
);
