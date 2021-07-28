create table IF NOT EXISTS products
(
    product_id     INTEGER not null
    primary key autoincrement,
    productName    TEXT,
    category    TEXT,
    quantity      INTEGER,
    price  REAL,
    image TEXT,
    code VARCHAR(100)
);