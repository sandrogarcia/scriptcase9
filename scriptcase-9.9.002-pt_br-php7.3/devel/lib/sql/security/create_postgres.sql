/* Add table "sec_apps"                                                   */

CREATE TABLE sec_apps (
    app_name CHARACTER VARYING(128)   NOT NULL,
    app_type CHARACTER VARYING(255),
    description CHARACTER VARYING(255) ,
    PRIMARY KEY (app_name)
);

/* Add table "sec_groups"                                                 */

CREATE TABLE sec_groups (
    group_id SERIAL   NOT NULL,
    description CHARACTER VARYING(255) ,
    PRIMARY KEY (group_id)
);

/* Add table "sec_groups_apps"                                            */

CREATE TABLE sec_groups_apps (
    group_id INTEGER   NOT NULL,
    app_name CHARACTER VARYING(128)   NOT NULL,
    priv_access CHARACTER VARYING(1) ,
    priv_insert CHARACTER VARYING(1) ,
    priv_delete CHARACTER VARYING(1) ,
    priv_update CHARACTER VARYING(1) ,
    priv_export CHARACTER VARYING(1) ,
    priv_print CHARACTER VARYING(1) ,
    PRIMARY KEY (group_id, app_name)
);

/* Add table "sec_users"                                                  */

CREATE TABLE sec_users (
    login CHARACTER VARYING(255)   NOT NULL,
    pswd CHARACTER VARYING(255)   NOT NULL,
    name CHARACTER VARYING(64) ,
    email CHARACTER VARYING(64) ,
    active CHARACTER VARYING(1) ,
    activation_code CHARACTER VARYING(32) ,
    priv_admin CHARACTER VARYING(1) ,
    mfa CHARACTER VARYING(255) ,
    picture BYTEA,
    PRIMARY KEY (login)
);

/* Add table "sec_users_social"                                           */

CREATE TABLE sec_users_social (
  login CHARACTER VARYING(255) NOT NULL,
  resource CHARACTER VARYING(255) NOT NULL,
  resource_id CHARACTER VARYING(255) NOT NULL,
  PRIMARY KEY (login, resource, resource_id)
);

/* Add table "sec_users_apps"                                             */

CREATE TABLE sec_users_apps (
    login CHARACTER VARYING(255)   NOT NULL,
    app_name CHARACTER VARYING(128)   NOT NULL,
    priv_access CHARACTER VARYING(1) ,
    priv_insert CHARACTER VARYING(1) ,
    priv_delete CHARACTER VARYING(1) ,
    priv_update CHARACTER VARYING(1) ,
    priv_export CHARACTER VARYING(1) ,
    priv_print CHARACTER VARYING(1) ,
    PRIMARY KEY (login, app_name)
);

/* Add table "sec_users_groups"                                           */

CREATE TABLE sec_users_groups (
    login CHARACTER VARYING(255)   NOT NULL,
    group_id INTEGER   NOT NULL,
    PRIMARY KEY (login, group_id)
);

/* Add table "sec_logged"                                           */

CREATE TABLE "sec_logged" (
    login CHARACTER VARYING(255)  NOT NULL,
    date_login CHARACTER VARYING(128),
    sc_session CHARACTER VARYING(32),
    ip CHARACTER VARYING(32)
);


/* Add table "sec_settings"                                           */

CREATE TABLE sec_settings (
    set_name CHARACTER VARYING(255)  NOT NULL,
    set_value CHARACTER VARYING(255),
    PRIMARY KEY (set_name)
);