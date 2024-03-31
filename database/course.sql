CREATE TABLE course (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name_course VARCHAR(100) NOT NULL,
  description_of_course VARCHAR(1500) NOT NULL,

  number_of_video INT UNSIGNED NOT NULL, -- durata 
  price DECIMAL(4,2) UNSIGNED NOT NULL,
  average_evaluation DECIMAL(1,1) UNSIGNED NOT NULL CHECK (average_evaluation <= 5.0),

  PRIMARY KEY (id)
);