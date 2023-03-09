/* Add table "sec_apps"                                                   */

CREATE TABLE sec_apps (
    app_name varchar(128) NOT NULL,
    app_type varchar(255) NULL,
    description varchar(255) NULL,
    PRIMARY KEY (app_name)
);


/* Add table "sec_groups"                                                 */

CREATE TABLE sec_groups (
    group_id integer NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (group_id)
);


/* Add table "sec_groups_apps"                                            */

CREATE TABLE sec_groups_apps (
    group_id integer NOT NULL,
    app_name varchar(128) NOT NULL,
    priv_access varchar(1) NULL,
    priv_insert varchar(1) NULL,
    priv_delete varchar(1) NULL,
    priv_update varchar(1) NULL,
    priv_export varchar(1) NULL,
    priv_print varchar(1) NULL,
    PRIMARY KEY (group_id, app_name)
);


/* Add table "sec_users"                                                  */

CREATE TABLE sec_users (
    login varchar(255) NOT NULL,
    pswd varchar(255) NOT NULL,
    name varchar(64) NULL,
    email varchar(64),
    active varchar(1) NULL,
    activation_code varchar(32) NULL,
    priv_admin varchar(1) NULL,
    mfa varchar(255) NULL,
    picture IMAGE NULL,
    PRIMARY KEY (login)
);


/* Add table "sec_users_social"                                            */

CREATE TABLE sec_users_social (
  login VARCHAR(255) NOT NULL,
  resource VARCHAR(255) NOT NULL,
  resource_id VARCHAR(255) NOT NULL,
  PRIMARY KEY (login, resource, resource_id)
);

/* Add table "sec_users_apps"                                             */

CREATE TABLE sec_users_apps (
    login varchar(255) NOT NULL,
    app_name varchar(128) NOT NULL,
    priv_access varchar(1),
    priv_insert varchar(1),
    priv_delete varchar(1),
    priv_update varchar(1),
    priv_export varchar(1),
    priv_print varchar(1),
    PRIMARY KEY (login, app_name)
);

/* Add table "sec_users_groups"                                           */

CREATE TABLE sec_users_groups (
    login varchar(255) NOT NULL,
    group_id integer NOT NULL,
    PRIMARY KEY (login, group_id)
);

/* Add table "sec_logged"                                           */

CREATE TABLE sec_logged (
    login varchar(255) NOT NULL,
    date_login varchar(128),
    sc_session varchar(32),
    ip varchar(32) NULL
);

/* Add table "sec_settings"                                           */

CREATE TABLE sec_settings (
    set_name varchar(255) NOT NULL,
    set_value varchar(255),
    PRIMARY KEY ( set_name )
);
