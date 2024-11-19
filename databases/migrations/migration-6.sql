CREATE TABLE IF NOT EXISTS assessment_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    NIDN VARCHAR(100) NOT NULL,
    pangkat VARCHAR(100) NOT NULL,
    golongan VARCHAR(100) NOT NULL,
    jab_struktural VARCHAR(100) NOT NULL,
    jab_akademik VARCHAR(100) NOT NULL,
    perguruan_tinggi VARCHAR(100) NOT NULL,
    fakultas VARCHAR(100) NOT NULL,
    program_studi VARCHAR(100) NOT NULL,

    CONSTRAINT fk_assessment_profiles_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);