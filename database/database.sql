-- Create database
CREATE DATABASE 3tpanDB;
CREATE USER 3tpan IDENTIFIED WITH MYSQL_NATIVE_PASSWORD BY 'ecc';
GRANT ALL ON 3tpanDB.* TO 3tpan;
use 3tpanDB;


-- Thong tin dang nhap
DROP TABLE IF EXISTS login_infomation;
CREATE TABLE IF NOT EXISTS login_infomation(
  id SMALLINT AUTO_INCREMENT,
  admin INT(1) NOT NULL DEFAULT '0',
  user VARCHAR(50) UNIQUE NOT NULL,
  fullnameUser VARCHAR(50) UNIQUE,
  password VARCHAR(255) NOT NULL,
  email TEXT NOT NULL,
  created_time datetime  NULL,
  last_updated datetime  NULL,
  PRIMARY KEY (id)
);
-- them token
ALTER TABLE login_infomation ADD COLUMN remember_token VARCHAR(100) NULL AFTER email;


-- foreign key

-- insert
INSERT INTO login_infomation (`admin`, `user`, `fullnameUser`, `password`, `email`)
VALUES (1, 'admin', 'admin', '123456', 'admin@gmail.com');

-- alphabet
CREATE TABLE alphabet (
	stt int PRIMARY KEY,
	hiragana VARCHAR(255) NOT NULL,
	katakana VARCHAR(255) NOT NULL,
	romaji VARCHAR(255) NOT NULL
);


-- Vocabulary
DROP TABLE IF EXISTS vocabulary;
CREATE TABLE IF NOT EXISTS vocabulary(
	stt int PRIMARY KEY,
	lever VARCHAR(15),
	tango VARCHAR(255),
	romaji VARCHAR(50),
	hiragana VARCHAR(255),
	type VARCHAR(255),
	mean VARCHAR(255)
);

DELETE FROM vocabulary WHERE stt IS NULL;


--THEM INDEX cho cột stt
ALTER TABLE vocabulary ADD INDEX (stt);
-- Đảm bảo rằng bảng `vocabulary` được tạo với cột `stt` là `INT UNSIGNED`
ALTER TABLE `vocabulary` MODIFY `stt` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY;

-- user_vocabulary
DROP TABLE IF EXISTS user_vocabulary;
CREATE TABLE IF NOT EXISTS `user_vocabulary` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` SMALLINT NOT NULL, -- Lưu ý đã bỏ `UNSIGNED`
  `vocabulary_id` INT UNSIGNED NOT NULL, -- Đảm bảo `stt` trong `vocabulary` cũng là `INT UNSIGNED` và đã được đánh index
  `learned` BOOLEAN DEFAULT FALSE,
  `review_time` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `login_infomation`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`vocabulary_id`) REFERENCES `vocabulary`(`stt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






--comment
DROP TABLE IF EXISTS tango_comment;
CREATE TABLE IF NOT EXISTS tango_comment(
	user VARCHAR(50) NOT NULL,
	tango VARCHAR(50),
	comment TEXT,
	created_time datetime  NULL,
  	last_updated datetime  NULL
);




