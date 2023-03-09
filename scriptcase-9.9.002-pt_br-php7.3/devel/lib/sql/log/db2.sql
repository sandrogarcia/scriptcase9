CREATE TABLE tabela_log (
    id	integer not null GENERATED ALWAYS AS IDENTITY (START WITH 1 INCREMENT BY 1),
    inserted_date timestamp,
    username varchar(90) NOT NULL,
    application varchar(255) NOT NULL,
    creator varchar(30) NOT NULL,
    ip_user varchar(255) NOT NULL,
    action varchar(30) NOT NULL,
    description CLOB,
    PRIMARY KEY (id)
)