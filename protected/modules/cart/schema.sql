-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 31 日 08:40
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
