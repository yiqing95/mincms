-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 22 日 10:03
-- 服务器版本: 5.5.8-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `books`
--

-- --------------------------------------------------------

--
-- 表的结构 `auth_access`
--

CREATE TABLE IF NOT EXISTS `auth_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限列表(仅对数据库表的字段)' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `auth_access`
--

INSERT INTO `auth_access` (`id`, `name`, `pid`) VALUES
(1, 'auth.auth', 0),
(2, 'index', 1),
(3, 'auth.group', 0),
(4, 'create', 3),
(5, 'update', 3),
(6, 'delete', 3),
(7, 'index', 3),
(8, 'auth.site', 0),
(9, 'index', 8),
(10, 'auth.user', 0),
(11, 'create', 10),
(12, 'update', 10),
(13, 'delete', 10),
(14, 'index', 10),
(15, 'svn.site', 0),
(16, 'index', 15),
(17, 'bind', 3);

-- --------------------------------------------------------

--
-- 表的结构 `auth_groups`
--

CREATE TABLE IF NOT EXISTS `auth_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) NOT NULL COMMENT '唯一标识',
  `name` varchar(200) NOT NULL COMMENT '用户组名',
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组信息' AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `slug`, `name`, `pid`) VALUES
(15, 'acc', 'cccc', 12),
(13, 'test', 'test', 0),
(14, 'aaa', 'aa', 16),
(16, 'eee', 'eeee', 12),
(12, 'admin', '管理员', 0),
(17, 'test2', '我是有', 12),
(18, 'qq', 'qq', 17),
(19, 'ww', 'www', 18),
(20, 'rr', 'rr', 19),
(21, 'aes', '23223', 13),
(22, 'adfsd', 'sdfsdf', 21),
(23, 'ddd', 'ddd', 15),
(24, 'aaaa', 'aadfadsf', 0),
(25, 'wewrwe', 'rwerwer', 0),
(26, 'adf', 'sdf', 24),
(27, 'tre', 'adf', 25),
(28, 'qqq', '2222222', 27),
(29, 'erer', '再测试', 28);

-- --------------------------------------------------------

--
-- 表的结构 `auth_group_access`
--

CREATE TABLE IF NOT EXISTS `auth_group_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  `access_id` int(11) NOT NULL COMMENT '权限列表ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组与权限列表 关系' AUTO_INCREMENT=94 ;

--
-- 转存表中的数据 `auth_group_access`
--

INSERT INTO `auth_group_access` (`id`, `group_id`, `access_id`) VALUES
(93, 15, 9),
(92, 15, 2);

-- --------------------------------------------------------

--
-- 表的结构 `auth_users`
--

CREATE TABLE IF NOT EXISTS `auth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT '登录使用的EMAIL',
  `password` varchar(100) NOT NULL COMMENT '加密后的密码',
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否激活',
  `active_code` varchar(200) NOT NULL COMMENT '用户激活码',
  `yourself` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否只有操作自己添加的数据权限。1为是',
  `created` int(11) NOT NULL COMMENT '创建时间',
  `updated` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户(管理员)' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `auth_users`
--

INSERT INTO `auth_users` (`id`, `username`, `email`, `password`, `active`, `active_code`, `yourself`, `created`, `updated`) VALUES
(1, 'admin', 'test@test.com', '$2a$10$hPcZTqXm2Gyel5nM5Fj1D.hW/DcPvt2KREFCMCT5F3fiQZTIjWEN6', 1, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `auth_user_group`
--

CREATE TABLE IF NOT EXISTS `auth_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户与组 对应关系' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `auth_user_group`
--

INSERT INTO `auth_user_group` (`id`, `user_id`, `group_id`) VALUES
(2, 1, 21),
(3, 1, 15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
