CREATE TABLE IF NOT EXISTS `oauth_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `key1` varchar(255) NOT NULL,
  `key2` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `oauth_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `oauth_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;