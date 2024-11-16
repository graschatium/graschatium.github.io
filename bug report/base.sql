CREATE TABLE bug_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    bug_type VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    steps TEXT,
    screenshot TEXT,
    submitted_at DATETIME NOT NULL
);
