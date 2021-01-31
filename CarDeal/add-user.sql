/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : hw201202

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-12-06 11:09:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'tom', '123456', 'tom@gmail.com');
INSERT INTO `user` VALUES ('2', 'jerry', '123456', 'jerry@gmail.com');
INSERT INTO `user` VALUES ('3', 'rose', '123456', 'rose@gmail.com');
