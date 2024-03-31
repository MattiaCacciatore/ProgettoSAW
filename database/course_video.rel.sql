CREATE TABLE course_video (
  id_corso BIGINT,
  id_video BIGINT,

  PRIMARY KEY (id_corso, id_video), -- ho visto che 

  FOREIGN KEY (id_corso) REFERENCES course(id),
  FOREIGN KEY (id_video) REFERENCES video(id)
);