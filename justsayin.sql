/*
SQLyog Ultimate v8.55 
MySQL - 5.1.44 : Database - justsayin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `cms_contents` */

CREATE TABLE `cms_contents` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cms_contents` */

insert  into `cms_contents`(`id`,`key`,`value`,`created`,`updated`) values (1,'mobile.page.aboutus','<p>Just Sayin\' is the first voice conversation app for social media. The free cloud based iPhone application allows you to cross-post conversations to your respective Twitter and Facebook profiles, and share any combination of voice, text, photos, and video. </p>\r\n\r\n<p>The app\'s technology enables news outlets to utilize social media for interviews and reporting, celebrities can now engage with fans in dialogue, and the general public can communicate online as they would offline, speaking. It allows YOU to converse with your friends and find new friends using your VOICE with photos, text and video. It\'s Fun! </p>\r\n\r\n<p>Ricky Gervais, \'The Office\' creator and comedic Innovator and Internet Web 1.0 visionary, David Hayden partnered to create Just Sayin\' because they felt voice was the missing link to a users online social media persona.</p>\r\n\r\n<p>Just Sayin\' is especially valuable to celebrities whose fans demand personal and authentic content; politicians, athletes, comedians, and musicians can use Just Sayin\' to better engage their fans. Powered by Just Sayin\', you can listen to Ricky heckle his friend Karl as well as be a part of the conversation. Ricky can also respond to his followers by voice or even invite a celebrity or you into a public conversation. 2008 Presidential candidate Mike Huckabee, soccer star Brandi Chastain, and musical talents Cavo, Nikki Sixx, Tommy Lee, Crossfade, and IKILLYA, were able to use Just Sayin\' to speak directly to fans. Motley Crue\'s Nikki Sixx shares, \"I use the JustSayin app as a way to further close the gap between fan and artist. Not only do the fans get to hear my voice directly but I get to hear theirs as well. I love it.\" </p>\r\n\r\n<p>Just Sayin\' is compatible with any iOS device (iPhone, iPod Touch, and iPad). Just Sayin\' also has a browser accessible version available as www.justsayinapp.com. Just Sayin\' will soon be available in the Google Play Android marketplace by the end of 2012.</p>','2013-05-13 16:35:47','2013-05-13 16:35:47');

/*Table structure for table `configurations` */

CREATE TABLE `configurations` (
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `value` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `comment` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `ordernum` int(10) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `configurations` */

insert  into `configurations`(`name`,`value`,`comment`,`ordernum`) values ('SITE_TITLE','Cassiuking','',1),('SITE_ADDRESS1','','',11),('SITE_ADDRESS2','','',12),('CONTACT_EMAIL','info@mps.com','',14),('CONTACT_PHONE','','',15),('CONTACT_URL','','',16),('CONTACT_LOCATION','','',17),('SESS_LIFE','86400','.....',20),('DEFAULT_COUNTRY_CODE','US','',30),('MAX_DISPLAY_COUNT_ONE_PAGE','20','',40),('MAX_DISPLAY_PAGE_LINKS','20','.....',41),('PUSH_NOTIFICATION_URL','https://go.urbanairship.com/api/push/','',100),('SEND_PROADCASR_URL','https://go.urbanairship.com/api/brodcast/','',101),('PUSH_DEV_OR_PRODUCT','DEV','DEV or PRODUCT',110),('PUSH_PRODUCT_IPHONE_APPKEY','L28qMDsgSZ6iuMLlOg17hw','',151),('PUSH_PRODUCT_IPHONE_PUSHSECRET','SV_xhIjrTUCzzKVvcju0ng','',152),('PUSH_DEV_IPHONE_APPKEY','L28qMDsgSZ6iuMLlOg17hw','',155),('PUSH_DEV_IPHONE_PUSHSECRET','SV_xhIjrTUCzzKVvcju0ng','',156),('PUSH_PRODUCT_ANDROID_PACKAGE','','',161),('PUSH_PRODUCT_ANDROID_CSDM_AUTHORIZATION_TOKEN','','',162),('PUSH_DEV_ANDROID_PACKAGE','','',165),('PUSH_DEV_ANDROID_CSDM_AUTHORIZATION_TOKEN','','',166);

/*Table structure for table `email_queues` */

CREATE TABLE `email_queues` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `to_email` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `fail_count` bigint(11) NOT NULL,
  `success_count` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `email_queues` */

/*Table structure for table `featured_tags` */

CREATE TABLE `featured_tags` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `featured_tags` */

insert  into `featured_tags`(`id`,`name`) values (4,'#justsain');

/*Table structure for table `featured_urls` */

CREATE TABLE `featured_urls` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `featured_urls` */

insert  into `featured_urls`(`id`,`url`) values (1,'http://facebook.com');

/*Table structure for table `featured_users` */

CREATE TABLE `featured_users` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) NOT NULL,
  `sort_num` bigint(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `featured_users` */

/*Table structure for table `followings` */

CREATE TABLE `followings` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `follower_id` bigint(11) NOT NULL,
  `following_id` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `followings` */

insert  into `followings`(`id`,`follower_id`,`following_id`) values (1,100,107),(3,107,100);

/*Table structure for table `groups` */

CREATE TABLE `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`) values (1,'Admin'),(2,'User');

/*Table structure for table `media_likes` */

CREATE TABLE `media_likes` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) NOT NULL,
  `media_id` bigint(11) NOT NULL,
  `registed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `media_likes` */

/*Table structure for table `media_resays` */

CREATE TABLE `media_resays` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `media_id` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `media_resays` */

/*Table structure for table `media_tags` */

CREATE TABLE `media_tags` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `media_id` bigint(11) NOT NULL,
  `tag_id` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `media_tags` */

/*Table structure for table `medias` */

CREATE TABLE `medias` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) NOT NULL,
  `created` int(10) NOT NULL,
  `width` int(4) NOT NULL,
  `height` int(4) NOT NULL,
  `size` int(10) NOT NULL,
  `contents` varchar(500) NOT NULL,
  `video` varchar(256) NOT NULL,
  `video_time` int(4) NOT NULL,
  `audio` varchar(256) NOT NULL,
  `audio_time` int(4) NOT NULL,
  `photo` varchar(256) NOT NULL,
  `location` varchar(256) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `facebook_postid` varchar(100) NOT NULL,
  `twitter_postid` varchar(100) NOT NULL,
  `parent_id` bigint(11) NOT NULL,
  `visibility` enum('private','public') NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `medias` */

insert  into `medias`(`id`,`user_id`,`created`,`width`,`height`,`size`,`contents`,`video`,`video_time`,`audio`,`audio_time`,`photo`,`location`,`latitude`,`longitude`,`facebook_postid`,`twitter_postid`,`parent_id`,`visibility`) values (11,100,1369940661,0,0,10,'OKOKOK!!!!','',0,'',0,'','',0,0,'','',0,'public'),(10,107,1369940661,0,0,32,'#justsain @jin.jingri.5 welcome!','',0,'',0,'','',0,0,'','',0,'public'),(12,107,1369940661,0,0,13,'location test','',0,'',0,'','37.0298',-76.3452,0,'100005758711030_129332290602061','',0,'public'),(13,107,1369940661,0,0,14,'location test1','',0,'',0,'','37.0298',-76.3452,0,'100005758711030_129332833935340','',0,'public'),(14,107,1369940661,0,0,14,'location test2','',0,'',0,'','37.0298',-76.3452,0,'100005758711030_129332963935327','',0,'public'),(15,107,1369940661,0,0,4,'rrrr','',0,'',0,'','37.0298',-76.3452,0,'100005758711030_129333870601903','',0,'public'),(16,107,1369940661,0,0,5,'rrrr1','',0,'',0,'','37.0298',-76.3452,0,'100005758711030_129333933935230','',0,'public'),(17,107,1369940661,0,0,5,'rrrr2','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(18,107,1369940661,0,0,5,'rrrr2','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(19,107,1369940661,0,0,5,'rrrr2','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(20,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(21,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(22,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(23,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(24,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(25,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(26,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','',0,'public'),(27,107,1369940661,0,0,5,'rrrr3','',0,'',0,'','37.0298',-76.3452,0,'','340021704040525824',0,'public'),(28,107,1369940661,0,0,5,'rrrr4','',0,'',0,'','37.0298',-76.3452,0,'','340021807304294400',0,'public'),(29,107,1369940661,0,0,4,'rrr5','',0,'',0,'','37.0298',-76.3452,0,'','340022174331064321',0,'public'),(30,107,1369940661,0,0,4,'rrr5','',0,'',0,'','Virginia, US',37.0298,-76.3452,'','',0,'public'),(31,107,1369940661,0,0,4,'rrr5','',0,'',0,'','Virginia, US',37.0298,-76.3452,'','',0,'public'),(32,107,1369940661,0,0,4,'rrr5','',0,'',0,'','Virginia, US',37.0298,-76.3452,'','',0,'public'),(33,107,1369940661,0,0,4,'rrr5','',0,'',0,'','Virginia, US',37.0298,-76.3452,'','340022581254033408',0,'public'),(34,107,1369940661,0,0,12,'Virginia, US','',0,'',0,'','Virginia, US',37.0298,-76.3452,'','340022787362131968',0,'public'),(35,100,1369940661,0,0,7,'kkkkkkk','',0,'',0,'','',0,0,'','',10,'public'),(36,100,1369940661,0,0,7,'kkkkkkk','',0,'',0,'','',0,0,'','',10,'public'),(37,100,1369940661,0,0,7,'kkkkkkk','',0,'',0,'','',0,0,'','',10,'public'),(38,100,1369940661,0,0,7,'kkkkkkk','',0,'',0,'','',0,0,'','',10,'public'),(39,107,1369941103,0,0,4,'qqqq','',0,'',0,'','',0,0,'','',0,'public');

/*Table structure for table `notifications` */

CREATE TABLE `notifications` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) NOT NULL,
  `type` enum('follow','reply','resay','like','chat','post') NOT NULL,
  `register_id` bigint(11) NOT NULL,
  `media_id` bigint(11) NOT NULL,
  `registed` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `notifications` */

insert  into `notifications`(`id`,`user_id`,`type`,`register_id`,`media_id`,`registed`) values (3,107,'post',100,37,1369940661),(2,107,'follow',100,0,1369940761),(4,107,'post',100,38,1369940861),(5,107,'reply',100,10,1369940961),(6,100,'follow',107,0,1369940961),(7,100,'follow',107,0,2013);

/*Table structure for table `sessions` */

CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `sessions` */

insert  into `sessions`(`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`) values ('cd6aa796d518bac092e913288ba9104e','192.168.1.175','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:21.0) Gecko/20100101 Firefox/21.0',1370314719,''),('c470dda2a9e2e597cddbba2028b181ef','192.168.0.192','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36',1370310037,''),('ab8b5c7a35e33d5a1a3112ce3ab0ea6f','192.168.0.192','JustSayin\'/1.0 CFNetwork/609 Darwin/11.4.2',1370295505,''),('489836b41d66937b2d844cf752517c30','192.168.0.192','JustSayin\'/1.0 CFNetwork/609 Darwin/11.4.2',1370295847,''),('a1ba66cdcd9d7be5e4ccda7b73d19f17','192.168.0.192','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36',1370295103,''),('0fbe8e1f658bf77958e54760243f2dab','192.168.0.192','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36',1370280928,'');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(256) NOT NULL,
  `location` varchar(200) NOT NULL,
  `bio` text NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `password` char(40) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `group_id` bigint(20) unsigned NOT NULL,
  `timezone` varchar(5) NOT NULL,
  `actived` char(1) NOT NULL DEFAULT 'Y',
  `joined` int(10) NOT NULL,
  `foursquare` varchar(128) NOT NULL DEFAULT '',
  `security` varchar(255) NOT NULL,
  `os` varchar(20) NOT NULL,
  `device` varchar(256) NOT NULL,
  `logined` int(10) NOT NULL,
  `status` enum('offline','online') NOT NULL DEFAULT 'offline',
  `ip` varchar(50) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `facebook_id` varchar(20) NOT NULL,
  `facebook_token` varchar(200) NOT NULL,
  `twitter_id` varchar(20) NOT NULL,
  `twitter_auth_token` varchar(100) NOT NULL,
  `twitter_auth_token_secret` varchar(100) NOT NULL,
  `push_new_post_by_following` char(1) NOT NULL DEFAULT 'Y',
  `push_new_reply` char(1) NOT NULL DEFAULT 'Y',
  `push_new_followed` char(1) NOT NULL DEFAULT 'Y',
  `email_new_post_by_following` char(1) NOT NULL DEFAULT 'Y',
  `email_new_reply` char(1) NOT NULL DEFAULT 'Y',
  `email_new_followed` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`fullname`,`url`,`location`,`bio`,`email`,`phone`,`avatar`,`password`,`salt`,`group_id`,`timezone`,`actived`,`joined`,`foursquare`,`security`,`os`,`device`,`logined`,`status`,`ip`,`agent`,`facebook_id`,`facebook_token`,`twitter_id`,`twitter_auth_token`,`twitter_auth_token_secret`,`push_new_post_by_following`,`push_new_reply`,`push_new_followed`,`email_new_post_by_following`,`email_new_reply`,`email_new_followed`) values (1,'admin','admin','','','','admin@gmail.com','','','3eaf6a0fb81ca31dcc6744d3b696e4b8215acf78','99',2,'','Y',1369940661,'','a','ios','aaa',1369940661,'online','192.168.0.175','Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Win64; x64; Trident/6.0; .NET CLR 2.0.50727; SLCC2; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C)','','','','','','Y','Y','Y','Y','Y','Y'),(100,'jiangyong.522','Jiang Yong','www.new.chengtong-yilin.com','Zhuhai','Thanks','chengtie522@hotmail.com','','2013/05/23/picture75753','','',2,'+0800','Y',1369940661,'','a','ios','gggg',1370314762,'online','192.168.1.175','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:21.0) Gecko/20100101 Firefox/21.0','100004725935708','CAADhdRZATLyUBAAaBTZCB0MpUjqatgycswPZA6oGahpN6rEhFdbz9yxPaZATVg8eYaBQ7SlSAKkQzJxJZClECh0jdjqp2JHA58yxDgBb7zX9AFZAZCBdNP0sKO8IaQq5VctBmZCQZCMZC5tCnv8RH1fpPQesF9fwrHa3rUx9mIrJiW0gZDZD','','','','Y','Y','Y','Y','Y','Y'),(107,'jin.jingri.5','Jin JingRi','','Zhuhai','','jinjingri3@gmail.com','','2013-05-28/picture13383','','',2,'+0800','Y',1369940661,'','a','ios','1234567890',1370144816,'online','192.168.1.175','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36','100005758711030','CAADhdRZATLyUBAJahaMNLY09k4wd8QCwDgm0E7FeQX81NAIb4IlQh8w604QDVTaNHxe7OIWR7NGfwK1KZA0PzZAXxa8Ho6ovOCJHD646Xwfo8ZAOtZCXh8JZCuyjxpTgn2Na14g3fZC5T9PLLm77IZAAbimpeuwtPELvfpwY5FiW9AZDZD','1466812850','1466812850-XKTn1NUYq2x9tdXgmndL6tI3CqX3ezZnHBxBS0k','s9WLh36p1lrYcnuxKx6xOQ7dpXPWZpr7dixnAEUno','Y','Y','Y','Y','Y','Y'),(113,'jin_gyong','jingyong','','Zhuhai, in China','','','','2013-05-30/os0k6a9pow0v3meeti1u_normal.png','','',2,' 0800','Y',1369944816,'','a','ios','iPhone Simulator iPhone OS 6.0',1369948694,'online','192.168.0.192','JustSayin\'/1.0 CFNetwork/609 Darwin/11.4.2','','','717343573','717343573-rbkPtXMDh2MKIfErtwJb6kdK1JDJpZnDE9J0odPS','lgapRfkW632Hzvqwu30FmfpYIs6C0snbGinM6e8','Y','Y','Y','Y','Y','Y');

/*Table structure for table `yoticons` */

CREATE TABLE `yoticons` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(20) NOT NULL,
  `price` double(6,2) NOT NULL,
  `in_app` char(1) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `yoticons` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
