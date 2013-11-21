CREATE TABLE Galleries (
  id            int(10) NOT NULL AUTO_INCREMENT, 
  user_id       int(10) NOT NULL, 
  name          varchar(32) NOT NULL, 
  views         int(10) DEFAULT 0, 
  favourites    int(10) DEFAULT 0, 
  description   varchar(255), 
  tumbnail_href varchar(255), 
  PRIMARY KEY (id)) CHARACTER SET UTF8;
CREATE TABLE Users (
  id         int(10) NOT NULL AUTO_INCREMENT, 
  login      varchar(32) NOT NULL, 
  name       varchar(32), 
  surname    varchar(32), 
  email      varchar(255) NOT NULL, 
  password   varchar(32) NOT NULL, 
  city       varchar(32), 
  gender     varchar(1), 
  birth_date date, 
  avatar     varchar(255) DEFAULT 'src/img/default_user_avatar.png', 
  PRIMARY KEY (id)) CHARACTER SET UTF8;
CREATE TABLE Photos (
  id            int(10) NOT NULL AUTO_INCREMENT, 
  href          varchar(255) NOT NULL, 
  tumbnail_href varchar(255) NOT NULL, 
  name          varchar(32), 
  views         int(10) DEFAULT 0, 
  favourites    int(10) DEFAULT 0, 
  width         int(5) NOT NULL, 
  height        int(5) NOT NULL, 
  camera        varchar(32), 
  software      varchar(32), 
  `date`        datetime NULL, 
  add_date      datetime NOT NULL, 
  exposure_time varchar(32), 
  f_number      varchar(32), 
  PRIMARY KEY (id)) CHARACTER SET UTF8;
CREATE TABLE Comments (
  user_id  int(10) NOT NULL, 
  photo_id int(10) NOT NULL, 
  title    varchar(32) NOT NULL, 
  body     text NOT NULL, 
  add_date datetime NOT NULL, 
  PRIMARY KEY (user_id, 
  photo_id)) CHARACTER SET UTF8;
CREATE TABLE Friends (
  user_id   int(10) NOT NULL, 
  friend_id int(10) NOT NULL, 
  PRIMARY KEY (user_id, 
  friend_id)) CHARACTER SET UTF8;
CREATE TABLE Favorite_photos (
  user_id  int(10) NOT NULL, 
  photo_id int(10) NOT NULL, 
  PRIMARY KEY (user_id, 
  photo_id)) CHARACTER SET UTF8;
CREATE TABLE Favorite_galleries (
  user_id    int(10) NOT NULL, 
  gallery_id int(10) NOT NULL, 
  PRIMARY KEY (user_id, 
  gallery_id)) CHARACTER SET UTF8;
CREATE TABLE Photos_galleries (
  gallery_id int(10) NOT NULL, 
  photo_id   int(10) NOT NULL, 
  PRIMARY KEY (gallery_id, 
  photo_id)) CHARACTER SET UTF8;
ALTER TABLE Comments ADD INDEX have (photo_id), ADD CONSTRAINT have FOREIGN KEY (photo_id) REFERENCES Photos (id);
ALTER TABLE Comments ADD INDEX `ADD comment` (user_id), ADD CONSTRAINT `ADD comment` FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Friends ADD INDEX FKFriends456366 (user_id), ADD CONSTRAINT FKFriends456366 FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Friends ADD INDEX FKFriends446654 (friend_id), ADD CONSTRAINT FKFriends446654 FOREIGN KEY (friend_id) REFERENCES Users (id);
ALTER TABLE Favorite_photos ADD INDEX FKFavorite_p454723 (user_id), ADD CONSTRAINT FKFavorite_p454723 FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Favorite_photos ADD INDEX FKFavorite_p878772 (photo_id), ADD CONSTRAINT FKFavorite_p878772 FOREIGN KEY (photo_id) REFERENCES Photos (id);
ALTER TABLE Galleries ADD INDEX `ADD gallery` (user_id), ADD CONSTRAINT `ADD gallery` FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Favorite_galleries ADD INDEX FKFavorite_g434236 (user_id), ADD CONSTRAINT FKFavorite_g434236 FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Favorite_galleries ADD INDEX FKFavorite_g331965 (gallery_id), ADD CONSTRAINT FKFavorite_g331965 FOREIGN KEY (gallery_id) REFERENCES Galleries (id);
ALTER TABLE Photos_galleries ADD INDEX FKPhotos_gal289198 (gallery_id), ADD CONSTRAINT FKPhotos_gal289198 FOREIGN KEY (gallery_id) REFERENCES Galleries (id);
ALTER TABLE Photos_galleries ADD INDEX FKPhotos_gal554285 (photo_id), ADD CONSTRAINT FKPhotos_gal554285 FOREIGN KEY (photo_id) REFERENCES Photos (id);
INSERT INTO Users
  (id, login, name, surname, email, password, city, gender, birth_date, avatar) 
VALUES 
  (1, 'logSmith', 'Will', 'Smith', 'will.smith@gmail.com', 'secret1', 'New York', 'M', '1992-07-10', 'src/img/default_user_avatar.png');
INSERT INTO Users
  (id, login, name, surname, email, password, city, gender, birth_date, avatar) 
VALUES 
  (2, 'logBlack', 'John', 'Black', 'john.black@gmail.com', 'secret2', null, null, null, 'src/img/default_user_avatar.png');
INSERT INTO Galleries
  (id, user_id, name, views, favourites, description, tumbnail_href) 
VALUES 
  (1, 1, 'Galleria 1', 0, 0, 'test gallery 1', 'src/img/img1.jpg');
INSERT INTO Galleries
  (id, user_id, name, views, favourites, description, tumbnail_href) 
VALUES 
  (2, 2, 'Galleria 2', 0, 0, 'test gallery 2', 'src/img/img2.jpg');
INSERT INTO Photos
  (id, href, tumbnail_href, name, views, favourites, width, height, camera, software, `date`, add_date, exposure_time, f_number) 
VALUES 
  (1, 'src/img/img1.jpg', 'src/img/img1.jpg', 'foto_1', 0, 0, 1060, 1050, 'Canon EOS 5D Mark II', 'Adobe Photoshop CS5', '2012-11-26 16:04:45', '2013-11-26 16:04:45', '1/200 sec', 'F2.8');
INSERT INTO Photos
  (id, href, tumbnail_href, name, views, favourites, width, height, camera, software, `date`, add_date, exposure_time, f_number) 
VALUES 
  (2, 'src/img/img2.jpg', 'src/img/img2.jpg', 'foto_2', 0, 0, 1060, 1050, 'Canon EOS 5D Mark II', 'Adobe Photoshop CS5', '2011-11-26 16:04:45', '2013-10-26 16:04:45', '1/200 sec', 'F2.8');
INSERT INTO Photos
  (id, href, tumbnail_href, name, views, favourites, width, height, camera, software, `date`, add_date, exposure_time, f_number) 
VALUES 
  (3, 'src/img/img3.jpg', 'src/img/img3.jpg', 'foto_3', 0, 0, 1060, 1050, null, null, null, '2013-10-26 16:04:45', null, null);
INSERT INTO Photos
  (id, href, tumbnail_href, name, views, favourites, width, height, camera, software, `date`, add_date, exposure_time, f_number) 
VALUES 
  (4, 'src/img/img4.jpg', 'src/img/img4.jpg						', 'foto_4', 0, 0, 1060, 1050, null, null, null, '2013-10-26 16:04:45', null, null);
INSERT INTO Photos
  (id, href, tumbnail_href, name, views, favourites, width, height, camera, software, `date`, add_date, exposure_time, f_number) 
VALUES 
  (5, 'src/img/img5.jpg', 'src/img/img5.jpg							', 'foto_5', 0, 0, 1060, 1050, null, null, null, '2013-10-26 16:04:45', null, null);
INSERT INTO Photos
  (id, href, tumbnail_href, name, views, favourites, width, height, camera, software, `date`, add_date, exposure_time, f_number) 
VALUES 
  (6, 'src/img/img6.jpg', 'src/img/img6.jpg', 'foto_6', 0, 0, 1060, 1050, null, null, null, '2013-10-26 16:04:45', null, null);
INSERT INTO Photos
  (id, href, tumbnail_href, name, views, favourites, width, height, camera, software, `date`, add_date, exposure_time, f_number) 
VALUES 
  (7, 'src/img/img7.jpg', 'src/img/img7.jpg', 'foto_7', 0, 0, 1060, 1050, null, null, null, '2013-10-26 16:04:45', null, null);
INSERT INTO Comments
  (user_id, photo_id, title, body, add_date) 
VALUES 
  (1, 1, 'Test title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac volutpat magna. Vestibulum semper dignissim diam, eget auctor diam feugiat vitae. Integer suscipit orci at nisl ultricies dignissim. Donec elementum leo est', '2013-10-26 16:04:45');
INSERT INTO Comments
  (user_id, photo_id, title, body, add_date) 
VALUES 
  (2, 1, 'Test title 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac volutpat magna. Vestibulum semper dignissim diam, eget auctor diam feugiat vitae. Integer suscipit orci at nisl ultricies dignissim. Donec elementum leo est, at rhoncus elit pellentesque id. Aenean euismod dolor tellus, porttitor facilisis elit tempus quis. Mauris accumsan risus magna, vitae vehicula massa tempor pretium', '2013-10-26 16:04:45');
INSERT INTO Friends
  (user_id, friend_id) 
VALUES 
  (1, 2);
INSERT INTO Friends
  (user_id, friend_id) 
VALUES 
  (2, 1);
INSERT INTO Favorite_photos
  (user_id, photo_id) 
VALUES 
  (1, 1);
INSERT INTO Favorite_photos
  (user_id, photo_id) 
VALUES 
  (1, 2);
INSERT INTO Favorite_photos
  (user_id, photo_id) 
VALUES 
  (2, 3);
INSERT INTO Favorite_galleries
  (user_id, gallery_id) 
VALUES 
  (1, 1);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (1, 1);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (1, 2);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (1, 3);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (2, 1);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (2, 2);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (2, 3);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (2, 4);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (2, 5);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (2, 6);
INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (2, 7);
