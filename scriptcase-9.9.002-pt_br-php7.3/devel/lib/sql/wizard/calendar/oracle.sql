CREATE TABLE calendar (
      id		int NOT NULL ,
      title 		varchar(300) NOT NULL,
      description 	CLOB,
      start_date	date NOT NULL,
      start_time	date,
      end_date		date,
      end_time		date,
      recurrence	varchar(1),
      period		varchar(1),
      category		int,
      id_api            varchar(255),
      id_event_google   varchar(255),
      recur_info  varchar(255),
      event_color	varchar(255),
      creator varchar(255),
      reminder varchar(255),
      PRIMARY KEY (id)
    )
