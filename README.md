# streamp3
An SQL+HTML/PHP/CSS based mp3 player [![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/tackyunicorn/streamp3/issues)

## Database Setup
This project uses MySQL as a backend for storing information of users and the music files  
* Create a database - **music**  
	```mysql
	CREATE DATABASE music;
	```  

* Under the music database, create two tables - **mp3s** and **users**  
	```mysql
	CREATE TABLE `mp3s` (
	`id` int(5) NOT NULL,
	`filename` varchar(100) NOT NULL,
	`artist` varchar(100) NOT NULL,
	`title` varchar(100) NOT NULL,
	`visual` varchar(100) NOT NULL,
	`comments` varchar(100) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `title` (`title`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8
	```  
	```mysql
	CREATE TABLE `users` (
	`uid` int(5) NOT NULL,
	`username` varchar(100) NOT NULL,
	`password` varchar(100) NOT NULL,
	PRIMARY KEY (`uid`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8
	```
## Server Setup
Host all the files onto your server  
* Edit the **wimpy.sql.ed.php** file to include the username and password of your MySQL installation
	```php
	$publicUser  = "yourusername";
	$publicPwd   = "yourpassword";
	```  
* Edit the **form.php** and **pass.php** to include the username and password of your MySQL installation
	```php
	$con=mysqli_connect("localhost" , "yourusername" , "yourpassword" , "music");
	```  
## Dumping data for tables
```mysql
INSERT INTO `mp3s` (`id`, `filename`, `artist`, `title`, `visual`, `comments`) VALUES
(1, 'Night.mp3', 'Killeen and Gieson', 'Night', 'http://localhost/mp3s/cover/Night.jpg', 'Y'),
(2, 'Get_Lucky.mp3', 'Daft Punk', 'Get Lucky', 'http://localhost/mp3s/cover/Get_Lucky.jpg', 'Y'),
(3, 'Lights.mp3', 'Ellie Goulding', 'Lights', 'http://localhost/mp3s/cover/Lights.jpg', 'Y'),
(4, 'Royals.mp3', 'Lorde', 'Royals', 'http://localhost/mp3s/cover/Royals.jpg', 'Y'),
(5, 'Mirrors.mp3', 'Justin Timberlake', 'Mirrors', 'http://localhost/mp3s/cover/Mirrors.jpg', 'Y'),
(6, 'Sail.mp3', 'Awolnation', 'Sail', 'http://localhost/mp3s/cover/Sail.jpg', 'Y'),
(7, 'Treasure.mp3', 'Bruno Mars', 'Treasure', 'http://localhost/mp3s/cover/Treasure.jpg', 'Y'),
(8, 'Time.mp3', 'Hans Zimmer', 'Time', 'http://localhost/mp3s/cover/Time.jpg', 'Y'),
(9, 'Radioactive.mp3', 'Imagine Dragons', 'Radioactive', 'http://localhost/mp3s/cover/Radioactive.jpg', 'Y'),
(10, 'Jitterbug.mp3', 'Wham', 'Jitterbug', 'http://localhost/mp3s/cover/Jitterbug.jpg', 'Y');
```
```mysql
INSERT INTO `users` (`uid`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'user', 'c33367701511b4f6020ec61ded352059');
```
> The admin and user passwords are stored as MD5 hashes  
	admin - 123456  
	user - 654321
