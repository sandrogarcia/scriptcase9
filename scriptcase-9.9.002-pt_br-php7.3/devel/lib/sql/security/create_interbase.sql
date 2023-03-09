CREATE ROLE RDB$ADMIN;

/* Add table "SEC_APPS"                                                   */

CREATE TABLE SEC_APPS (
    APP_NAME VARCHAR(128) NOT NULL,
    APP_TYPE VARCHAR(255),
    DESCRIPTION VARCHAR(255)
);

/* Add table "SEC_GROUPS"                                                 */

CREATE TABLE SEC_GROUPS (
    GROUP_ID INTEGER NOT NULL,
    DESCRIPTION VARCHAR(255)
);


/* Add table "SEC_GROUPS_APPS"                                            */

CREATE TABLE SEC_GROUPS_APPS (
    GROUP_ID INTEGER NOT NULL,
    APP_NAME VARCHAR(128) NOT NULL,
    PRIV_ACCESS VARCHAR(1),
    PRIV_INSERT VARCHAR(1),
    PRIV_DELETE VARCHAR(1),
    PRIV_UPDATE VARCHAR(1),
    PRIV_EXPORT VARCHAR(1),
    PRIV_PRINT VARCHAR(1)
);


/* Add table "SEC_USERS"                                                  */

CREATE TABLE SEC_USERS (
    LOGIN VARCHAR(128) NOT NULL,
    PSWD VARCHAR(255) NOT NULL,
    NAME VARCHAR(64),
    EMAIL VARCHAR(64),
    "ACTIVE" VARCHAR(1),
    ACTIVATION_CODE VARCHAR(32),
    PRIV_ADMIN VARCHAR(1),
    MFA VARCHAR(255),
    PICTURE BLOB SUB_TYPE BINARY
);


/* Add table "SEC_USERS_SOCIAL"                                           */

CREATE TABLE SEC_USERS_SOCIAL (
  LOGIN VARCHAR(255) NOT NULL,
  RESOURCE VARCHAR(255) NOT NULL,
  RESOURCE_ID VARCHAR(255) NOT NULL
);


/* Add table "SEC_USERS_APPS"                                             */

CREATE TABLE SEC_USERS_APPS (
    LOGIN VARCHAR(128) NOT NULL,
    APP_NAME VARCHAR(128) NOT NULL,
    PRIV_ACCESS VARCHAR(1),
    PRIV_INSERT VARCHAR(1),
    PRIV_DELETE VARCHAR(1),
    PRIV_UPDATE VARCHAR(1),
    PRIV_EXPORT VARCHAR(1),
    PRIV_PRINT VARCHAR(1)
);


/* Add table "SEC_USERS_GROUPS"                                           */

CREATE TABLE SEC_USERS_GROUPS (
    LOGIN VARCHAR(128) NOT NULL,
    GROUP_ID INTEGER NOT NULL
);


/* Add table "SEC_LOGGED"                                           */

CREATE TABLE SEC_LOGGED (
    LOGIN VARCHAR(128)  NOT NULL,
    DATE_LOGIN VARCHAR(128),
    SC_SESSION VARCHAR(32),
    IP VARCHAR(32)
);

/* Add table "SEC_SETTINGS"                                        */

CREATE TABLE SEC_SETTINGS (
    SET_NAME VARCHAR(255) NOT NULL,
    SET_VALUE VARCHAR(255)
);
