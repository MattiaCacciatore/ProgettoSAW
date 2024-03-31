CREATE TABLE evaluate (
    user VARCHAR(100),
    course BIGINT UNSIGNED,

    PRIMARY KEY (user, course),

    FOREIGN KEY (user) REFERENCES user (email) ON DELETE SET NULL,
    FOREIGN KEY (course) REFERENCES course (id) ON DELETE SET NULL,

    vote TINYINT CHECK (vote >= 0 AND vote <= 5) NOT NULL, -- range 0-5
    feedback VARCHAR(1500)

);