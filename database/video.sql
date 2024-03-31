CREATE TABLE video (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title_course VARCHAR(255) NOT NULL,
  duration_course INT NOT NULL, -- in minuti
  type_video VARCHAR(50) NOT NULL,
  file_video VARCHAR(255) NOT NULL
);