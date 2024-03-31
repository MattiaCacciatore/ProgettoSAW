CREATE TABLE evaluate (
    user VARCHAR(100),
    course BIGINT UNSIGNED,

    PRIMARY KEY (user, course),

    FOREIGN KEY (user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (course) REFERENCES course (id) ON DELETE CASCADE,

    vote TINYINT UNSIGNED NOT NULL CHECK (vote <= 5), 
    feedback VARCHAR(1500)

);