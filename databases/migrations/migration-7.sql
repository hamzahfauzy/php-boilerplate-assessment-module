CREATE TABLE IF NOT EXISTS assessment_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    period_id INT NOT NULL,
    user_id INT NOT NULL,
    instrument_id INT NOT NULL,
    commenter_id INT NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_assessment_comments_period_id FOREIGN KEY (period_id) REFERENCES assessment_periods(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_comments_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_comments_instrument_id FOREIGN KEY (instrument_id) REFERENCES assessment_instruments(id) ON DELETE CASCADE,
    CONSTRAINT fk_assessment_comments_commenter_id FOREIGN KEY (commenter_id) REFERENCES users(id) ON DELETE CASCADE
);