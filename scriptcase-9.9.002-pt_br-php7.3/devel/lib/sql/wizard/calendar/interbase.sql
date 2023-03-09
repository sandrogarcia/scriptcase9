CREATE TABLE calendar (
      id SMALLINT,
      title VARCHAR(300) CHARACTER SET NONE COLLATE NONE,
      description VARCHAR(600) CHARACTER SET NONE COLLATE NONE,
      start_date DATE,
      start_time TIME,
      end_date DATE,
      end_time TIME,
      recurrence CHAR(1) CHARACTER SET NONE COLLATE NONE,
      period CHAR(1) CHARACTER SET NONE COLLATE NONE,
      category		SMALLINT,
      id_api            varchar(255),
      id_event_google            varchar(255),
      recur_info        varchar(255),
      event_color		varchar(255),
      creator varchar(255),
      reminder varchar(255),
      CONSTRAINT PK_calendar_id PRIMARY KEY(id)
)
####SQLNM####
CREATE GENERATOR calendar_ID_GEN
####SQLNM####

SET GENERATOR calendar_ID_GEN TO 0
####SQLNM####
CREATE TRIGGER BI_calendar_ID FOR calendar
ACTIVE BEFORE INSERT
POSITION 0
AS
BEGIN
  IF (NEW.ID IS NULL) THEN
      NEW.ID = GEN_ID(calendar_ID_GEN, 1);
END
