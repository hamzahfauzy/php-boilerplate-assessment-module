ALTER TABLE assessment_records ADD COLUMN record_type VARCHAR(100) DEFAULT NULL;
ALTER TABLE assessment_records MODIFY COLUMN questions JSON DEFAULT NULL;