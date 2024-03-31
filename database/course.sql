CREATE TABLE course(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_course VARCHAR(100) NOT NULL,
    description_of_course VARCHAR(1500) NOT NULL,
    --numer_of_videos is duration
    number_of_videos INT NOT NULL,
    price DECIMAL(4,2) NOT NULL,
    average_evaluation DECIMAL(2,1),
    PRIMARY KEY (id)
);