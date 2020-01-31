CREATE TABLE CV (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
fileToUpload VARCHAR(60),
name VARCHAR(30) NOT NULL,
surname VARCHAR(30) NOT NULL,
bday DATE,
email VARCHAR(50),
language TEXT,
lanSpeak TEXT,
lanRead TEXT,
lanWrite TEXT,
eduName TEXT,
eduFrom TEXT,
eduTo TEXT,
eduSpec TEXT
)
