CREATE TABLE video(
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  duration INT UNSIGNED NOT NULL, /* in minuti. */
  type VARCHAR(50) NOT NULL, /* tipologia? */
  file VARCHAR(255) NOT NULL, /* link? */
  id_course BIGINT UNSIGNED NOT NULL, /* sostituisce la relazione course_video. */
  FOREIGN KEY (id_course) REFERENCES course(id) ON DELETE CASCADE
);
