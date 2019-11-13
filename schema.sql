CREATE DATABASE jeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE jeticave;

CREATE TABLE categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(64),
  character_code VARCHAR(128) NOT NULL UNIQUE
  );

CREATE TABLE users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_registration DATETIME DEFAULT CURRENT_TIMESTAMP,
  email VARCHAR(128) NOT NULL UNIQUE,
  name VARCHAR(128) NOT NULL,
  password VARCHAR(128) NOT NULL,
  contact TEXT
  );

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title TEXT NOT NULL,
  description TEXT NOT NULL,
  url_image VARCHAR(200) NOT NULL,
  first_price DECIMAL NOT NULL,
  date_finish TIMESTAMP,
  bet_step DECIMAL,
  user_id INT NOT NULL,
  winner_id INT,
  category_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
  );

CREATE TABLE bets(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_post DATETIME DEFAULT CURRENT_TIMESTAMP,
  price DECIMAL NOT NULL,
  user_id INT,
  lot_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
  );

CREATE UNIQUE INDEX i_email ON users(email);
CREATE INDEX i_name ON users(name);
CREATE INDEX date_finish ON lots(date_finish);
CREATE INDEX date_post ON bets(date_post);