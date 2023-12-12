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

ALTER TABLE login_infomation ADD COLUMN level VARCHAR(10) AFTER id;



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
	level VARCHAR(15),
	tango VARCHAR(255),
	romaji VARCHAR(50),
	hiragana VARCHAR(255),
	type VARCHAR(255),
	mean VARCHAR(255)
);

-- Kanji
DROP TABLE IF EXISTS kanji
CREATE TABLE IF NOT EXISTS kanji(
	stt int PRIMARY KEY,
	level VARCHAR(15),
	kanji VARCHAR(255),
	onyomi_romaji VARCHAR(50),
	onyomi VARCHAR(50),
	kunyomi_romaji VARCHAR(50),
	kunyomi VARCHAR(50),
	kanji_mean VARCHAR(255)
);

-- Grammar
DROP TABLE IF EXISTS grammar
CREATE TABLE IF NOT EXISTS grammar(
	stt int PRIMARY KEY,
	level VARCHAR(15),
	grm_romaji VARCHAR(255),
	grm_hira VARCHAR(255),
	grm_mean VARCHAR(255)
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


//Contact
DROP TABLE IF EXISTS contact;
CREATE TABLE IF NOT EXISTS contact(
    id INT AUTO_INCREMENT PRIMARY KEY,     -- ID duy nhất cho mỗi liên hệ
    first_name VARCHAR(50) NOT NULL,       -- Tên
    last_name VARCHAR(50) NOT NULL,        -- Họ
    email VARCHAR(100),                    -- Địa chỉ Email
    country VARCHAR(25),
    phone_number VARCHAR(15),              -- Số điện thoại
    message TEXT,                          -- messsage
    remember_token VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Thời gian tạo bản ghi
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Thời gian cập nhật bản ghi
);


// reset password
CREATE TABLE password_resets (
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    INDEX password_resets_email_index (email)
);

//news
DROP TABLE IF EXISTS news;
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    images TEXT NOT NULL,
    audio TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


// NEWS FURIGANA
CREATE TABLE news_hiragana (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kanji VARCHAR(50),
    hiragana VARCHAR(50)
);

// INSERT DU LIỆU CHO table news_hiragana


INSERT INTO news_hiragana (kanji, hiragana) VALUES
('同一', 'どういつ'),
('食料不足対策', 'しょくりょうぶそくたいさく'),
('東農大', 'とうのうだい'),
('食研究','しょくけんきゅう'),
('人口', 'じんこう'),
('増加', 'ぞうか'),
('気候変動', 'きこうへんどう'),
('食料不足', 'しょくりょうぶそく'),
('解決策', 'かいけつさく'),
('東京農業大学', 'とうきょうのうぎょうだいがく'),
('新', 'あら'),
('食資源', 'しょくしげん'),
('活用', 'かつよう'),
('研究', 'けんきゅう'),
('発表', 'はっぴょう'),
('企業', 'きぎょう'),
('共', 'とも'),
('食用資源化', 'しょくようしげんか'),
('向', 'むこう'),
('行', 'こう'),
('日本', 'にほん'),
('生態系', 'せいたいけい'),
('脅', 'きょう'),
('今年', 'ことし'),
('月', 'つき'),
('条件付特定外来生物', 'じょうけんつきとくていがいらいせいぶつ'),
('特定', 'とくてい'),
('外来', 'がいらい'),
('生物', 'せいぶつ'),
('指定', 'してい'),
('販売', 'はんばい'),
('目的', 'もくてき'),
('飼育', 'しいく'),
('禁止', 'きんし'),
('養殖', 'ようしょく'),
('以上', 'いじょう'),
('主', 'おも'),
('中国', 'ちゅうごく'),
('食用', 'しょくよう'),
('高', 'たか'),
('たんぱく', 'たんぱく'),
('成長', 'せいちょう'),
('スピード', 'スピード'),
('速', 'はや'),
('生産', 'せいさん'),
('コスト', 'コスト'),
('低', 'ひく'),
('栄養', 'えいよう'),
('不足', 'ふそく'),
('深刻', 'しんこく'),
('食文化', 'しょくぶんか'),
('取', 'と'),
('入', 'にゅう'),
('続', 'つづ'),
('江口文陽学長', 'えぐちぶんようがくちょう'),
('学長', 'がくちょう'),
('砂抜き', 'すなぬき'),
('臭', 'にお'),
('非常', 'ひじょう'),
('素晴らしい', 'すばらしい'),
('食資源', 'しょくしげん'),
('感', 'かん'),
('世界各国', 'せかいかっこく'),
('生産', 'せいさん'),
('活用', 'かつよう'),
('意味', 'いみ'),
('話', 'はなし'),
('世界', 'せかい'),
('的','てき'),
('大', 'おお'),
('不具合', 'ふぐあい'),
('回目', 'かいめ'),
('万台', 'まんだい'),
('燃料', 'ねんりょう'),
('不具合', 'ふぐあい'),
    ('走行中', 'そうこうちゅう'),
    ('恐', 'おそ'),
    ('万台余', 'まんだいよ'),
    ('国土交通省', 'こくどこうつうしょう'),
    ('届', 'とどけ'),
    ('出', 'で'),
    ('対象', 'たいしょう'),
    ('年', 'ねん'),
    ('月', 'つき'),
    ('年', 'ねん'),
    ('月', 'つき'),
    ('製造', 'せいぞう'),
    ('万', 'まん'),
    ('台余', 'だいよ'),
    ('国交省', 'こっこうしょう'),
    ('内部', 'ないぶ'),
    ('変形', 'へんけい'),
    ('燃料', 'ねんりょう'),
    ('動', 'どう'),
    ('最悪', 'さいあく'),
    ('場合', 'ばあい'),
    ('走行中', 'そうこうちゅう'),
    ('恐', 'おそ'),
    ('件', 'けん'),
    ('不具合', 'ふぐあい'),
    ('確認', 'かくにん'),
    ('事故', 'じこ'),
    ('起', 'おこ'),
    ('同様', 'どうよう'),
    ('不具合', 'ふぐあい'),
    ('届', 'とどけ'),
    ('出', 'で'),
    ('回目', 'かいめ'),
    ('生産', 'せいさん'),
    ('車', 'くるま'),
    ('含', 'ふくむ'),
    ('合', 'ごう'),
    ('約', 'やく'),
    ('万台', 'まんだい'),
    ('上', 'うえ'),
    ('同様', 'どうよう'),
    ('事象', 'じしょう'),
    ('他社', 'たしゃ'),
    ('確認', 'かくにん'),
    ('一連', 'いちれん'),
    ('不具合', 'ふぐあい'),
    ('届', 'とどけ'),
    ('出', 'で'),
    ('年以降', 'ねんいこう'),
    ('合', 'ごう'),
    ('万台', 'まんだい'),
    ('超', 'ちょう');


INSERT INTO news_hiragana (kanji, hiragana) VALUES 
('氏', 'し'),
('年', 'ねん'),
('２４年', 'ねん'),
('大統領選', 'だいとうりょうせん'),
('出馬', 'しゅつば'),
('表明', 'ひょうめい'),
('大統領', 'だいとうりょう'),
('日', 'にち'),
('来年', 'らいねん'),
('月', 'がつ'),
('実施予定', 'じっしよてい'),
('大統領選', 'だいとうりょうせん'),
('出馬', 'しゅつば'),
('意向', 'いこう'),
('表明', 'ひょうめい'),
('通算', 'つうさん'),
('選目', 'せんもく'),
('目指', 'もくし'),
('出馬', 'しゅつば'),
('当選', 'とうせん'),
('少', 'すく'),
('年', 'ねん'),
('権力', 'けんりょく'),
('座', 'ざ'),
('維持', 'いじ'),
('選挙', 'せんきょ'),
('併合', 'へいごう'),
('各州', 'かくしゅう'),
('行', 'おこな'),
('初', 'はじ'),
('大統領選', 'だいとうりょうせん'),
('中央選管', 'ちゅうおうせんかん'),
('州', 'しゅう'),
('戸別訪問', 'こべつほうもん'),
('投票', 'とうひょう'),
('実施', 'じっし'),
('以前', 'いぜん'),
('親', 'しん'),
('派', 'は'),
('当局者', 'とうきょくしゃ'),
('際','さい'),
('地方選', 'ちほうせん'),
('国際社会', 'こくさいしゃかい'),
('茶番', 'ちゃばん'),
('非難', 'ひなん'),
('声', 'こえ'),
('上','あ');
