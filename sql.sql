CREATE TABLE customer(
  id int AUTO_INCREMENT PRIMARY KEY,
  name varchar(70),
  address text,
  subdistrict_id int,
  account varchar(70),
  phone varchar(15),
  status varchar(50),
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE purchase(
  id int AUTO_INCREMENT PRIMARY KEY,
  customer_id int,
  dates date,
  name varchar(70),
  phone varchar(15),
  account varchar(70),
  subdistrict_id int,
  address text,
  shipping varchar(25),
  expedition varchar(25),
  prices varchar(25),
  commission varchar(25),
  status varchar(25),
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE items(
  id int AUTO_INCREMENT PRIMARY KEY,
  purchase_id int,
  item_id int,
  price_id int,
  customer_id int,
  name varchar(70),
  price varchar(70),
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE item(
  id int AUTO_INCREMENT PRIMARY KEY,
  name varchar(70),
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE price(
  id int AUTO_INCREMENT PRIMARY KEY,
  item_id int,
  value varchar(25),
  status varchar(25) DEFAULT 'Aktif',
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE commission(
  id int AUTO_INCREMENT PRIMARY KEY,
  percent varchar(25),
  status varchar(25) DEFAULT 'Aktif',
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE(
  id int AUTO_INCREMENT PRIMARY KEY,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);