-- Expected environment values:
-- 	address:localhost
-- 	port:3306
-- 	user login:app_user
-- 	user password:pswl
-- 	database name:dropbox_app

CREATE TABLE Galleries (
  id            int(10) NOT NULL AUTO_INCREMENT, 
  name          varchar(32) NOT NULL, 
  views         int(10) DEFAULT 0, 
  favorites     int(10) DEFAULT 0, 
  description   varchar(255), 
  tumbnail_href varchar(255), 
  user_id       int(10), 
  PRIMARY KEY (id)) CHARACTER SET UTF8;

CREATE TABLE Users (
  id            int(10) NOT NULL AUTO_INCREMENT, 
  login         varchar(32) NOT NULL, 
  name          varchar(32), 
  surname       varchar(32), 
  email         varchar(255) NOT NULL, 
  password      varchar(32) NOT NULL UNIQUE, 
  gender        varchar(1), 
  birth_date    date, 
  avatar        varchar(255) DEFAULT 'NULL', 
  register_date datetime NOT NULL, 
  address_id    int(11) NOT NULL, 
  PRIMARY KEY (id)) CHARACTER SET UTF8;

CREATE TABLE Photos (
  id             int(10) NOT NULL AUTO_INCREMENT, 
  link           varchar(255) NOT NULL, 
  thumbnail_link varchar(255) NOT NULL, 
  width          int(5) NOT NULL, 
  height         int(5) NOT NULL, 
  name           varchar(32), 
  views          int(10) DEFAULT 0, 
  address_id     int(11), 
  favorites      int(10) DEFAULT 0, 
  manufacturer   varchar(32), 
  model          varchar(16), 
  software       varchar(32), 
  date_and_time  datetime NULL, 
  upload_date    datetime NOT NULL, 
  exposure_time  varchar(32), 
  f_number       varchar(32), 
  compression    varchar(16), 
  focal_lenght   varchar(16), 
  PRIMARY KEY (id)) CHARACTER SET UTF8;

CREATE TABLE Comments (
  id            int(11) NOT NULL AUTO_INCREMENT, 
  title         varchar(32), 
  text          text NOT NULL, 
  date_and_time datetime NOT NULL, 
  user_id       int(10) NOT NULL, 
  photo_id      int(10) NOT NULL, 
  PRIMARY KEY (id)) CHARACTER SET UTF8;

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

CREATE TABLE Followed_galleries (
  user_id    int(10) NOT NULL, 
  gallery_id int(10) NOT NULL, 
  PRIMARY KEY (user_id, 
  gallery_id)) CHARACTER SET UTF8;

CREATE TABLE Photos_galleries (
  gallery_id int(10) NOT NULL, 
  photo_id   int(10) NOT NULL, 
  PRIMARY KEY (gallery_id, 
  photo_id)) CHARACTER SET UTF8;

CREATE TABLE Addresses (
  id         int(11) NOT NULL AUTO_INCREMENT, 
  city       varchar(30), 
  latitude   bigint(20), 
  longitude  bigint(20), 
  country_id int(11) NOT NULL, 
  PRIMARY KEY (id)) CHARACTER SET UTF8;

CREATE TABLE Countries (
  id   int(11) NOT NULL AUTO_INCREMENT, 
  code varchar(5) NOT NULL UNIQUE, 
  name varchar(30) NOT NULL UNIQUE, 
  PRIMARY KEY (id)) CHARACTER SET UTF8;



ALTER TABLE Comments ADD INDEX have (photo_id), ADD CONSTRAINT have FOREIGN KEY (photo_id) REFERENCES Photos (id);
ALTER TABLE Comments ADD INDEX `ADD comment` (user_id), ADD CONSTRAINT `ADD comment` FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Friends ADD INDEX FKFriends456366 (user_id), ADD CONSTRAINT FKFriends456366 FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Friends ADD INDEX FKFriends446654 (friend_id), ADD CONSTRAINT FKFriends446654 FOREIGN KEY (friend_id) REFERENCES Users (id);
ALTER TABLE Favorite_photos ADD INDEX FKFavorite_p454723 (user_id), ADD CONSTRAINT FKFavorite_p454723 FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Favorite_photos ADD INDEX FKFavorite_p878772 (photo_id), ADD CONSTRAINT FKFavorite_p878772 FOREIGN KEY (photo_id) REFERENCES Photos (id);
ALTER TABLE Galleries ADD INDEX `ADD gallery` (user_id), ADD CONSTRAINT `ADD gallery` FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Followed_galleries ADD INDEX FKFollowed_g537349 (user_id), ADD CONSTRAINT FKFollowed_g537349 FOREIGN KEY (user_id) REFERENCES Users (id);
ALTER TABLE Followed_galleries ADD INDEX FKFollowed_g228852 (gallery_id), ADD CONSTRAINT FKFollowed_g228852 FOREIGN KEY (gallery_id) REFERENCES Galleries (id);
ALTER TABLE Photos_galleries ADD INDEX FKPhotos_gal289198 (gallery_id), ADD CONSTRAINT FKPhotos_gal289198 FOREIGN KEY (gallery_id) REFERENCES Galleries (id);
ALTER TABLE Photos_galleries ADD INDEX FKPhotos_gal554285 (photo_id), ADD CONSTRAINT FKPhotos_gal554285 FOREIGN KEY (photo_id) REFERENCES Photos (id);
ALTER TABLE Addresses ADD INDEX FKAddresses702127 (country_id), ADD CONSTRAINT FKAddresses702127 FOREIGN KEY (country_id) REFERENCES Countries (id);
ALTER TABLE Users ADD INDEX FKUsers629329 (address_id), ADD CONSTRAINT FKUsers629329 FOREIGN KEY (address_id) REFERENCES Addresses (id);
ALTER TABLE Photos ADD INDEX FKPhotos565816 (address_id), ADD CONSTRAINT FKPhotos565816 FOREIGN KEY (address_id) REFERENCES Addresses (id);



INSERT INTO Countries
  (id, code, name) 
VALUES 
	(1, 'AFG', 'Afghanistan'),
	(2, 'ALA', 'Åland Islands'),
	(3, 'ALB', 'Albania'),
	(4, 'DZA', 'Algeria (El Djazaïr)'),
	(5, 'ASM', 'American Samoa'),
	(6, 'AND', 'Andorra'),
	(7, 'AGO', 'Angola'),
	(8, 'AIA', 'Anguilla'),
	(9, 'ATA', 'Antarctica'),
	(10, 'ATG', 'Antigua and Barbuda'),
	(11, 'ARG', 'Argentina'),
	(12, 'ARM', 'Armenia'),
	(13, 'ABW', 'Aruba'),
	(14, 'AUS', 'Australia'),
	(15, 'AUT', 'Austria'),
	(16, 'AZE', 'Azerbaijan'),
	(17, 'BHS', 'Bahamas'),
	(18, 'BHR', 'Bahrain'),
	(19, 'BGD', 'Bangladesh'),
	(20, 'BRB', 'Barbados'),
	(21, 'BLR', 'Belarus'),
	(22, 'BEL', 'Belgium'),
	(23, 'BLZ', 'Belize'),
	(24, 'BEN', 'Benin'),
	(25, 'BMU', 'Bermuda'),
	(26, 'BTN', 'Bhutan'),
	(27, 'BOL', 'Bolivia'),
	(28, 'BIH', 'Bosnia and Herzegovina'),
	(29, 'BWA', 'Botswana'),
	(30, 'BVT', 'Bouvet Island'),
	(31, 'BRA', 'Brazil'),
	(32, 'IOT', 'British Indian Ocean Territory'),
	(33, 'BRN', 'Brunei Darussalam'),
	(34, 'BGR', 'Bulgaria'),
	(35, 'BFA', 'Burkina Faso'),
	(36, 'BDI', 'Burundi'),
	(37, 'KHM', 'Cambodia'),
	(38, 'CMR', 'Cameroon'),
	(39, 'CAN', 'Canada'),
	(40, 'CPV', 'Cape Verde'),
	(41, 'CYM', 'Cayman Islands'),
	(42, 'CAF', 'Central African Republic'),
	(43, 'TCD', 'Chad (T''Chad)'),
	(44, 'CHL', 'Chile'),
	(45, 'CHN', 'China'),
	(46, 'CXR', 'Christmas Island'),
	(47, 'CCK', 'Cocos (Keeling) Islands'),
	(48, 'COL', 'Colombia'),
	(49, 'COM', 'Comoros'),
	(50, 'COG', 'Congo, Republic Of'),
	(51, 'COD', 'Congo, The Democratic Republic of the (formerly Zaire)'),
	(52, 'COK', 'Cook Islands'),
	(53, 'CRI', 'Costa Rica'),
	(54, 'CIV', 'CÔte D''Ivoire (Ivory Coast)'),
	(55, 'HRV', 'Croatia (hrvatska)'),
	(56, 'CUB', 'Cuba'),
	(57, 'CYP', 'Cyprus'),
	(58, 'CZE', 'Czech Republic'),
	(59, 'DNK', 'Denmark'),
	(60, 'DJI', 'Djibouti'),
	(61, 'DMA', 'Dominica'),
	(62, 'DOM', 'Dominican Republic'),
	(63, 'ECU', 'Ecuador'),
	(64, 'EGY', 'Egypt'),
	(65, 'SLV', 'El Salvador'),
	(66, 'GNQ', 'Equatorial Guinea'),
	(67, 'ERI', 'Eritrea'),
	(68, 'EST', 'Estonia'),
	(69, 'ETH', 'Ethiopia'),
	(70, 'FRO', 'Faeroe Islands'),
	(71, 'FLK', 'Falkland Islands (Malvinas)'),
	(72, 'FJI', 'Fiji'),
	(73, 'FIN', 'Finland'),
	(74, 'FRA', 'France'),
	(75, 'GUF', 'French Guiana'),
	(76, 'PYF', 'French Polynesia'),
	(77, 'ATF', 'French Southern Territories'),
	(78, 'GAB', 'Gabon'),
	(79, 'GMB', 'Gambia, The'),
	(80, 'GEO', 'Georgia'),
	(81, 'DEU', 'Germany (Deutschland)'),
	(82, 'GHA', 'Ghana'),
	(83, 'GIB', 'Gibraltar'),
	(85, 'GRC', 'Greece'),
	(86, 'GRL', 'Greenland'),
	(87, 'GRD', 'Grenada'),
	(88, 'GLP', 'Guadeloupe'),
	(89, 'GUM', 'Guam'),
	(90, 'GTM', 'Guatemala'),
	(91, 'GIN', 'Guinea'),
	(92, 'GNB', 'Guinea-bissau'),
	(93, 'GUY', 'Guyana'),
	(94, 'HTI', 'Haiti'),
	(95, 'HMD', 'Heard Island and Mcdonald Islands'),
	(96, 'HND', 'Honduras'),
	(97, 'HKG', 'Hong Kong (Special Administrative Region of China)'),
	(98, 'HUN', 'Hungary'),
	(99, 'ISL', 'Iceland'),
	(100, 'IND', 'India'),
	(101, 'IDN', 'Indonesia'),
	(102, 'IRN', 'Iran (Islamic Republic of Iran)'),
	(103, 'IRQ', 'Iraq'),
	(104, 'IRL', 'Ireland'),
	(105, 'ISR', 'Israel'),
	(106, 'ITA', 'Italy'),
	(107, 'JAM', 'Jamaica'),
	(108, 'JPN', 'Japan'),
	(109, 'JOR', 'Jordan (Hashemite Kingdom of Jordan)'),
	(110, 'KAZ', 'Kazakhstan'),
	(111, 'KEN', 'Kenya'),
	(112, 'KIR', 'Kiribati'),
	(113, 'PRK', 'Korea (Democratic Peoples Republic pf [North] Korea)'),
	(114, 'KOR', 'Korea (Republic of [South] Korea)'),
	(115, 'KWT', 'Kuwait'),
	(116, 'KGZ', 'Kyrgyzstan'),
	(117, 'LAO', 'Lao People''s Democratic Republic'),
	(118, 'LVA', 'Latvia'),
	(119, 'LBN', 'Lebanon'),
	(120, 'LSO', 'Lesotho'),
	(121, 'LBR', 'Liberia'),
	(122, 'LBY', 'Libya (Libyan Arab Jamahirya)'),
	(123, 'LIE', 'Liechtenstein (Fürstentum Liechtenstein)'),
	(124, 'LTU', 'Lithuania'),
	(125, 'LUX', 'Luxembourg'),
	(126, 'MAC', 'Macao (Special Administrative Region of China)'),
	(127, 'MKD', 'Macedonia (Former Yugoslav Republic of Macedonia)'),
	(128, 'MDG', 'Madagascar'),
	(129, 'MWI', 'Malawi'),
	(130, 'MYS', 'Malaysia'),
	(131, 'MDV', 'Maldives'),
	(132, 'MLI', 'Mali'),
	(133, 'MLT', 'Malta'),
	(134, 'MHL', 'Marshall Islands'),
	(135, 'MTQ', 'Martinique'),
	(136, 'MRT', 'Mauritania'),
	(137, 'MUS', 'Mauritius'),
	(138, 'MYT', 'Mayotte'),
	(139, 'MEX', 'Mexico'),
	(140, 'FSM', 'Micronesia (Federated States of Micronesia)'),
	(141, 'MDA', 'Moldova'),
	(142, 'MCO', 'Monaco'),
	(143, 'MNG', 'Mongolia'),
	(144, 'MSR', 'Montserrat'),
	(145, 'MAR', 'Morocco'),
	(146, 'MOZ', 'Mozambique (Moçambique)'),
	(147, 'MMR', 'Myanmar (formerly Burma)'),
	(148, 'NAM', 'Namibia'),
	(149, 'NRU', 'Nauru'),
	(150, 'NPL', 'Nepal'),
	(151, 'NLD', 'Netherlands'),
	(152, 'ANT', 'Netherlands Antilles'),
	(153, 'NCL', 'New Caledonia'),
	(154, 'NZL', 'New Zealand'),
	(155, 'NIC', 'Nicaragua'),
	(156, 'NER', 'Niger'),
	(157, 'NGA', 'Nigeria'),
	(158, 'NIU', 'Niue'),
	(159, 'NFK', 'Norfolk Island'),
	(160, 'MNP', 'Northern Mariana Islands'),
	(161, 'NOR', 'Norway'),
	(162, 'OMN', 'Oman'),
	(163, 'PAK', 'Pakistan'),
	(164, 'PLW', 'Palau'),
	(165, 'PSE', 'Palestinian Territories'),
	(166, 'PAN', 'Panama'),
	(167, 'PNG', 'Papua New Guinea'),
	(168, 'PRY', 'Paraguay'),
	(169, 'PER', 'Peru'),
	(170, 'PHL', 'Philippines'),
	(171, 'PCN', 'Pitcairn'),
	(172, 'POL', 'Poland'),
	(173, 'PRT', 'Portugal'),
	(174, 'PRI', 'Puerto Rico'),
	(175, 'QAT', 'Qatar'),
	(176, 'REU', 'RÉunion'),
	(177, 'ROU', 'Romania'),
	(178, 'RUS', 'Russian Federation'),
	(179, 'RWA', 'Rwanda'),
	(180, 'SHN', 'Saint Helena'),
	(181, 'KNA', 'Saint Kitts and Nevis'),
	(182, 'LCA', 'Saint Lucia'),
	(183, 'SPM', 'Saint Pierre and Miquelon'),
	(184, 'VCT', 'Saint Vincent and the Grenadines'),
	(185, 'WSM', 'Samoa (formerly Western Samoa)'),
	(186, 'SMR', 'San Marino (Republic of)'),
	(187, 'STP', 'Sao Tome and Principe'),
	(188, 'SAU', 'Saudi Arabia (Kingdom of Saudi Arabia)'),
	(189, 'SEN', 'Senegal'),
	(190, 'SCG', 'Serbia and Montenegro (formerly Yugoslavia)'),
	(191, 'SYC', 'Seychelles'),
	(192, 'SLE', 'Sierra Leone'),
	(193, 'SGP', 'Singapore'),
	(194, 'SVK', 'Slovakia (Slovak Republic)'),
	(195, 'SVN', 'Slovenia'),
	(196, 'SLB', 'Solomon Islands'),
	(197, 'SOM', 'Somalia'),
	(198, 'ZAF', 'South Africa (zuid Afrika)'),
	(199, 'SGS', 'South Georgia and the South Sandwich Islands'),
	(200, 'ESP', 'Spain (españa)'),
	(201, 'LKA', 'Sri Lanka'),
	(202, 'SDN', 'Sudan'),
	(203, 'SUR', 'Suriname'),
	(204, 'SJM', 'Svalbard and Jan Mayen'),
	(205, 'SWZ', 'Swaziland'),
	(206, 'SWE', 'Sweden'),
	(207, 'CHE', 'Switzerland (Confederation of Helvetia)'),
	(208, 'SYR', 'Syrian Arab Republic'),
	(209, 'TWN', 'Taiwan ("Chinese Taipei" for IOC)'),
	(210, 'TJK', 'Tajikistan'),
	(211, 'TZA', 'Tanzania'),
	(212, 'THA', 'Thailand'),
	(213, 'TLS', 'Timor-Leste (formerly East Timor)'),
	(214, 'TGO', 'Togo'),
	(215, 'TKL', 'Tokelau'),
	(216, 'TON', 'Tonga'),
	(217, 'TTO', 'Trinidad and Tobago'),
	(218, 'TUN', 'Tunisia'),
	(219, 'TUR', 'Turkey'),
	(220, 'TKM', 'Turkmenistan'),
	(221, 'TCA', 'Turks and Caicos Islands'),
	(222, 'TUV', 'Tuvalu'),
	(223, 'UGA', 'Uganda'),
	(224, 'UKR', 'Ukraine'),
	(225, 'ARE', 'United Arab Emirates'),
	(226, 'GBR', 'United Kingdom (Great Britain)'),
	(227, 'USA', 'United States'),
	(228, 'UMI', 'United States Minor Outlying Islands'),
	(229, 'URY', 'Uruguay'),
	(230, 'UZB', 'Uzbekistan'),
	(231, 'VUT', 'Vanuatu'),
	(232, 'VAT', 'Vatican City (Holy See)'),
	(233, 'VEN', 'Venezuela'),
	(234, 'VNM', 'Viet Nam'),
	(235, 'VGB', 'Virgin Islands, British'),
	(236, 'VIR', 'Virgin Islands, U.S.'),
	(237, 'WLF', 'Wallis and Futuna'),
	(238, 'ESH', 'Western Sahara (formerly Spanish Sahara)'),
	(239, 'YEM', 'Yemen (Arab Republic)'),
	(240, 'ZMB', 'Zambia'),
	(241, 'ZWE', 'Zimbabwe');



INSERT INTO Addresses
  (id, city, latitude, longitude, country_id) 
VALUES (1, 'New York', null, null, 1);

INSERT INTO Photos
  (id, link, thumbnail_link, width, height, name, views, address_id, favorites, manufacturer, model, software, date_and_time, upload_date, exposure_time, f_number, compression, focal_lenght) 
VALUES 
  (1, 'src/img/img1.jpg', 'src/img/img1.jpg', 1060, 1050, 'foto_1', 0, null, 0, 'Canon', ' EOS 5D Mark II', 'Adobe Photoshop CS5', '2012-11-26 16:04:45', '2013-11-26 16:04:45', '1/200 sec', 'F2.8', null, null);

INSERT INTO Photos
	(id, link, thumbnail_link, width, height, name, views, address_id, favorites, manufacturer, model, software, date_and_time, upload_date, exposure_time, f_number, compression, focal_lenght) 
	VALUES 
	(2, 'src/img/img2.jpg', 'src/img/img2.jpg', 1060, 1050, 'foto_2', 0, null, 0, 'Canon', null, 'Adobe Photoshop CS5', '2011-11-26 16:04:45', '2013-10-26 16:04:45', '1/200 sec', 'F2.8', null, null);

INSERT INTO Photos
  (id, link, thumbnail_link, width, height, name, views, address_id, favorites, manufacturer, model, software, date_and_time, upload_date, exposure_time, f_number, compression, focal_lenght) 
VALUES 
  (3, 'src/img/img3.jpg', 'src/img/img3.jpg', 1060, 1050, 'foto_3', 0, null, 0, null, null, null, null, '2013-10-26 16:04:45', null, null, null, null);

INSERT INTO Photos
  (id, link, thumbnail_link, width, height, name, views, address_id, favorites, manufacturer, model, software, date_and_time, upload_date, exposure_time, f_number, compression, focal_lenght) 
VALUES 
  (4, 'src/img/img4.jpg', 'src/img/img4.jpg', 1060, 1050, 'foto_4', 0, null, 0, null, null, null, null, '2013-10-26 16:04:45', null, null, null, null);

INSERT INTO Photos
  (id, link, thumbnail_link, width, height, name, views, address_id, favorites, manufacturer, model, software, date_and_time, upload_date, exposure_time, f_number, compression, focal_lenght) 
VALUES 
  (5, 'src/img/img5.jpg', 'src/img/img5.jpg		', 1060, 1050, 'foto_5', 0, null, 0, null, null, null, null, '2013-10-26 16:04:45', null, null, null, null);

INSERT INTO Photos
  (id, link, thumbnail_link, width, height, name, views, address_id, favorites, manufacturer, model, software, date_and_time, upload_date, exposure_time, f_number, compression, focal_lenght) 
VALUES 
  (6, 'src/img/img6.jpg', 'src/img/img6.jpg', 1060, 1050, 'foto_6', 0, null, 0, null, null, null, null, '2013-10-26 16:04:45', null, null, null, null);

INSERT INTO Photos
  (id, link, thumbnail_link, width, height, name, views, address_id, favorites, manufacturer, model, software, date_and_time, upload_date, exposure_time, f_number, compression, focal_lenght) 
VALUES 
  (7, 'src/img/img7.jpg', 'src/img/img7.jpg', 1060, 1050, 'foto_7', 0, null, 0, null, null, null, null, '2013-10-26 16:04:45', null, null, null, null);

INSERT INTO Users
  (id, login, name, surname, email, password, gender, birth_date, avatar, register_date, address_id) 
VALUES 
  (1, 'logSmith', 'Will', 'Smith', 'will.smith@gmail.com', 'secret1', 'M', '1992-07-10', '', '2013-11-20 16:04:45', 1);

INSERT INTO Users
  (id, login, name, surname, email, password, gender, birth_date, avatar, register_date, address_id) 
VALUES 
  (2, 'logBlack', 'John', 'Black', 'john.black@gmail.com', 'secret2', null, null, '', '2013-11-21 16:04:45', 1);

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

INSERT INTO Galleries
  (id, name, views, favorites, description, tumbnail_href, user_id) 
VALUES 
  (1, 'Popular', 0, 0, 'Contains the most popular photos', null, null);

INSERT INTO Galleries
  (id, name, views, favorites, description, tumbnail_href, user_id) 
VALUES 
  (2, 'Galleria 2', 0, 0, 'test gallery 2', 'src/img/img2.jpg', 2);


INSERT INTO Galleries
  (id, name, views, favorites, description, tumbnail_href, user_id) 
VALUES 
  (3, 'Galleria 1', 0, 0, 'test gallery 1', 'src/img/img1.jpg', 1);


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

INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (3, 1);

INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (3, 2);

INSERT INTO Photos_galleries
  (gallery_id, photo_id) 
VALUES 
  (3, 3);

INSERT INTO Followed_galleries
  (user_id, gallery_id) 
VALUES 
  (2, 1);

INSERT INTO Comments
  (id, title, text, date_and_time, user_id, photo_id) 
VALUES 
  (1, 'Test title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac volutpat magna. Vestibulum semper dignissim diam, eget auctor diam feugiat vitae. Integer suscipit orci at nisl ultricies dignissim. Donec elementum leo est', '2013-10-26 16:04:45', 1, 1);

INSERT INTO Comments
  (id, title, text, date_and_time, user_id, photo_id) 
VALUES 
  (2, 'Test title 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac volutpat magna. Vestibulum semper dignissim diam, eget auctor diam feugiat vitae. Integer suscipit orci at nisl ultricies dignissim. Donec elementum leo est, at rhoncus elit pellentesque id. Aenean euismod dolor tellus, porttitor facilisis elit tempus quis. Mauris accumsan risus magna, vitae vehicula massa tempor pretium', '2013-10-26 16:04:45', 2, 1);
