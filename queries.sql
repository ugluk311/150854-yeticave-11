-- Добавляем данные в таблицу категорий
INSERT INTO categories
(category, character_code) VALUES ('Доски и лыжи', 'boards');
INSERT INTO categories
(category, character_code) VALUES ('Крепления', 'attachment');
INSERT INTO categories
(category, character_code) VALUES ('Ботинки', 'boots');
INSERT INTO categories
(category, character_code) VALUES ('Одежда', 'clothing');
INSERT INTO categories
(category, character_code) VALUES ('Инструменты', 'tools');
INSERT INTO categories
(category, character_code) VALUES ('Разное', 'other');


-- Добавляем данные в таблицу пользователей
INSERT INTO users
(email, name, password, contact) VALUES ('john@gmail.ru', 'Джон', 'jOhn321', 'Skype: John');
INSERT INTO users
(email, name, password, contact) VALUES ('harry@gmail.ru', 'Гарри', 'hArry321', 'Skype: Harry');


-- Добавляем данные в таблицу объявлений
INSERT INTO lots
SET title = '2014 Rossignol District Snowboard',
    description = 'доска чемпионов',
    url_image = 'img/lot-1.jpg',
    first_price = 10999,
    date_finish = '2019-11-07',
    user_id = 1,
    category_id = 1;
INSERT INTO lots
SET title = 'DC Ply Mens 2016/2017 Snowboard',
    description = 'доска богов',
    url_image = 'img/lot-2.jpg',
    first_price = 159999,
    date_finish = '2019-11-08',
    user_id = 1,
    category_id = 1;
INSERT INTO lots
SET title = 'Крепления Union Contact Pro 2015 года размер L/XL',
    description = 'доска богов',
    url_image = 'img/lot-3.jpg',
    first_price = 8000,
    date_finish = '2019-11-09',
    user_id = 1,
    category_id = 2;
INSERT INTO lots
SET title = 'Ботинки для сноуборда DC Mutiny Charocal',
    description = 'изящные лабутены',
    url_image = 'img/lot-4.jpg',
    first_price = 10999,
    date_finish = '2019-11-07',
    user_id = 2,
    category_id = 3;
INSERT INTO lots
SET title = 'Куртка для сноуборда DC Mutiny Charocal',
    description = 'Куртка антихолод',
    url_image = 'img/lot-5.jpg',
    first_price = 7500,
    date_finish = '2019-11-06',
    user_id = 2,
    category_id = 4;
INSERT INTO lots
SET title = 'Маска Oakley Canopy',
    description = 'доска богов',
    url_image = 'img/lot-6.jpg',
    first_price = 5400,
    date_finish = '2019-11-11',
    user_id = 2,
    category_id = 6;


-- Добавляем данные в таблицу ставок
INSERT INTO bets
(price, user_id, lot_id) VALUES (6000, 1, 6);
INSERT INTO bets
(price, user_id, lot_id) VALUES (8500, 2, 3);




-- Получаем все категории
SELECT category FROM categories;

-- Получаем самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, текущую цену, название категории;
SELECT title, first_price, url_image, c.category,
IFNULL((SELECT price FROM bets WHERE lot_id = l.id ORDER BY date_post DESC LIMIT 1), l.first_price) AS last_price
FROM lots l
JOIN bets b ON l.id = b.lot_id
JOIN categories c ON l.category_id = c.id
WHERE date_finish > NOW()
ORDER BY b.date_post DESC;

-- Показываем лот по его id. Получите также название категории, к которой принадлежит лот;
SELECT title, c.category FROM lots l
JOIN categories c ON l.category_id = c.id
WHERE l.id = 4;

-- Обновляем название лота по его идентификатору;
UPDATE lots SET title = 'Maska'
WHERE id = 6;

-- Получаем список ставок для лота по его идентификатору с сортировкой по дате.
SELECT price, date_post FROM bets
WHERE lot_id = 6
ORDER BY date_post DESC;