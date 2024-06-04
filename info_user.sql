Create Database Spotify_User;
Use Spotify_User;

Create Table info_user(
id int PRIMARY KEY auto_increment,
name VARCHAR(50),
surname Varchar(50),
username varchar(50),
email Varchar(50),
password Varchar(250),
profile Varchar(250)
);
select* from info_user;

Create Table artist(
id int PRIMARY KEY auto_increment,
id_artist varchar(250),
id_user int,
foreign key (id_user) references info_user(id),
artist VARCHAR(50),
image Varchar(250),
kind varchar(50),
follower Varchar(50),
unique(id_user,artist)
);

select* from artist;

Create Table album(
id int PRIMARY KEY auto_increment,
id_album varchar(250),
id_user int,
foreign key (id_user) references info_user(id),
album VARCHAR(50),
artist VARCHAR(50),
image Varchar(250),
total_tracks Varchar(50),
unique(id_user,album)
);

Create Table audio(
id int PRIMARY KEY auto_increment,
id_audio varchar(250),
id_user int,
foreign key (id_user) references info_user(id),
audio VARCHAR(50),
authors VARCHAR(50),
image Varchar(250),
publisher Varchar(50),
unique(id_user,audio)
);

Create Table tracks(
id int PRIMARY KEY auto_increment,
id_tracks varchar(250),
id_user int,
foreign key (id_user) references info_user(id),
title VARCHAR(50),
artist VARCHAR(50),
album Varchar(250),
image Varchar(250),
unique(id_user,title)
);