/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : hackaton

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2020-05-31 13:17:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tblperguntas
-- ----------------------------
DROP TABLE IF EXISTS `tblperguntas`;
CREATE TABLE `tblperguntas` (
  `idPergunta` int(25) NOT NULL AUTO_INCREMENT,
  `strPergunta` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `strA` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `intPesoA` int(10) DEFAULT NULL,
  `strB` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `intPesoB` int(10) DEFAULT NULL,
  `strC` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `intPesoC` int(10) DEFAULT NULL,
  `strD` varchar(250) COLLATE latin1_bin DEFAULT NULL,
  `intPesoD` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `strE` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `intPesoE` int(10) DEFAULT NULL,
  `intTipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- ----------------------------
-- Records of tblperguntas
-- ----------------------------
INSERT INTO `tblperguntas` VALUES ('1', 'Selecione o assunto dos dados socioeconômicos:', 'Saúde', '4', 'Fome', '3', 'Agricultura', '2', 'Desemprego', '1', 'Pobreza', '0', '1');
INSERT INTO `tblperguntas` VALUES ('2', 'Selecione o assunto dos dados de Observação da Terra:', 'Qualidade do ar', '4', 'Qualidade da água', '3', 'Temperatura', '2', 'Luminosidade', '1', 'Desmatamento', '0', '0');

-- ----------------------------
-- Table structure for tblresposta
-- ----------------------------
DROP TABLE IF EXISTS `tblresposta`;
CREATE TABLE `tblresposta` (
  `idResposta` int(255) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(255) DEFAULT NULL,
  `idPergunta` int(255) DEFAULT NULL,
  `intResposta` int(5) DEFAULT NULL,
  PRIMARY KEY (`idResposta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblresposta
-- ----------------------------

-- ----------------------------
-- Table structure for tblusuarios
-- ----------------------------
DROP TABLE IF EXISTS `tblusuarios`;
CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `strKey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblusuarios
-- ----------------------------
