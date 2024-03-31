CREATE TABLE course_video (
  id_corso INT,
  id_video INT,

  PRIMARY KEY (id_corso, id_video), -- ho visto che 

  FOREIGN KEY (id_corso) REFERENCES courses(id),
  FOREIGN KEY (id_video) REFERENCES video(id)
);