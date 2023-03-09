CREATE TABLE calendar
(
	id int identity(1,1) PRIMARY KEY,
	title varchar(300) NULL,
	description text NULL,
	start_date date NULL,
	start_time time,
	end_date date NULL,
	end_time time NULL,
	recurrence char(1) NULL,
	period char(1) NULL,
    category integer,
    id_api varchar(255),
    id_event_google varchar(255),
    recur_info varchar(255),
    event_color varchar(255),
    creator varchar(255),
    reminder varchar(255)
)
