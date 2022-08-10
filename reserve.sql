CREATE TABLE 'reserve'(
    'id' int NOT NULL,
    'reserve_date' date NOT NULL,
    'reserve_time' time NOT NULL,
    'reserve_num' int NOT NULL,
    'name' varchar(100)COLLATE utf8mb4_bin NOT NULL,
    'email' varchar(254)COLLATE utf8mb4_bin NOT NULL,
    'tel' varchar(20)COLLATE utf8mb4_bin NOT NULL,
    'comment' mediumtext COLLATE utf8mb4_bin
)ENGLISH=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;