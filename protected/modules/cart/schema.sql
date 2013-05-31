-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 31 日 06:04
-- 服务器版本: 5.5.8-log
-- PHP 版本: 5.3.5

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限列表(仅对数据库表的字段)' AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `auth_access`
--

INSERT INTO `auth_access` (`id`, `name`, `pid`) VALUES
(1, 'auth.auth', 0),
(2, 'index', 1),
(3, 'auth.group', 0),
(4, 'bind', 3),
(5, 'create', 3),
(6, 'update', 3),
(7, 'delete', 3),
(8, 'index', 3),
(9, 'auth.site', 0),
(10, 'index', 9),
(11, 'auth.user', 0),
(12, 'create', 11),
(13, 'update', 11),
(14, 'delete', 11),
(15, 'index', 11),
(16, 'core.modules', 0),
(17, 'index', 16),
(18, 'add', 16),
(19, 'install', 16),
(20, 'email.config', 0),
(21, 'index', 20),
(22, 'email.site', 0),
(23, 'index', 22),
(24, 'i18n.site', 0),
(25, 'index', 24),
(26, 'svn.site', 0),
(27, 'index', 26),
(28, 'core.config', 0),
(29, 'create', 28),
(30, 'update', 28),
(31, 'delete', 28),
(32, 'index', 28),
(33, 'file.site', 0),
(34, 'index', 33),
(35, 'image.site', 0),
(36, 'index', 35),
(37, 'media.post', 0),
(38, 'index', 37);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组信息' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `slug`, `name`, `pid`) VALUES
(1, 'admin', '管理员', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户(管理员)' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `auth_users`
--

INSERT INTO `auth_users` (`id`, `username`, `email`, `password`, `active`, `active_code`, `yourself`, `created`, `updated`) VALUES
(1, 'admin', 'test@test.com', '$2y$13$jVu0gn0TPJ1jGE2FcuAprO1tRyMkYfMsoyn/qDJInyfsussBf2HZC', 1, '', 0, 0, 1369819228);

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

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT '产品ID',
  `product_table` varchar(50) NOT NULL COMMENT '产品对应的 【数据表名】::【字段】::【库存】，可以cart模块中直接配置默认',
  `qty` int(11) NOT NULL COMMENT '个数据',
  `mid` int(11) NOT NULL COMMENT '会员ID',
  `unid` varchar(255) NOT NULL COMMENT '当用户没登录时，生成的唯一值',
  `created` int(11) NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车';

-- --------------------------------------------------------

--
-- 表的结构 `cart_address`
--

CREATE TABLE IF NOT EXISTS `cart_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '收货人名',
  `address` varchar(255) NOT NULL COMMENT '详细地址',
  `tel` varchar(255) NOT NULL COMMENT '手机或电话',
  `nums` int(11) NOT NULL DEFAULT '0' COMMENT '该地址使用次数',
  `mid` int(11) NOT NULL COMMENT '会员ID',
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `area_id` int(11) NOT NULL COMMENT '所在区域ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收货地址' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cart_area`
--

CREATE TABLE IF NOT EXISTS `cart_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收货所在地址' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cart_discount`
--

CREATE TABLE IF NOT EXISTS `cart_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL COMMENT '优惠券码',
  `discount` float NOT NULL COMMENT '百分比折扣,或价格。当小于1时为百分比。这个字段优惠券如是价格至少要大于 1块钱的优惠',
  `created` int(11) NOT NULL,
  `pass_time` int(11) NOT NULL COMMENT '过期时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='优惠券' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cart_email`
--

CREATE TABLE IF NOT EXISTS `cart_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT '产品ID',
  `product_table` varchar(50) NOT NULL,
  `email` int(11) NOT NULL COMMENT '用户EMAIL',
  `created` int(11) NOT NULL,
  `nums` int(11) NOT NULL COMMENT '通过过的次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车中到货通知' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cart_member_discount`
--

CREATE TABLE IF NOT EXISTS `cart_member_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `is_pass` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已经过期了',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员有的优惠券' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cart_test`
--

CREATE TABLE IF NOT EXISTS `cart_test` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` int(11) NOT NULL COMMENT '产品名称',
  `price` int(11) NOT NULL COMMENT '价格',
  `all` int(11) NOT NULL COMMENT '总数',
  `left` int(11) NOT NULL COMMENT '库存'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='测试cart模块[这个是产品信息]';

-- --------------------------------------------------------

--
-- 表的结构 `content_field`
--

CREATE TABLE IF NOT EXISTS `content_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  `pid` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `content_field`
--

INSERT INTO `content_field` (`id`, `slug`, `name`, `memo`, `pid`, `created`, `updated`, `uid`, `sort`) VALUES
(1, 'posts', '文章', '文章', 0, 0, 0, 0, 0),
(2, 'title', '标题', '', 1, 0, 0, 0, 0),
(3, 'body', '内容', '', 1, 0, 0, 0, 0),
(7, 'test', '测试', '', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `content_float`
--

CREATE TABLE IF NOT EXISTS `content_float` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `content_int`
--

CREATE TABLE IF NOT EXISTS `content_int` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `content_text`
--

CREATE TABLE IF NOT EXISTS `content_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `content_text`
--

INSERT INTO `content_text` (`id`, `value`) VALUES
(1, 'ccc');

-- --------------------------------------------------------

--
-- 表的结构 `content_validate`
--

CREATE TABLE IF NOT EXISTS `content_validate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `content_varchar`
--

CREATE TABLE IF NOT EXISTS `content_varchar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `content_varchar`
--

INSERT INTO `content_varchar` (`id`, `value`) VALUES
(1, 'aaa'),
(2, 'ttt');

-- --------------------------------------------------------

--
-- 表的结构 `content_widget`
--

CREATE TABLE IF NOT EXISTS `content_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `content_widget`
--

INSERT INTO `content_widget` (`id`, `field_id`, `name`, `memo`) VALUES
(6, 3, 'text', ''),
(7, 2, 'input', ''),
(10, 7, 'input', '');

-- --------------------------------------------------------

--
-- 表的结构 `core_config`
--

CREATE TABLE IF NOT EXISTS `core_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `memo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `core_config`
--

INSERT INTO `core_config` (`id`, `slug`, `body`, `memo`) VALUES
(1, 'title', '<p>标题</p>', '网站标题'),
(2, 'front_footer', '<address><strong>liujifatiachi.com</strong><br> \r\n				Xianyang Park HuaiHai Road<br> \r\n				Email: liujifa@outlook.com<br></address>\r\n', '前端页脚'),
(3, 'front_title', '<p>Master JiFa Liu</p>', '');

-- --------------------------------------------------------

--
-- 表的结构 `core_modules`
--

CREATE TABLE IF NOT EXISTS `core_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `label` varchar(50) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `core` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `core_modules`
--

INSERT INTO `core_modules` (`id`, `name`, `label`, `memo`, `core`, `active`, `sort`) VALUES
(1, 'core', 'Core', '内核', 1, 1, 0),
(2, 'auth', 'auth', '权限', 1, 1, 0),
(3, 'email', 'email', '邮件', 0, 1, 0),
(4, 'member', 'member', '会员', 0, 1, 0),
(5, 'oauth', 'oauth', '登录', 0, 1, 0),
(6, 'cart', 'cart', '购物车', 0, 1, 0),
(7, 'comment', 'comment', '评论', 0, 1, 0),
(8, 'content', 'content', '内容', 0, 1, 0),
(9, 'document', 'document', '手册', 0, 1, 0),
(10, 'file', 'file', '文件', 0, 1, 0),
(11, 'image', 'image', '图片', 0, 1, 0),
(12, 'media', 'media', '文章/相册/视频', 0, 1, 0),
(13, 'menu', 'menu', '菜单', 0, 1, 0),
(14, 'payment', 'payment', '支付', 0, 1, 0),
(15, 'svn', 'svn', 'SVN同步', 0, 1, 0),
(16, 'tag', 'tag', '标签云', 0, 1, 0),
(17, 'taxonomy', 'taxonomy', '分类', 0, 1, 0),
(18, 'i18n', 'i18n', '多语言', 0, 1, 0),
(19, 'multisite', 'multisite', '多站点', 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `email_config`
--

CREATE TABLE IF NOT EXISTS `email_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(200) NOT NULL,
  `from_name` varchar(200) NOT NULL,
  `smtp` varchar(200) NOT NULL,
  `from_password` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `port` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `email_config`
--

INSERT INTO `email_config` (`id`, `from_email`, `from_name`, `smtp`, `from_password`, `type`, `port`) VALUES
(1, 'mincms@yeah.net', 'yiiphp', 'smtp.yeah.net', 'gimmNnx0UkZt5Eqf3SLVq/15X2IHkMvtL3qKrrGrpbQ=', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `email_send`
--

CREATE TABLE IF NOT EXISTS `email_send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(200) NOT NULL,
  `to_name` varchar(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `attach` text NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `email_send`
--

INSERT INTO `email_send` (`id`, `to_email`, `to_name`, `title`, `body`, `attach`, `created`) VALUES
(1, 'yiiphp@qq.com', '', 'aaa', 'cccc', '', 1369302378),
(2, 'yiiphp@qq.com', '', 'aaa', 'cccc', '', 1369302735),
(3, 'yiiphp@qq.com', '测试', '这是测试', '看看吧', '', 1369302786);

-- --------------------------------------------------------

--
-- 表的结构 `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '1' COMMENT '默认是管理员',
  `uniqid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `file`
--

INSERT INTO `file` (`id`, `path`, `type`, `size`, `created`, `uid`, `admin`, `uniqid`) VALUES
(1, 'upload/2013/05/29/12b6fb35933703dadf3dcf5b6e944e33.jpg', 'image/jpeg', 201606, 1369823124, 1, 1, '95735e51dfe8c753622deb7da5bdb51f'),
(2, 'upload/2013/05/29/82738d1cd8c27e680b31913a9cfbaa47.jpg', 'image/jpeg', 272142, 1369823125, 1, 1, 'ffd6953c5617164f0681db9cd0eae440');

-- --------------------------------------------------------

--
-- 表的结构 `file_ext`
--

CREATE TABLE IF NOT EXISTS `file_ext` (
  `width` int(11) NOT NULL AUTO_INCREMENT,
  `height` int(11) NOT NULL,
  `make` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `datetime` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  PRIMARY KEY (`width`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `node_posts`
--

CREATE TABLE IF NOT EXISTS `node_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '1',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- 转存表中的数据 `node_posts`
--

INSERT INTO `node_posts` (`id`, `created`, `updated`, `uid`, `admin`, `display`, `sort`) VALUES
(1, 1369907211, 1369907211, 1, 1, 1, 0),
(2, 1369907232, 1369907232, 1, 1, 1, 0),
(3, 1369907276, 1369907276, 1, 1, 1, 0),
(4, 1369907290, 1369907290, 1, 1, 1, 0),
(5, 1369907302, 1369907302, 1, 1, 1, 0),
(6, 1369907305, 1369907305, 1, 1, 1, 0),
(7, 1369907597, 1369907597, 1, 1, 1, 0),
(8, 1369907601, 1369907601, 1, 1, 1, 0),
(9, 1369907626, 1369907626, 1, 1, 1, 0),
(10, 1369907649, 1369907649, 1, 1, 1, 0),
(11, 1369907663, 1369907663, 1, 1, 1, 0),
(12, 1369907675, 1369907675, 1, 1, 1, 0),
(13, 1369907676, 1369907676, 1, 1, 1, 0),
(14, 1369907703, 1369907703, 1, 1, 1, 0),
(15, 1369907704, 1369907704, 1, 1, 1, 0),
(16, 1369907708, 1369907708, 1, 1, 1, 0),
(17, 1369907724, 1369907724, 1, 1, 1, 0),
(18, 1369907741, 1369907741, 1, 1, 1, 0),
(19, 1369907755, 1369907755, 1, 1, 1, 0),
(20, 1369907785, 1369907785, 1, 1, 1, 0),
(21, 1369907795, 1369907795, 1, 1, 1, 0),
(22, 1369907795, 1369907795, 1, 1, 1, 0),
(23, 1369907796, 1369907796, 1, 1, 1, 0),
(24, 1369907796, 1369907796, 1, 1, 1, 0),
(25, 1369907796, 1369907796, 1, 1, 1, 0),
(26, 1369907797, 1369907797, 1, 1, 1, 0),
(27, 1369907851, 1369907851, 1, 1, 1, 0),
(28, 1369907853, 1369907853, 1, 1, 1, 0),
(29, 1369907857, 1369907857, 1, 1, 1, 0),
(30, 1369907877, 1369907877, 1, 1, 1, 0),
(31, 1369907911, 1369907911, 1, 1, 1, 0),
(32, 1369907927, 1369907927, 1, 1, 1, 0),
(33, 1369907940, 1369907940, 1, 1, 1, 0),
(34, 1369907985, 1369907985, 1, 1, 1, 0),
(35, 1369908003, 1369908003, 1, 1, 1, 0),
(36, 1369908046, 1369908046, 1, 1, 1, 0),
(37, 1369908118, 1369908118, 1, 1, 1, 0),
(38, 1369908138, 1369908138, 1, 1, 1, 0),
(39, 1369908152, 1369908152, 1, 1, 1, 0),
(40, 1369908155, 1369908155, 1, 1, 1, 0),
(41, 1369908349, 1369908349, 1, 1, 1, 0),
(42, 1369908355, 1369908355, 1, 1, 1, 0),
(43, 1369908409, 1369908409, 1, 1, 1, 0),
(44, 1369908576, 1369908576, 1, 1, 1, 0),
(45, 1369908592, 1369908592, 1, 1, 1, 0),
(46, 1369908821, 1369908821, 1, 1, 1, 0),
(47, 1369908839, 1369908839, 1, 1, 1, 0),
(48, 1369909009, 1369909009, 1, 1, 1, 0),
(49, 1369909046, 1369909046, 1, 1, 1, 0),
(50, 1369909056, 1369909056, 1, 1, 1, 0),
(51, 1369909058, 1369909058, 1, 1, 1, 0),
(52, 1369909067, 1369909067, 1, 1, 1, 0),
(53, 1369909089, 1369909089, 1, 1, 1, 0),
(54, 1369909102, 1369909102, 1, 1, 1, 0),
(55, 1369909114, 1369909114, 1, 1, 1, 0),
(56, 1369909115, 1369909115, 1, 1, 1, 0),
(57, 1369909120, 1369909120, 1, 1, 1, 0),
(58, 1369909131, 1369909131, 1, 1, 1, 0),
(59, 1369909153, 1369909153, 1, 1, 1, 0),
(60, 1369909181, 1369909181, 1, 1, 1, 0),
(61, 1369909447, 1369909447, 1, 1, 1, 0),
(62, 1369909458, 1369909458, 1, 1, 1, 0),
(63, 1369909473, 1369909473, 1, 1, 1, 0),
(64, 1369909485, 1369909485, 1, 1, 1, 0),
(65, 1369909502, 1369909502, 1, 1, 1, 0),
(66, 1369909523, 1369909523, 1, 1, 1, 0),
(67, 1369912191, 1369912191, 1, 1, 1, 0),
(68, 1369912193, 1369912193, 1, 1, 1, 0),
(69, 1369912215, 1369912215, 1, 1, 1, 0),
(70, 1369912227, 1369912227, 1, 1, 1, 0),
(71, 1369912239, 1369912239, 1, 1, 1, 0),
(72, 1369912248, 1369912248, 1, 1, 1, 0),
(73, 1369912253, 1369912253, 1, 1, 1, 0),
(74, 1369912267, 1369912267, 1, 1, 1, 0),
(75, 1369912271, 1369912271, 1, 1, 1, 0),
(76, 1369912280, 1369912280, 1, 1, 1, 0),
(77, 1369912294, 1369912294, 1, 1, 1, 0),
(78, 1369912328, 1369912328, 1, 1, 1, 0),
(79, 1369912343, 1369912343, 1, 1, 1, 0),
(80, 1369912827, 1369912827, 1, 1, 1, 0),
(81, 1369912874, 1369912874, 1, 1, 1, 0),
(82, 1369913114, 1369913114, 1, 1, 1, 0),
(83, 1369913135, 1369913135, 1, 1, 1, 0),
(84, 1369913596, 1369913596, 1, 1, 1, 0),
(85, 1369913628, 1369913628, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `node_posts_relate`
--

CREATE TABLE IF NOT EXISTS `node_posts_relate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
