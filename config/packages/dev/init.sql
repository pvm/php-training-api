CREATE DATABASE IF NOT EXISTS dev;
CREATE DATABASE IF NOT EXISTS test;
GRANT ALL PRIVILEGES ON dev.* TO 'dev'@'%';
GRANT ALL PRIVILEGES ON test.* TO 'dev'@'%';
USE dev;