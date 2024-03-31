CREATE TABLE course (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name_course VARCHAR(100) NOT NULL,
  description_of_course VARCHAR(1500) NOT NULL,

  number_of_video UNSIGNED INT NOT NULL, -- durata 
  price DECIMAL(4,2) UNSIGNED NOT NULL,
  average_evaluation TINYINT UNSIGNED NOT NULL CHECK (vote <= 5),

  PRIMARY KEY (id)
);