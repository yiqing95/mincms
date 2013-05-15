-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 15 日 06:01
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
  `name` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限列表(仅对数据库表的字段)' AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组信息' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `slug`, `name`, `pid`) VALUES
(1, 'admin', '管理员', 0),
(2, 'edit', '编辑', 1),
(3, 'test', '测试会员', 0),
(4, 'small_edit', '小编', 2);

-- --------------------------------------------------------

--
-- 表的结构 `auth_group_access`
--

CREATE TABLE IF NOT EXISTS `auth_group_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  `access_id` int(11) NOT NULL COMMENT '权限列表ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与权限列表 关系' AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户(管理员)' AUTO_INCREMENT=2 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户与组 对应关系' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
