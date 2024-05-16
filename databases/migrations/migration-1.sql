CREATE TABLE IF NOT EXISTS assessment_periods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    status VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS assessment_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    order_number INT NOT NULL DEFAULT 1
);

CREATE TABLE IF NOT EXISTS assessment_weights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    min DOUBLE(10, 2) NOT NULL,
    max DOUBLE(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS assessment_instruments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS assessment_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    instrument_id INT NOT NULL,
    description LONGTEXT NOT NULL,

    CONSTRAINT fk_assessment_questions_category_id FOREIGN KEY (category_id) REFERENCES assessment_categories(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_questions_instrument_id FOREIGN KEY (instrument_id) REFERENCES assessment_instruments(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS assessment_evaluations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    media_id INT NOT NULL,
    evaluator_id INT DEFAULT NULL,
    notes LONGTEXT DEFAULT NULL,

    CONSTRAINT fk_assessment_evaluations_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_evaluations_evaluator_id FOREIGN KEY (evaluator_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_evaluations_media_id FOREIGN KEY (media_id) REFERENCES media(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS assessment_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    period_id INT NOT NULL,
    user_id INT NOT NULL,
    assessor_id INT NOT NULL,
    questions JSON NOT NULL,
    status VARCHAR(100) NOT NULL,

    CONSTRAINT fk_assessment_records_period_id FOREIGN KEY (period_id) REFERENCES assessment_periods(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_records_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_records_assessor_id FOREIGN KEY (assessor_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS assessment_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    record_id INT NOT NULL,
    user_id INT NOT NULL,
    question_index INT NOT NULL,

    CONSTRAINT fk_assessment_responses_record_id FOREIGN KEY (record_id) REFERENCES assessment_records(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_responses_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);