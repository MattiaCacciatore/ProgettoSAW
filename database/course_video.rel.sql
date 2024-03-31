CREATE TABLE Corsi_Video (
  id_corso INT,
  id_video INT,
  PRIMARY KEY (id_corso, id_video),
  FOREIGN KEY (id_corso) REFERENCES courses(id),
  FOREIGN KEY (id_video) REFERENCES video(id)
);