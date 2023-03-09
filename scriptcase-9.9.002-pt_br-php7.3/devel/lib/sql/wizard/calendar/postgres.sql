CREATE TABLE calendar
    (
		id serial PRIMARY KEY,
		title character varying(300),
		description text,
		start_date date,
		start_time time without time zone,
		end_date date,
		end_time time without time zone,
		recurrence character(1),
		period character(1),
     	category		integer,
      	id_api		character varying(255),
      	id_event_google		character varying(255),
      	recur_info		character varying(255),
      	event_color		character varying(255),
      	creator varchar(255),
      reminder varchar(255)
    )
