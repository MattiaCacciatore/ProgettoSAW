CREATE TABLE course(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_course VARCHAR(100) NOT NULL,
    description_of_course VARCHAR(1500) NOT NULL,
    --numer_of_videos is duration
    number_of_videos INT NOT NULL,
    price DECIMAL(4,2) UNSIGNED NOT NULL,
    average_evaluation DECIMAL(2,1) UNSIGNED,

    PRIMARY KEY (id),

    CONSTRAINT evaluation_in_range CHECK (average_evaluation < 10.0)
);