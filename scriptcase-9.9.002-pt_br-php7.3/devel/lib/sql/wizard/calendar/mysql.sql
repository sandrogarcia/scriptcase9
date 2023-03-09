CREATE TABLE calendar (
      id		int(11) NOT NULL AUTO_INCREMENT,
      title		varchar(300) NOT NULL,
      description	text,
      start_date	date NOT NULL,
      start_time	time,
      end_date	date,
      end_time	time,
      recurrence	varchar(1),
      period		varchar(1),
      category		int,
      id_api            varchar(255),
      id_event_google   varchar(255),
      recur_info        varchar(255),
      event_color		varchar(255),
      creator varchar(255),
      reminder varchar(255),
      PRIMARY KEY (id)
    )
