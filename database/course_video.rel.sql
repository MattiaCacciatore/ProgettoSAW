CREATE TABLE course_video (
  id_corso BIGINT,
  id_video BIGINT,

  PRIMARY KEY (id_corso, id_video),

  FOREIGN KEY (id_corso) REFERENCES course(id) ON DELETE SET NULL,
  FOREIGN KEY (id_video) REFERENCES video(id) ON DELETE SET NULL
);