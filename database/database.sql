CREATE DATABASE 3tpanDB;
CREATE USER 3tpan IDENTIFIED WITH MYSQL_NATIVE_PASSWORD BY 'ecc';
GRANT ALL ON 3tpanDB.* TO 3tpan;
use 3tpanDB;



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


ALTER TABLE login_infomation ADD COLUMN remember_token VARCHAR(100) NULL AFTER email;

ALTER TABLE login_infomation ADD COLUMN level VARCHAR(10) AFTER id;

ALTER TABLE login_infomation ADD COLUMN payment_status BOOLEAN default FALSE after id;


INSERT INTO login_infomation (`admin`, `user`, `fullnameUser`, `password`, `email`)
VALUES (1, 'admin', 'admin', '$2y$10$/Vt4lzYoW5QS22XnoWzZ.uxsg3goC43KxOHVqEjhhgjn76XtyPR/W', 'admin@gmail.com');



DROP TABLE IF EXISTS vocabulary;
CREATE TABLE IF NOT EXISTS vocabulary (
    stt INT PRIMARY KEY,
    level VARCHAR(15),
    tango VARCHAR(255),
    romaji VARCHAR(50),
    hiragana VARCHAR(255),
    type VARCHAR(255),
    mean VARCHAR(255)
);



DROP TABLE IF EXISTS kanji;
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


DROP TABLE IF EXISTS grammar;
CREATE TABLE IF NOT EXISTS grammar(
	stt int PRIMARY KEY,
	level VARCHAR(15),
	grm_romaji VARCHAR(255),
	grm_hira VARCHAR(255),
	grm_mean VARCHAR(255)
);

DELETE FROM vocabulary WHERE stt IS NULL;

ALTER TABLE vocabulary ADD INDEX (stt);


CREATE TABLE IF NOT EXISTS `user_vocabulary` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` SMALLINT NOT NULL,
    `vocabulary_id` INT NOT NULL,
    `learned` BOOLEAN DEFAULT FALSE,
    `review_time` DATETIME DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `login_infomation`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`vocabulary_id`) REFERENCES `vocabulary`(`stt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;








DROP TABLE IF EXISTS tango_comment;
CREATE TABLE IF NOT EXISTS tango_comment(
	user VARCHAR(50) NOT NULL,
	tango VARCHAR(50),
	comment TEXT,
	created_time datetime  NULL,
  	last_updated datetime  NULL
);


DROP TABLE IF EXISTS contact;
CREATE TABLE IF NOT EXISTS contact(
    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(15) DEFAULT '処理中',
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    country VARCHAR(25),
    phone_number VARCHAR(15),
    message TEXT,
    remember_token VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



DROP TABLE IF EXISTS password_resets;
CREATE TABLE IF NOT EXISTS password_resets (
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    INDEX password_resets_email_index (email)
);


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




CREATE TABLE news_hiragana (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kanji VARCHAR(50),
    hiragana VARCHAR(50)
);




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



INSERT INTO news_hiragana (kanji, hiragana) VALUES
('旧', 'きゅう'),
('所有', 'しょゆう'),
('米起業家', 'べいきぎょうか'),
('日', 'にち'),
('広告', 'こうこく'),
('引', 'ひき'),
('揚', 'あげ'),
('米', 'こめ'),
('最高経営責任者', 'さいこうけいえいせきにんしゃ'),
('決定', 'けってい'),
('批判', 'ひはん'),
('強制解任', 'きょうせいかいにん'),
('明言', 'めいげん'),
('直', 'ちょく'),
('解任', 'かいにん'),
('書', 'しょ'),
('込', 'こむ'),
('創業者', 'そうぎょうしゃ'),
('自分', 'じぶん'),
('会社', 'かいしゃ'),
('見', 'み'),
('墓', 'はか'),
('中', 'なか'),
('安', 'あん'),
('眠', 'ねむ'),
('述', 'じゅつ'),
('代理人', 'だいりにん'),
('求', 'きゅう'),
('現時点', 'げんじてん'),
('応', 'おう'),
('最初', 'さいしょ'),
('任期中', 'にんきちゅう'),
('巧', 'たくみ'),
('買収', 'ばいしゅう'),
('通', 'つう'),
('巨大', 'きょだい'),
('企業', 'きぎょう'),
('押', 'おす'),
('上', 'うえ'),
('手腕', 'しゅわん'),
('広', 'ひろ'),
('評価', 'ひょうか'),
('先月', 'せんげつ'),
('他', 'た'),
('多', 'おお'),
('大企業', 'だいきぎょう'),
('同様', 'どうよう'),
('広告出稿', 'こうこくしゅつこう'),
('停止', 'ていし'),
('氏', 'うじ'),
('白人至上主義者', 'はくじんししょうしゅぎしゃ'),
('間', 'あいだ'),
('受', 'うけ'),
('良', 'よ'),
('反', 'はん'),
('主義陰謀論', 'しゅぎいんぼうろん'),
('支持', 'しじ'),
('企業', 'きぎょう'),
('相次', 'あいつ'),
('関係', 'かんけい'),
('断', 'た'),
('受', 'うけ'),
('氏', 'うじ'),
('先週', 'せんしゅう'),
('問題', 'もんだい'),
('投稿', 'とうこう'),
('暗', 'くら'),
('謝罪', 'しゃざい'),
('同時', 'どうじ'),
('広告購入', 'こうこくこうにゅう'),
('控', 'ひか'),
('企業', 'きぎょう'),
('汚', 'よご'),
('言葉', 'ことば'),
('交', 'まじ'),
('罵倒', 'ばとう'),
('米紙', 'べいし'),
('登壇', 'とうだん'),
('言葉', 'ことば'),
('連発', 'れんぱつ'),
('先立', 'さきだ'),
('理由', 'りゆう'),
('広告出稿停止', 'こうこくしゅつこうていし'),
('決', 'けつ'),
('説明', 'せつめい'),
('氏', 'うじ'),
('名指', 'めいし'),
('罵詈', 'ばり'),
('雑言', 'ぞうごん'),
('浴', 'あび'),
('場面', 'ばめん'),
('年後半', 'としごはん'),
('買収', 'ばいしゅう'),
('以降', 'いこう'),
('憎悪表現', 'ぞうおひょうげん'),
('誤情報', 'ごじょうほう'),
('陰謀論', 'いんぼうろん'),
('増加', 'ぞうか'),
('招', 'まね'),
('決定', 'けってい'),
('相次', 'あいつ'),
('下', 'した');


INSERT INTO news_hiragana (kanji, hiragana) VALUES
('要求', 'ようきゅう'),
('広告引き', 'こうこくひき');




DROP TABLE IF EXISTS kanji;
CREATE TABLE IF NOT EXISTS kanji (
	id INT AUTO_INCREMENT PRIMARY KEY,
	kanji VARCHAR(25),
	kanji_svg VARCHAR(25),
	kunyomi VARCHAR(255),
	onyomi VARCHAR(255),
	mean VARCHAR(255)
);

INSERT INTO kanji (kanji, kanji_svg, kunyomi, onyomi, mean)
VALUES
('鈴', '0f9b1', 'すず', 'レイ、 リン', 'small bell, buzzer'),
('零', '0f9b2', 'ぜろ、 こぼ.す、 こぼ.れる', 'レイ', 'zero, spill, overflow, nothing, cipher'),
('領', '0f9b4', 'えり', 'リョウ', 'jurisdiction, dominion, territory, fief, reign'),
('冷', '0f92e', 'つめ.たい、 ひ.える、 ひ.や、 ひ.ややか、 ひ.やす、 ひ.やかす、 さ.める、 さ.ます', 'レイ', 'cool, cold (beer, person), chill'),
('万', '04e07', ' よろず', 'マン、 バン', 'ten thousand'),
('香', '09999', ' か、 かおり、 かおる', ' コウ、 キョウ', 'incense, smell, perfume'),
('下', '04e0b', ' した、 しも、 もと、 さ.げる、 さ.がる、 くだ.る、 くだ.り、 くだ.す、 -くだ.す、 くだ.さる、 お.ろす、 お.りる', '  カ、 ゲ', 'below, down, descend, give, low, inferior '),
('不', '04e0d', ' NULL', ' フ、 ブ ','negative, non-, bad, ugly, clumsy'),
('与', '04e0e', 'あた.える、 あずか.る、 くみ.する、 ともに', 'ヨ', 'bestow, participate in, give, award, impart, provide, cause, gift, godsend'),
('丁', '04e01', 'ひのと', 'チョウ、 テイ、 チン、 トウ、 チ', 'street, ward, town, counter for guns, tools, leaves or cakes of something, even number, 4th calendar sign'),
('丞', '04e1e', 'ひのと', 'チョウ、 テイ、 チン、 トウ、 チ', 'street, ward, town, counter for guns, tools, leaves or cakes of something, even number, 4th calendar sign'),
('中', '04e2d', 'なか、 うち、 あた.る', 'チュウ', 'in, inside, middle, mean, center'),
('七', '04e03', ' なな、 なな.つ、 なの', 'シチ', 'seven'),
('主', '04e3b-VtLst', 'ぬし、 おも、 あるじ', 'シュ、 ス、 シュウ', 'lord, chief, master, main thing, principal'),
('丼', '04e3c', 'どんぶり', ' トン、 タン、 ショウ、 セイ', 'bowl, bowl of food'),
('乾', '04e7e-Kaisho', 'かわ.く、 かわ.かす、 ほ.す、 ひ.る、 いぬい', 'カン、 ケン', 'drought, dry, dessicate, drink up, heaven, emperor'),
('事', '04e8b', 'こと、 つか.う、 つか.える', 'ジ、 ズ', 'matter, thing, fact, business, reason, possibly'),
('世', '04e16', 'よ', 'セイ、 セ、 ソウ', 'generation, world, society, public'),
('両', '04e21', 'てる、 ふたつ', 'リョウ', 'both, old Japanese coin, counter for carriages (e.g., in a train), two'),
('並', '04e26', ' な.み、 なみ、 なら.べる、 なら.ぶ、 なら.びに', 'ヘイ、 ホウ', 'row, and, besides, as well as, line up, rank with, rival, equal'),
('串', '04e32', 'くし、 つらぬ.く', 'カン、 ケン、 セン', 'spit, skewer'),
('丸', '04e38', 'まる、 まる.める、 まる.い', 'ガン', 'round, full (month), perfection, -ship, pills, make round, roll up, curl up, seduce, explain away'),
('乗', '04e57', 'の.る、 -の.り、 の.せる', ' ジョウ、 ショウ', 'ride, power, multiplication, record, counter for vehicles, board, mount, join'),
('乱', '04e71', 'みだ.れる、 みだ.る、 みだ.す、 みだ、 おさ.める、 わた.る', ' ラン、 ロン', 'riot, war, disorder, disturb'),
('乳', '04e73', ' ちち、 ち', 'ニュウ', 'milk, breasts'),
('亀', '04e80', 'かめ', 'キ、 キュウ、 キン', 'tortoise, turtle'),
('予', '04e88', 'あらかじ.め', 'ヨ、 シャ', 'beforehand, previous, myself, I'),
('互', '04e92', 'たが.い、 かたみ.に', 'ゴ', 'mutually, reciprocally, together');



ALTER TABLE login_infomation ADD COLUMN images TEXT AFTER email;


DROP TABLES IF EXISTS videos;
CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    url VARCHAR(255) NOT NULL,
    images TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO videos (title, description, url, images)
VALUES 
('Mieruko-chan-Episode-1', 'Mieruko-chan-Episode-1', 'videos/MierukoChanEpisode1.mp4', null),
('Mieruko-chan-Episode-2', 'Mieruko-chan-Episode-2', 'videos/mierukochanepisode2.mp4', 'images/Mieruko-chan-Episode-2.jpg'),
('Movie Title', 'Movie', 'videos/movie.mp4', 'images/movie.jpg');
