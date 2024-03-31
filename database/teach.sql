-- In this table all users are teachers.
CREATE TABLE teach(
    user VARCHAR(100),
    course BIGINT UNSIGNED,

    PRIMARY KEY (user, course),

    FOREIGN KEY (user) REFERENCES user (email) ON DELETE CASCADE,
    FOREIGN KEY (course) REFERENCES course (id) ON DELETE CASCADE
);