-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 06 月 04 日 12:04
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限列表(仅对数据库表的字段)' AUTO_INCREMENT=53 ;

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
(38, 'index', 37),
(39, 'cart.site', 0),
(40, 'index', 39),
(41, 'cart.test', 0),
(42, 'index', 41),
(43, 'content.node', 0),
(44, 'create', 43),
(45, 'update', 43),
(46, 'delete', 43),
(47, 'index', 43),
(48, 'content.site', 0),
(49, 'create', 48),
(50, 'update', 48),
(51, 'delete', 48),
(52, 'index', 48);

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
  `abcd` varchar(200) NOT NULL COMMENT '全拼',
  `abc` varchar(100) NOT NULL COMMENT '首字母',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- 表的结构 `content_widget`
--

CREATE TABLE IF NOT EXISTS `content_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

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
(20, 'emailcontact', 'emailcontact', '获取邮件联系人', 0, 1, 0),
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
-- 表的结构 `oauth_config`
--

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
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `oauth_config`
--

INSERT INTO `oauth_config` (`id`, `slug`, `name`, `key1`, `key2`, `created`, `updated`, `uid`, `display`, `sort`) VALUES
(1, 'qq', 'qq', '212156', 'c8f07c8529f6002160a2a0ae9bb352a0', 0, 0, 0, 1, 0),
(2, 'github', 'github', 'fccec689af5a203d9db8', 'e4874cb3b6b8a84282a7d5359bf3a629cefbe621', 0, 0, 0, 1, 0),
(3, 'msn', 'MSN', '000000004C0C5716', 'TZPF7ZQDbD7pM9rNONbPhvJZ3k1aKlxa', 0, 0, 0, 1, 0),
(4, 'sina', 'SINA', '32618989', 'b82dd82b76d02812c8c5f3d9d1f7c26e', 0, 0, 0, 1, 0),
(5, 'instagram', 'Instagram', 'e30432f942ec462cbb02432113fdf801', '940995910a37401db954eac55a8adb5d', 0, 0, 0, 0, 0),
(6, 'google', 'Google', '680952100943-cfo952brj8shv9jkm27592vi02bgf257.apps.googleusercontent.com', '680952100943-cfo952brj8shv9jkm27592vi02bgf257@developer.gserviceaccount.com', 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `oauth_users`
--

CREATE TABLE IF NOT EXISTS `oauth_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `oauth_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `oauth_users`
--

INSERT INTO `oauth_users` (`id`, `uuid`, `name`, `email`, `oauth_id`, `token`, `uid`) VALUES
(1, '5e253ec9db04eef82808739c8d5e5e1e', '轻飘如羽', 'info', 1, '6E1B6DF737828454D860E2D301DEB93B', '7CBA366530BEF6788F78D7B65FE7ACB0'),
(2, '8bb2a42140cb12e0b8c61b01fc977f61', 'Kang Sun', 'info', 3, 'EwBwAq1DBAAUGCCXc8wU/zFu9QnLdZXy+YnElFkAAVqQt5h3BvapDue0TPX0Xx13F3JboEkHBnQ7tghHfpT29h9f2AZ2eK6TO+4mfHS1MXvvu6sQwL4w6uX3eL6D0bdqpYDMGpnA2BqalluDpUsY12m3urjwYrD5QgsTlZkboTuwrNAcaG1bKTpAsfRTGFnOefMjYoqx8GaLsPPRcHIY5pXIhvCXZzblfI9SeMvYFwK8jrjGqeTG5Bz5KRPwAWq', '931daa896377cf86'),
(3, '77a11ad27f15be9930c05243fb8b823a', 'mincms', 'info', 2, '1139f09e068368f7f2587db7a2a267b5ae8d4c82', '250463'),
(4, '854be636ff6fa6563c5ce7eb74df6999', '一点太极', 'info', 4, '2.00YOPfkC0jgrMCd1e95fb0d89gnYFE', '2521807130'),
(5, '9d864257ad72e0b391955341299ebda1', 'Sun Kang', 'yiiphp@gmail.com', 6, 'ya29.AHES6ZSMQt0AJuylQzJJTKlrlnYvC_3zagw6F1u6LremI30Bow', '107606802653868575024');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
