create table IF NOT EXISTS orderDetails
(
    orderDetails_id INTEGER      not null
        primary key autoincrement,
    orderCode       TEXT not null,
    customerID      INTEGER      not null,
    productCode     TEXT not null,
    orderDate       DATETIME,
    quantity        INTEGER,
    status          TEXT
);