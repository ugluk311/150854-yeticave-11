
  CREATE TABLE lots (
  lot_id INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR,
  description TEXT,
  url_image CHAR,
  first_price DECIMAL,
  date_finish TIMESTAMP,
  rate_step DECIMAL,
  user_id INT,
  winner INT,
  category_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (winner) REFERENCES users(user_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id)

  );
  CREATE TABLE users(
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  date_registration DATE,
  email CHAR NOT NULL UNIQUE,
  name CHAR NOT NULL,
  password CHAR NOT NULL,
  contact CHAR,
  lots_id INT,
  rate_id INT,
  FOREIGN KEY (lots_id) REFERENCES lots(lot_id),
  FOREIGN KEY (rate_id) REFERENCES rates(rate_id)
  );

  CREATE TABLE categories(
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category CHAR
  );

  CREATE TABLE rates(
  rate_id INT AUTO_INCREMENT PRIMARY KEY,
  date_post DATE,
  price DECIMAL NOT NULL,
  user_id INT,
  lot_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (lot_id) REFERENCES lots(lot_id)
  );

  CREATE UNIQUE INDEX i_email ON user(email);
  CREATE INDEX i_name ON user(name);
  CREATE INDEX title ON lot(title);
  CREATE INDEX date_finish ON lot(date_finish);
  CREATE INDEX date_post ON rate(date_post);