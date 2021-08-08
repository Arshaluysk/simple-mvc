/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : mvc

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-08-05 21:04:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `task_to_user` (`user_id`),
  CONSTRAINT `task_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('1', '2', 'sdsadsad', '0');
INSERT INTO `task` VALUES ('2', '1', 'sdfsdffsd', '0');
INSERT INTO `task` VALUES ('3', '2', 'dsffsd', '0');
INSERT INTO `task` VALUES ('4', '1', 'dsfsdfds', '0');
INSERT INTO `task` VALUES ('5', '1', 'sdffsdf', '0');
INSERT INTO `task` VALUES ('6', '1', 'sdffsd', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'test', 'test@email', '', '0');
INSERT INTO `user` VALUES ('2', 'test', 'test2@gmail.com', '', '0');
