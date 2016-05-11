
CREATE DATABASE IF NOT EXISTS crudrestspa_demo;

USE crudrestspa_demo;

DROP TABLE IF EXISTS calories;

DROP TABLE IF EXISTS user;

CREATE TABLE IF NOT EXISTS user
(
    user_id             INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_email          VARCHAR(255) NOT NULL UNIQUE,
    user_firstname      VARCHAR(255) NOT NULL,
    user_lastname       VARCHAR(255) NOT NULL,
    user_passwordhash   VARCHAR(255) NOT NULL,
    user_accesstoken    VARCHAR(255) NOT NULL UNIQUE,
    user_role           ENUM('user', 'manager', 'admin') DEFAULT 'user' NOT NULL,
    user_expectedcalories FLOAT NOT NULL DEFAULT 2500
);




CREATE TABLE IF NOT EXISTS calories
(
    calories_id         INTEGER PRIMARY KEY AUTO_INCREMENT,
    calories_datetime   DATETIME NOT NULL,
    calories_text       VARCHAR(255) NOT NULL,
    calories_number     FLOAT NOT NULL,
    user_id             INTEGER NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(user_id) ON DELETE CASCADE
);

INSERT INTO user(user_email, user_firstname, user_lastname, user_passwordhash,
    user_accesstoken) VALUES('vitaly.spirin@gmail.com', 'Vitaly', 'Spirin',
    '$2y$13$P8stiFqkafDBPwDhfypTSeUC3cr49rc8ropuV/GkRBOdzxdM/GSRG',
    'PEp982aMnzjjTFqItf8ORva0J9LgWGBt');


SET @ID = LAST_INSERT_ID();

INSERT INTO calories(calories_datetime, calories_text, calories_number, user_id) 
    VALUES('2016-04-06 09:01:01', 'rice', 1000, @ID);

INSERT INTO calories(calories_datetime, calories_text, calories_number, user_id) 
    VALUES('2016-04-06 13:01:01', 'noodles', 1000, @ID);
    
INSERT INTO calories(calories_datetime, calories_text, calories_number, user_id) 
    VALUES('2016-04-06 20:01:01', 'potato', 1000, @ID);
    
    
INSERT INTO calories(calories_datetime, calories_text, calories_number, user_id) 
    VALUES('2016-04-07 10:01:01', 'chicken', 1000, @ID);

INSERT INTO calories(calories_datetime, calories_text, calories_number, user_id) 
    VALUES('2016-04-07 12:01:01', 'beef', 1000, @ID);


INSERT INTO user(user_email, user_firstname, user_lastname, user_role, user_passwordhash,
    user_accesstoken) VALUES('john.smith@gmail.com', 'John', 'Smith', 'manager',
    '$2y$13$1GQxxx3z/vlt0ZWAEL2oLOH4TsIL.wbPkAQfH9NC4DtKq.2U89Dau',
    'LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS');


SET @ID = LAST_INSERT_ID();

INSERT INTO calories(calories_datetime, calories_text, calories_number, user_id) 
    VALUES('2016-04-01 19:01:01', 'orange', 1000, @ID);


INSERT INTO user(user_email, user_firstname, user_lastname, user_role, user_passwordhash,
    user_accesstoken) VALUES('david.black@gmail.com', 'David', 'Black', 'user',
    '$2y$13$NMDM5OJPGaTjFNOL2DIFiOrgssS5bL4KVeRpmhBHIQqsU/OeT.KBm',
    '7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04');
