DROP DATABASE IF EXISTS livechat;
CREATE DATABASE IF NOT EXISTS livechat;
USE livechat;
CREATE TABLE IF NOT EXISTS USERS (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    user_name VARCHAR(30) UNIQUE,
    profile_image VARCHAR(256) NULL,
    email VARCHAR(30) UNIQUE NOT NULL,
    gender VARCHAR(10) NULL,
    about VARCHAR(200) NULL,
    pasword VARCHAR(100) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP NULL,
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS `GROUPS`(
    id INT NOT NULL AUTO_INCREMENT,
    `group_name` VARCHAR(30),
    `about_group` TEXT,
    `group_owner` INT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (group_owner) REFERENCES USERS(id)
);
CREATE TABLE IF NOT EXISTS USERS_CHATS(
    id INT AUTO_INCREMENT,
    from_user INT,
    to_user INT,
    attachment TEXT NULL,
    msg VARCHAR(255),
    created_at TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (from_user) REFERENCES USERS(id),
    FOREIGN KEY (to_user) REFERENCES USERS(id)
);
CREATE TABLE IF NOT EXISTS GROUPS_CHATS(
    id INT AUTO_INCREMENT,
    from_user INT,
    group_id INT,
    attachment TEXT NULL,
    msg VARCHAR(255),
    created_at TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (group_id) REFERENCES `GROUPS`(id)
);
CREATE TABLE IF NOT EXISTS GROUPS_SUBSCRIBERS(
    id INT AUTO_INCREMENT,
    group_id INT,
    user_id INT,
    created_at TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (group_id) REFERENCES `GROUPS`(id),
    FOREIGN KEY (user_id) REFERENCES USERS(id)
);
CREATE TABLE IF NOT EXISTS USER_UPLOADS(
    id INT AUTO_INCREMENT,
    user_id INT,
    file_name VARCHAR(100),
    file_type VARCHAR(7),
    created_at TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES `USERS`(id)
);