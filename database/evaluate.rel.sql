CREATE TABLE evaluate(
    email_user VARCHAR(100),
    id_course BIGINT UNSIGNED,
    feedback VARCHAR(1500),
    vote TINYINT UNSIGNED NOT NULL CHECK (vote <= 5),

    PRIMARY KEY (email_user, id_course),

    FOREIGN KEY (email_user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (id_course) REFERENCES course (id) ON DELETE CASCADE
);
