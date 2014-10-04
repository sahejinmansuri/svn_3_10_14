-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: wigi
-- ------------------------------------------------------
-- Server version	5.1.54-1ubuntu4-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authorized_device`
--

DROP TABLE IF EXISTS `authorized_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authorized_device` (
  `authorized_device_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobile_id` int(11) unsigned NOT NULL,
  `os_id` varchar(255) NOT NULL,
  PRIMARY KEY (`authorized_device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authorized_device`
--

LOCK TABLES `authorized_device` WRITE;
/*!40000 ALTER TABLE `authorized_device` DISABLE KEYS */;
INSERT INTO `authorized_device` VALUES (3,3,'d0ca3e83e9c5fb9a380e9fd92cda679d5bec90f4'),(5,4,'c8cc07f160a436adc25aec29672107705f2ad83a'),(15,1,'6E7BB815-BDDA-5EFF-A4B9-8EC89CF09347'),(16,1,'b5f293362eb5e14d2a067051ce99ba0b23e28c3e'),(17,2,'asdf'),(18,2,'asdf'),(19,2,'asdf'),(20,2,'asdf'),(21,2,'asdf'),(22,8,'d0ca3e83e9c5fb9a380e9fd92cda679d5bec90f4'),(23,8,'d0ca3e83e9c5fb9a380e9fd92cda679d5bec90f4'),(24,2,'asdf'),(25,2,'asdf'),(26,2,'asdf'),(27,9,'81FCA122-C8B5-5246-A244-1CC16F465899'),(28,9,'81FCA122-C8B5-5246-A244-1CC16F465899'),(29,9,'81FCA122-C8B5-5246-A244-1CC16F465899'),(30,9,'81FCA122-C8B5-5246-A244-1CC16F465899'),(31,2,'6b1b8d525f715c3c008f473605ee3376da4fc1dd'),(32,15,'abcdefg'),(33,18,'abcdefg'),(34,20,'abcdefg'),(35,20,'abcdefg'),(36,20,'abcdefg'),(37,20,'abcdefg'),(38,20,'abcdefg'),(39,20,'abcdefg'),(40,20,'abcdefg'),(41,20,'abcdefg'),(42,20,'abcdefg'),(43,43,'1234'),(44,43,'1234'),(45,43,'1234'),(46,43,'1234'),(47,43,'1234'),(48,44,'A0000022786E3C'),(49,45,'A0000022786E3C'),(50,47,'6E7BB815-BDDA-5EFF-A4B9-8EC89CF09347'),(51,51,'6E7BB815-BDDA-5EFF-A4B9-8EC89CF09347'),(52,51,'b5f293362eb5e14d2a067051ce99ba0b23e28c3e'),(65,71,'A00000245897E1'),(66,51,'6b1b8d525f715c3c008f473605ee3376da4fc1dd'),(67,72,'0f9ffdbbb395a4f2e957d6c4dddb254a617c1731'),(68,76,'353648042459668'),(69,51,'c22f8de0fa9ad0639b04546771f72be9a95b7de3'),(70,55,'6b1b8d525f715c3c008f473605ee3376da4fc1dd'),(71,94,'6b1b8d525f715c3c008f473605ee3376da4fc1dd');
/*!40000 ALTER TABLE `authorized_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_type` smallint(5) unsigned NOT NULL DEFAULT '0',
  `company_sub_type` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_user`
--

DROP TABLE IF EXISTS `company_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_user` (
  `company_user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `type` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`company_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_user`
--

LOCK TABLES `company_user` WRITE;
/*!40000 ALTER TABLE `company_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_info`
--

DROP TABLE IF EXISTS `doc_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc_info` (
  `doc_info_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile_id` int(10) unsigned NOT NULL,
  `doc_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `current_version` smallint(5) unsigned NOT NULL DEFAULT '1',
  `expiration` datetime NOT NULL DEFAULT '2020-01-01 00:00:00',
  `number` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `user_added` varchar(60) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_changed` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`doc_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_info`
--

LOCK TABLES `doc_info` WRITE;
/*!40000 ALTER TABLE `doc_info` DISABLE KEYS */;
INSERT INTO `doc_info` VALUES (1,1,2,3,'2011-12-12 00:00:00','12345','My Card','USERNAME','2011-09-03 13:20:28','USERNAME','2011-09-03 17:27:00'),(2,1,2,3,'2011-12-12 00:00:00','12345','My Card','USERNAME','2011-09-03 13:23:34','USERNAME','2011-09-03 17:27:00'),(3,1,1,2,'2011-10-10 00:00:00','12345','test description','USERNAME','2011-09-03 13:48:16','USERNAME','2011-09-03 17:48:16'),(4,1,1,2,'2011-10-10 00:00:00','12345','test description','USERNAME','2011-09-03 15:03:34','USERNAME','2011-09-03 19:03:34'),(5,1,1,1,'0000-00-00 00:00:00','mynumber','mydescription','USERNAME','2011-09-03 15:15:06','USERNAME','2011-09-03 19:15:06'),(6,1,1,2,'0000-00-00 00:00:00','12345','test description','USERNAME','2011-09-03 15:29:02','USERNAME','2011-09-03 19:29:02'),(7,1,0,1,'2012-09-03 00:00:00','None of your business','Julies Credit Card','USERNAME','2011-09-03 15:36:24','USERNAME','2011-09-03 19:36:24'),(8,1,0,1,'2011-10-03 00:00:00','whatever','Julies BofA CC','USERNAME','2011-09-03 15:38:41','USERNAME','2011-09-03 19:38:41'),(9,1,0,1,'2012-09-03 00:00:00','1234567','New Document','USERNAME','2011-09-03 15:53:41','USERNAME','2011-09-03 19:53:41'),(10,1,0,1,'2011-09-04 00:00:00','12453','New CC','USERNAME','2011-09-03 15:55:11','USERNAME','2011-09-03 19:55:11'),(11,1,0,1,'0000-00-00 00:00:00','','','USERNAME','2011-09-03 16:16:59','USERNAME','2011-09-03 20:16:59'),(12,1,0,1,'0000-00-00 00:00:00','','','USERNAME','2011-09-03 16:24:47','USERNAME','2011-09-03 20:24:47'),(13,1,0,1,'0000-00-00 00:00:00','','','USERNAME','2011-09-03 16:35:46','USERNAME','2011-09-03 20:35:46'),(14,1,0,1,'0000-00-00 00:00:00','','','USERNAME','2011-09-03 16:50:56','USERNAME','2011-09-03 20:50:56'),(15,1,3,1,'2011-09-05 00:00:00','987654321','Julie final test','USERNAME','2011-09-03 16:55:39','USERNAME','2011-09-03 20:55:39'),(16,3,0,1,'2020-09-04 00:00:00','yryfghyfghh','DL','USERNAME','2011-09-04 10:46:18','USERNAME','2011-09-04 14:46:18'),(17,3,0,1,'2017-09-04 00:00:00','yyghuhhii','Credit Card','USERNAME','2011-09-04 23:43:42','USERNAME','2011-09-05 03:43:42'),(18,55,1,1,'2011-09-29 11:34:30','1234567','My License','cbaechle','2011-09-29 11:34:30','cbaechle','2011-09-29 15:34:30'),(19,55,1,1,'2011-09-29 11:34:44','1234567','My Insurance Card','cbaechle','2011-09-29 11:34:44','cbaechle','2011-09-29 15:34:44'),(20,51,1,1,'2011-09-29 11:38:15','1234567','My License','cbaechle','2011-09-29 11:38:15','cbaechle','2011-09-29 15:38:15'),(21,51,1,1,'2011-09-29 11:38:21','1234567','My Insurance Card','cbaechle','2011-09-29 11:38:21','cbaechle','2011-09-29 15:38:21'),(22,51,1,1,'2011-09-29 11:38:38','1234567','My Rewards Card','cbaechle','2011-09-29 11:38:38','cbaechle','2011-09-29 15:38:38');
/*!40000 ALTER TABLE `doc_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_history`
--

DROP TABLE IF EXISTS `login_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_history` (
  `login_history_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) DEFAULT NULL,
  `application` varchar(10) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `browser` varchar(60) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL,
  `client_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`login_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_history`
--

LOCK TABLES `login_history` WRITE;
/*!40000 ALTER TABLE `login_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text,
  `subject` varchar(255) DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `message_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'message','subject',0,1),(2,'message','subject',0,1),(3,'message','subject',0,1),(4,'message','subject',0,1),(5,'message','subject',0,1),(6,'message','subject',0,1),(7,'message','subject',0,1),(8,'message 2','subject 2',0,2),(9,'message 2','subject 2',0,1),(10,'message 3','subject 3',0,1),(11,'message 4\nblah\nblah\nblah\nblah\nblah','subject 4',0,1),(12,'We have awesome new features in this version!','New Features',0,1),(13,'Dont give out your PIN to anyone!','Security alert',0,1),(14,'This holiday season, give the gift of wigi. Start an account for a family member today.','Give the gift of wigi',0,1);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferences` (
  `user_id` int(11) NOT NULL,
  `prefs` text,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES (117,'{\"mobws\":{\"wigi\":{\"timeout\":60,\"max_per_trans\":100,\"max_per_day\":100},\"gift\":{\"max_per_trans\":200,\"max_per_day\":200},\"notification\":{\"statement\":\"email\",\"receipt\":\"sms\"}},\"cw\":{\"login\":{\"otp\":0,\"sitekeyimg\":\"def.gif\",\"sitekeyphrase\":\"This is a sitekey\"},\"wigi\":{\"timeout\":60,\"max_per_trans\":100,\"max_per_day\":100},\"notification\":{\"statement\":\"email\",\"receipt\":\"sms\"}},\"posws\":[],\"mw\":[]}');
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tos`
--

DROP TABLE IF EXISTS `tos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tos` (
  `tos_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tos` text,
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`tos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tos`
--

LOCK TABLES `tos` WRITE;
/*!40000 ALTER TABLE `tos` DISABLE KEYS */;
INSERT INTO `tos` VALUES (1,' \nTerms of Use  (revision 1.2)\n\nWiGi Inc., the parent company, owner and operator of WiGime.com, and its affiliates, merchant retailers and suppliers (collectively referred to .WiGime\") provide mobile money/ gifting services, transactional based services and related product services (the \"Services\") to you, subject to the following:  If you visit or utilize the products and services at WiGime.com, you accept these terms and conditions.\n\nDescription of Services\nWiGi Inc. through the use of WiGime.com and their products provides online global mobile money, gifting services (of funds), money remittances and payment disbursement services for the convenience and security of our participants. By Participating in these Services, users are able to send (or remit and receive) to any person/user having a mobile device an amount of funds limited by laws of the sender.s country of origin. The sender will be directly establishing for their recipients a secure mobile proxy holding escrow account that will provide the recipient convenience and security to receive monies/funds gifts or reload anytime from any approved source for the use at participating on line ecommerce, brick & mortar retailers and service providers with the use of their registered mobile device. Charges are only incurred as a processing fee when reloading the account with additional funds is added by you from your personal account. Click here for fee structure.  WiGi Inc. expressed or implied, completely treats this account as a temporary holding account for the for the convenience of our members and WITHOUT ANY EXPRESSIVE OR IMPLIED INTENT by WiGi, Inc. or its members should not treat this account or any other similar account related to the Services as a financial interest bearing account  or similar like entity. WiGi, Inc. is not considered a financial institution. The funds will earn NO INTEREST can be or will never be earned on any gifts/funds temporarily residing in said accounts. In Addition this account is to be used as a temporary holding account and will not be FDIC insured or insure by ant other governmental or insurance body. WiGi, Inc. through WiGime.com website only provides a secure, convenient service of mobile money for its participating members.  \n\nWiGi, Inc. reserves the right to modify or add additional fees and billing terms, without prior notice to the participating members of our service. WiGi, Inc. may change the Services it offers at any time.\n\nUnless you elect terminate your account services, your credit card (OR any other registered financial account entity) designated to your account will remain securely on file and will be billed the applicable transaction fee when any additional funds requested by you are to be added to you account. Members must keep their registered email addresses, personal billing information and all other personal account information current and up to date. WiGi, Inc. may provide address for delivery to participating retailers; send important notices to email accounts, etc. In connection with billing we may receive updated information about your account from the financial institution issuing your credit card. If we are unable to process your credit card payment (or similar billing entity), your account will be temporarily SUSPENDED until we are contacted by you for updated billing instructions.\n \nTermination\nWiGi, Inc. agrees to terminate your account at any time upon request by notifying us of your wish to cancel your account at customersupport@WiGime.com.\nWiGi, Inc. may terminate your account or your access to and use of the Services, with or without cause at any time and effective immediately, at WiGi, Inc.\'s sole discretion, for any reason, including but not limited to your failure to conform to these Terms. If you violate these Terms in the Terms and Conditions requirements then WiGi, Inc., in its sole discretion, may also elect to require you to remedy any violation of these Terms, and/or take any other actions that WiGi Inc. deems appropriate to enforce its rights and pursue all available remedies.\nUpon termination of your account for these reasons, you will receive a refund in the mail or electronically for any amount remaining in the account after all reconciliation. In the event we have to collect unpaid amounts owed to WiGi, Inc. on your account, you will be liable for all attorneys\' and collection agency fees.\n \nPrivacy\nWiGi, Inc. has established a Privacy Policy to explain to you how your information is collected and used. Your use of the WiGime.com website or the WiGi Services signifies acknowledgement of, and agreement to our Privacy Policy.\nYou understand and agree that WiGi, Inc may store and process your information on state-of-the .art secure computer servers located in remote regions  domestically or outside your country of origin and by providing any data to WiGi, Inc. you consent to the secure transfer and storage of such information.\nYou acknowledge and agree that WiGi, Inc. may disclose information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to comply with business practice processes, to carry out these Terms and provide Services, or to protect the rights, property, or safety of WiGi, Inc. its employees, users and third party affiliates.\n\nElectronic Communications                       \nWhen you visit WiGime.com, or send emails to us, or contacting us through the any form of mobile process, you are communicating with us electronically. You consent to receive communications from us electronically. We will communicate with you by email to your registered email address or by posting notices on this site or through other forms of mobile communication. You agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.\n \nCopyright and Intellectual Property\n \nAll content included on this site, such as text, graphics, logos, icons, images, photographs, audio clips, video clips, digital downloads, data compilations, and software which is part of the WirelessGifitng.com website, is the property of WiGi, Inc. and or the respective WiGi member merchant\'s. However, content posted or created by users is assumed to be the responsibility of the user who   posted or created it, or the author that the poster credited as being the owner of the creation. Copyrighted material is protected by United States and international copyright laws.\nWiGi Inc..s selection, coordination and arrangement of all content on this site is the exclusive property of WiGi Inc. and is protected as a compilation by U.S. and international copyright laws. All software used on this site or in conjunction with the Services is the property of WiGi Inc., the parent company of WiGime.com, and is protected by United States and international copyright laws.\nAll other unregistered or registered trademarks are property of their respective owners. Nothing contained on this site should be construed as granting, by implication, estoppels or otherwise, any license or right to use any of WiGi Inc.s intellectual property displayed on the WiGime.com site without the written permission to CGC Inc. \n \nCopyright Complaints\n WiGi Inc. respects the intellectual property rights of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please contact a WiGi Inc. customer service agent for notice of claims of copyright or other intellectual property infringement (\"Agent\"), at customerservice@WiGime.com. Please provide our Agent with the following Notice:\nIdentify the copyrighted work or other intellectual property that you claim has been infringed;\nIdentify the image, movie or audio on the WiGi Inc. website that you claim is infringing, with enough detail so that we may locate it on the website;\nA statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;\nA statement by you declaring under penalty of perjury that (a) the above information in your Notice is accurate, and (b) that you are the owner of the copyright interest involved or that you are authorized to act on behalf of that owner;\nYour address, telephone number, and email address and your physical or electronic signature.\nWiGi Inc.s Legal Agent of record will forward this information to the alleged infringer.\n\nLicense and Site Access\nEND USER LICENSE AGREEMENT (.EULA.)        \nWiGi Inc. grants you a limited license to access and make personal use of the Services provided by WiGi Inc through the mobile applications and the WiGime.com site, but not to download (other than page caching) or modify it or any portion of it, except with the express written consent of WiGi Inc. This license does not include any resale or commercial use of this site or its contents. This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of WiGi Inc. Any unauthorized use terminates the permission or license granted by WiGi Inc.\nYou are granted a limited, revocable, and nonexclusive right to create hyperlinks to WiGime.com page so long as the links do not portray WiGi Inc or its suppliers or their products or services in a false or misleading manner.\n\nThis End User License Agreement (\"EULA\") is an agreement between the user (\"you\" or \"your\") and WiGi, Inc. (\"we\", \"our\", \"us\") concerning your use of this software and all related documentation and services, and all updates and upgrades that replace or supplement the foregoing and are not distributed with a separate EULA (collectively, the \"Software\"). \nBy clicking \"Yes\" or \"Yes, I agree\" or similar language presented on your handset or Web page, or by using the Software, you agree to the terms and conditions of this EULA.\n\nI.  Software\n\nA.  Description of Software\nThe Software provides a means to view and interact with personal financial information and other information. We receive this information from third parties and you grant us and our service providers permission to retrieve the information and to use the information to provide the services enabled by the Software. We reserve the right to change the nature of the services available through the Software at any time, and to refuse to make any transaction you request through the Software. The Software may not be available on all wireless devices and on all mobile service carriers or providers, and may not be accessible or may have limited utility over some mobile networks in situations such as, but not limited to, roaming.\n\nB.  Use of Software\nThe Software will not work unless you use it properly. You accept responsibility for making sure that you understand how to use the Software before you actually do so, and then that you always use the Software in accordance with all applicable instructions. You also accept responsibility for making sure that you know how to properly use your wireless device. We may change or upgrade the Software from time to time. In the event of such changes or upgrades, you are responsible for making sure that you understand how to use the Software as changed or upgraded. We will not be liable to you for any losses caused by your failure to properly use the Software or your wireless device.\n\nC.   Relationship to Other Agreements\nThe Software forms a connection across wireless carrier data networks to the computer systems of your financial institution(s) and other third parties (\"Providers\"). Information about your account(s) comes from, and all processing occurs on, the Providers\' computer systems. We do not provide the information about your accounts that is displayed on your wireless device.\nYou have separate agreements with your Providers for their services, and you agree that you remain subject to those agreements. You also agree that you continue to be subject to the terms and conditions of your existing agreements with any other service providers, including but not limited to your mobile service carrier or provider. This EULA does not amend or supersede any of those agreements. Those agreements may provide for fees, limitations and restrictions which might impact your use of the Software (for example, your Provider may charge fees associated with the Software or your mobile service carrier may impose data usage or text message charges for your use of or interaction with the Software, including while downloading the Software or other use of your wireless device when using the Software), and you agree to be solely responsible for all such fees, limitations and restrictions. You acknowledge and agree that neither we nor your Provider are responsible for your mobile service carrier or provider\'s products and services. You acknowledge and agree that your mobile service carrier or provider is not the provider of any financial services available through or related to the Software, and is not responsible for any of the materials, information, products, or services made available to you in connection with the Software. Accordingly, you agree to resolve any problems with your Provider directly with that Provider without involving your mobile service carrier or us, and you agree to resolve any problems with your mobile service carrier directly with that mobile service carrier without involving your Provider or us.\n\nII. WiGi SOFTWARE LICENSE AGREEMENT                 \n\nA.  License\nSubject to your compliance with this EULA, you are hereby granted a personal, limited, non-transferable, non-exclusive, non-sub licensable, and non-assignable license (\"License\") to download, install and/or use the Software on your wireless device within the United States and its territories and within those countries where export and use of the Software is permitted under United States law and under the laws of the location where the Software is used. In the event that you obtain a new or different wireless device, you will be required to download and install the Software to that new or different wireless device.\n\nB.  License Restrictions / Revocation\nThis License shall be deemed revoked immediately upon (i) by not complying with these terms and conditions and noncompliance with this EULA; (ii) any reason to suspect infringement or copying of software (iii) any illegal activity domestically or international as defined in your country of origin (iv) written notice to you at any time, with or without cause; or (iv) us ceasing to provide service or ceasing to provide service for your Provider, wireless carrier, wireless device, or bank. In the event this License is revoked for any of the foregoing reasons, you agree to promptly delete the Software from your wireless device, except that if you change carriers and/or numbers without changing wireless devices you may continue using the Software if you re-enroll under your new carrier/number. We reserve all rights not granted to you in this EULA. The provisions of Sections I, II.B, III, and IV of this EULA shall survive revocation of the License.\n\nIII. YOUR OBLIGATIONS\nWhen you use the Software you agree to the following:\n\n1. Account Ownership/Accurate Information. You represent that you are the legal owner of the accounts and related information which may be accessed via the Software. You represent and agree that all information you provide in connection with the Software is accurate, current and complete, and that you have the right to provide such information to us and that we have the right to use the information for the purpose of providing the services available in connection with the Software. You agree to not misrepresent your identity or your account information. You agree to keep your account information up to date and accurate. You agree that we and our service providers may send you, by short message service (with an opportunity to opt-out), e-mail, and other methods, communications relating to the Software, related items, and offers, including without limitation welcome messages, information, and surveys and other requests for information. You agree to use the Software carefully, to keep your passwords and PINs for using the Software confidential and secure and not share them with others, to check your statements and transactions regularly, and to report any errors to your Provider promptly.\n\n2. Location Based Information. If you use any location-based feature of the Software you agree that your geographic location and other personal information may be accessed and disclosed through the Software. If you wish to revoke access to such information you must cease using location-based features of the Software.\n\n3. Export Control. You acknowledge that the Software is subject to the United States (U.S.) government export control and economic sanctions laws and regulations, which may restrict or prohibit the use, export, re-export, or transfer of the Software. You agree that you will not directly or indirectly use in, or export, re-export, transfer, or release the Software to, any destination, person, entity, or end-use prohibited or restricted under such laws or regulations without prior U.S. government authorization as applicable, either in writing or as permitted by applicable regulation. Without limitation, you agree that you will not use the Software in any embargoed or sanctioned country such as Cuba, Iran, North Korea, Sudan, and Syria.\n\n4. Proprietary Rights. You may not copy, reproduce, distribute, or create derivative works from the Software, and you agree not to reverse engineer or reverse compile or disassemble the Software.\n\n5. User Conduct. You agree not to use the Software or the content or information delivered through the Software in any way that would: (a) infringe any third-party copyright, patent, trademark, trade secret, or other proprietary rights or rights of publicity or privacy, including any rights in the Software; (b) be fraudulent or involve the sale of counterfeit or stolen items, including but not limited to use of the Software to impersonate another person or entity; (c) violate any law, statute, ordinance or regulation (including but not limited to those governing export control, consumer protection, unfair competition, anti-discrimination or false advertising); (d) be false, misleading or inaccurate; (e) create liability for us or our affiliates or service providers, or cause us to lose all or part of the services of any of our service providers; (f) be defamatory, libelous, unlawfully threatening or unlawfully harassing; (g) be perceived as illegal, offensive or objectionable; (h) interfere with or disrupt networks connected to the Software; (i) interfere with or disrupt the use of the Software by any other user; (j) use the Software to gain unauthorized entry or access to the systems or information of others, or (k) copy or display to third parties the information provided by the Software, except as required by the services available through the Software.\n\n6. No Commercial Use or Re-Sale. You agree that the Software is for personal use only. You agree not to resell or make commercial use of the Software.\n\n7. Indemnification. You agree to indemnify, defend, and hold us and our affiliates and service providers harmless from and against any and all third party claims, liability, damages, expenses and costs (including but not limited to reasonable attorneys\' fees) caused by or arising from your use of the Software, your violation of this EULA, your violation of applicable federal, state or local law, regulation or ordinance, or your infringement (or infringement by any other user of your account) of any intellectual property or other right of anyone.\n\nIV. ADDITIONAL PROVISIONS\n\nA. Software Limitations\n\n1. Neither we nor our service providers can always foresee or anticipate technical or other difficulties related to the Software. These difficulties may result in loss of data, loss or change of personalization settings, or other Software, service, or wireless device interruptions. You agree that neither we nor any of our service providers assumes responsibility for any disclosure of account information to third parties, or for the timeliness, deletion, miss-delivery or failure to store any user data, communications, or personalization settings in connection with your use of the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n\n2. You agree that neither we nor any of our service providers assumes responsibility for the operation, security, functionality, or availability of any wireless device or mobile network which you use to access the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n\n3. Nothing in the Software is an offer to sell any of the components or devices used or referenced in connection therewith. Certain components for use in the U.S. are available only through licensed suppliers. Some components are not available for use in the U.S. Support services in the U.S. may be limited.\n\n4. You agree to exercise caution when using the Software on your wireless device and to use good judgment and discretion when obtaining or transmitting information.\n\n5. Information available via the Software may differ from the information that is available directly from your Provider, and may not be current or up-to-date. Information available directly through your Provider\'s website may not be available via the Software, may be described using different terminology, or may be more current than the information available via the Software, including but not limited to account balance information.  Additionally, you agree that neither we nor our service providers will be liable for any errors or delays in the information presented, or for any actions taken in reliance thereon.\n\nB.  Cancellation\nYou may cancel your participation in the Software and Services Provided by emailing us at .customersupport@wigime.com. and deleting the Software. We reserve the right to cancel the Software at any time without notice. We may suspend your access to the Software at any time without notice and for any reason, including but not limited to your non-use of the Software. You agree that we will not be liable to you or any third party for any modification or discontinuance of the Software.\n\nC.  Use of Data\nWe and our service providers will use information you provide for purposes of providing the Software, the services it enables, and related functions such as billing and the communications set forth above, and to prepare analyses and compilations of aggregate customer data that does not identify you (such as the number of customers who signed up for the Software in a month).\n\nD. Third Party Beneficiary\nYou agree that the Providers, our service providers, and the owners, operators, and merchant(s) of record of any software application store or kiosk/business (\"Application Store\") from which you may have downloaded or otherwise obtained the Software, may rely upon your agreements and representations in this EULA, and such Providers, service providers, and Application Store are third party beneficiaries of this EULA, with the power to enforce its provisions against you, including without limitation the liability limitations and warranty disclaimers below for any claim related to or arising out of the Software or this EULA.\n\nE.  Limitations and Warranty Disclaimers\nWE AND OUR SERVICE PROVIDERS DISCLAIM ALL WARRANTIES RELATING TO THE SOFTWARE OR OTHERWISE IN CONNECTION WITH THIS EULA, WHETHER ORAL OR WRITTEN, EXPRESS, IMPLIED OR STATUTORY, INCLUDING WITHOUT LIMITATION THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR PARTICULAR PURPOSE AND NON-INFRINGEMENT.\nNEITHER WE NOR OUR SERVICE PROVIDERS WILL BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY INDIRECT, INCIDENTAL, EXEMPLARY, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES OF ANY KIND, OR FOR ANY LOSS OF PROFITS, BUSINESS, OR DATA, WHETHER BASED IN STATUTE, CONTRACT, TORT OR OTHERWISE, EVEN IF WE OR OUR SERVICE PROVIDERS HAVE BEEN ADVISED OF, OR HAD REASON TO KNOW OF, THE POSSIBILITY OF SUCH DAMAGES. Some states/jurisdictions do not allow the exclusion or limitation of incidental or consequential damages, so the above limitation or exclusion may not apply to you.\nUNDER NO CIRCUMSTANCE WILL THE TOTAL LIABILITY OF US OR OUR SERVICE PROVIDERS TO YOU IN CONNECTION WITH THE SOFTWARE OR RELATED SERVICES OR OTHERWISE IN CONNECTION WITH THIS EULA EXCEED $100.\nYOU UNDERSTAND AND AGREE THAT ANY APPLICATION STORE FROM WHICH YOU MAY HAVE DOWNLOADED THE SOFTWARE MAKES NO WARRANTY AND SHALL NOT BE LIABLE IN ANY MANNER WHATSOEVER FOR ANY CLAIMS RELATED TO OR ARISING OUT OF THE SOFTWARE OR THIS EULA, INCLUDING BUT NOT LIMITED TO ANY CLAIMS (I) IN RELATION TO THE SALE, DISTRIBUTION OR USE OF THE SOFTWARE, OR THE PERFORMANCE OR NON-PERFORMANCE OF THE SOFTWARE, (II) FOR PRODUCT LIABILITY, (III) THAT THE APPLICATION FAILS TO CONFORM TO ANY LEGAL OR REGULATORY REQUIREMENT, (IV) UNDER CONSUMER PROTECTION LAWS, OR (V) SEEKING DEFENSE AND INDEMNITY FOR INFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS.\n\nF.  Disputes\nWE EACH AGREE THAT ANY AND ALL CLAIMS OR DISPUTES IN ANY WAY RELATED TO OR CONCERNING THIS EULA, THE SOFTWARE, OR OUR SERVICES OR PRODUCTS, WILL BE RESOLVED BY BINDING ARBITRATION, RATHER THAN IN COURT. Such arbitration shall take place in Stuart, Florida, and shall be administered by the American Arbitration Association under its Commercial Arbitration Rules (and not under any other or ancillary rules or procedures such as the Supplementary Procedures for Consumer-Related Disputes or the Wireless Industry Arbitration Rules). This includes any claims you may assert against other parties relating to services provided to you (such as our suppliers or retail dealers) in connection with this EULA, the Software, or our services or products. We each also agree that this EULA affects interstate commerce so that the Federal Arbitration Act and federal arbitration law apply. THERE IS NO JUDGE OR JURY IN ARBITRATION, AND COURT REVIEW OF AN ARBITRATION AWARD IS LIMITED. THE ARBITRATOR(S) MUST FOLLOW THIS AGREEMENT AND CAN AWARD THE SAME DAMAGES AND RELIEF AS A COURT (INCLUDING ATTORNEYS\' FEES). The parties waive any right they may have to proceed on behalf of or against a class, and agree that any claim, counterclaim, cross-claim or the like shall be brought on an individual basis and not consolidated with any other party\'s claim, counterclaim, cross-claim or the like. The arbitration award shall be in writing, shall be signed by the arbitrator(s), and shall include a reasoned opinion setting forth findings of fact and conclusions of law. Judgment on the award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof.\nNotwithstanding the immediately preceding paragraph or the Severability section below, if the foregoing prohibition on class arbitration is not enforced for any reason, then the immediately preceding paragraph also shall not be enforced and any class action claims shall be brought exclusively in the United States District Court for the Southern District Court of Florida.\nAny demand for arbitration or claim in litigation must be filed within 3 months of the time the cause of action accrued, or the cause of action shall forever be barred.\n\nG.  Severability\nIf any provision of this EULA is declared invalid by a court or other tribunal of competent jurisdiction then, except to the extent set forth in the Disputes section above, such provision shall be ineffective only to the extent of such invalidity, so that the remainder of that provision and all remaining provisions of this EULA shall be valid and enforceable to the fullest extent permitted by applicable law.\n\nH.  Entire Agreement\nThis EULA constitutes the entire agreement between us and you relating to the Software and related services, supersedes any other agreements between us and you relating thereto, and may only be amended by a subsequent written agreement posted on our website (with subsequent use of the Software by you), sent to you by e-mail or SMS (with subsequent use of the Software by you), clicked through by you on your wireless device or otherwise, or signed by each of us.\n\nThis software consists of proprietary content and contributions made by professional programmers on behalf of WiGi, Inc.\nThe WiGi Software License, Version 1.2\nCopyright (c) 2008-2011 WiGi, Inc. All rights reserved.\n\"This product includes software developed by the WiGi, Inc. a US-based software development company.\n\nAlternately, this acknowledgement may appear in the software itself, if and wherever such third-party acknowledgements normally appear.\n The names WiGi., WiGiMe.com, WiGiMe. or WirelessGifting. must always be used to endorse or promote products derived from this software service. For written permission, please contact inquiry@wigime.com.\n\nAccount Security\nBy  participating in the services WiGi Inc and WiGime.com provides, you understand, agree and will be  responsible for maintaining the confidentiality of your account, your password, your PIN#, your mobile application, your personal mobile device and all other personal information pertaining to your account  and you are responsible for restricting access to your computer, your mobile device or any other electronic or non-electronic system containing WirelessGifting applications, your WirelessGifting Account information, and you further agree to accept all personal responsibility as for all activities that occur under your account including but not limited to, protecting and securing your passwords, your PIN# and all other personal and pertinent account information. You further agree to immediately notify WiGi Inc. through customersupport@WiGime.com of any unauthorized use of your account or any other breach of security known to you; and you are responsible for locking down your WiGime account upon knowing this information either by visiting the WiGime website, using the WiGime Mobile application or calling WiGi Inc. \n\nWiGi Inc. uses industry standard security measures to protect the loss, misuse and alteration of the information under our control. Although we make good faith efforts to store the non-public information collected by the WiGime.com website and the mobile application in a secure operating environment that is not available to the public, we cannot always guarantee 100% complete security. Further, while we make every effort to ensure the integrity and security of our network and systems, we can never guarantee 100% security measures will prevent third-party \"hackers\" from illegally accessing our site. WiGi, Inc will always keep up with the current and changing security state .of- the art measures as they become available.\n\nContent\nUse of the Services by you is subject to all applicable local, state, national and international laws and regulations. You may post photos or other electronic images, movies, audio clips, reviews, comments, suggestions, ideas, questions, or other information (collectively \"Content\"), so long as the Content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, chain letters, mass mailings, or any form of \"spam.\" WiGi Inc. reserves the right (but not the obligation) to remove or edit said illicit or derogatory Content at anytime, but does not regularly review posted Content.\n\nLicense Granted by Users\nWiGi, Inc. does not claim ownership in the photographs or other electronic images, movies, audio clips or other media created or uploaded by participants or members. Unless we indicate otherwise, if you upload Content, including any Media, to the WiGime website/servers, you grant WiGi, Inc. a nonexclusive, royalty-free right to publish distribute and display the Content as we deem appropriate in providing the Services authorized or requested by you and others, including the right to use the name that is submitted in connection with such Content. You further understand and agree that, in order to help ensure smooth operation of our system, we may keep backup copies of Content indefinitely.\nYou represent and warrant that you own or otherwise control all of the rights to the Content (including without limitation images, artwork, movies, text, and audio files) that you create and post; that use of the Content you supply does not violate these Terms of Use and will not cause injury to any person or entity; and that you will indemnify WiGi Inc. for all claims resulting from Content you supply. WiGi, Inc. has the right but not the obligation to monitor and edit or remove any activity or Content. You understand and agree that WiGi, Inc. takes no responsibility and assumes no liability for any Content created or posted by you or any third party.\n\nDisclaimer of Warranties and Limitations of Liability\nTHIS SITE IS PROVIDED BY WiGi, Inc. ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS. WiGi Inc. MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS, PRODUCT DESCRIPTIONS OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF THIS SITE IS AT YOUR SOLE RISK.\nTO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LAW, WiGi Inc. DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. TO THE FULLEST EXTENT PERMITTED BY LAW, WiGi Inc. DISCLAIMS ANY WARRANTIES FOR THE SECURITY, RELIABILITY, TIMELINESS, ACCURACY, AND PERFORMANCE OF ITS WEBSITE AND THE SERVICES, AND DOES NOT WARRANT THAT THE PRODUCT DESCRIPTIONS OR OTHER CONTENT ON ITS WEBSTIE ARE ACCURATE, COMPLETE, RELIABLE, CURRENT OR ERROR-FREE OR THAT THIS SITE, ITS SERVERS, OR EMAIL SENT FROM WiGi Inc. ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. UNDER NO CIRCUMSTANCES SHALL WiGi Inc. BE LIABLE ON ACCOUNT OF YOUR USE OR MISUSE OF THE WIGime.COM WEBSITE OR THE WiGime SERVICES, WHETHER THE DAMAGES ARISE FROM USE OR MISUSE OF THE WiGime.COM WEBSITE OR THE SERVICES, FROM INABILITY TO USE THE WiGime.COM WEBSITE OR THE SERVICES, OR THE INTERRUPTION, SUSPENSION, MODIFICATION, ALTERATION, OR TERMINATION OF THE WiGime.COM WEBSITE OR THE SERVICES, OR VIEWING THE SITES INFORMATION, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES. WiGi Inc. CANNOT BE HELD LIABLE FOR THE ACCIDENTAL LOSS OF PERSONAL INFORMATION AND PERSONAL ELECTRONIC MEDIA ON ITS SITE, OR THE COPYING OF ELECTRONIC MEDIA BY ITS USERS. OUR LIABILITY, AND THE LIABILITY OF OUR SUBSIDIARIES, EMPLOYEES, VENDORS AND SUPPLIERS, TO YOU IN ANY CIRCUMSTANCE IS LIMITED TO $100.\nCERTAIN STATE LAWS and COUNTRIES DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.\n\nIndemnity\nYou agree to indemnify and hold WiGi Inc, its subsidiaries, affiliates, successors, assigns, directors, officers, agents, employees, service providers, and suppliers harmless from any dispute that may arise from your breach of these Terms of Use or violation of any representations or warranties contained in these Terms. You also agree to hold WiGi Inc. harmless from any claims and expenses, including reasonable attorney\'s fees and court costs, related to any personal information, electronic media or other material you provide to or post on \nWiGime.com website.\n\nApplicable Law\nBy visiting WiGime.com, you agree that the laws of the State of Florida, without regard to principles of conflict of laws, will govern these Terms of Use and any dispute of any sort that might arise between you and WiGi Inc.\n\nMerger or Acquisition\nIt is possible that as we continue to develop our website and our business, WiGi Inc Services and/or related assets might be acquired or transferred as part of a merger. In the event of such a transaction, you understand and agree that WiGi Inc. may assign its rights under these Terms and that your personal information may be transferred to the succeeding entity. You will be provided with reasonable notice of such occurrence.\n\nDisputes\nAny dispute relating in any way to your visit to WiGime.com or to products or services you purchase through WiGime.com shall be submitted to confidential arbitration in Florida., except that, to the extent you have in any manner violated or threatened to violate WiGi Inc.\'s intellectual property rights, WiGi Inc. may seek injunctive or other appropriate relief in any state or federal court in the state of Florida, and you consent to exclusive jurisdiction and venue in such courts.\nArbitration under this agreement shall be conducted under the rules then prevailing of the American Arbitration Association. The arbitrator\'s award shall be binding and may be entered as a judgment in any court of competent jurisdiction. To the fullest extent permitted by applicable law, no arbitration under this Agreement shall be joined to an arbitration involving any other party subject to this Agreement, whether through class arbitration proceedings or otherwise. Any cause of action you may have with respect to your use of the WiGi, Inc Services must be commenced within 3 months after the claim or cause of action arises.\n\nPolicies, Modification and Severability\nWe reserve the right to make changes to our site, policies, and these Terms of Use at any time. Should you object to any terms and conditions of these Terms of Use or any subsequent modifications thereto or become dissatisfied with WiGi Inc. in any way, your only recourse is to immediately: (1) discontinue use of WiGi Inc.s Services and WiGime.com site and (2) terminate your subscription by contacting customersupport@WiGime.com. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.\n\nGeneral Information\nThese Terms constitute the entire agreement between you and WiGi Inc. parent company of WiGime.com and govern your use of the Service, superseding any prior agreements between you and WiGi Inc. You also may be subject to additional terms and conditions that may apply when you use affiliate services, third-party content or third-party software.\nThe section titles in these Terms of Use are for convenience only and have no legal or contractual effect.\n\nPlease report any violations of these Terms to WiGi Inc. by contacting customersupport@WiGime.com.\n\nNO WARRANTIES: LIMITATION OF LIABILITY.\nTHIS SITE IS PROVIDED \"AS IS\" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.\nWiGi Inc. also assumes no responsibility, and shall not be liable for any such damages to or viruses that may infect your computer equipment, software, data or other property on account of your access to, use of, or browsing in the Site or your downloading of any materials, data, text, images, video or audio from the Site or any linked sites.\nIn no event shall WiGi Inc. or any other party involved in creating, producing, maintaining or delivering the Site, or any of their affiliates, or the officers, directors, employees, shareholders, or agents of each of them, be liable for any damages of any kind, including without limitation any direct, special, incidental, indirect, exemplary, punitive or consequential damages, whether or not advised of the possibility of such damages, and on any theory of liability whatsoever, arising out of or in connection with the use or performance of, or your browsing in, or your links to other sites from, this Site.\n\nUNAFFILIATED PRODUCTS AND SITES\nDescriptions of, or references to, products, publications or sites not owned by WiGi Inc. or its affiliates do not imply endorsement of that product, publication or site. WiGi Inc. has not reviewed all material linked to the Site and is not responsible for the content of any such material and specifically does not endorse any materials which may appear on such linked sites. By permitting advertising by third parties on the Site, WiGi Inc does not make any warranties or representations of any kind as to the accuracy of the content of the suitability of any such advertisement. Your linking to any other sites is at your own risk.\n\nCOMMUNICATIONS WITH THIS SITE\nYou are prohibited from creating, posting or transmitting any unlawful material including but not limited to threatening, libelous, defamatory, obscene, scandalous, inflammatory, pornographic, or profane material or any material that could constitute or encourage conduct that would be considered a criminal offense, give rise to civil liability, or otherwise violate any law. WiGi Inc. will fully cooperate with any law enforcement authorities or court order requesting or directing WiGi Inc. to disclose the identity of or help identify or locate anyone posting any such information or materials.\n\nAny communication or material you transmit to WiGi Inc through the WiGime Web Site by e-mail or other written or electronic media, including any data, questions, comments, suggestions, or the like, are and will be treated as, non-confidential and non-proprietary.  WiGi Inc. cannot prevent the \"harvesting\" of information from this Site, and you may be contacted by WiGi Inc, or unrelated third parties, by e-mail or otherwise, within or outside of this Site. Anything you transmit may be edited by or on behalf of WiGi Inc., may or may not be posted to this Site at the sole discretion of WiGi Inc. and may be used by WiGi Inc. or its affiliates for any purpose, including, but not limited to, reproduction, disclosure, transmission, publication, broadcast and posting. \n\nFurthermore, WiGi Inc. is free to use any ideas, concepts, know-how, or techniques contained in any communication you send to the Site for any purpose whatsoever including, but not limited to, developing, manufacturing and marketing products using such information.\nAlthough WiGi Inc. may from time to time monitor or review discussion, chats, postings, transmissions, bulletin boards, and the like on the Site, WiGi Inc. is under no obligation to do so and assumes no responsibility or liability arising from the content of any such locations nor for any error, defamation, libel, slander, omission, falsehood, obscenity, pornography, profanity, danger, or inaccuracy contained in any information within such locations on the Site. WiGi Inc. assumes no responsibility or liability for any actions or communications by you or any unrelated third party within or outside of this Site.\n\nLINKING POLICY\nThis Site may contain links to sites owned or operated by parties other than WiGi Inc. such links are provided for your convenience only. WiGi Inc. does not control, and is not responsible for the availability or content of these external sites, or the security of, such sites. WiGi Inc. does not endorse the content, or any products or services available, on such sites. If you link to such sites you do so at your own risk.\n\nGOVERNING LAWS\nWiGime.com was developed with the intent for international use and shall be governed by the laws of the State of Florida, USA. This Site may be viewed internationally and may contain references to products or services not available in all countries at this time. In helping to provide better services for our members and future members WiGi Inc would like to be notified of the region the service is being requested. WiGi Inc. intends to make a reasonable effort, within the guidelines of country.s governing laws for those services to be available in such country.','2011-08-29 11:31:39','cbaechle','2011-08-30 01:22:06','cbaechle'),(2,' \nTerms of Use  (revision 1.2)\n\nWiGi Inc., the parent company, owner and operator of WiGime.com, and its affiliates, merchant retailers and suppliers (collectively referred to .WiGime\") provide mobile money/ gifting services, transactional based services and related product services (the \"Services\") to you, subject to the following:  If you visit or utilize the products and services at WiGime.com, you accept these terms and conditions.\n\nDescription of Services\nWiGi Inc. through the use of WiGime.com and their products provides online global mobile money, gifting services (of funds), money remittances and payment disbursement services for the convenience and security of our participants. By Participating in these Services, users are able to send (or remit and receive) to any person/user having a mobile device an amount of funds limited by laws of the sender.s country of origin. The sender will be directly establishing for their recipients a secure mobile proxy holding escrow account that will provide the recipient convenience and security to receive monies/funds gifts or reload anytime from any approved source for the use at participating on line ecommerce, brick & mortar retailers and service providers with the use of their registered mobile device. Charges are only incurred as a processing fee when reloading the account with additional funds is added by you from your personal account. Click here for fee structure.  WiGi Inc. expressed or implied, completely treats this account as a temporary holding account for the for the convenience of our members and WITHOUT ANY EXPRESSIVE OR IMPLIED INTENT by WiGi, Inc. or its members should not treat this account or any other similar account related to the Services as a financial interest bearing account  or similar like entity. WiGi, Inc. is not considered a financial institution. The funds will earn NO INTEREST can be or will never be earned on any gifts/funds temporarily residing in said accounts. In Addition this account is to be used as a temporary holding account and will not be FDIC insured or insure by ant other governmental or insurance body. WiGi, Inc. through WiGime.com website only provides a secure, convenient service of mobile money for its participating members.  \n\nWiGi, Inc. reserves the right to modify or add additional fees and billing terms, without prior notice to the participating members of our service. WiGi, Inc. may change the Services it offers at any time.\n\nUnless you elect terminate your account services, your credit card (OR any other registered financial account entity) designated to your account will remain securely on file and will be billed the applicable transaction fee when any additional funds requested by you are to be added to you account. Members must keep their registered email addresses, personal billing information and all other personal account information current and up to date. WiGi, Inc. may provide address for delivery to participating retailers; send important notices to email accounts, etc. In connection with billing we may receive updated information about your account from the financial institution issuing your credit card. If we are unable to process your credit card payment (or similar billing entity), your account will be temporarily SUSPENDED until we are contacted by you for updated billing instructions.\n \nTermination\nWiGi, Inc. agrees to terminate your account at any time upon request by notifying us of your wish to cancel your account at customersupport@WiGime.com.\nWiGi, Inc. may terminate your account or your access to and use of the Services, with or without cause at any time and effective immediately, at WiGi, Inc.\'s sole discretion, for any reason, including but not limited to your failure to conform to these Terms. If you violate these Terms in the Terms and Conditions requirements then WiGi, Inc., in its sole discretion, may also elect to require you to remedy any violation of these Terms, and/or take any other actions that WiGi Inc. deems appropriate to enforce its rights and pursue all available remedies.\nUpon termination of your account for these reasons, you will receive a refund in the mail or electronically for any amount remaining in the account after all reconciliation. In the event we have to collect unpaid amounts owed to WiGi, Inc. on your account, you will be liable for all attorneys\' and collection agency fees.\n \nPrivacy\nWiGi, Inc. has established a Privacy Policy to explain to you how your information is collected and used. Your use of the WiGime.com website or the WiGi Services signifies acknowledgement of, and agreement to our Privacy Policy.\nYou understand and agree that WiGi, Inc may store and process your information on state-of-the .art secure computer servers located in remote regions  domestically or outside your country of origin and by providing any data to WiGi, Inc. you consent to the secure transfer and storage of such information.\nYou acknowledge and agree that WiGi, Inc. may disclose information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to comply with business practice processes, to carry out these Terms and provide Services, or to protect the rights, property, or safety of WiGi, Inc. its employees, users and third party affiliates.\n\nElectronic Communications                       \nWhen you visit WiGime.com, or send emails to us, or contacting us through the any form of mobile process, you are communicating with us electronically. You consent to receive communications from us electronically. We will communicate with you by email to your registered email address or by posting notices on this site or through other forms of mobile communication. You agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.\n \nCopyright and Intellectual Property\n \nAll content included on this site, such as text, graphics, logos, icons, images, photographs, audio clips, video clips, digital downloads, data compilations, and software which is part of the WirelessGifitng.com website, is the property of WiGi, Inc. and or the respective WiGi member merchant\'s. However, content posted or created by users is assumed to be the responsibility of the user who   posted or created it, or the author that the poster credited as being the owner of the creation. Copyrighted material is protected by United States and international copyright laws.\nWiGi Inc..s selection, coordination and arrangement of all content on this site is the exclusive property of WiGi Inc. and is protected as a compilation by U.S. and international copyright laws. All software used on this site or in conjunction with the Services is the property of WiGi Inc., the parent company of WiGime.com, and is protected by United States and international copyright laws.\nAll other unregistered or registered trademarks are property of their respective owners. Nothing contained on this site should be construed as granting, by implication, estoppels or otherwise, any license or right to use any of WiGi Inc.s intellectual property displayed on the WiGime.com site without the written permission to CGC Inc. \n \nCopyright Complaints\n WiGi Inc. respects the intellectual property rights of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please contact a WiGi Inc. customer service agent for notice of claims of copyright or other intellectual property infringement (\"Agent\"), at customerservice@WiGime.com. Please provide our Agent with the following Notice:\nIdentify the copyrighted work or other intellectual property that you claim has been infringed;\nIdentify the image, movie or audio on the WiGi Inc. website that you claim is infringing, with enough detail so that we may locate it on the website;\nA statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;\nA statement by you declaring under penalty of perjury that (a) the above information in your Notice is accurate, and (b) that you are the owner of the copyright interest involved or that you are authorized to act on behalf of that owner;\nYour address, telephone number, and email address and your physical or electronic signature.\nWiGi Inc.s Legal Agent of record will forward this information to the alleged infringer.\n\nLicense and Site Access\nEND USER LICENSE AGREEMENT (.EULA.)        \nWiGi Inc. grants you a limited license to access and make personal use of the Services provided by WiGi Inc through the mobile applications and the WiGime.com site, but not to download (other than page caching) or modify it or any portion of it, except with the express written consent of WiGi Inc. This license does not include any resale or commercial use of this site or its contents. This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of WiGi Inc. Any unauthorized use terminates the permission or license granted by WiGi Inc.\nYou are granted a limited, revocable, and nonexclusive right to create hyperlinks to WiGime.com page so long as the links do not portray WiGi Inc or its suppliers or their products or services in a false or misleading manner.\n\nThis End User License Agreement (\"EULA\") is an agreement between the user (\"you\" or \"your\") and WiGi, Inc. (\"we\", \"our\", \"us\") concerning your use of this software and all related documentation and services, and all updates and upgrades that replace or supplement the foregoing and are not distributed with a separate EULA (collectively, the \"Software\"). \nBy clicking \"Yes\" or \"Yes, I agree\" or similar language presented on your handset or Web page, or by using the Software, you agree to the terms and conditions of this EULA.\n\nI.  Software\n\nA.  Description of Software\nThe Software provides a means to view and interact with personal financial information and other information. We receive this information from third parties and you grant us and our service providers permission to retrieve the information and to use the information to provide the services enabled by the Software. We reserve the right to change the nature of the services available through the Software at any time, and to refuse to make any transaction you request through the Software. The Software may not be available on all wireless devices and on all mobile service carriers or providers, and may not be accessible or may have limited utility over some mobile networks in situations such as, but not limited to, roaming.\n\nB.  Use of Software\nThe Software will not work unless you use it properly. You accept responsibility for making sure that you understand how to use the Software before you actually do so, and then that you always use the Software in accordance with all applicable instructions. You also accept responsibility for making sure that you know how to properly use your wireless device. We may change or upgrade the Software from time to time. In the event of such changes or upgrades, you are responsible for making sure that you understand how to use the Software as changed or upgraded. We will not be liable to you for any losses caused by your failure to properly use the Software or your wireless device.\n\nC.   Relationship to Other Agreements\nThe Software forms a connection across wireless carrier data networks to the computer systems of your financial institution(s) and other third parties (\"Providers\"). Information about your account(s) comes from, and all processing occurs on, the Providers\' computer systems. We do not provide the information about your accounts that is displayed on your wireless device.\nYou have separate agreements with your Providers for their services, and you agree that you remain subject to those agreements. You also agree that you continue to be subject to the terms and conditions of your existing agreements with any other service providers, including but not limited to your mobile service carrier or provider. This EULA does not amend or supersede any of those agreements. Those agreements may provide for fees, limitations and restrictions which might impact your use of the Software (for example, your Provider may charge fees associated with the Software or your mobile service carrier may impose data usage or text message charges for your use of or interaction with the Software, including while downloading the Software or other use of your wireless device when using the Software), and you agree to be solely responsible for all such fees, limitations and restrictions. You acknowledge and agree that neither we nor your Provider are responsible for your mobile service carrier or provider\'s products and services. You acknowledge and agree that your mobile service carrier or provider is not the provider of any financial services available through or related to the Software, and is not responsible for any of the materials, information, products, or services made available to you in connection with the Software. Accordingly, you agree to resolve any problems with your Provider directly with that Provider without involving your mobile service carrier or us, and you agree to resolve any problems with your mobile service carrier directly with that mobile service carrier without involving your Provider or us.\n\nII. WiGi SOFTWARE LICENSE AGREEMENT                 \n\nA.  License\nSubject to your compliance with this EULA, you are hereby granted a personal, limited, non-transferable, non-exclusive, non-sub licensable, and non-assignable license (\"License\") to download, install and/or use the Software on your wireless device within the United States and its territories and within those countries where export and use of the Software is permitted under United States law and under the laws of the location where the Software is used. In the event that you obtain a new or different wireless device, you will be required to download and install the Software to that new or different wireless device.\n\nB.  License Restrictions / Revocation\nThis License shall be deemed revoked immediately upon (i) by not complying with these terms and conditions and noncompliance with this EULA; (ii) any reason to suspect infringement or copying of software (iii) any illegal activity domestically or international as defined in your country of origin (iv) written notice to you at any time, with or without cause; or (iv) us ceasing to provide service or ceasing to provide service for your Provider, wireless carrier, wireless device, or bank. In the event this License is revoked for any of the foregoing reasons, you agree to promptly delete the Software from your wireless device, except that if you change carriers and/or numbers without changing wireless devices you may continue using the Software if you re-enroll under your new carrier/number. We reserve all rights not granted to you in this EULA. The provisions of Sections I, II.B, III, and IV of this EULA shall survive revocation of the License.\n\nIII. YOUR OBLIGATIONS\nWhen you use the Software you agree to the following:\n\n1. Account Ownership/Accurate Information. You represent that you are the legal owner of the accounts and related information which may be accessed via the Software. You represent and agree that all information you provide in connection with the Software is accurate, current and complete, and that you have the right to provide such information to us and that we have the right to use the information for the purpose of providing the services available in connection with the Software. You agree to not misrepresent your identity or your account information. You agree to keep your account information up to date and accurate. You agree that we and our service providers may send you, by short message service (with an opportunity to opt-out), e-mail, and other methods, communications relating to the Software, related items, and offers, including without limitation welcome messages, information, and surveys and other requests for information. You agree to use the Software carefully, to keep your passwords and PINs for using the Software confidential and secure and not share them with others, to check your statements and transactions regularly, and to report any errors to your Provider promptly.\n\n2. Location Based Information. If you use any location-based feature of the Software you agree that your geographic location and other personal information may be accessed and disclosed through the Software. If you wish to revoke access to such information you must cease using location-based features of the Software.\n\n3. Export Control. You acknowledge that the Software is subject to the United States (U.S.) government export control and economic sanctions laws and regulations, which may restrict or prohibit the use, export, re-export, or transfer of the Software. You agree that you will not directly or indirectly use in, or export, re-export, transfer, or release the Software to, any destination, person, entity, or end-use prohibited or restricted under such laws or regulations without prior U.S. government authorization as applicable, either in writing or as permitted by applicable regulation. Without limitation, you agree that you will not use the Software in any embargoed or sanctioned country such as Cuba, Iran, North Korea, Sudan, and Syria.\n\n4. Proprietary Rights. You may not copy, reproduce, distribute, or create derivative works from the Software, and you agree not to reverse engineer or reverse compile or disassemble the Software.\n\n5. User Conduct. You agree not to use the Software or the content or information delivered through the Software in any way that would: (a) infringe any third-party copyright, patent, trademark, trade secret, or other proprietary rights or rights of publicity or privacy, including any rights in the Software; (b) be fraudulent or involve the sale of counterfeit or stolen items, including but not limited to use of the Software to impersonate another person or entity; (c) violate any law, statute, ordinance or regulation (including but not limited to those governing export control, consumer protection, unfair competition, anti-discrimination or false advertising); (d) be false, misleading or inaccurate; (e) create liability for us or our affiliates or service providers, or cause us to lose all or part of the services of any of our service providers; (f) be defamatory, libelous, unlawfully threatening or unlawfully harassing; (g) be perceived as illegal, offensive or objectionable; (h) interfere with or disrupt networks connected to the Software; (i) interfere with or disrupt the use of the Software by any other user; (j) use the Software to gain unauthorized entry or access to the systems or information of others, or (k) copy or display to third parties the information provided by the Software, except as required by the services available through the Software.\n\n6. No Commercial Use or Re-Sale. You agree that the Software is for personal use only. You agree not to resell or make commercial use of the Software.\n\n7. Indemnification. You agree to indemnify, defend, and hold us and our affiliates and service providers harmless from and against any and all third party claims, liability, damages, expenses and costs (including but not limited to reasonable attorneys\' fees) caused by or arising from your use of the Software, your violation of this EULA, your violation of applicable federal, state or local law, regulation or ordinance, or your infringement (or infringement by any other user of your account) of any intellectual property or other right of anyone.\n\nIV. ADDITIONAL PROVISIONS\n\nA. Software Limitations\n\n1. Neither we nor our service providers can always foresee or anticipate technical or other difficulties related to the Software. These difficulties may result in loss of data, loss or change of personalization settings, or other Software, service, or wireless device interruptions. You agree that neither we nor any of our service providers assumes responsibility for any disclosure of account information to third parties, or for the timeliness, deletion, miss-delivery or failure to store any user data, communications, or personalization settings in connection with your use of the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n\n2. You agree that neither we nor any of our service providers assumes responsibility for the operation, security, functionality, or availability of any wireless device or mobile network which you use to access the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n\n3. Nothing in the Software is an offer to sell any of the components or devices used or referenced in connection therewith. Certain components for use in the U.S. are available only through licensed suppliers. Some components are not available for use in the U.S. Support services in the U.S. may be limited.\n\n4. You agree to exercise caution when using the Software on your wireless device and to use good judgment and discretion when obtaining or transmitting information.\n\n5. Information available via the Software may differ from the information that is available directly from your Provider, and may not be current or up-to-date. Information available directly through your Provider\'s website may not be available via the Software, may be described using different terminology, or may be more current than the information available via the Software, including but not limited to account balance information.  Additionally, you agree that neither we nor our service providers will be liable for any errors or delays in the information presented, or for any actions taken in reliance thereon.\n\nB.  Cancellation\nYou may cancel your participation in the Software and Services Provided by emailing us at .customersupport@wigime.com. and deleting the Software. We reserve the right to cancel the Software at any time without notice. We may suspend your access to the Software at any time without notice and for any reason, including but not limited to your non-use of the Software. You agree that we will not be liable to you or any third party for any modification or discontinuance of the Software.\n\nC.  Use of Data\nWe and our service providers will use information you provide for purposes of providing the Software, the services it enables, and related functions such as billing and the communications set forth above, and to prepare analyses and compilations of aggregate customer data that does not identify you (such as the number of customers who signed up for the Software in a month).\n\nD. Third Party Beneficiary\nYou agree that the Providers, our service providers, and the owners, operators, and merchant(s) of record of any software application store or kiosk/business (\"Application Store\") from which you may have downloaded or otherwise obtained the Software, may rely upon your agreements and representations in this EULA, and such Providers, service providers, and Application Store are third party beneficiaries of this EULA, with the power to enforce its provisions against you, including without limitation the liability limitations and warranty disclaimers below for any claim related to or arising out of the Software or this EULA.\n\nE.  Limitations and Warranty Disclaimers\nWE AND OUR SERVICE PROVIDERS DISCLAIM ALL WARRANTIES RELATING TO THE SOFTWARE OR OTHERWISE IN CONNECTION WITH THIS EULA, WHETHER ORAL OR WRITTEN, EXPRESS, IMPLIED OR STATUTORY, INCLUDING WITHOUT LIMITATION THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR PARTICULAR PURPOSE AND NON-INFRINGEMENT.\nNEITHER WE NOR OUR SERVICE PROVIDERS WILL BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY INDIRECT, INCIDENTAL, EXEMPLARY, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES OF ANY KIND, OR FOR ANY LOSS OF PROFITS, BUSINESS, OR DATA, WHETHER BASED IN STATUTE, CONTRACT, TORT OR OTHERWISE, EVEN IF WE OR OUR SERVICE PROVIDERS HAVE BEEN ADVISED OF, OR HAD REASON TO KNOW OF, THE POSSIBILITY OF SUCH DAMAGES. Some states/jurisdictions do not allow the exclusion or limitation of incidental or consequential damages, so the above limitation or exclusion may not apply to you.\nUNDER NO CIRCUMSTANCE WILL THE TOTAL LIABILITY OF US OR OUR SERVICE PROVIDERS TO YOU IN CONNECTION WITH THE SOFTWARE OR RELATED SERVICES OR OTHERWISE IN CONNECTION WITH THIS EULA EXCEED $100.\nYOU UNDERSTAND AND AGREE THAT ANY APPLICATION STORE FROM WHICH YOU MAY HAVE DOWNLOADED THE SOFTWARE MAKES NO WARRANTY AND SHALL NOT BE LIABLE IN ANY MANNER WHATSOEVER FOR ANY CLAIMS RELATED TO OR ARISING OUT OF THE SOFTWARE OR THIS EULA, INCLUDING BUT NOT LIMITED TO ANY CLAIMS (I) IN RELATION TO THE SALE, DISTRIBUTION OR USE OF THE SOFTWARE, OR THE PERFORMANCE OR NON-PERFORMANCE OF THE SOFTWARE, (II) FOR PRODUCT LIABILITY, (III) THAT THE APPLICATION FAILS TO CONFORM TO ANY LEGAL OR REGULATORY REQUIREMENT, (IV) UNDER CONSUMER PROTECTION LAWS, OR (V) SEEKING DEFENSE AND INDEMNITY FOR INFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS.\n\nF.  Disputes\nWE EACH AGREE THAT ANY AND ALL CLAIMS OR DISPUTES IN ANY WAY RELATED TO OR CONCERNING THIS EULA, THE SOFTWARE, OR OUR SERVICES OR PRODUCTS, WILL BE RESOLVED BY BINDING ARBITRATION, RATHER THAN IN COURT. Such arbitration shall take place in Stuart, Florida, and shall be administered by the American Arbitration Association under its Commercial Arbitration Rules (and not under any other or ancillary rules or procedures such as the Supplementary Procedures for Consumer-Related Disputes or the Wireless Industry Arbitration Rules). This includes any claims you may assert against other parties relating to services provided to you (such as our suppliers or retail dealers) in connection with this EULA, the Software, or our services or products. We each also agree that this EULA affects interstate commerce so that the Federal Arbitration Act and federal arbitration law apply. THERE IS NO JUDGE OR JURY IN ARBITRATION, AND COURT REVIEW OF AN ARBITRATION AWARD IS LIMITED. THE ARBITRATOR(S) MUST FOLLOW THIS AGREEMENT AND CAN AWARD THE SAME DAMAGES AND RELIEF AS A COURT (INCLUDING ATTORNEYS\' FEES). The parties waive any right they may have to proceed on behalf of or against a class, and agree that any claim, counterclaim, cross-claim or the like shall be brought on an individual basis and not consolidated with any other party\'s claim, counterclaim, cross-claim or the like. The arbitration award shall be in writing, shall be signed by the arbitrator(s), and shall include a reasoned opinion setting forth findings of fact and conclusions of law. Judgment on the award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof.\nNotwithstanding the immediately preceding paragraph or the Severability section below, if the foregoing prohibition on class arbitration is not enforced for any reason, then the immediately preceding paragraph also shall not be enforced and any class action claims shall be brought exclusively in the United States District Court for the Southern District Court of Florida.\nAny demand for arbitration or claim in litigation must be filed within 3 months of the time the cause of action accrued, or the cause of action shall forever be barred.\n\nG.  Severability\nIf any provision of this EULA is declared invalid by a court or other tribunal of competent jurisdiction then, except to the extent set forth in the Disputes section above, such provision shall be ineffective only to the extent of such invalidity, so that the remainder of that provision and all remaining provisions of this EULA shall be valid and enforceable to the fullest extent permitted by applicable law.\n\nH.  Entire Agreement\nThis EULA constitutes the entire agreement between us and you relating to the Software and related services, supersedes any other agreements between us and you relating thereto, and may only be amended by a subsequent written agreement posted on our website (with subsequent use of the Software by you), sent to you by e-mail or SMS (with subsequent use of the Software by you), clicked through by you on your wireless device or otherwise, or signed by each of us.\n\nThis software consists of proprietary content and contributions made by professional programmers on behalf of WiGi, Inc.\nThe WiGi Software License, Version 1.2\nCopyright (c) 2008-2011 WiGi, Inc. All rights reserved.\n\"This product includes software developed by the WiGi, Inc. a US-based software development company.\n\nAlternately, this acknowledgement may appear in the software itself, if and wherever such third-party acknowledgements normally appear.\n The names WiGi., WiGiMe.com, WiGiMe. or WirelessGifting. must always be used to endorse or promote products derived from this software service. For written permission, please contact inquiry@wigime.com.\n\nAccount Security\nBy  participating in the services WiGi Inc and WiGime.com provides, you understand, agree and will be  responsible for maintaining the confidentiality of your account, your password, your PIN#, your mobile application, your personal mobile device and all other personal information pertaining to your account  and you are responsible for restricting access to your computer, your mobile device or any other electronic or non-electronic system containing WirelessGifting applications, your WirelessGifting Account information, and you further agree to accept all personal responsibility as for all activities that occur under your account including but not limited to, protecting and securing your passwords, your PIN# and all other personal and pertinent account information. You further agree to immediately notify WiGi Inc. through customersupport@WiGime.com of any unauthorized use of your account or any other breach of security known to you; and you are responsible for locking down your WiGime account upon knowing this information either by visiting the WiGime website, using the WiGime Mobile application or calling WiGi Inc. \n\nWiGi Inc. uses industry standard security measures to protect the loss, misuse and alteration of the information under our control. Although we make good faith efforts to store the non-public information collected by the WiGime.com website and the mobile application in a secure operating environment that is not available to the public, we cannot always guarantee 100% complete security. Further, while we make every effort to ensure the integrity and security of our network and systems, we can never guarantee 100% security measures will prevent third-party \"hackers\" from illegally accessing our site. WiGi, Inc will always keep up with the current and changing security state .of- the art measures as they become available.\n\nContent\nUse of the Services by you is subject to all applicable local, state, national and international laws and regulations. You may post photos or other electronic images, movies, audio clips, reviews, comments, suggestions, ideas, questions, or other information (collectively \"Content\"), so long as the Content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, chain letters, mass mailings, or any form of \"spam.\" WiGi Inc. reserves the right (but not the obligation) to remove or edit said illicit or derogatory Content at anytime, but does not regularly review posted Content.\n\nLicense Granted by Users\nWiGi, Inc. does not claim ownership in the photographs or other electronic images, movies, audio clips or other media created or uploaded by participants or members. Unless we indicate otherwise, if you upload Content, including any Media, to the WiGime website/servers, you grant WiGi, Inc. a nonexclusive, royalty-free right to publish distribute and display the Content as we deem appropriate in providing the Services authorized or requested by you and others, including the right to use the name that is submitted in connection with such Content. You further understand and agree that, in order to help ensure smooth operation of our system, we may keep backup copies of Content indefinitely.\nYou represent and warrant that you own or otherwise control all of the rights to the Content (including without limitation images, artwork, movies, text, and audio files) that you create and post; that use of the Content you supply does not violate these Terms of Use and will not cause injury to any person or entity; and that you will indemnify WiGi Inc. for all claims resulting from Content you supply. WiGi, Inc. has the right but not the obligation to monitor and edit or remove any activity or Content. You understand and agree that WiGi, Inc. takes no responsibility and assumes no liability for any Content created or posted by you or any third party.\n\nDisclaimer of Warranties and Limitations of Liability\nTHIS SITE IS PROVIDED BY WiGi, Inc. ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS. WiGi Inc. MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS, PRODUCT DESCRIPTIONS OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF THIS SITE IS AT YOUR SOLE RISK.\nTO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LAW, WiGi Inc. DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. TO THE FULLEST EXTENT PERMITTED BY LAW, WiGi Inc. DISCLAIMS ANY WARRANTIES FOR THE SECURITY, RELIABILITY, TIMELINESS, ACCURACY, AND PERFORMANCE OF ITS WEBSITE AND THE SERVICES, AND DOES NOT WARRANT THAT THE PRODUCT DESCRIPTIONS OR OTHER CONTENT ON ITS WEBSTIE ARE ACCURATE, COMPLETE, RELIABLE, CURRENT OR ERROR-FREE OR THAT THIS SITE, ITS SERVERS, OR EMAIL SENT FROM WiGi Inc. ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. UNDER NO CIRCUMSTANCES SHALL WiGi Inc. BE LIABLE ON ACCOUNT OF YOUR USE OR MISUSE OF THE WIGime.COM WEBSITE OR THE WiGime SERVICES, WHETHER THE DAMAGES ARISE FROM USE OR MISUSE OF THE WiGime.COM WEBSITE OR THE SERVICES, FROM INABILITY TO USE THE WiGime.COM WEBSITE OR THE SERVICES, OR THE INTERRUPTION, SUSPENSION, MODIFICATION, ALTERATION, OR TERMINATION OF THE WiGime.COM WEBSITE OR THE SERVICES, OR VIEWING THE SITES INFORMATION, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES. WiGi Inc. CANNOT BE HELD LIABLE FOR THE ACCIDENTAL LOSS OF PERSONAL INFORMATION AND PERSONAL ELECTRONIC MEDIA ON ITS SITE, OR THE COPYING OF ELECTRONIC MEDIA BY ITS USERS. OUR LIABILITY, AND THE LIABILITY OF OUR SUBSIDIARIES, EMPLOYEES, VENDORS AND SUPPLIERS, TO YOU IN ANY CIRCUMSTANCE IS LIMITED TO $100.\nCERTAIN STATE LAWS and COUNTRIES DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.\n\nIndemnity\nYou agree to indemnify and hold WiGi Inc, its subsidiaries, affiliates, successors, assigns, directors, officers, agents, employees, service providers, and suppliers harmless from any dispute that may arise from your breach of these Terms of Use or violation of any representations or warranties contained in these Terms. You also agree to hold WiGi Inc. harmless from any claims and expenses, including reasonable attorney\'s fees and court costs, related to any personal information, electronic media or other material you provide to or post on \nWiGime.com website.\n\nApplicable Law\nBy visiting WiGime.com, you agree that the laws of the State of Florida, without regard to principles of conflict of laws, will govern these Terms of Use and any dispute of any sort that might arise between you and WiGi Inc.\n\nMerger or Acquisition\nIt is possible that as we continue to develop our website and our business, WiGi Inc Services and/or related assets might be acquired or transferred as part of a merger. In the event of such a transaction, you understand and agree that WiGi Inc. may assign its rights under these Terms and that your personal information may be transferred to the succeeding entity. You will be provided with reasonable notice of such occurrence.\n\nDisputes\nAny dispute relating in any way to your visit to WiGime.com or to products or services you purchase through WiGime.com shall be submitted to confidential arbitration in Florida., except that, to the extent you have in any manner violated or threatened to violate WiGi Inc.\'s intellectual property rights, WiGi Inc. may seek injunctive or other appropriate relief in any state or federal court in the state of Florida, and you consent to exclusive jurisdiction and venue in such courts.\nArbitration under this agreement shall be conducted under the rules then prevailing of the American Arbitration Association. The arbitrator\'s award shall be binding and may be entered as a judgment in any court of competent jurisdiction. To the fullest extent permitted by applicable law, no arbitration under this Agreement shall be joined to an arbitration involving any other party subject to this Agreement, whether through class arbitration proceedings or otherwise. Any cause of action you may have with respect to your use of the WiGi, Inc Services must be commenced within 3 months after the claim or cause of action arises.\n\nPolicies, Modification and Severability\nWe reserve the right to make changes to our site, policies, and these Terms of Use at any time. Should you object to any terms and conditions of these Terms of Use or any subsequent modifications thereto or become dissatisfied with WiGi Inc. in any way, your only recourse is to immediately: (1) discontinue use of WiGi Inc.s Services and WiGime.com site and (2) terminate your subscription by contacting customersupport@WiGime.com. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.\n\nGeneral Information\nThese Terms constitute the entire agreement between you and WiGi Inc. parent company of WiGime.com and govern your use of the Service, superseding any prior agreements between you and WiGi Inc. You also may be subject to additional terms and conditions that may apply when you use affiliate services, third-party content or third-party software.\nThe section titles in these Terms of Use are for convenience only and have no legal or contractual effect.\n\nPlease report any violations of these Terms to WiGi Inc. by contacting customersupport@WiGime.com.\n\nNO WARRANTIES: LIMITATION OF LIABILITY.\nTHIS SITE IS PROVIDED \"AS IS\" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.\nWiGi Inc. also assumes no responsibility, and shall not be liable for any such damages to or viruses that may infect your computer equipment, software, data or other property on account of your access to, use of, or browsing in the Site or your downloading of any materials, data, text, images, video or audio from the Site or any linked sites.\nIn no event shall WiGi Inc. or any other party involved in creating, producing, maintaining or delivering the Site, or any of their affiliates, or the officers, directors, employees, shareholders, or agents of each of them, be liable for any damages of any kind, including without limitation any direct, special, incidental, indirect, exemplary, punitive or consequential damages, whether or not advised of the possibility of such damages, and on any theory of liability whatsoever, arising out of or in connection with the use or performance of, or your browsing in, or your links to other sites from, this Site.\n\nUNAFFILIATED PRODUCTS AND SITES\nDescriptions of, or references to, products, publications or sites not owned by WiGi Inc. or its affiliates do not imply endorsement of that product, publication or site. WiGi Inc. has not reviewed all material linked to the Site and is not responsible for the content of any such material and specifically does not endorse any materials which may appear on such linked sites. By permitting advertising by third parties on the Site, WiGi Inc does not make any warranties or representations of any kind as to the accuracy of the content of the suitability of any such advertisement. Your linking to any other sites is at your own risk.\n\nCOMMUNICATIONS WITH THIS SITE\nYou are prohibited from creating, posting or transmitting any unlawful material including but not limited to threatening, libelous, defamatory, obscene, scandalous, inflammatory, pornographic, or profane material or any material that could constitute or encourage conduct that would be considered a criminal offense, give rise to civil liability, or otherwise violate any law. WiGi Inc. will fully cooperate with any law enforcement authorities or court order requesting or directing WiGi Inc. to disclose the identity of or help identify or locate anyone posting any such information or materials.\n\nAny communication or material you transmit to WiGi Inc through the WiGime Web Site by e-mail or other written or electronic media, including any data, questions, comments, suggestions, or the like, are and will be treated as, non-confidential and non-proprietary.  WiGi Inc. cannot prevent the \"harvesting\" of information from this Site, and you may be contacted by WiGi Inc, or unrelated third parties, by e-mail or otherwise, within or outside of this Site. Anything you transmit may be edited by or on behalf of WiGi Inc., may or may not be posted to this Site at the sole discretion of WiGi Inc. and may be used by WiGi Inc. or its affiliates for any purpose, including, but not limited to, reproduction, disclosure, transmission, publication, broadcast and posting. \n\nFurthermore, WiGi Inc. is free to use any ideas, concepts, know-how, or techniques contained in any communication you send to the Site for any purpose whatsoever including, but not limited to, developing, manufacturing and marketing products using such information.\nAlthough WiGi Inc. may from time to time monitor or review discussion, chats, postings, transmissions, bulletin boards, and the like on the Site, WiGi Inc. is under no obligation to do so and assumes no responsibility or liability arising from the content of any such locations nor for any error, defamation, libel, slander, omission, falsehood, obscenity, pornography, profanity, danger, or inaccuracy contained in any information within such locations on the Site. WiGi Inc. assumes no responsibility or liability for any actions or communications by you or any unrelated third party within or outside of this Site.\n\nLINKING POLICY\nThis Site may contain links to sites owned or operated by parties other than WiGi Inc. such links are provided for your convenience only. WiGi Inc. does not control, and is not responsible for the availability or content of these external sites, or the security of, such sites. WiGi Inc. does not endorse the content, or any products or services available, on such sites. If you link to such sites you do so at your own risk.\n\nGOVERNING LAWS\nWiGime.com was developed with the intent for international use and shall be governed by the laws of the State of Florida, USA. This Site may be viewed internationally and may contain references to products or services not available in all countries at this time. In helping to provide better services for our members and future members WiGi Inc would like to be notified of the region the service is being requested. WiGi Inc. intends to make a reasonable effort, within the guidelines of country.s governing laws for those services to be available in such country.','2011-08-29 11:31:48','cbaechle','2011-08-30 01:22:06','cbaechle'),(3,'Terms of Use  (revision 1.3)\n \nWiGi Inc., the parent company, owner and operator of WiGime.com, and its affiliates, merchant retailers and suppliers (collectively referred to .WiGime\") provide a convenient service for both consumers and merchants consisting of mobile money/ gifting services, transactional based services and related product services (the \"Services\") to you, subject to the following:  If you visit or utilize the products and services at WiGime.com, you accept these terms and conditions.\n \nDescription of Services\nWiGi Inc. through the use of WiGime.com and their products provides escrowing services of online global mobile money, gifting services (of funds), money remittances and payment disbursement for the convenience and security of our participants. By Participating in these Services, the user achknowlegedes the establishment of a personal account enabling users to carry out functions as it relates to services of sending and receiving monies to any person/user/Merchant, anywhere, having a mobile device or on-line, an amount of funds limited by laws of the sender.s country of origin. The user.s account is a secure mobile proxy holding escrow account that will provide the user the utmost level of security and convenience to send/receive monies/funds gifts or reload anytime from any approved source for the use at participating on line ecommerce, brick & mortar retailers and service providers with the use of their registered mobile device. Charges are incurred as a processing fee when sending money and by merchants as a transaction fee for purchases made and /or advertising and WiGi, Inc. reserves the right to modify or add additional fees and billing terms, without prior notice to the participating members of our service.  WiGi Inc. expressed or implied, completely treats this account as a personal individual escrow holding account for the convenience of our members and WITHOUT ANY EXPRESSIVE OR IMPLIED INTENT by WiGi, Inc. or its members should not treat this account or any other similar account related to the Services as a financial interest bearing account  or similar like entity. WiGi, Inc. is not considered a financial institution or a money transfer service and extends its license to the end user to use the provided service for their convenience and security. The funds will currently earn no interest. In Addition this account is to be used as a temporary holding account and is not FDIC insured or insured by any other governmental or insurance body. WiGi, Inc. through WiGime.com website only provides a secure, convenient service for its participating members as an extension of a license to use it services. It is up to the individual person(s) and/or entity to follow all applicable local, state and federal laws as it relates to the use of this service.\n \n \nUnless you elect terminate your account services, your credit card (OR any other registered financial account entity) designated to your account will remain securely on file. Applicable transaction fees will be deducted from time to time from your secure mobile escrow proxy account when those billable services are used. Members must keep their registered email addresses, personal billing information and all other personal account information current and up to date. WiGi, Inc. may provide address for delivery of purchased products to participating retailers; send important notices to email accounts, etc. In connection with billing we may receive updated information about your account from the financial institution(s) issuing your credit card. If we are unable to process your credit card payment (or similar billing entity), your account will be temporarily SUSPENDED until we are contacted by you for updated billing instructions.\n \n \n \nTermination\nWiGi, Inc. agrees to terminate your account at any time upon request by notifying us of your wish to cancel your account at support@WiGime.com. WiGi, Inc. may terminate your account or your access to and use of the Services, with or without cause at any time and effective immediately, at WiGi Inc.\'s sole discretion, for any reason, including but not limited to your failure to conform to these Terms, acts of suspicious money laundering schemes, terrorist acts or fraudulent activity. If you violate these Terms in the Terms and Conditions requirements then WiGi, Inc., in its sole discretion, may also require you to remedy any violation of these Terms, and/or take any other actions that WiGi Inc. deems appropriate to enforce its rights and pursue all available remedies.\nUpon termination of your account for these reasons, you will receive a refund in the mail or electronically for any amount remaining in the account after all reconciliation. In the event we have to collect unpaid amounts owed to WiGi, Inc. on your account, you will be liable for all attorneys\' and collection agency fees.\n \nPrivacy\nWiGi, Inc. has established a Privacy Policy to explain to you how your information is collected and used. Your use of the WiGime.com website or the WiGi Services signifies acknowledgement of, and agreement to our Privacy Policy. You understand and agree that WiGi, Inc may store and process your information on state-of-the .art secure computer servers along with back up which may be located in remote regions both domestically and internationally and by providing any data to WiGi, Inc. you consent to the secure transfer and storage of such information.\nYou acknowledge and agree that WiGi, Inc. may disclose information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to comply with business practice processes, governing local, state and federal laws in order to carry out these Terms and provide Services, and/or to protect the rights, property, or safety of WiGi, Inc. its employees, users and third party affiliates.\n\nElectronic Communications                               \nWhen you visit WiGime.com, or send emails to us, or contacting us through the any form of mobile process, you are communicating with us electronically. You consent to receive communications from us electronically. We will communicate with you by email to your registered email address or by posting notices on this site or through other forms of mobile communication. You agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.\n \nCopyright and Intellectual Property\n \nAll content included on this site, such as text, graphics, logos, icons, images, photographs, audio clips, video clips, digital downloads, data compilations, and software which is part of the WiGime.com website, is the property of WiGi, Inc. and or the respective WiGi member merchant\'s. However, content posted or created by users is assumed to be the responsibility of the user who   posted or created it, or the author that the poster credited as being the owner of the creation. Copyrighted material including but not limited to its source code, and website and mobile applications is protected by United States and international copyright laws.\nWiGi Inc..s selection, coordination and arrangement of all content on this site is the exclusive property of WiGi Inc. and is protected as a compilation by U.S. and international copyright laws. All software used on this site or in conjunction with the Services is the property of WiGi Inc., the parent company of WiGime.com, and is protected by United States and international copyright laws.\nAll other unregistered or registered trademarks are property of their respective owners. Nothing contained on this site should be construed as granting, by implication, estoppels or otherwise, any license or right to use any of WiGi Inc.s intellectual property displayed on the WiGime.com site without the written permission to WiGi, Inc.\n \nCopyright Complaints\n WiGi Inc. respects the intellectual property rights of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please contact a WiGi Inc. customer service agent for notice of claims of copyright or other intellectual property infringement (\"Agent\"), at support@WiGime.com. Please provide our Agent with the following Notice:\nIdentify the copyrighted work or other intellectual property that you claim has been infringed;\nIdentify the image, movie or audio on the WiGi Inc. website that you claim is infringing, with enough detail so that we may locate it on the website;\nA statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;\nA statement by you declaring under penalty of perjury that (a) the above information in your Notice is accurate, and (b) that you are the owner of the copyright interest involved or that you are authorized to act on behalf of that owner;\nYour address, telephone number, and email address and your physical or electronic signature.\nWiGi Inc.s Legal Agent of record will forward this information to the alleged infringer.\n \nLicense and Site Access\nEND USER LICENSE AGREEMENT (.EULA.)                \nWiGi Inc. grants you ( The consumer or Merchant) a limited license to access and make personal use of the Services provided by WiGi Inc system through the mobile applications and the WiGime.com site, but not to download (other than page caching) or modify it or any portion of it, except with the express written consent of WiGi Inc. This license does not include any resale or commercial use of this site or its contents. This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of WiGi Inc. Any unauthorized use terminates the permission or license granted by WiGi Inc.\nYou are granted a limited, revocable, and nonexclusive right to create hyperlinks to WiGime.com page so long as the links do not portray WiGi Inc or its suppliers or their products or services in a false or misleading manner.\n \nThis End User License Agreement (\"EULA\") is an agreement between the user (\"you\" or \"your\") and WiGi, Inc. (\"we\", \"our\", \"us\") concerning your use of this software and all related documentation and services, and all updates and upgrades that replace or supplement the foregoing and are not distributed with a separate EULA (collectively, the \"Software\").\nBy clicking \"Yes\" or \"Yes, I agree\" or similar language presented on your handset or Web page, or by using the Software, you agree to the terms and conditions of this EULA.\n \n \n \nI.          Software\n \nA.          Description of Software\nThe Software provides a means to view and interact with personal account information and other related information. We receive this information from third parties and you grant us and our service providers permission to retrieve the information and to use the information to provide the services enabled by the Software. We reserve the right to change the nature of the services available through the Software at any time, and to refuse to make any transaction you request through the Software. The Software may not be available on all wireless devices and on all mobile service carriers or providers, and may not be accessible or may have limited utility over some mobile networks in situations such as, but not limited to, roaming.\n \nB.          Use of Software\nThe Software will not work unless you use it properly. You accept responsibility for making sure that you understand how to use the Software before you actually do so, and then that you always use the Software in accordance with all applicable instructions. You also accept responsibility for making sure that you know how to properly use your wireless device. We may change or upgrade the Software from time to time. In the event of such changes or upgrades, you are responsible for making sure that you understand how to use the Software as changed or upgraded. We will not be liable to you for any losses caused by your failure to properly use the Software or your wireless device. You give WiGi, Inc the right to upgrade the software at anytime or send messages/updates to the mobile device which may incur costs as it relates to the use of your mobile device.s data plan services through Internet connectivity or text (SMS) messaging.\n \n \nC.           Relationship to Other Agreements\nThe Software forms a connection across wireless carrier data networks to the computer systems of escrow accounts and to your personal financial institution(s) and other third parties (\"Providers\"). Information about your account(s) comes from, and all processing occurs on, the Providers\' computer systems. We do not provide the information about your accounts that is displayed on your wireless device.\nYou have separate agreements with your Providers for their services, and you agree that you remain subject to those agreements. You also agree that you continue to be subject to the terms and conditions of your existing agreements with any other service providers, including but not limited to your mobile service carrier or provider. This EULA does not amend or supersede any of those agreements. Those agreements may provide for fees, limitations and restrictions which might impact your use of the Software (for example, your Provider may charge fees associated with the Software or your mobile service carrier may impose data usage or text message charges for your use of or interaction with the Software, including while downloading the Software or other use of your wireless device when using the Software), and you agree to be solely responsible for all such fees, limitations and restrictions. You acknowledge and agree that neither we nor your Provider are responsible for your mobile service carrier or provider\'s products and services. You acknowledge and agree that your mobile service carrier or provider is not the provider of any financial services available through or related to the Software, and is not responsible for any of the materials, information, products, or services made available to you in connection with the Software. Accordingly, you agree to resolve any problems with your Provider directly with that Provider without involving your mobile service carrier or us (WiGi, Inc), and you agree to resolve any problems with your mobile service carrier directly with that mobile service carrier without involving your Provider or us (WiGi, Inc).\n \nII. WiGi Inc. SOFTWARE LICENSE AGREEMENT                         \n \nA.          License\nSubject to your compliance with this EULA, you are hereby granted a personal, limited, non-transferable, non-exclusive, non-sub licensable, and non-assignable license (\"License\") to download, install and/or use the Software on your wireless device within the United States and its territories and within those countries where export and use of the Software is permitted under United States law and under the laws of the location where the Software is used. In the event that you obtain a new or different wireless device, you will be required to download and install the Software to that new or different wireless device and re-register your mobile device.\n \nB.          License Restrictions / Revocation\nThis License shall be deemed revoked immediately upon (i) by not complying with these terms and conditions and noncompliance with this EULA; (ii) any reason to suspect infringement or copying of software (iii) any illegal activity domestically or international as defined in your country of origin (iv) written notice to you at any time, with or without cause; or (iv) us ceasing to provide service or ceasing to provide service for your Provider, wireless carrier, wireless device, or financial entities. In the event this License is revoked for any of the foregoing reasons, you agree to promptly delete the Software from your wireless device, except that if you change carriers and/or numbers without changing wireless devices you may continue using the Software if you re-enroll under your new carrier/number you must re-register the mobile device to your account. We reserve all rights not granted to you in this EULA. The provisions of Sections I, II.B, III, and IV of this EULA shall survive revocation of the License.\n \nIII. YOUR OBLIGATIONS\nWhen you use the Software you agree to the following:\n \n1. Account Ownership/Accurate Information. You represent that you are the legal owner of the accounts and related information which may be accessed via the Software. You represent and agree that all information you provide in connection with the Software is accurate, current and complete, and that you have the right to provide such information to us and that we have the right to use the information for the purpose of providing the services available in connection with the Software. You agree to not misrepresent your identity or your account information. You agree to keep your account information up to date and accurate. You agree that we and/or our service providers may send you, by short message service (an opportunity to opt-out), e-mail, and other methods, communications relating to the Software, related items, and offers, including without limitation welcome messages, information, and surveys and other requests for information. You agree to use the Software carefully, to keep your passwords and PINs for using the Software confidential and secure and not share them with others, to check your statements and transactions regularly, and to report any errors to your Provider promptly.\n \n2. Location Based Information: For security purposes location-based features of the Software may be used and you agree that your geographic location and other personal information may be accessed and disclosed through the Software for your security.\n \n3. Export Control. You acknowledge that the Software may be subject to certain governmental export control and economic sanctions laws and regulations, which may restrict or prohibit the use, export, re-export, or transfer of the Software. You agree that you will not directly or indirectly use in, or export, re-export, transfer, or release the Software to, any destination, person, entity, or end-use prohibited or restricted under such laws or regulations without prior federal government authorization as applicable, either in writing or as permitted by applicable regulation. Without limitation, you agree that you will not use the Software in any embargoed or sanctioned country such as Cuba, Iran, North Korea, Sudan, and Syria.\n \n4. Proprietary Rights. You may not copy, reproduce, distribute, or create derivative works from the Software, and you agree not to reverse engineer or reverse compile or disassemble the Software.\n \n5. User Conduct. You agree not to use the Software or the content or information delivered through the Software in any way that would: (a) infringe any parent company (WiGi, Inc) or third-party copyright, patent, trademark, trade secret, or other proprietary rights or rights of publicity or privacy, including any rights in the Software; (b) be fraudulent or involve the sale of counterfeit or stolen items, including but not limited to use of the Software to impersonate another person or entity; (c) violate any law, statute, ordinance or regulation (including but not limited to those governing export control, consumer protection, unfair competition, anti-discrimination or false advertising); (d) be false, misleading or inaccurate; (e) create liability for us or our affiliates or service providers, or cause us to lose all or part of the services of any of our service providers; (f) be defamatory, libelous, unlawfully threatening or unlawfully harassing; (g) be perceived as illegal, offensive or objectionable; (h) interfere with or disrupt networks connected to the Software; (i) interfere with or disrupt the use of the Software by any other user; (j) use the Software to gain unauthorized entry or access to the systems or information of others, or (k) copy or display to third parties the information provided by the Software, except as required by the services available through the Software.\n \n6. No Commercial Use or Re-Sale. You agree that the Software is for personal use only. You agree not to resell or make commercial use of the Software.\n \n7. Indemnification. You agree to indemnify, defend, and hold us the company (WiGi, Inc) and our affiliates and service providers harmless from and against any and all third party claims, liability, damages, expenses and costs (including but not limited to reasonable attorneys\' fees) caused by or arising from your use of the Software, your violation of this EULA, your violation of applicable federal, state or local law, regulation or ordinance, or your infringement (or infringement by any other user of your account) of any intellectual property or other right of anyone.\n \nIV. ADDITIONAL PROVISIONS\n \nA. Software Limitations\n \n1. Neither the company (WiGi, Inc) nor our service providers can always foresee or anticipate technical, acts of nature or catastrophic events including terrorist.s acts or other difficulties related to the Software, the WiGime System, its serves etc. Although all information is stored in a Class 1 PCI compliant hosting data centers, these difficulties/events may result in loss of data, loss or change of personalization settings, preferences, or other Software, service, or wireless device interruptions. You agree that neither we nor any of our service providers assumes responsibility for any disclosure of account information to third parties, or for the timeliness, deletion, miss-delivery or failure to store any user data, communications, or personalization settings in connection with your use of the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n \n2. You agree that neither we nor any of our service providers assumes responsibility for the operation, security, functionality, or availability of any wireless device or mobile network which you use to access the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n \n3. Nothing in the Software is an offer to sell any of the components or devices used or referenced in connection therewith.\n \n4. You agree to exercise caution when using the Software on your wireless device and to use good judgment and discretion when obtaining or transmitting information.\n \n5. Information available via the Software may differ from the information that is available directly from your website, and may not be current or up-to-date and may occasional result from time delays. Information available directly through your website may not be available via the Software, may be described using different terminology, or may be more current than the information available via the Software, including but not limited to account balance information.  Additionally, you agree that neither we nor our service providers will be liable for any errors or delays in the information presented, or for any actions taken in reliance thereon.\n \nB.          Cancellation\nYou may cancel your participation in the Software and Services Provided by emailing us at .support@wigime.com. and deleting the Software. We reserve the right to cancel the Software at any time without notice. We may suspend your access to the Software at any time without notice and for any reason, including but not limited to your non-use of the Software. You agree that we will not be liable to you or any third party for any modification or discontinuance of the Software.\n \nC.          Use of Data\nWe and our service providers will use information you provide for purposes of providing the Software, the services it enables, and related functions such as billing and the communications set forth above, and to prepare analyses and compilations of aggregate customer data that may or may not identify you.\n \nD. Third Party Beneficiary\nYou agree that the Providers, our service providers, and the owners, operators, and merchant(s) of record of any software application store or kiosk/business (\"Application Store\") from which you may have downloaded or otherwise obtained the Software, may rely upon your agreements and representations in this EULA, and such Providers, service providers, and Application Store are third party beneficiaries of this EULA, with the power to enforce its provisions against you, including without limitation the liability limitations and warranty disclaimers below for any claim related to or arising out of the Software or this EULA.\n \nE.          Limitations and Warranty Disclaimers\nWE AND OUR SERVICE PROVIDERS DISCLAIM ALL WARRANTIES RELATING TO THE SOFTWARE OR OTHERWISE IN CONNECTION WITH THIS EULA, WHETHER ORAL OR WRITTEN, EXPRESS, IMPLIED OR STATUTORY, INCLUDING WITHOUT LIMITATION THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR PARTICULAR PURPOSE AND NON-INFRINGEMENT.\nNEITHER WE NOR OUR SERVICE PROVIDERS WILL BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY INDIRECT, INCIDENTAL, EXEMPLARY, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES OF ANY KIND, OR FOR ANY LOSS OF PROFITS, BUSINESS, OR DATA, WHETHER BASED IN STATUTE, CONTRACT, TORT OR OTHERWISE, EVEN IF WE OR OUR SERVICE PROVIDERS HAVE BEEN ADVISED OF, OR HAD REASON TO KNOW OF, THE POSSIBILITY OF SUCH DAMAGES. Some states/jurisdictions do not allow the exclusion or limitation of incidental or consequential damages, so the above limitation or exclusion may not apply to you.\nUNDER NO CIRCUMSTANCE WILL THE TOTAL LIABILITY OF US OR OUR SERVICE PROVIDERS TO YOU IN CONNECTION WITH THE SOFTWARE OR RELATED SERVICES OR OTHERWISE IN CONNECTION WITH THIS EULA EXCEED $100.\nYOU UNDERSTAND AND AGREE THAT ANY APPLICATION STORE FROM WHICH YOU MAY HAVE DOWNLOADED THE SOFTWARE MAKES NO WARRANTY AND SHALL NOT BE LIABLE IN ANY MANNER WHATSOEVER FOR ANY CLAIMS RELATED TO OR ARISING OUT OF THE SOFTWARE OR THIS EULA, INCLUDING BUT NOT LIMITED TO ANY CLAIMS (I) IN RELATION TO THE SALE, DISTRIBUTION OR USE OF THE SOFTWARE, OR THE PERFORMANCE OR NON-PERFORMANCE OF THE SOFTWARE, (II) FOR PRODUCT LIABILITY, (III) THAT THE APPLICATION FAILS TO CONFORM TO ANY LEGAL OR REGULATORY REQUIREMENT, (IV) UNDER CONSUMER PROTECTION LAWS, OR (V) SEEKING DEFENSE AND INDEMNITY FOR INFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS.\n \nF.          Disputes\nWE EACH AGREE THAT ANY AND ALL CLAIMS OR DISPUTES IN ANY WAY RELATED TO OR CONCERNING THIS EULA, THE SOFTWARE, OR OUR SERVICES OR PRODUCTS, WILL BE RESOLVED BY BINDING ARBITRATION, RATHER THAN IN COURT. Such arbitration shall take place in Boca Raton, Florida, and shall be administered by the American Arbitration Association under its Commercial Arbitration Rules (and not under any other or ancillary rules or procedures such as the Supplementary Procedures for Consumer-Related Disputes or the Wireless Industry Arbitration Rules). This includes any claims you may assert against other parties relating to services provided to you (such as our suppliers or retail dealers) in connection with this EULA, the Software, or our services or products. We each also agree that this EULA may affect interstate commerce so that the Federal Arbitration Act and federal arbitration law apply. THERE IS NO JUDGE OR JURY IN ARBITRATION, AND COURT REVIEW OF AN ARBITRATION AWARD IS LIMITED. THE ARBITRATOR(S) MUST FOLLOW THIS AGREEMENT AND CAN AWARD THE SAME DAMAGES AND RELIEF AS A COURT (INCLUDING ATTORNEYS\' FEES). The parties waive any right they may have to proceed on behalf of or against a class, and agree that any claim, counterclaim, cross-claim or the like shall be brought on an individual basis and not consolidated with any other party\'s claim, counterclaim, cross-claim or the like. The arbitration award shall be in writing, shall be signed by the arbitrator(s), and shall include a reasoned opinion setting forth findings of fact and conclusions of law. Judgment on the award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof.\nNotwithstanding the immediately preceding paragraph or the Severability section below, if the foregoing prohibition on class arbitration is not enforced for any reason, then the immediately preceding paragraph also shall not be enforced and any class action claims shall be brought exclusively in the United States District Court for the Southern District Court of Florida.\nAny demand for arbitration or claim in litigation must be filed within 3 months of the time the cause of action accrued, or the cause of action shall forever be barred.\n \nG.          Severability\nIf any provision of this EULA is declared invalid by a court or other tribunal of competent jurisdiction then, except to the extent set forth in the Disputes section above, such provision shall be ineffective only to the extent of such invalidity, so that the remainder of that provision and all remaining provisions of this EULA shall be valid and enforceable to the fullest extent permitted by applicable law.\n \nH.          Entire Agreement\nThis EULA constitutes the entire agreement between the company (WiGi, Inc) and you (the consumers and merchants) relating to the Software and related services, supersedes any other agreements between us and you relating thereto, and may only be amended by a subsequent written agreement posted on our website (with subsequent use of the Software by you), sent to you by e-mail or SMS (with subsequent use of the Software by you), clicked through by you on your wireless device or otherwise, or signed by each of us.\n \nThis software consists of proprietary content and contributions made by professional programmers on behalf of WiGi, Inc. The WiGi Software License, Version 5.1\nCopyright (c) 2008-2011 WiGi, Inc. All rights reserved. \"This product includes software developed by the WiGi, Inc. a US-based software development company.\n \nAlternately, this acknowledgement may appear in the software itself, if and wherever such third-party acknowledgements normally appear.\n The names WiGi., WiGiMe.com, WiGime. or WirelessGifting., WiGime ScanAd must always be used to endorse or promote products derived from this software service. For written permission, please contact inquiry@wigime.com.\n \nAccount Security\nBy  participating in the services WiGi Inc and WiGime.com provides, you understand, agree and will be  responsible for maintaining the confidentiality of your account, your password, your PIN#, your mobile application, your personal mobile device and all other personal information pertaining to your account  and you are responsible for restricting access to your computer, your mobile device or any other electronic or non-electronic system containing WiGime applications, your escrow account information, and you further agree to accept all personal responsibility as for all activities that occur under your account including but not limited to, protecting and securing your passwords, your PIN# and all other personal and pertinent account information. You agree to be maintaining all pertinent personal account and financial information up to date. You further agree to immediately notify WiGi Inc. through support@WiGime.com of any unauthorized use of your account or any other breach of security known to you; and you are responsible for locking down your WiGime account upon knowing this information either by visiting the WiGime website, using the WiGime Mobile application or contacting WiGi Inc customer support.\n \nWiGi Inc. uses industry standard security measures to protect the loss, misuse and alteration of the information under our control. Although we make good faith efforts to store the non-public information collected by the WiGime.com website and the mobile application in a secure operating environment that is not available to the public, we cannot always guarantee 100% complete security. Further, while we make every effort to ensure the integrity and security of our network and systems, we can never guarantee 100% security measures will prevent third-party \"hackers\" from illegally accessing our site. WiGi, Inc will always keep up with the current and changing security state .of- the art measures as they become available.\n \nContent\nUse of the Services by you is subject to all applicable local, state, national and international laws and regulations. By using the service you are granted a limited license for the use of the WiGi, Inc services. You may post photos or other electronic images, movies, audio clips, reviews, comments, suggestions, ideas, questions, or other information (collectively \"Content\"), so long as the Content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, chain letters, mass mailings, or any form of \"spam.\" WiGi Inc. reserves the right (but not the obligation) to remove or edit said illicit or derogatory Content at anytime, but does not regularly review posted Content.\n \nLicense Granted by Users\nWiGi, Inc. does not claim ownership in the photographs or other electronic images, movies, audio clips or other media created or uploaded by participants or members. Unless we indicate otherwise, if you upload Content, including any Media, to the WiGime website/servers, you grant WiGi, Inc. a nonexclusive, royalty-free right to publish distribute and display the Content as we deem appropriate in providing the Services authorized or requested by you and others, including the right to use the name that is submitted in connection with such Content. You further understand and agree that, in order to help ensure smooth operation of our system, we may keep backup copies of Content indefinitely.\nYou represent and warrant that you own or otherwise control all of the rights to the Content (including without limitation images, artwork, movies, text, and audio files) that you create and post; that use of the Content you supply does not violate these Terms of Use and will not cause injury to any person or entity; and that you will indemnify WiGi Inc. for all claims resulting from Content you supply. WiGi, Inc. has the right but not the obligation to monitor and edit or remove any activity or Content. You understand and agree that WiGi, Inc. takes no responsibility and assumes no liability for any Content created or posted by you or any third party.\n \nDisclaimer of Warranties and Limitations of Liability\nTHIS SITE IS PROVIDED BY WiGi, Inc. ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS. WiGi Inc. MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS, PRODUCT DESCRIPTIONS OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF THIS SITE IS AT YOUR SOLE RISK.\nTO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LOCAL, STATE and FEDERAL LAWs, WiGi Inc. DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. TO THE FULLEST EXTENT PERMITTED BY LAW, WiGi Inc. DISCLAIMS ANY WARRANTIES FOR THE SECURITY, RELIABILITY, TIMELINESS, ACCURACY, AND PERFORMANCE OF ITS WEBSITE AND THE SERVICES, AND DOES NOT WARRANT THAT THE PRODUCT DESCRIPTIONS OR OTHER CONTENT ON ITS WEBSITE ARE ACCURATE, COMPLETE, RELIABLE, CURRENT OR ERROR-FREE OR THAT THIS SITE, ITS SERVERS, OR EMAIL SENT FROM WiGi Inc. ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. UNDER NO CIRCUMSTANCES SHALL WiGi  Inc. BE LIABLE ON ACCOUNT OF YOUR USE OR MISUSE OF THE WIGime.COM WEBSITE OR THE WiGime SERVICES, WHETHER THE DAMAGES ARISE FROM USE OR MISUSE OF THE WiGime.COM WEBSITE OR THE SERVICES, FROM INABILITY TO USE THE WiGime.COM WEBSITE OR THE SERVICES, OR THE INTERRUPTION, SUSPENSION, MODIFICATION, ALTERATION, OR TERMINATION OF THE WiGime.COM WEBSITE, MOBILE APPLICATION OR THE SERVICES, OR VIEWING THE SITES INFORMATION, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES. WiGi Inc. CANNOT BE HELD LIABLE FOR THE ACCIDENTAL LOSS OF PERSONAL INFORMATION AND PERSONAL ELECTRONIC MEDIA ON ITS SITE, OR THE COPYING OF ELECTRONIC MEDIA BY ITS USERS. OUR LIABILITY, AND THE LIABILITY OF OUR SUBSIDIARIES, EMPLOYEES, VENDORS AND SUPPLIERS, TO YOU IN ANY CIRCUMSTANCE IS LIMITED TO $100.\nCERTAIN LOCAL, STATE and FEDERAL LAWS and COUNTRIES DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.\n \nIndemnity\nYou agree to indemnify and hold WiGi Inc, its subsidiaries, affiliates, successors, assigns, directors, officers, agents, employees, service providers, and suppliers harmless from any dispute that may arise from your breach of these Terms of Use or violation of any representations or warranties contained in these Terms. You also agree to hold WiGi Inc. harmless from any claims and expenses, including reasonable attorney\'s fees and court costs, related to any personal information, electronic media or other material you provide to or post on\nWiGime.com website.\n \nApplicable Law\nBy visiting WiGime.com, you agree that the laws of the State of Florida, without regard to principles of conflict of laws, will govern these Terms of Use and any dispute of any sort that might arise between you and WiGi Inc.\n \nMerger or Acquisition\nIt is possible that as we continue to develop our website and our business, WiGi Inc Services and/or related assets might be acquired or transferred as part of a merger. In the event of such a transaction, you understand and agree that WiGi Inc. may assign its rights under these Terms and that your personal information may be transferred to the succeeding entity. You will be provided with reasonable notice of such occurrence.\n \nDisputes\nAny dispute relating in any way to your visit to WiGime.com or to products or services you use through WiGime.com shall be submitted to confidential arbitration in Florida., except that, to the extent you have in any manner violated or threatened to violate WiGi Inc.\'s intellectual property rights, WiGi Inc. may seek injunctive or other appropriate relief in any state or federal court in the state of Florida, and you consent to exclusive jurisdiction and venue in such courts.\nArbitration under this agreement shall be conducted under the rules then prevailing of the American Arbitration Association. The arbitrator\'s award shall be binding and may be entered as a judgment in any court of competent jurisdiction. To the fullest extent permitted by applicable law, no arbitration under this Agreement shall be joined to an arbitration involving any other party subject to this Agreement, whether through class arbitration proceedings or otherwise. Any cause of action you may have with respect to your use of the WiGi, Inc Services must be commenced within 3 months after the claim or cause of action arises.\n \nPolicies, Modification and Severability\nWe reserve the right to make changes to our site, policies, and these Terms of Use at any time. Should you object to any terms and conditions of these Terms of Use or any subsequent modifications thereto or become dissatisfied with WiGi Inc. in any way, your only recourse is to immediately: (1) discontinue use of WiGi Inc.s Services and WiGime.com site and (2) terminate your subscription by contacting support@WiGime.com. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.\n \n \nGeneral Information\nThese Terms constitute the entire agreement between you and WiGi Inc. parent company of WiGime.com and govern your use of the Services, superseding any prior agreements between you and WiGi Inc. You also may be subject to additional terms and conditions that may apply when you use affiliate services, third-party content or third-party software.\nThe section titles in these Terms of Use are for convenience only and have no legal or contractual effect.\n \nPlease report any violations of these Terms to WiGi Inc. by contacting support@WiGime.com.\n \nNO WARRANTIES: LIMITATION OF LIABILITY.\nTHIS SITE IS PROVIDED \"AS IS\" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.\nWiGi Inc. also assumes no responsibility, and shall not be liable for any such damages to or viruses that may infect your computer equipment, software, data or other property on account of your access to, use of, or browsing in the Site or your downloading of any materials, data, text, images, video or audio from the Site or any linked sites.\nIn no event shall WiGi Inc. or any other party involved in creating, producing, maintaining or delivering the Site, or any of their affiliates, or the officers, directors, employees, shareholders, or agents of each of them, be liable for any damages of any kind, including without limitation any direct, special, incidental, indirect, exemplary, punitive or consequential damages, whether or not advised of the possibility of such damages, and on any theory of liability whatsoever, arising out of or in connection with the use or performance of, or your browsing in, or your links to other sites from, this Site.\n \nUNAFFILIATED PRODUCTS AND SITES\nDescriptions of, or references to, products, publications or sites not owned by WiGi Inc. or its affiliates do not imply endorsement of that product, publication or site. WiGi Inc. has not reviewed all material linked to the Site and is not responsible for the content of any such material and specifically does not endorse any materials which may appear on such linked sites. By permitting advertising by third parties on the Site, WiGi Inc does not make any warranties or representations of any kind as to the accuracy of the content of the suitability of any such advertisement. Your linking to any other sites is at your own risk.\n \nCOMMUNICATIONS WITH THIS SITE\nYou are prohibited from creating, posting or transmitting any unlawful material including but not limited to threatening, libelous, defamatory, obscene, scandalous, inflammatory, pornographic, or profane material or any material that could constitute or encourage conduct that would be considered a criminal offense, give rise to civil liability, or otherwise violate any law. WiGi Inc. will fully cooperate with any law enforcement authorities or court order requesting or directing WiGi Inc. to disclose the identity of or help identify or locate anyone posting any such information or materials.\n \nAny communication or material you transmit to WiGi Inc through the WiGime Web Site by e-mail or other written or electronic media, including any data, questions, comments, suggestions, or the like, are and will be treated as, non-confidential and non-proprietary.  WiGi Inc. cannot prevent the \"harvesting\" of information from this Site, and you may be contacted by WiGi Inc, or unrelated third parties, by e-mail or otherwise, within or outside of this Site. Anything you transmit may be edited by or on behalf of WiGi Inc., may or may not be posted to this Site at the sole discretion of WiGi Inc. and may be used by WiGi Inc. or its affiliates for any purpose, including, but not limited to, reproduction, disclosure, transmission, publication, broadcast and posting.\n \nFurthermore, WiGi Inc. is free to use any ideas, concepts, know-how, or techniques contained in any communication you send to the Site for any purpose whatsoever including, but not limited to, developing, manufacturing and marketing products using such information.\nAlthough WiGi Inc. may from time to time monitor or review discussion, chats, postings, transmissions, bulletin boards, and the like on the Site, WiGi Inc. is under no obligation to do so and assumes no responsibility or liability arising from the content of any such locations nor for any error, defamation, libel, slander, omission, falsehood, obscenity, pornography, profanity, danger, or inaccuracy contained in any information within such locations on the Site. WiGi Inc. assumes no responsibility or liability for any actions or communications by you or any unrelated third party within or outside of this Site.\n \nLINKING POLICY\nThis Site may contain links to sites owned or operated by parties other than WiGi Inc. such links are provided for your convenience only. WiGi Inc. does not control, and is not responsible for the availability or content of these external sites, or the security of, such sites. WiGi Inc. does not endorse the content, or any products or services available, on such sites. If you link to such sites you do so at your own risk.\n \nGOVERNING LAWS\nWiGime.com was developed with the intent for international use and shall be governed by the laws of the State of Florida, USA. This Site may be viewed internationally and may contain references to products or services not available in all countries at this time. In helping to provide better services for our members and future members WiGi Inc would like to be notified of the region the service is being requested. WiGi Inc. intends to make a reasonable effort, within the guidelines of country.s governing laws for those services to be available in such country.\n ',NULL,NULL,'2011-09-01 12:02:49',NULL),(4,'Terms of Use  (revision 1.3)',NULL,NULL,'2011-09-01 12:32:00',NULL),(5,'Terms of Use  (revision 1.3)\n \nWiGi Inc., the parent company, owner and operator of WiGime.com, and its affiliates, merchant retailers and suppliers (collectively referred to â€œWiGime\") provide a convenient service for both consumers and merchants consisting of mobile money/ gifting services, transactional based services and related product services (the \"Services\") to you, subject to the following:  If you visit or utilize the products and services at WiGime.com, you accept these terms and conditions.\n \nDescription of Services\nWiGi Inc. through the use of WiGime.com and their products provides escrowing services of online global mobile money, gifting services (of funds), money remittances and payment disbursement for the convenience and security of our participants. By Participating in these Services, the user achknowlegedes the establishment of a personal account enabling users to carry out functions as it relates to services of sending and receiving monies to any person/user/Merchant, anywhere, having a mobile device or on-line, an amount of funds limited by laws of the senderâ€™s country of origin. The userâ€™s account is a secure mobile proxy holding escrow account that will provide the user the utmost level of security and convenience to send/receive monies/funds gifts or reload anytime from any approved source for the use at participating on line ecommerce, brick & mortar retailers and service providers with the use of their registered mobile device. Charges are incurred as a processing fee when sending money and by merchants as a transaction fee for purchases made and /or advertising and WiGi, Inc. reserves the right to modify or add additional fees and billing terms, without prior notice to the participating members of our service.  WiGi Inc. expressed or implied, completely treats this account as a personal individual escrow holding account for the convenience of our members and WITHOUT ANY EXPRESSIVE OR IMPLIED INTENT by WiGi, Inc. or its members should not treat this account or any other similar account related to the Services as a financial interest bearing account  or similar like entity. WiGi, Inc. is not considered a financial institution or a money transfer service and extends its license to the end user to use the provided service for their convenience and security. The funds will currently earn no interest. In Addition this account is to be used as a temporary holding account and is not FDIC insured or insured by any other governmental or insurance body. WiGi, Inc. through WiGime.com website only provides a secure, convenient service for its participating members as an extension of a license to use it services. It is up to the individual person(s) and/or entity to follow all applicable local, state and federal laws as it relates to the use of this service.\n \n \nUnless you elect terminate your account services, your credit card (OR any other registered financial account entity) designated to your account will remain securely on file. Applicable transaction fees will be deducted from time to time from your secure mobile escrow proxy account when those billable services are used. Members must keep their registered email addresses, personal billing information and all other personal account information current and up to date. WiGi, Inc. may provide address for delivery of purchased products to participating retailers; send important notices to email accounts, etc. In connection with billing we may receive updated information about your account from the financial institution(s) issuing your credit card. If we are unable to process your credit card payment (or similar billing entity), your account will be temporarily SUSPENDED until we are contacted by you for updated billing instructions.\n \n \n \nTermination\nWiGi, Inc. agrees to terminate your account at any time upon request by notifying us of your wish to cancel your account at support@WiGime.com. WiGi, Inc. may terminate your account or your access to and use of the Services, with or without cause at any time and effective immediately, at WiGi Inc.\'s sole discretion, for any reason, including but not limited to your failure to conform to these Terms, acts of suspicious money laundering schemes, terrorist acts or fraudulent activity. If you violate these Terms in the Terms and Conditions requirements then WiGi, Inc., in its sole discretion, may also require you to remedy any violation of these Terms, and/or take any other actions that WiGi Inc. deems appropriate to enforce its rights and pursue all available remedies.\nUpon termination of your account for these reasons, you will receive a refund in the mail or electronically for any amount remaining in the account after all reconciliation. In the event we have to collect unpaid amounts owed to WiGi, Inc. on your account, you will be liable for all attorneys\' and collection agency fees.\n \nPrivacy\nWiGi, Inc. has established a Privacy Policy to explain to you how your information is collected and used. Your use of the WiGime.com website or the WiGi Services signifies acknowledgement of, and agreement to our Privacy Policy. You understand and agree that WiGi, Inc may store and process your information on state-of-the â€“art secure computer servers along with back up which may be located in remote regions both domestically and internationally and by providing any data to WiGi, Inc. you consent to the secure transfer and storage of such information.\nYou acknowledge and agree that WiGi, Inc. may disclose information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to comply with business practice processes, governing local, state and federal laws in order to carry out these Terms and provide Services, and/or to protect the rights, property, or safety of WiGi, Inc. its employees, users and third party affiliates.\n\nElectronic Communications                               \nWhen you visit WiGime.com, or send emails to us, or contacting us through the any form of mobile process, you are communicating with us electronically. You consent to receive communications from us electronically. We will communicate with you by email to your registered email address or by posting notices on this site or through other forms of mobile communication. You agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.\n \nCopyright and Intellectual Property\n \nAll content included on this site, such as text, graphics, logos, icons, images, photographs, audio clips, video clips, digital downloads, data compilations, and software which is part of the WiGime.com website, is the property of WiGi, Inc. and or the respective WiGi member merchant\'s. However, content posted or created by users is assumed to be the responsibility of the user who   posted or created it, or the author that the poster credited as being the owner of the creation. Copyrighted material including but not limited to its source code, and website and mobile applications is protected by United States and international copyright laws.\nWiGi Inc.â€™s selection, coordination and arrangement of all content on this site is the exclusive property of WiGi Inc. and is protected as a compilation by U.S. and international copyright laws. All software used on this site or in conjunction with the Services is the property of WiGi Inc., the parent company of WiGime.com, and is protected by United States and international copyright laws.\nAll other unregistered or registered trademarks are property of their respective owners. Nothing contained on this site should be construed as granting, by implication, estoppels or otherwise, any license or right to use any of WiGi Incâ€™s intellectual property displayed on the WiGime.com site without the written permission to WiGi, Inc.\n \nCopyright Complaints\n WiGi Inc. respects the intellectual property rights of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please contact a WiGi Inc. customer service agent for notice of claims of copyright or other intellectual property infringement (\"Agent\"), at support@WiGime.com. Please provide our Agent with the following Notice:\nIdentify the copyrighted work or other intellectual property that you claim has been infringed;\nIdentify the image, movie or audio on the WiGi Inc. website that you claim is infringing, with enough detail so that we may locate it on the website;\nA statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;\nA statement by you declaring under penalty of perjury that (a) the above information in your Notice is accurate, and (b) that you are the owner of the copyright interest involved or that you are authorized to act on behalf of that owner;\nYour address, telephone number, and email address and your physical or electronic signature.\nWiGi Incâ€™s Legal Agent of record will forward this information to the alleged infringer.\n \nLicense and Site Access\nEND USER LICENSE AGREEMENT (â€œEULAâ€)                \nWiGi Inc. grants you ( The consumer or Merchant) a limited license to access and make personal use of the Services provided by WiGi Inc system through the mobile applications and the WiGime.com site, but not to download (other than page caching) or modify it or any portion of it, except with the express written consent of WiGi Inc. This license does not include any resale or commercial use of this site or its contents. This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of WiGi Inc. Any unauthorized use terminates the permission or license granted by WiGi Inc.\nYou are granted a limited, revocable, and nonexclusive right to create hyperlinks to WiGime.com page so long as the links do not portray WiGi Inc or its suppliers or their products or services in a false or misleading manner.\n \nThis End User License Agreement (\"EULA\") is an agreement between the user (\"you\" or \"your\") and WiGi, Inc. (\"we\", \"our\", \"us\") concerning your use of this software and all related documentation and services, and all updates and upgrades that replace or supplement the foregoing and are not distributed with a separate EULA (collectively, the \"Software\").\nBy clicking \"Yes\" or \"Yes, I agree\" or similar language presented on your handset or Web page, or by using the Software, you agree to the terms and conditions of this EULA.\n \n \n \nI.          Software\n \nA.          Description of Software\nThe Software provides a means to view and interact with personal account information and other related information. We receive this information from third parties and you grant us and our service providers permission to retrieve the information and to use the information to provide the services enabled by the Software. We reserve the right to change the nature of the services available through the Software at any time, and to refuse to make any transaction you request through the Software. The Software may not be available on all wireless devices and on all mobile service carriers or providers, and may not be accessible or may have limited utility over some mobile networks in situations such as, but not limited to, roaming.\n \nB.          Use of Software\nThe Software will not work unless you use it properly. You accept responsibility for making sure that you understand how to use the Software before you actually do so, and then that you always use the Software in accordance with all applicable instructions. You also accept responsibility for making sure that you know how to properly use your wireless device. We may change or upgrade the Software from time to time. In the event of such changes or upgrades, you are responsible for making sure that you understand how to use the Software as changed or upgraded. We will not be liable to you for any losses caused by your failure to properly use the Software or your wireless device. You give WiGi, Inc the right to upgrade the software at anytime or send messages/updates to the mobile device which may incur costs as it relates to the use of your mobile deviceâ€™s data plan services through Internet connectivity or text (SMS) messaging.\n \n \nC.           Relationship to Other Agreements\nThe Software forms a connection across wireless carrier data networks to the computer systems of escrow accounts and to your personal financial institution(s) and other third parties (\"Providers\"). Information about your account(s) comes from, and all processing occurs on, the Providers\' computer systems. We do not provide the information about your accounts that is displayed on your wireless device.\nYou have separate agreements with your Providers for their services, and you agree that you remain subject to those agreements. You also agree that you continue to be subject to the terms and conditions of your existing agreements with any other service providers, including but not limited to your mobile service carrier or provider. This EULA does not amend or supersede any of those agreements. Those agreements may provide for fees, limitations and restrictions which might impact your use of the Software (for example, your Provider may charge fees associated with the Software or your mobile service carrier may impose data usage or text message charges for your use of or interaction with the Software, including while downloading the Software or other use of your wireless device when using the Software), and you agree to be solely responsible for all such fees, limitations and restrictions. You acknowledge and agree that neither we nor your Provider are responsible for your mobile service carrier or provider\'s products and services. You acknowledge and agree that your mobile service carrier or provider is not the provider of any financial services available through or related to the Software, and is not responsible for any of the materials, information, products, or services made available to you in connection with the Software. Accordingly, you agree to resolve any problems with your Provider directly with that Provider without involving your mobile service carrier or us (WiGi, Inc), and you agree to resolve any problems with your mobile service carrier directly with that mobile service carrier without involving your Provider or us (WiGi, Inc).\n \nII. WiGi Inc. SOFTWARE LICENSE AGREEMENT                         \n \nA.          License\nSubject to your compliance with this EULA, you are hereby granted a personal, limited, non-transferable, non-exclusive, non-sub licensable, and non-assignable license (\"License\") to download, install and/or use the Software on your wireless device within the United States and its territories and within those countries where export and use of the Software is permitted under United States law and under the laws of the location where the Software is used. In the event that you obtain a new or different wireless device, you will be required to download and install the Software to that new or different wireless device and re-register your mobile device.\n \nB.          License Restrictions / Revocation\nThis License shall be deemed revoked immediately upon (i) by not complying with these terms and conditions and noncompliance with this EULA; (ii) any reason to suspect infringement or copying of software (iii) any illegal activity domestically or international as defined in your country of origin (iv) written notice to you at any time, with or without cause; or (iv) us ceasing to provide service or ceasing to provide service for your Provider, wireless carrier, wireless device, or financial entities. In the event this License is revoked for any of the foregoing reasons, you agree to promptly delete the Software from your wireless device, except that if you change carriers and/or numbers without changing wireless devices you may continue using the Software if you re-enroll under your new carrier/number you must re-register the mobile device to your account. We reserve all rights not granted to you in this EULA. The provisions of Sections I, II.B, III, and IV of this EULA shall survive revocation of the License.\n \nIII. YOUR OBLIGATIONS\nWhen you use the Software you agree to the following:\n \n1. Account Ownership/Accurate Information. You represent that you are the legal owner of the accounts and related information which may be accessed via the Software. You represent and agree that all information you provide in connection with the Software is accurate, current and complete, and that you have the right to provide such information to us and that we have the right to use the information for the purpose of providing the services available in connection with the Software. You agree to not misrepresent your identity or your account information. You agree to keep your account information up to date and accurate. You agree that we and/or our service providers may send you, by short message service (an opportunity to opt-out), e-mail, and other methods, communications relating to the Software, related items, and offers, including without limitation welcome messages, information, and surveys and other requests for information. You agree to use the Software carefully, to keep your passwords and PINs for using the Software confidential and secure and not share them with others, to check your statements and transactions regularly, and to report any errors to your Provider promptly.\n \n2. Location Based Information: For security purposes location-based features of the Software may be used and you agree that your geographic location and other personal information may be accessed and disclosed through the Software for your security.\n \n3. Export Control. You acknowledge that the Software may be subject to certain governmental export control and economic sanctions laws and regulations, which may restrict or prohibit the use, export, re-export, or transfer of the Software. You agree that you will not directly or indirectly use in, or export, re-export, transfer, or release the Software to, any destination, person, entity, or end-use prohibited or restricted under such laws or regulations without prior federal government authorization as applicable, either in writing or as permitted by applicable regulation. Without limitation, you agree that you will not use the Software in any embargoed or sanctioned country such as Cuba, Iran, North Korea, Sudan, and Syria.\n \n4. Proprietary Rights. You may not copy, reproduce, distribute, or create derivative works from the Software, and you agree not to reverse engineer or reverse compile or disassemble the Software.\n \n5. User Conduct. You agree not to use the Software or the content or information delivered through the Software in any way that would: (a) infringe any parent company (WiGi, Inc) or third-party copyright, patent, trademark, trade secret, or other proprietary rights or rights of publicity or privacy, including any rights in the Software; (b) be fraudulent or involve the sale of counterfeit or stolen items, including but not limited to use of the Software to impersonate another person or entity; (c) violate any law, statute, ordinance or regulation (including but not limited to those governing export control, consumer protection, unfair competition, anti-discrimination or false advertising); (d) be false, misleading or inaccurate; (e) create liability for us or our affiliates or service providers, or cause us to lose all or part of the services of any of our service providers; (f) be defamatory, libelous, unlawfully threatening or unlawfully harassing; (g) be perceived as illegal, offensive or objectionable; (h) interfere with or disrupt networks connected to the Software; (i) interfere with or disrupt the use of the Software by any other user; (j) use the Software to gain unauthorized entry or access to the systems or information of others, or (k) copy or display to third parties the information provided by the Software, except as required by the services available through the Software.\n \n6. No Commercial Use or Re-Sale. You agree that the Software is for personal use only. You agree not to resell or make commercial use of the Software.\n \n7. Indemnification. You agree to indemnify, defend, and hold us the company (WiGi, Inc) and our affiliates and service providers harmless from and against any and all third party claims, liability, damages, expenses and costs (including but not limited to reasonable attorneys\' fees) caused by or arising from your use of the Software, your violation of this EULA, your violation of applicable federal, state or local law, regulation or ordinance, or your infringement (or infringement by any other user of your account) of any intellectual property or other right of anyone.\n \nIV. ADDITIONAL PROVISIONS\n \nA. Software Limitations\n \n1. Neither the company (WiGi, Inc) nor our service providers can always foresee or anticipate technical, acts of nature or catastrophic events including terroristâ€™s acts or other difficulties related to the Software, the WiGime System, its serves etc. Although all information is stored in a Class 1 PCI compliant hosting data centers, these difficulties/events may result in loss of data, loss or change of personalization settings, preferences, or other Software, service, or wireless device interruptions. You agree that neither we nor any of our service providers assumes responsibility for any disclosure of account information to third parties, or for the timeliness, deletion, miss-delivery or failue to store any user data, communications, or personalization settings in connection with your use of the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n \n2. You agree that neither we nor any of our service providers assumes responsibility for the operation, security, functionality, or availability of any wireless device or mobile network which you use to access the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n \n3. Nothing in the Software is an offer to sell any of the components or devices used or referenced in connection therewith.\n \n4. You agree to exercise caution when using the Software on your wireless device and to use good judgment and discretion when obtaining or transmitting information.\n \n5. Information available via the Software may differ from the information that is available directly from your website, and may not be current or up-to-date and may occasional result from time delays. Information available directly through your website may not be available via the Software, may be described using different terminology, or may be more current than the information available via the Software, including but not limited to account balance information.  Additionally, you agree that neither we nor our service providers will be liable for any errors or delays in the information presented, or for any actions taken in reliance thereon.\n \nB.          Cancellation\nYou may cancel your participation in the Software and Services Provided by emailing us at â€œsupport@wigime.comâ€ and deleting the Software. We reserve the right to cancel the Software at any time without notice. We may suspend your access to the Software at any time without notice and for any reason, including but not limited to your non-use of the Software. You agree that we will not be liable to you or any third party for any modification or discontinuance of the Software.\n \nC.          Use of Data\nWe and our service providers will use information you provide for purposes of providing the Software, the services it enables, and related functions such as billing and the communications set forth above, and to prepare analyses and compilations of aggregate customer data that may or may not identify you.\n \nD. Third Party Beneficiary\nYou agree that the Providers, our service providers, and the owners, operators, and merchant(s) of record of any software application store or kiosk/business (\"Application Store\") from which you may have downloaded or otherwise obtained the Software, may rely upon your agreements and representations in this EULA, and such Providers, service providers, and Application Store are third party beneficiaries of this EULA, with the power to enforce its provisions against you, including without limitation the liability limitations and warranty disclaimers below for any claim related to or arising out of the Software or this EULA.\n \nE.          Limitations and Warranty Disclaimers\nWE AND OUR SERVICE PROVIDERS DISCLAIM ALL WARRANTIES RELATING TO THE SOFTWARE OR OTHERWISE IN CONNECTION WITH THIS EULA, WHETHER ORAL OR WRITTEN, EXPRESS, IMPLIED OR STATUTORY, INCLUDING WITHOUT LIMITATION THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR PARTICULAR PURPOSE AND NON-INFRINGEMENT.\nNEITHER WE NOR OUR SERVICE PROVIDERS WILL BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY INDIRECT, INCIDENTAL, EXEMPLARY, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES OF ANY KIND, OR FOR ANY LOSS OF PROFITS, BUSINESS, OR DATA, WHETHER BASED IN STATUTE, CONTRACT, TORT OR OTHERWISE, EVEN IF WE OR OUR SERVICE PROVIDERS HAVE BEEN ADVISED OF, OR HAD REASON TO KNOW OF, THE POSSIBILITY OF SUCH DAMAGES. Some states/jurisdictions do not allow the exclusion or limitation of incidental or consequential damages, so the above limitation or exclusion may not apply to you.\nUNDER NO CIRCUMSTANCE WILL THE TOTAL LIABILITY OF US OR OUR SERVICE PROVIDERS TO YOU IN CONNECTION WITH THE SOFTWARE OR RELATED SERVICES OR OTHERWISE IN CONNECTION WITH THIS EULA EXCEED $100.\nYOU UNDERSTAND AND AGREE THAT ANY APPLICATION STORE FROM WHICH YOU MAY HAVE DOWNLOADED THE SOFTWARE MAKES NO WARRANTY AND SHALL NOT BE LIABLE IN ANY MANNER WHATSOEVER FOR ANY CLAIMS RELATED TO OR ARISING OUT OF THE SOFTWARE OR THIS EULA, INCLUDING BUT NOT LIMITED TO ANY CLAIMS (I) IN RELATION TO THE SALE, DISTRIBUTION OR USE OF THE SOFTWARE, OR THE PERFORMANCE OR NON-PERFORMANCE OF THE SOFTWARE, (II) FOR PRODUCT LIABILITY, (III) THAT THE APPLICATION FAILS TO CONFORM TO ANY LEGAL OR REGULATORY REQUIREMENT, (IV) UNDER CONSUMER PROTECTION LAWS, OR (V) SEEKING DEFENSE AND INDEMNITY FOR INFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS.\n \nF.          Disputes\nWE EACH AGREE THAT ANY AND ALL CLAIMS OR DISPUTES IN ANY WAY RELATED TO OR CONCERNING THIS EULA, THE SOFTWARE, OR OUR SERVICES OR PRODUCTS, WILL BE RESOLVED BY BINDING ARBITRATION, RATHER THAN IN COURT. Such arbitration shall take place in Boca Raton, Florida, and shall be administered by the American Arbitration Association under its Commercial Arbitration Rules (and not under any other or ancillary rules or procedures such as the Supplementary Procedures for Consumer-Related Disputes or the Wireless Industry Arbitration Rules). This includes any claims you may assert against other parties relating to services provided to you (such as our suppliers or retail dealers) in connection with this EULA, the Software, or our services or products. We each also agree that this EULA may affect interstate commerce so that the Federal Arbitration Act and federal arbitration law apply. THERE IS NO JUDGE OR JURY IN ARBITRATION, AND COURT REVIEW OF AN ARBITRATION AWARD IS LIMITED. THE ARBITRATOR(S) MUST FOLLOW THIS AGREEMENT AND CAN AWARD THE SAME DAMAGES AND RELIEF AS A COURT (INCLUDING ATTORNEYS\' FEES). The parties waive any right they may have to proceed on behalf of or against a class, and agree that any claim, counterclaim, cross-claim or the like shall be brought on an individual basis and not consolidated with any other party\'s claim, counterclaim, cross-claim or the like. The arbitration award shall be in writing, shall be signed by the arbitrator(s), and shall include a reasoned opinion setting forth findings of fact and conclusions of law. Judgment on the award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof.\nNotwithstanding the immediately preceding paragraph or the Severability section below, if the foregoing prohibition on class arbitration is not enforced for any reason, then the immediately preceding paragraph also shall not be enforced and any class action claims shall be brought exclusively in the United States District Court for the Southern District Court of Florida.\nAny demand for arbitration or claim in litigation must be filed within 3 months of the time the cause of action accrued, or the cause of action shall forever be barred.\n \nG.          Severability\nIf any provision of this EULA is declared invalid by a court or other tribunal of competent jurisdiction then, except to the extent set forth in the Disputes section above, such provision shall be ineffective only to the extent of such invalidity, so that the remainder of that provision and all remaining provisions of this EULA shall be valid and enforceable to the fullest extent permitted by applicable law.\n \nH.          Entire Agreement\nThis EULA constitutes the entire agreement between the company (WiGi, Inc) and you (the consumers and merchants) relating to the Software and related services, supersedes any other agreements between us and you relating thereto, and may only be amended by a subsequent written agreement posted on our website (with subsequent use of the Software by you), sent to you by e-mail or SMS (with subsequent use of the Software by you), clicked through by you on your wireless device or otherwise, or signed by each of us.\n \nThis software consists of proprietary content and contributions made by professional programmers on behalf of WiGi, Inc. The WiGi Software License, Version 5.1\nCopyright (c) 2008-2011 WiGi, Inc. All rights reserved. \"This product includes software developed by the WiGi, Inc. a US-based software development company.\n \nAlternately, this acknowledgement may appear in the software itself, if and wherever such third-party acknowledgements normally appear.\n The names WiGiâ„¢, WiGiMe.com, WiGimeâ„¢ or WirelessGiftingâ„¢, WiGime ScanAd must always be used to endorse or promote products derived from this software service. For written permission, please contact inquiry@wigime.com.\n \nAccount Security\nBy  participating in the services WiGi Inc and WiGime.com provides, you understand, agree and will be  responsible for maintaining the confidentiality of your account, your password, your PIN#, your mobile application, your personal mobile device and all other personal information pertaining to your account  and you are responsible for restricting access to your computer, your mobile device or any other electronic or non-electronic system containing WiGime applications, your escrow account information, and you further agree to accept all personal responsibility as for all activities that occur under your account including but not limited to, protecting and securing your passwords, your PIN# and all other personal and pertinent account information. You agree to be maintaining all pertinent personal account and financial information up to date. You further agree to immediately notify WiGi Inc. through support@WiGime.com of any unauthorized use of your account or any other breach of security known to you; and you are responsible for locking down your WiGime account upon knowing this information either by visiting the WiGime website, using the WiGime Mobile application or contacting WiGi Inc customer support.\n \nWiGi Inc. uses industry standard security measures to protect the loss, misuse and alteration of the information under our control. Although we make good faith efforts to store the non-public information collected by the WiGime.com website and the mobile application in a secure operating environment that is not available to the public, we cannot always guarantee 100% complete security. Further, while we make every effort to ensure the integrity and security of our network and systems, we can never guarantee 100% security measures will prevent third-party \"hackers\" from illegally accessing our site. WiGi, Inc will always keep up with the current and changing security state â€“of- the art measures as they become available.\n \nContent\nUse of the Services by you is subject to all applicable local, state, national and international laws and regulations. By using the service you are granted a limited license for the use of the WiGi, Inc services. You may post photos or other electronic images, movies, audio clips, reviews, comments, suggestions, ideas, questions, or other information (collectively \"Content\"), so long as the Content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, chain letters, mass mailings, or any form of \"spam.\" WiGi Inc. reserves the right (but not the obligation) to remove or edit said illicit or derogatory Content at anytime, but does not regularly review posted Content.\n \nLicense Granted by Users\nWiGi, Inc. does not claim ownership in the photographs or other electronic images, movies, audio clips or other media created or uploaded by participants or members. Unless we indicate otherwise, if you upload Content, including any Media, to the WiGime website/servers, you grant WiGi, Inc. a nonexclusive, royalty-free right to publish distribute and display the Content as we deem appropriate in providing the Services authorized or requested by you and others, including the right to use the name that is submitted in connection with such Content. You further understand and agree that, in order to help ensure smooth operation of our system, we may keep backup copies of Content indefinitely.\nYou represent and warrant that you own or otherwise control all of the rights to the Content (including without limitation images, artwork, movies, text, and audio files) that you create and post; that use of the Content you supply does not violate these Terms of Use and will not cause injury to any person or entity; and that you will indemnify WiGi Inc. for all claims resulting from Content you supply. WiGi, Inc. has the right but not the obligation to monitor and edit or remove any activity or Content. You understand and agree that WiGi, Inc. takes no responsibility and assumes no liability for any Content created or posted by you or any third party.\n \nDisclaimer of Warranties and Limitations of Liability\nTHIS SITE IS PROVIDED BY WiGi, Inc. ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS. WiGi Inc. MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS, PRODUCT DESCRIPTIONS OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF THIS SITE IS AT YOUR SOLE RISK.\nTO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LOCAL, STATE and FEDERAL LAWs, WiGi Inc. DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. TO THE FULLEST EXTENT PERMITTED BY LAW, WiGi Inc. DISCLAIMS ANY WARRANTIES FOR THE SECURITY, RELIABILITY, TIMELINESS, ACCURACY, AND PERFORMANCE OF ITS WEBSITE AND THE SERVICES, AND DOES NOT WARRANT THAT THE PRODUCT DESCRIPTIONS OR OTHER CONTENT ON ITS WEBSITE ARE ACCURATE, COMPLETE, RELIABLE, CURRENT OR ERROR-FREE OR THAT THIS SITE, ITS SERVERS, OR EMAIL SENT FROM WiGi Inc. ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. UNDER NO CIRCUMSTANCES SHALL WiGi  Inc. BE LIABLE ON ACCOUNT OF YOUR USE OR MISUSE OF THE WIGime.COM WEBSITE OR THE WiGime SERVICES, WHETHER THE DAMAGES ARISE FROM USE OR MISUSE OF THE WiGime.COM WEBSITE OR THE SERVICES, FROM INABILITY TO USE THE WiGime.COM WEBSITE OR THE SERVICES, OR THE INTERRUPTION, SUSPENSION, MODIFICATION, ALTERATION, OR TERMINATION OF THE WiGime.COM WEBSITE, MOBILE APPLICATION OR THE SERVICES, OR VIEWING THE SITES INFORMATION, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES. WiGi Inc. CANNOT BE HELD LIABLE FOR THE ACCIDENTAL LOSS OF PERSONAL INFORMATION AND PERSONAL ELECTRONIC MEDIA ON ITS SITE, OR THE COPYING OF ELECTRONIC MEDIA BY ITS USERS. OUR LIABILITY, AND THE LIABILITY OF OUR SUBSIDIARIES, EMPLOYEES, VENDORS AND SUPPLIERS, TO YOU IN ANY CIRCUMSTANCE IS LIMITED TO $100.\nCERTAIN LOCAL, STATE and FEDERAL LAWS and COUNTRIES DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.\n \nIndemnity\nYou agree to indemnify and hold WiGi Inc, its subsidiaries, affiliates, successors, assigns, directors, officers, agents, employees, service providers, and suppliers harmless from any dispute that may arise from your breach of these Terms of Use or violation of any representations or warranties contained in these Terms. You also agree to hold WiGi Inc. harmless from any claims and expenses, including reasonable attorney\'s fees and court costs, related to any personal information, electronic media or other material you provide to or post on\nWiGime.com website.\n \nApplicable Law\nBy visiting WiGime.com, you agree that the laws of the State of Florida, without regard to principles of conflict of laws, will govern these Terms of Use and any dispute of any sort that might arise between you and WiGi Inc.\n \nMerger or Acquisition\nIt is possible that as we continue to develop our website and our business, WiGi Inc Services and/or related assets might be acquired or transferred as part of a merger. In the event of such a transaction, you understand and agree that WiGi Inc. may assign its rights under these Terms and that your personal information may be transferred to the succeeding entity. You will be provided with reasonable notice of such occurrence.\n \nDisputes\nAny dispute relating in any way to your visit to WiGime.com or to products or services you use through WiGime.com shall be submitted to confidential arbitration in Florida., except that, to the extent you have in any manner violated or threatened to violate WiGi Inc.\'s intellectual property rights, WiGi Inc. may seek injunctive or other appropriate relief in any state or federal court in the state of Florida, and you consent to exclusive jurisdiction and venue in such courts.\nArbitration under this agreement shall be conducted under the rules then prevailing of the American Arbitration Association. The arbitrator\'s award shall be binding and may be entered as a judgment in any court of competent jurisdiction. To the fullest extent permitted by applicable law, no arbitration under this Agreement shall be joined to an arbitration involving any other party subject to this Agreement, whether through class arbitration proceedings or otherwise. Any cause of action you may have with respect to your use of the WiGi, Inc Services must be commenced within 3 months after the claim or cause of action arises.\n \nPolicies, Modification and Severability\nWe reserve the right to make changes to our site, policies, and these Terms of Use at any time. Should you object to any terms and conditions of these Terms of Use or any subsequent modifications thereto or become dissatisfied with WiGi Inc. in any way, your only recourse is to immediately: (1) discontinue use of WiGi Incâ€™s Services and WiGime.com site and (2) terminate your subscription by contacting support@WiGime.com. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.\n \n \nGeneral Information\nThese Terms constitute the entire agreement between you and WiGi Inc. parent company of WiGime.com and govern your use of the Services, superseding any prior agreements between you and WiGi Inc. You also may be subject to additional terms and conditions that may apply when you use affiliate services, third-party content or third-party software.\nThe section titles in these Terms of Use are for convenience only and have no legal or contractual effect.\n \nPlease report any violations of these Terms to WiGi Inc. by contacting support@WiGime.com.\n \nNO WARRANTIES: LIMITATION OF LIABILITY.\nTHIS SITE IS PROVIDED \"AS IS\" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.\nWiGi Inc. also assumes no responsibility, and shall not be liable for any such damages to or viruses that may infect your computer equipment, software, data or other property on account of your access to, use of, or browsing in the Site or your downloading of any materials, data, text, images, video or audio from the Site or any linked sites.\nIn no event shall WiGi Inc. or any other party involved in creating, producing, maintaining or delivering the Site, or any of their affiliates, or the officers, directors, employees, shareholders, or agents of each of them, be liable for any damages of any kind, including without limitation any direct, special, incidental, indirect, exemplary, punitive or consequential damages, whether or not advised of the possibility of such damages, and on any theory of liability whatsoever, arising out of or in connection with the use or performance of, or your browsing in, or your links to other sites from, this Site.\n \nUNAFFILIATED PRODUCTS AND SITES\nDescriptions of, or references to, products, publications or sites not owned by WiGi Inc. or its affiliates do not imply endorsement of that product, publication or site. WiGi Inc. has not reviewed all material linked to the Site and is not responsible for the content of any such material and specifically does not endorse any materials which may appear on such linked sites. By permitting advertising by third parties on the Site, WiGi Inc does not make any warranties or representations of any kind as to the accuracy of the content of the suitability of any such advertisement. Your linking to any other sites is at your own risk.\n \nCOMMUNICATIONS WITH THIS SITE\nYou are prohibited from creating, posting or transmitting any unlawful material including but not limited to threatening, libelous, defamatory, obscene, scandalous, inflammatory, pornographic, or profane material or any material that could constitute or encourage conduct that would be considered a criminal offense, give rise to civil liability, or otherwise violate any law. WiGi Inc. will fully cooperate with any law enforcement authorities or court order requesting or directing WiGi Inc. to disclose the identity of or help identify or locate anyone posting any such information or materials.\n \nAny communication or material you transmit to WiGi Inc through the WiGime Web Site by e-mail or other written or electronic media, including any data, questions, comments, suggestions, or the like, are and will be treated as, non-confidential and non-proprietary.  WiGi Inc. cannot prevent the \"harvesting\" of information from this Site, and you may be contacted by WiGi Inc, or unrelated third parties, by e-mail or otherwise, within or outside of this Site. Anything you transmit may be edited by or on behalf of WiGi Inc., may or may not be posted to this Site at the sole discretion of WiGi Inc. and may be used by WiGi Inc. or its affiliates for any purpose, including, but not limited to, reproduction, disclosure, transmission, publication, broadcast and posting.\n \nFurthermore, WiGi Inc. is free to use any ideas, concepts, know-how, or techniques contained in any communication you send to the Site for any purpose whatsoever including, but not limited to, developing, manufacturing and marketing products using such information.\nAlthough WiGi Inc. may from time to time monitor or review discussion, chats, postings, transmissions, bulletin boards, and the like on the Site, WiGi Inc. is under no obligation to do so and assumes no responsibility or liability arising from the content of any such locations nor for any error, defamation, libel, slander, omission, falsehood, obscenity, pornography, profanity, danger, or inaccuracy contained in any information within such locations on the Site. WiGi Inc. assumes no responsibility or liability for any actions or communications by you or any unrelated third party within or outside of this Site.\n \nLINKING POLICY\nThis Site may contain links to sites owned or operated by parties other than WiGi Inc. such links are provided for your convenience only. WiGi Inc. does not control, and is not responsible for the availability or content of these external sites, or the security of, such sites. WiGi Inc. does not endorse the content, or any products or services available, on such sites. If you link to such sites you do so at your own risk.\n \nGOVERNING LAWS\nWiGime.com was developed with the intent for international use and shall be governed by the laws of the State of Florida, USA. This Site may be viewed internationally and may contain references to products or services not available in all countries at this time. In helping to provide better services for our members and future members WiGi Inc would like to be notified of the region the service is being requested. WiGi Inc. intends to make a reasonable effort, within the guidelines of countryâ€™s governing laws for those services to be available in such country.\n ',NULL,NULL,'2011-09-01 12:33:25',NULL),(6,'Terms of Use  (revision 1.3)\n \nWiGi Inc., the parent company, owner and operator of WiGime.com, and its affiliates, merchant retailers and suppliers (collectively referred to â€œWiGime\") provide a convenient service for both consumers and merchants consisting of mobile money/ gifting services, transactional based services and related product services (the \"Services\") to you, subject to the following:  If you visit or utilize the products and services at WiGime.com, you accept these terms and conditions.\n \nDescription of Services\nWiGi Inc. through the use of WiGime.com and their products provides escrowing services of online global mobile money, gifting services (of funds), money remittances and payment disbursement for the convenience and security of our participants. By Participating in these Services, the user achknowlegedes the establishment of a personal account enabling users to carry out functions as it relates to services of sending and receiving monies to any person/user/Merchant, anywhere, having a mobile device or on-line, an amount of funds limited by laws of the senderâ€™s country of origin. The userâ€™s account is a secure mobile proxy holding escrow account that will provide the user the utmost level of security and convenience to send/receive monies/funds gifts or reload anytime from any approved source for the use at participating on line ecommerce, brick & mortar retailers and service providers with the use of their registered mobile device. Charges are incurred as a processing fee when sending money and by merchants as a transaction fee for purchases made and /or advertising and WiGi, Inc. reserves the right to modify or add additional fees and billing terms, without prior notice to the participating members of our service.  WiGi Inc. expressed or implied, completely treats this account as a personal individual escrow holding account for the convenience of our members and WITHOUT ANY EXPRESSIVE OR IMPLIED INTENT by WiGi, Inc. or its members should not treat this account or any other similar account related to the Services as a financial interest bearing account  or similar like entity. WiGi, Inc. is not considered a financial institution or a money transfer service and extends its license to the end user to use the provided service for their convenience and security. The funds will currently earn no interest. In Addition this account is to be used as a temporary holding account and is not FDIC insured or insured by any other governmental or insurance body. WiGi, Inc. through WiGime.com website only provides a secure, convenient service for its participating members as an extension of a license to use it services. It is up to the individual person(s) and/or entity to follow all applicable local, state and federal laws as it relates to the use of this service.\n \n \nUnless you elect terminate your account services, your credit card (OR any other registered financial account entity) designated to your account will remain securely on file. Applicable transaction fees will be deducted from time to time from your secure mobile escrow proxy account when those billable services are used. Members must keep their registered email addresses, personal billing information and all other personal account information current and up to date. WiGi, Inc. may provide address for delivery of purchased products to participating retailers; send important notices to email accounts, etc. In connection with billing we may receive updated information about your account from the financial institution(s) issuing your credit card. If we are unable to process your credit card payment (or similar billing entity), your account will be temporarily SUSPENDED until we are contacted by you for updated billing instructions.\n \n \n \nTermination\nWiGi, Inc. agrees to terminate your account at any time upon request by notifying us of your wish to cancel your account at support@WiGime.com. WiGi, Inc. may terminate your account or your access to and use of the Services, with or without cause at any time and effective immediately, at WiGi Inc.\'s sole discretion, for any reason, including but not limited to your failure to conform to these Terms, acts of suspicious money laundering schemes, terrorist acts or fraudulent activity. If you violate these Terms in the Terms and Conditions requirements then WiGi, Inc., in its sole discretion, may also require you to remedy any violation of these Terms, and/or take any other actions that WiGi Inc. deems appropriate to enforce its rights and pursue all available remedies.\nUpon termination of your account for these reasons, you will receive a refund in the mail or electronically for any amount remaining in the account after all reconciliation. In the event we have to collect unpaid amounts owed to WiGi, Inc. on your account, you will be liable for all attorneys\' and collection agency fees.\n \nPrivacy\nWiGi, Inc. has established a Privacy Policy to explain to you how your information is collected and used. Your use of the WiGime.com website or the WiGi Services signifies acknowledgement of, and agreement to our Privacy Policy. You understand and agree that WiGi, Inc may store and process your information on state-of-the â€“art secure computer servers along with back up which may be located in remote regions both domestically and internationally and by providing any data to WiGi, Inc. you consent to the secure transfer and storage of such information.\nYou acknowledge and agree that WiGi, Inc. may disclose information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to comply with business practice processes, governing local, state and federal laws in order to carry out these Terms and provide Services, and/or to protect the rights, property, or safety of WiGi, Inc. its employees, users and third party affiliates.\n\nElectronic Communications                               \nWhen you visit WiGime.com, or send emails to us, or contacting us through the any form of mobile process, you are communicating with us electronically. You consent to receive communications from us electronically. We will communicate with you by email to your registered email address or by posting notices on this site or through other forms of mobile communication. You agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.\n \nCopyright and Intellectual Property\n \nAll content included on this site, such as text, graphics, logos, icons, images, photographs, audio clips, video clips, digital downloads, data compilations, and software which is part of the WiGime.com website, is the property of WiGi, Inc. and or the respective WiGi member merchant\'s. However, content posted or created by users is assumed to be the responsibility of the user who   posted or created it, or the author that the poster credited as being the owner of the creation. Copyrighted material including but not limited to its source code, and website and mobile applications is protected by United States and international copyright laws.\nWiGi Inc.â€™s selection, coordination and arrangement of all content on this site is the exclusive property of WiGi Inc. and is protected as a compilation by U.S. and international copyright laws. All software used on this site or in conjunction with the Services is the property of WiGi Inc., the parent company of WiGime.com, and is protected by United States and international copyright laws.\nAll other unregistered or registered trademarks are property of their respective owners. Nothing contained on this site should be construed as granting, by implication, estoppels or otherwise, any license or right to use any of WiGi Incâ€™s intellectual property displayed on the WiGime.com site without the written permission to WiGi, Inc.\n \nCopyright Complaints\n WiGi Inc. respects the intellectual property rights of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please contact a WiGi Inc. customer service agent for notice of claims of copyright or other intellectual property infringement (\"Agent\"), at support@WiGime.com. Please provide our Agent with the following Notice:\nIdentify the copyrighted work or other intellectual property that you claim has been infringed;\nIdentify the image, movie or audio on the WiGi Inc. website that you claim is infringing, with enough detail so that we may locate it on the website;\nA statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;\nA statement by you declaring under penalty of perjury that (a) the above information in your Notice is accurate, and (b) that you are the owner of the copyright interest involved or that you are authorized to act on behalf of that owner;\nYour address, telephone number, and email address and your physical or electronic signature.\nWiGi Incâ€™s Legal Agent of record will forward this information to the alleged infringer.\n \nLicense and Site Access\nEND USER LICENSE AGREEMENT (â€œEULAâ€)                \nWiGi Inc. grants you ( The consumer or Merchant) a limited license to access and make personal use of the Services provided by WiGi Inc system through the mobile applications and the WiGime.com site, but not to download (other than page caching) or modify it or any portion of it, except with the express written consent of WiGi Inc. This license does not include any resale or commercial use of this site or its contents. This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of WiGi Inc. Any unauthorized use terminates the permission or license granted by WiGi Inc.\nYou are granted a limited, revocable, and nonexclusive right to create hyperlinks to WiGime.com page so long as the links do not portray WiGi Inc or its suppliers or their products or services in a false or misleading manner.\n \nThis End User License Agreement (\"EULA\") is an agreement between the user (\"you\" or \"your\") and WiGi, Inc. (\"we\", \"our\", \"us\") concerning your use of this software and all related documentation and services, and all updates and upgrades that replace or supplement the foregoing and are not distributed with a separate EULA (collectively, the \"Software\").\nBy clicking \"Yes\" or \"Yes, I agree\" or similar language presented on your handset or Web page, or by using the Software, you agree to the terms and conditions of this EULA.\n \n \n \nI.          Software\n \nA.          Description of Software\nThe Software provides a means to view and interact with personal account information and other related information. We receive this information from third parties and you grant us and our service providers permission to retrieve the information and to use the information to provide the services enabled by the Software. We reserve the right to change the nature of the services available through the Software at any time, and to refuse to make any transaction you request through the Software. The Software may not be available on all wireless devices and on all mobile service carriers or providers, and may not be accessible or may have limited utility over some mobile networks in situations such as, but not limited to, roaming.\n \nB.          Use of Software\nThe Software will not work unless you use it properly. You accept responsibility for making sure that you understand how to use the Software before you actually do so, and then that you always use the Software in accordance with all applicable instructions. You also accept responsibility for making sure that you know how to properly use your wireless device. We may change or upgrade the Software from time to time. In the event of such changes or upgrades, you are responsible for making sure that you understand how to use the Software as changed or upgraded. We will not be liable to you for any losses caused by your failure to properly use the Software or your wireless device. You give WiGi, Inc the right to upgrade the software at anytime or send messages/updates to the mobile device which may incur costs as it relates to the use of your mobile deviceâ€™s data plan services through Internet connectivity or text (SMS) messaging.\n \n \nC.           Relationship to Other Agreements\nThe Software forms a connection across wireless carrier data networks to the computer systems of escrow accounts and to your personal financial institution(s) and other third parties (\"Providers\"). Information about your account(s) comes from, and all processing occurs on, the Providers\' computer systems. We do not provide the information about your accounts that is displayed on your wireless device.\nYou have separate agreements with your Providers for their services, and you agree that you remain subject to those agreements. You also agree that you continue to be subject to the terms and conditions of your existing agreements with any other service providers, including but not limited to your mobile service carrier or provider. This EULA does not amend or supersede any of those agreements. Those agreements may provide for fees, limitations and restrictions which might impact your use of the Software (for example, your Provider may charge fees associated with the Software or your mobile service carrier may impose data usage or text message charges for your use of or interaction with the Software, including while downloading the Software or other use of your wireless device when using the Software), and you agree to be solely responsible for all such fees, limitations and restrictions. You acknowledge and agree that neither we nor your Provider are responsible for your mobile service carrier or provider\'s products and services. You acknowledge and agree that your mobile service carrier or provider is not the provider of any financial services available through or related to the Software, and is not responsible for any of the materials, information, products, or services made available to you in connection with the Software. Accordingly, you agree to resolve any problems with your Provider directly with that Provider without involving your mobile service carrier or us (WiGi, Inc), and you agree to resolve any problems with your mobile service carrier directly with that mobile service carrier without involving your Provider or us (WiGi, Inc).\n \nII. WiGi Inc. SOFTWARE LICENSE AGREEMENT                         \n \nA.          License\nSubject to your compliance with this EULA, you are hereby granted a personal, limited, non-transferable, non-exclusive, non-sub licensable, and non-assignable license (\"License\") to download, install and/or use the Software on your wireless device within the United States and its territories and within those countries where export and use of the Software is permitted under United States law and under the laws of the location where the Software is used. In the event that you obtain a new or different wireless device, you will be required to download and install the Software to that new or different wireless device and re-register your mobile device.\n \nB.          License Restrictions / Revocation\nThis License shall be deemed revoked immediately upon (i) by not complying with these terms and conditions and noncompliance with this EULA; (ii) any reason to suspect infringement or copying of software (iii) any illegal activity domestically or international as defined in your country of origin (iv) written notice to you at any time, with or without cause; or (iv) us ceasing to provide service or ceasing to provide service for your Provider, wireless carrier, wireless device, or financial entities. In the event this License is revoked for any of the foregoing reasons, you agree to promptly delete the Software from your wireless device, except that if you change carriers and/or numbers without changing wireless devices you may continue using the Software if you re-enroll under your new carrier/number you must re-register the mobile device to your account. We reserve all rights not granted to you in this EULA. The provisions of Sections I, II.B, III, and IV of this EULA shall survive revocation of the License.\n \nIII. YOUR OBLIGATIONS\nWhen you use the Software you agree to the following:\n \n1. Account Ownership/Accurate Information. You represent that you are the legal owner of the accounts and related information which may be accessed via the Software. You represent and agree that all information you provide in connection with the Software is accurate, current and complete, and that you have the right to provide such information to us and that we have the right to use the information for the purpose of providing the services available in connection with the Software. You agree to not misrepresent your identity or your account information. You agree to keep your account information up to date and accurate. You agree that we and/or our service providers may send you, by short message service (an opportunity to opt-out), e-mail, and other methods, communications relating to the Software, related items, and offers, including without limitation welcome messages, information, and surveys and other requests for information. You agree to use the Software carefully, to keep your passwords and PINs for using the Software confidential and secure and not share them with others, to check your statements and transactions regularly, and to report any errors to your Provider promptly.\n \n2. Location Based Information: For security purposes location-based features of the Software may be used and you agree that your geographic location and other personal information may be accessed and disclosed through the Software for your security.\n \n3. Export Control. You acknowledge that the Software may be subject to certain governmental export control and economic sanctions laws and regulations, which may restrict or prohibit the use, export, re-export, or transfer of the Software. You agree that you will not directly or indirectly use in, or export, re-export, transfer, or release the Software to, any destination, person, entity, or end-use prohibited or restricted under such laws or regulations without prior federal government authorization as applicable, either in writing or as permitted by applicable regulation. Without limitation, you agree that you will not use the Software in any embargoed or sanctioned country such as Cuba, Iran, North Korea, Sudan, and Syria.\n \n4. Proprietary Rights. You may not copy, reproduce, distribute, or create derivative works from the Software, and you agree not to reverse engineer or reverse compile or disassemble the Software.\n \n5. User Conduct. You agree not to use the Software or the content or information delivered through the Software in any way that would: (a) infringe any parent company (WiGi, Inc) or third-party copyright, patent, trademark, trade secret, or other proprietary rights or rights of publicity or privacy, including any rights in the Software; (b) be fraudulent or involve the sale of counterfeit or stolen items, including but not limited to use of the Software to impersonate another person or entity; (c) violate any law, statute, ordinance or regulation (including but not limited to those governing export control, consumer protection, unfair competition, anti-discrimination or false advertising); (d) be false, misleading or inaccurate; (e) create liability for us or our affiliates or service providers, or cause us to lose all or part of the services of any of our service providers; (f) be defamatory, libelous, unlawfully threatening or unlawfully harassing; (g) be perceived as illegal, offensive or objectionable; (h) interfere with or disrupt networks connected to the Software; (i) interfere with or disrupt the use of the Software by any other user; (j) use the Software to gain unauthorized entry or access to the systems or information of others, or (k) copy or display to third parties the information provided by the Software, except as required by the services available through the Software.\n \n6. No Commercial Use or Re-Sale. You agree that the Software is for personal use only. You agree not to resell or make commercial use of the Software.\n \n7. Indemnification. You agree to indemnify, defend, and hold us the company (WiGi, Inc) and our affiliates and service providers harmless from and against any and all third party claims, liability, damages, expenses and costs (including but not limited to reasonable attorneys\' fees) caused by or arising from your use of the Software, your violation of this EULA, your violation of applicable federal, state or local law, regulation or ordinance, or your infringement (or infringement by any other user of your account) of any intellectual property or other right of anyone.\n \nIV. ADDITIONAL PROVISIONS\n \nA. Software Limitations\n \n1. Neither the company (WiGi, Inc) nor our service providers can always foresee or anticipate technical, acts of nature or catastrophic events including terroristâ€™s acts or other difficulties related to the Software, the WiGime System, its serves etc. Although all information is stored in a Class 1 PCI compliant hosting data centers, these difficulties/events may result in loss of data, loss or change of personalization settings, preferences, or other Software, service, or wireless device interruptions. You agree that neither we nor any of our service providers assumes responsibility for any disclosure of account information to third parties, or for the timeliness, deletion, miss-delivery or failure to store any user data, communications, or personalization settings in connection with your use of the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n \n2. You agree that neither we nor any of our service providers assumes responsibility for the operation, security, functionality, or availability of any wireless device or mobile network which you use to access the Software, and you hereby release us and our service providers from any liability connected with any such responsibility.\n \n3. Nothing in the Software is an offer to sell any of the components or devices used or referenced in connection therewith.\n \n4. You agree to exercise caution when using the Software on your wireless device and to use good judgment and discretion when obtaining or transmitting information.\n \n5. Information available via the Software may differ from the information that is available directly from your website, and may not be current or up-to-date and may occasional result from time delays. Information available directly through your website may not be available via the Software, may be described using different terminology, or may be more current than the information available via the Software, including but not limited to account balance information.  Additionally, you agree that neither we nor our service providers will be liable for any errors or delays in the information presented, or for any actions taken in reliance thereon.\n \nB.          Cancellation\nYou may cancel your participation in the Software and Services Provided by emailing us at â€œsupport@wigime.comâ€ and deleting the Software. We reserve the right to cancel the Software at any time without notice. We may suspend your access to the Software at any time without notice and for any reason, including but not limited to your non-use of the Software. You agree that we will not be liable to you or any third party for any modification or discontinuance of the Software.\n \nC.          Use of Data\nWe and our service providers will use information you provide for purposes of providing the Software, the services it enables, and related functions such as billing and the communications set forth above, and to prepare analyses and compilations of aggregate customer data that may or may not identify you.\n \nD. Third Party Beneficiary\nYou agree that the Providers, our service providers, and the owners, operators, and merchant(s) of record of any software application store or kiosk/business (\"Application Store\") from which you may have downloaded or otherwise obtained the Software, may rely upon your agreements and representations in this EULA, and such Providers, service providers, and Application Store are third party beneficiaries of this EULA, with the power to enforce its provisions against you, including without limitation the liability limitations and warranty disclaimers below for any claim related to or arising out of the Software or this EULA.\n \nE.          Limitations and Warranty Disclaimers\nWE AND OUR SERVICE PROVIDERS DISCLAIM ALL WARRANTIES RELATING TO THE SOFTWARE OR OTHERWISE IN CONNECTION WITH THIS EULA, WHETHER ORAL OR WRITTEN, EXPRESS, IMPLIED OR STATUTORY, INCLUDING WITHOUT LIMITATION THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR PARTICULAR PURPOSE AND NON-INFRINGEMENT.\nNEITHER WE NOR OUR SERVICE PROVIDERS WILL BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY INDIRECT, INCIDENTAL, EXEMPLARY, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES OF ANY KIND, OR FOR ANY LOSS OF PROFITS, BUSINESS, OR DATA, WHETHER BASED IN STATUTE, CONTRACT, TORT OR OTHERWISE, EVEN IF WE OR OUR SERVICE PROVIDERS HAVE BEEN ADVISED OF, OR HAD REASON TO KNOW OF, THE POSSIBILITY OF SUCH DAMAGES. Some states/jurisdictions do not allow the exclusion or limitation of incidental or consequential damages, so the above limitation or exclusion may not apply to you.\nUNDER NO CIRCUMSTANCE WILL THE TOTAL LIABILITY OF US OR OUR SERVICE PROVIDERS TO YOU IN CONNECTION WITH THE SOFTWARE OR RELATED SERVICES OR OTHERWISE IN CONNECTION WITH THIS EULA EXCEED $100.\nYOU UNDERSTAND AND AGREE THAT ANY APPLICATION STORE FROM WHICH YOU MAY HAVE DOWNLOADED THE SOFTWARE MAKES NO WARRANTY AND SHALL NOT BE LIABLE IN ANY MANNER WHATSOEVER FOR ANY CLAIMS RELATED TO OR ARISING OUT OF THE SOFTWARE OR THIS EULA, INCLUDING BUT NOT LIMITED TO ANY CLAIMS (I) IN RELATION TO THE SALE, DISTRIBUTION OR USE OF THE SOFTWARE, OR THE PERFORMANCE OR NON-PERFORMANCE OF THE SOFTWARE, (II) FOR PRODUCT LIABILITY, (III) THAT THE APPLICATION FAILS TO CONFORM TO ANY LEGAL OR REGULATORY REQUIREMENT, (IV) UNDER CONSUMER PROTECTION LAWS, OR (V) SEEKING DEFENSE AND INDEMNITY FOR INFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS.\n \nF.          Disputes\nWE EACH AGREE THAT ANY AND ALL CLAIMS OR DISPUTES IN ANY WAY RELATED TO OR CONCERNING THIS EULA, THE SOFTWARE, OR OUR SERVICES OR PRODUCTS, WILL BE RESOLVED BY BINDING ARBITRATION, RATHER THAN IN COURT. Such arbitration shall take place in Boca Raton, Florida, and shall be administered by the American Arbitration Association under its Commercial Arbitration Rules (and not under any other or ancillary rules or procedures such as the Supplementary Procedures for Consumer-Related Disputes or the Wireless Industry Arbitration Rules). This includes any claims you may assert against other parties relating to services provided to you (such as our suppliers or retail dealers) in connection with this EULA, the Software, or our services or products. We each also agree that this EULA may affect interstate commerce so that the Federal Arbitration Act and federal arbitration law apply. THERE IS NO JUDGE OR JURY IN ARBITRATION, AND COURT REVIEW OF AN ARBITRATION AWARD IS LIMITED. THE ARBITRATOR(S) MUST FOLLOW THIS AGREEMENT AND CAN AWARD THE SAME DAMAGES AND RELIEF AS A COURT (INCLUDING ATTORNEYS\' FEES). The parties waive any right they may have to proceed on behalf of or against a class, and agree that any claim, counterclaim, cross-claim or the like shall be brought on an individual basis and not consolidated with any other party\'s claim, counterclaim, cross-claim or the like. The arbitration award shall be in writing, shall be signed by the arbitrator(s), and shall include a reasoned opinion setting forth findings of fact and conclusions of law. Judgment on the award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof.\nNotwithstanding the immediately preceding paragraph or the Severability section below, if the foregoing prohibition on class arbitration is not enforced for any reason, then the immediately preceding paragraph also shall not be enforced and any class action claims shall be brought exclusively in the United States District Court for the Southern District Court of Florida.\nAny demand for arbitration or claim in litigation must be filed within 3 months of the time the cause of action accrued, or the cause of action shall forever be barred.\n \nG.          Severability\nIf any provision of this EULA is declared invalid by a court or other tribunal of competent jurisdiction then, except to the extent set forth in the Disputes section above, such provision shall be ineffective only to the extent of such invalidity, so that the remainder of that provision and all remaining provisions of this EULA shall be valid and enforceable to the fullest extent permitted by applicable law.\n \nH.          Entire Agreement\nThis EULA constitutes the entire agreement between the company (WiGi, Inc) and you (the consumers and merchants) relating to the Software and related services, supersedes any other agreements between us and you relating thereto, and may only be amended by a subsequent written agreement posted on our website (with subsequent use of the Software by you), sent to you by e-mail or SMS (with subsequent use of the Software by you), clicked through by you on your wireless device or otherwise, or signed by each of us.\n \nThis software consists of proprietary content and contributions made by professional programmers on behalf of WiGi, Inc. The WiGi Software License, Version 5.1\nCopyright (c) 2008-2011 WiGi, Inc. All rights reserved. \"This product includes software developed by the WiGi, Inc. a US-based software development company.\n \nAlternately, this acknowledgement may appear in the software itself, if and wherever such third-party acknowledgements normally appear.\n The names WiGiâ„¢, WiGiMe.com, WiGimeâ„¢ or WirelessGiftingâ„¢, WiGime ScanAd must always be used to endorse or promote products derived from this software service. For written permission, please contact inquiry@wigime.com.\n \nAccount Security\nBy  participating in the services WiGi Inc and WiGime.com provides, you understand, agree and will be  responsible for maintaining the confidentiality of your account, your password, your PIN#, your mobile application, your personal mobile device and all other personal information pertaining to your account  and you are responsible for restricting access to your computer, your mobile device or any other electronic or non-electronic system containing WiGime applications, your escrow account information, and you further agree to accept all personal responsibility as for all activities that occur under your account including but not limited to, protecting and securing your passwords, your PIN# and all other personal and pertinent account information. You agree to be maintaining all pertinent personal account and financial information up to date. You further agree to immediately notify WiGi Inc. through support@WiGime.com of any unauthorized use of your account or any other breach of security known to you; and you are responsible for locking down your WiGime account upon knowing this information either by visiting the WiGime website, using the WiGime Mobile application or contacting WiGi Inc customer support.\n \nWiGi Inc. uses industry standard security measures to protect the loss, misuse and alteration of the information under our control. Although we make good faith efforts to store the non-public information collected by the WiGime.com website and the mobile application in a secure operating environment that is not available to the public, we cannot always guarantee 100% complete security. Further, while we make every effort to ensure the integrity and security of our network and systems, we can never guarantee 100% security measures will prevent third-party \"hackers\" from illegally accessing our site. WiGi, Inc will always keep up with the current and changing security state â€“of- the art measures as they become available.\n \nContent\nUse of the Services by you is subject to all applicable local, state, national and international laws and regulations. By using the service you are granted a limited license for the use of the WiGi, Inc services. You may post photos or other electronic images, movies, audio clips, reviews, comments, suggestions, ideas, questions, or other information (collectively \"Content\"), so long as the Content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, chain letters, mass mailings, or any form of \"spam.\" WiGi Inc. reserves the right (but not the obligation) to remove or edit said illicit or derogatory Content at anytime, but does not regularly review posted Content.\n \nLicense Granted by Users\nWiGi, Inc. does not claim ownership in the photographs or other electronic images, movies, audio clips or other media created or uploaded by participants or members. Unless we indicate otherwise, if you upload Content, including any Media, to the WiGime website/servers, you grant WiGi, Inc. a nonexclusive, royalty-free right to publish distribute and display the Content as we deem appropriate in providing the Services authorized or requested by you and others, including the right to use the name that is submitted in connection with such Content. You further understand and agree that, in order to help ensure smooth operation of our system, we may keep backup copies of Content indefinitely.\nYou represent and warrant that you own or otherwise control all of the rights to the Content (including without limitation images, artwork, movies, text, and audio files) that you create and post; that use of the Content you supply does not violate these Terms of Use and will not cause injury to any person or entity; and that you will indemnify WiGi Inc. for all claims resulting from Content you supply. WiGi, Inc. has the right but not the obligation to monitor and edit or remove any activity or Content. You understand and agree that WiGi, Inc. takes no responsibility and assumes no liability for any Content created or posted by you or any third party.\n \nDisclaimer of Warranties and Limitations of Liability\nTHIS SITE IS PROVIDED BY WiGi, Inc. ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS. WiGi Inc. MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS, PRODUCT DESCRIPTIONS OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF THIS SITE IS AT YOUR SOLE RISK.\nTO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LOCAL, STATE and FEDERAL LAWs, WiGi Inc. DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. TO THE FULLEST EXTENT PERMITTED BY LAW, WiGi Inc. DISCLAIMS ANY WARRANTIES FOR THE SECURITY, RELIABILITY, TIMELINESS, ACCURACY, AND PERFORMANCE OF ITS WEBSITE AND THE SERVICES, AND DOES NOT WARRANT THAT THE PRODUCT DESCRIPTIONS OR OTHER CONTENT ON ITS WEBSITE ARE ACCURATE, COMPLETE, RELIABLE, CURRENT OR ERROR-FREE OR THAT THIS SITE, ITS SERVERS, OR EMAIL SENT FROM WiGi Inc. ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. UNDER NO CIRCUMSTANCES SHALL WiGi  Inc. BE LIABLE ON ACCOUNT OF YOUR USE OR MISUSE OF THE WIGime.COM WEBSITE OR THE WiGime SERVICES, WHETHER THE DAMAGES ARISE FROM USE OR MISUSE OF THE WiGime.COM WEBSITE OR THE SERVICES, FROM INABILITY TO USE THE WiGime.COM WEBSITE OR THE SERVICES, OR THE INTERRUPTION, SUSPENSION, MODIFICATION, ALTERATION, OR TERMINATION OF THE WiGime.COM WEBSITE, MOBILE APPLICATION OR THE SERVICES, OR VIEWING THE SITES INFORMATION, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES. WiGi Inc. CANNOT BE HELD LIABLE FOR THE ACCIDENTAL LOSS OF PERSONAL INFORMATION AND PERSONAL ELECTRONIC MEDIA ON ITS SITE, OR THE COPYING OF ELECTRONIC MEDIA BY ITS USERS. OUR LIABILITY, AND THE LIABILITY OF OUR SUBSIDIARIES, EMPLOYEES, VENDORS AND SUPPLIERS, TO YOU IN ANY CIRCUMSTANCE IS LIMITED TO $100.\nCERTAIN LOCAL, STATE and FEDERAL LAWS and COUNTRIES DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.\n \nIndemnity\nYou agree to indemnify and hold WiGi Inc, its subsidiaries, affiliates, successors, assigns, directors, officers, agents, employees, service providers, and suppliers harmless from any dispute that may arise from your breach of these Terms of Use or violation of any representations or warranties contained in these Terms. You also agree to hold WiGi Inc. harmless from any claims and expenses, including reasonable attorney\'s fees and court costs, related to any personal information, electronic media or other material you provide to or post on\nWiGime.com website.\n \nApplicable Law\nBy visiting WiGime.com, you agree that the laws of the State of Florida, without regard to principles of conflict of laws, will govern these Terms of Use and any dispute of any sort that might arise between you and WiGi Inc.\n \nMerger or Acquisition\nIt is possible that as we continue to develop our website and our business, WiGi Inc Services and/or related assets might be acquired or transferred as part of a merger. In the event of such a transaction, you understand and agree that WiGi Inc. may assign its rights under these Terms and that your personal information may be transferred to the succeeding entity. You will be provided with reasonable notice of such occurrence.\n \nDisputes\nAny dispute relating in any way to your visit to WiGime.com or to products or services you use through WiGime.com shall be submitted to confidential arbitration in Florida., except that, to the extent you have in any manner violated or threatened to violate WiGi Inc.\'s intellectual property rights, WiGi Inc. may seek injunctive or other appropriate relief in any state or federal court in the state of Florida, and you consent to exclusive jurisdiction and venue in such courts.\nArbitration under this agreement shall be conducted under the rules then prevailing of the American Arbitration Association. The arbitrator\'s award shall be binding and may be entered as a judgment in any court of competent jurisdiction. To the fullest extent permitted by applicable law, no arbitration under this Agreement shall be joined to an arbitration involving any other party subject to this Agreement, whether through class arbitration proceedings or otherwise. Any cause of action you may have with respect to your use of the WiGi, Inc Services must be commenced within 3 months after the claim or cause of action arises.\n \nPolicies, Modification and Severability\nWe reserve the right to make changes to our site, policies, and these Terms of Use at any time. Should you object to any terms and conditions of these Terms of Use or any subsequent modifications thereto or become dissatisfied with WiGi Inc. in any way, your only recourse is to immediately: (1) discontinue use of WiGi Incâ€™s Services and WiGime.com site and (2) terminate your subscription by contacting support@WiGime.com. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.\n \n \nGeneral Information\nThese Terms constitute the entire agreement between you and WiGi Inc. parent company of WiGime.com and govern your use of the Services, superseding any prior agreements between you and WiGi Inc. You also may be subject to additional terms and conditions that may apply when you use affiliate services, third-party content or third-party software.\nThe section titles in these Terms of Use are for convenience only and have no legal or contractual effect.\n \nPlease report any violations of these Terms to WiGi Inc. by contacting support@WiGime.com.\n \nNO WARRANTIES: LIMITATION OF LIABILITY.\nTHIS SITE IS PROVIDED \"AS IS\" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.\nWiGi Inc. also assumes no responsibility, and shall not be liable for any such damages to or viruses that may infect your computer equipment, software, data or other property on account of your access to, use of, or browsing in the Site or your downloading of any materials, data, text, images, video or audio from the Site or any linked sites.\nIn no event shall WiGi Inc. or any other party involved in creating, producing, maintaining or delivering the Site, or any of their affiliates, or the officers, directors, employees, shareholders, or agents of each of them, be liable for any damages of any kind, including without limitation any direct, special, incidental, indirect, exemplary, punitive or consequential damages, whether or not advised of the possibility of such damages, and on any theory of liability whatsoever, arising out of or in connection with the use or performance of, or your browsing in, or your links to other sites from, this Site.\n \nUNAFFILIATED PRODUCTS AND SITES\nDescriptions of, or references to, products, publications or sites not owned by WiGi Inc. or its affiliates do not imply endorsement of that product, publication or site. WiGi Inc. has not reviewed all material linked to the Site and is not responsible for the content of any such material and specifically does not endorse any materials which may appear on such linked sites. By permitting advertising by third parties on the Site, WiGi Inc does not make any warranties or representations of any kind as to the accuracy of the content of the suitability of any such advertisement. Your linking to any other sites is at your own risk.\n \nCOMMUNICATIONS WITH THIS SITE\nYou are prohibited from creating, posting or transmitting any unlawful material including but not limited to threatening, libelous, defamatory, obscene, scandalous, inflammatory, pornographic, or profane material or any material that could constitute or encourage conduct that would be considered a criminal offense, give rise to civil liability, or otherwise violate any law. WiGi Inc. will fully cooperate with any law enforcement authorities or court order requesting or directing WiGi Inc. to disclose the identity of or help identify or locate anyone posting any such information or materials.\n \nAny communication or material you transmit to WiGi Inc through the WiGime Web Site by e-mail or other written or electronic media, including any data, questions, comments, suggestions, or the like, are and will be treated as, non-confidential and non-proprietary.  WiGi Inc. cannot prevent the \"harvesting\" of information from this Site, and you may be contacted by WiGi Inc, or unrelated third parties, by e-mail or otherwise, within or outside of this Site. Anything you transmit may be edited by or on behalf of WiGi Inc., may or may not be posted to this Site at the sole discretion of WiGi Inc. and may be used by WiGi Inc. or its affiliates for any purpose, including, but not limited to, reproduction, disclosure, transmission, publication, broadcast and posting.\n \nFurthermore, WiGi Inc. is free to use any ideas, concepts, know-how, or techniques contained in any communication you send to the Site for any purpose whatsoever including, but not limited to, developing, manufacturing and marketing products using such information.\nAlthough WiGi Inc. may from time to time monitor or review discussion, chats, postings, transmissions, bulletin boards, and the like on the Site, WiGi Inc. is under no obligation to do so and assumes no responsibility or liability arising from the content of any such locations nor for any error, defamation, libel, slander, omission, falsehood, obscenity, pornography, profanity, danger, or inaccuracy contained in any information within such locations on the Site. WiGi Inc. assumes no responsibility or liability for any actions or communications by you or any unrelated third party within or outside of this Site.\n \nLINKING POLICY\nThis Site may contain links to sites owned or operated by parties other than WiGi Inc. such links are provided for your convenience only. WiGi Inc. does not control, and is not responsible for the availability or content of these external sites, or the security of, such sites. WiGi Inc. does not endorse the content, or any products or services available, on such sites. If you link to such sites you do so at your own risk.\n \nGOVERNING LAWS\nWiGime.com was developed with the intent for international use and shall be governed by the laws of the State of Florida, USA. This Site may be viewed internationally and may contain references to products or services not available in all countries at this time. In helping to provide better services for our members and future members WiGi Inc would like to be notified of the region the service is being requested. WiGi Inc. intends to make a reasonable effort, within the guidelines of countryâ€™s governing laws for those services to be available in such country.\n ',NULL,NULL,'2011-09-01 12:43:50',NULL);
/*!40000 ALTER TABLE `tos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `password` char(32) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `middle_init` varchar(3) DEFAULT NULL,
  `message_method` tinyint(3) NOT NULL DEFAULT '1',
  `email_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `email_confirmation_code` varchar(10) DEFAULT NULL,
  `cellphone_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `lock_count` tinyint(3) NOT NULL DEFAULT '0',
  `login_code` varchar(10) DEFAULT NULL,
  `login_code_expires` datetime DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  `tos_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `tos_accepted_date` datetime DEFAULT NULL,
  `merchant_id` varchar(30) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_login_ip` varchar(15) DEFAULT NULL,
  `business_type` tinyint(3) DEFAULT NULL,
  `business_name` varchar(100) DEFAULT NULL,
  `business_tax_id` varchar(50) DEFAULT NULL,
  `business_phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `uix_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'escalantea@gmail.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',1,'Armando','Escalante','',1,1,'368163',1,0,'570510','2011-10-02 17:59:22','My dog','Presto','2011-08-25 20:08:36','escalantea@gmail.com','2011-10-02 23:21:48','escalantea@gmail.com',6,'2011-09-01 08:45:06',NULL,'1','2011-10-02 19:21:48','66.229.119.100',NULL,NULL,NULL,NULL),(4,'john@wigime.com',1,'4cab35dce9cc383b5861652d142ee605',1,'John','Hruska','',1,1,'443427',1,0,'502268','2011-09-22 14:29:13','First dog','lucky','2011-08-27 11:12:31','john@wigime.com','2011-10-03 17:28:11','john@wigime.com',6,'2011-09-01 11:15:38',NULL,'1','2011-10-03 13:28:11','75.77.214.114',NULL,NULL,NULL,NULL),(5,'jcarmign@',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'J','C','',1,0,'511080',0,0,NULL,NULL,'city of birth','paris','2011-08-29 18:44:43','jcarmign@','2011-09-28 01:07:07','jcarmign@',2,NULL,NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(10,'cbaechle@wigime.com',2,'cff7edca2a8c28fb5bb5a9f47de93116',0,'McDonalds','','',1,1,'800851',0,0,NULL,NULL,'5555555555','question','2011-08-30 17:56:17','cbaechle@wigime.com','2011-09-28 01:07:07','cbaechle@wigime.com',0,NULL,NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(12,'info@adamsas.com',1,'73b3b7cca8740d81ea35c1d45304fbfb',1,'Adam','Sas','',1,1,'416395',1,0,'306027','2011-10-02 23:52:02','what?','what.','2011-09-03 09:35:52','info@adamsas.com','2011-10-03 03:45:56','info@adamsas.com',6,'2011-09-03 09:47:45',NULL,'1','2011-10-02 23:45:56','99.43.21.224',NULL,NULL,NULL,NULL),(13,'test@test.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'GGG','GGG','',1,0,'582895',0,0,NULL,NULL,'gggg','gggggg','2011-09-03 22:13:17','test@test.com','2011-09-28 01:07:07','test@test.com',0,NULL,NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(32,'a@b.com',1,'42599d89c2fab20b5c1e804b746e2640',1,'tfname','tlname','',1,0,'763951',1,0,'829787','2011-09-04 17:34:56','who','me','2011-09-04 14:41:59','a@b.com','2011-09-28 01:07:07','a@b.com',6,'2011-09-04 14:41:59',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(33,'aa@b.com',1,'42599d89c2fab20b5c1e804b746e2640',0,'tfname','tlname','',1,0,'360820',0,0,NULL,NULL,'who','me','2011-09-04 18:06:19','aa@b.com','2011-09-28 01:07:07','aa@b.com',6,'2011-09-04 18:06:19',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(39,'adam.sas@freemail.hu',1,'254efcc87ec6ccd3e6bc603f59eae373',0,'Adam','Sas','',1,0,'236658',0,0,NULL,NULL,'What?','What.','2011-09-04 23:05:21','adam.sas@freemail.hu','2011-09-28 01:07:07','adam.sas@freemail.hu',0,NULL,NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(41,'test@aol.com',1,'0a7fe79363b3d8e631e8ebd6e702a90c',0,'fname','lname','',1,0,'738498',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-08 09:28:46','test@aol.com','2011-09-28 01:07:07','test@aol.com',6,'2011-09-08 09:28:46',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(44,'test2@aol.com',1,'0a7fe79363b3d8e631e8ebd6e702a90c',0,'fname','lname','',1,0,'237334',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-08 09:39:12','test2@aol.com','2011-09-28 01:07:07','test2@aol.com',6,'2011-09-08 09:39:12',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(46,'test3@aol.com',1,'0a7fe79363b3d8e631e8ebd6e702a90c',0,'fname','lname','',1,0,'257747',0,0,NULL,NULL,'my question','my answer','2011-09-08 14:00:10','test3@aol.com','2011-09-28 01:07:07','test3@aol.com',6,'2011-09-08 14:00:10',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(48,'Bob@DVD.cim',1,'665b31b9c0621911033e678f5580c9f5',0,'fname','lname','',1,0,'198498',0,0,NULL,NULL,'mq','ma','2011-09-08 14:57:34','Bob@DVD.cim','2011-09-28 01:07:07','Bob@DVD.cim',6,'2011-09-08 14:57:34',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(49,'',1,'0144712dd81be0c3d9724f5e56ce6685',0,'','','',1,0,'385736',0,0,NULL,NULL,'','','2011-09-08 15:05:29','','2011-09-28 01:07:07','',6,'2011-09-08 15:05:29',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(64,'ffgg@aol.com',1,'4c960368a90a3be1652e14a60c17b8d3',0,'Test','Test','',1,0,'858592',0,0,NULL,NULL,'Qwerty','qwerty','2011-09-09 07:29:04','ffgg@aol.com','2011-09-28 01:07:07','ffgg@aol.com',6,'2011-09-09 07:29:05',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(65,'test6@aol.com',1,'0a7fe79363b3d8e631e8ebd6e702a90c',0,'fname','lname','',1,0,'902185',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-09 07:46:59','test6@aol.com','2011-09-28 01:07:07','test6@aol.com',6,'2011-09-09 07:46:59',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(66,'test7@aol.com',1,'0a7fe79363b3d8e631e8ebd6e702a90c',0,'fname','lname','',1,0,'351007',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-09 07:47:39','test7@aol.com','2011-09-28 01:07:07','test7@aol.com',6,'2011-09-09 07:47:39',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(67,'test17@aol.com',1,'0a7fe79363b3d8e631e8ebd6e702a90c',0,'fname','lname','',1,0,'126538',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-09 07:53:13','test17@aol.com','2011-09-28 01:07:07','test17@aol.com',6,'2011-09-09 07:53:13',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(68,'testi217@aol.com',1,'0a7fe79363b3d8e631e8ebd6e702a90c',0,'fname','lname','',1,0,'299488',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-09 11:40:28','testi217@aol.com','2011-09-28 01:07:07','testi217@aol.com',6,'2011-09-09 11:40:28',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(69,'asdf',1,'0144712dd81be0c3d9724f5e56ce6685',0,'','','',1,0,'514672',0,0,NULL,NULL,'','','2011-09-09 13:11:04','asdf','2011-09-28 01:07:07','asdf',6,'2011-09-09 13:11:04',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(70,'z@z.com',1,'3f50080446ec522fa4279e2e93421e45',0,'Chris','Baechle','',1,0,'597340',0,0,NULL,NULL,'q','a','2011-09-09 13:16:50','z@z.com','2011-09-28 01:07:07','z@z.com',6,'2011-09-09 13:16:50',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(71,'g@g.com',1,'665b31b9c0621911033e678f5580c9f5',0,'chris','baechle','',1,0,'598695',0,0,NULL,NULL,'question','answer','2011-09-09 13:24:52','g@g.com','2011-09-28 01:07:07','g@g.com',6,'2011-09-09 13:24:52',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(81,'jcarmign@wigime.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'Julie','Carmigniani','',1,0,'702267',1,0,NULL,NULL,'City of birth?','Paris','2011-09-10 15:28:21','jcarmign@wigime.com','2011-10-02 02:14:55','jcarmign@wigime.com',6,'2011-09-18 20:38:07',NULL,'1','2011-10-01 22:14:55','76.18.2.51',NULL,NULL,NULL,NULL),(83,'aaba@b.com',1,'42599d89c2fab20b5c1e804b746e2640',0,'tfname','tlname','',1,0,'576959',0,0,NULL,NULL,'who','me','2011-09-12 10:47:33','aaba@b.com','2011-09-28 01:07:07','aaba@b.com',6,'2011-09-12 10:47:33',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(96,'af@aol.co',1,'665b31b9c0621911033e678f5580c9f5',0,'a','b','',1,0,'515951',0,0,NULL,NULL,'q','a','2011-09-20 16:31:59','af@aol.co','2011-10-01 17:30:14','af@aol.co',6,'2011-09-20 16:31:59',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(97,'chrisbaechle4@gmail.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'fname','lname','',1,0,'542635',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-20 16:33:04','chrisbaechle4@gmail.com','2011-10-01 17:30:14','chrisbaechle4@gmail.com',6,'2011-09-20 16:33:04',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(98,'p@aol.com',1,'665b31b9c0621911033e678f5580c9f5',0,'c','f','',1,0,'955820',0,0,NULL,NULL,'q','a','2011-09-20 23:28:28','p@aol.com','2011-10-01 17:30:14','p@aol.com',6,'2011-09-20 23:28:28',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(99,'w',1,'a7486695890a2c343e45c3914fcdd210',0,'a','d','',1,0,'739567',0,0,NULL,NULL,'q','a','2011-09-20 23:54:54','w','2011-10-01 17:30:14','w',6,'2011-09-20 23:54:54',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(100,'u',1,'a7486695890a2c343e45c3914fcdd210',0,'a','d','',1,0,'435607',0,0,NULL,NULL,'q','a','2011-09-20 23:59:01','u','2011-10-01 17:30:14','u',6,'2011-09-20 23:59:01',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(101,'z',1,'cf0275afcae60f66aa6088cf83a185e4',0,'q','s','',1,0,'901129',0,0,NULL,NULL,'q','q','2011-09-21 00:02:59','z','2011-10-01 17:30:14','z',6,'2011-09-21 00:02:59',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(102,'t',1,'a7486695890a2c343e45c3914fcdd210',0,'w','f','',1,0,'164629',0,0,NULL,NULL,'q','q','2011-09-21 00:11:55','t','2011-10-01 17:30:14','t',6,'2011-09-21 00:11:55',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(103,'qq',1,'cf0275afcae60f66aa6088cf83a185e4',0,'a','a','',1,0,'471995',0,0,NULL,NULL,'qq','qq','2011-09-21 00:17:51','qq','2011-10-01 17:30:14','qq',6,'2011-09-21 00:17:51',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(104,'qw',1,'cf0275afcae60f66aa6088cf83a185e4',0,'qq','qq','',1,0,'463544',0,0,NULL,NULL,'q','q','2011-09-21 00:20:52','qw','2011-10-01 17:30:14','qw',6,'2011-09-21 00:20:52',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(105,'qqw',1,'a7486695890a2c343e45c3914fcdd210',0,'qq','qq','',1,0,'615337',0,0,NULL,NULL,'q','q','2011-09-21 00:27:28','qqw','2011-10-01 17:30:14','qqw',6,'2011-09-21 00:27:28',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(106,'yy',1,'a7486695890a2c343e45c3914fcdd210',0,'aa','aa','',1,0,'489921',0,0,NULL,NULL,'q','q','2011-09-21 00:36:10','yy','2011-10-01 17:30:14','yy',6,'2011-09-21 00:36:10',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(107,'chrisbaechle6@gmail.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'fname','lname','',1,0,'385012',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-21 01:01:59','chrisbaechle6@gmail.com','2011-10-01 17:30:14','chrisbaechle6@gmail.com',6,'2011-09-21 01:01:59',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(108,'chrisbaechl6@gmail.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'fname','lname','',1,0,'219889',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-21 01:23:51','chrisbaechl6@gmail.com','2011-10-01 17:30:14','chrisbaechl6@gmail.com',6,'2011-09-21 01:23:51',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(109,'chrisbaecl6@gmail.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'fname','lname','',1,0,'807713',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-21 01:25:27','chrisbaecl6@gmail.com','2011-10-01 17:30:14','chrisbaecl6@gmail.com',6,'2011-09-21 01:25:27',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(110,'chisbaecl6@gmail.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',0,'fname','lname','',1,0,'183953',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-21 01:35:22','chisbaecl6@gmail.com','2011-09-28 01:07:07','chisbaecl6@gmail.com',6,'2011-09-21 01:35:22',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(111,'armando@tio.com',1,'5b88cc4bfa3dce4da17ae548bc439f44',1,'Armando','Escalante','',1,1,'623655',1,0,'378770','2011-09-21 18:49:40','My dog','Presto','2011-09-21 10:08:04','armando@tio.com','2011-09-28 01:07:07','armando@tio.com',6,'2011-09-21 10:08:04',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(112,'ankuragarwal1977@gmail.com',1,'6169cee24a7812fe26e1ac71183a23ae',1,'Ankur','Agarwal','',1,1,'129948',1,0,'351497','2011-09-24 08:37:41','None1','none1','2011-09-22 15:21:36','ankuragarwal1977@gmail.com','2011-10-03 14:34:38','ankuragarwal1977@gmail.com',6,'2011-09-22 15:21:36',NULL,'1','2011-10-03 10:34:38','131.91.71.249',NULL,NULL,NULL,NULL),(113,'qg',1,'a7486695890a2c343e45c3914fcdd210',0,'Qa','Q','',1,0,'515623',0,0,NULL,NULL,'S','q','2011-09-24 03:38:30','qg','2011-09-28 01:07:07','qg',6,'2011-09-24 03:38:30',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(114,'vv',1,'a7486695890a2c343e45c3914fcdd210',0,'A','D','',1,0,'359761',0,0,NULL,NULL,'Q','a','2011-09-24 03:44:09','vv','2011-09-28 01:07:07','vv',6,'2011-09-24 03:44:09',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(115,'oo',1,'a7486695890a2c343e45c3914fcdd210',0,'A','D','',1,0,'542257',0,0,NULL,NULL,'Q','a','2011-09-24 03:45:08','oo','2011-09-28 01:07:07','oo',6,'2011-09-24 03:45:08',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(116,'aescalante@wigime.com',1,'140e0683804ef5b8e19b8f679e0ced69',1,'Armando','Escalante','',1,1,'978771',1,0,NULL,NULL,'My dog','Presto','2011-09-24 12:32:13','aescalante@wigime.com','2011-09-28 01:07:07','aescalante@wigime.com',6,'2011-09-24 12:32:13',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(117,'graghave@gmail.com',1,'f1b8f3931d125f9631d22e866927b612',1,'tfname','tlname','',1,1,'642360',0,0,'812151','2011-10-01 16:56:02','who','test','2011-09-24 18:00:14','graghave@gmail.com','2011-10-01 20:41:42','graghave@gmail.com',6,'2011-09-24 18:00:14',NULL,'1','2011-10-01 16:41:42','209.243.54.107',NULL,NULL,NULL,NULL),(118,'testmerch@wigime.com',2,'cff7edca2a8c28fb5bb5a9f47de93116',0,'Target',NULL,'',1,0,'261275',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-26 12:46:05','testmerch@wigime.com','2011-09-28 01:07:07','testmerch@wigime.com',6,'2011-09-26 12:46:05',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(119,'testmerchant@wigime.com',2,'cff7edca2a8c28fb5bb5a9f47de93116',0,'Target',NULL,'',1,0,'114275',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-26 12:56:18','testmerchant@wigime.com','2011-09-28 01:07:07','testmerchant@wigime.com',6,'2011-09-26 12:56:18',NULL,'1','2011-09-27 21:06:00','71.59.23.211',NULL,NULL,NULL,NULL),(120,'testmerchant2@wigime.com',2,'cff7edca2a8c28fb5bb5a9f47de93116',0,'Target',NULL,'',1,0,'476558',1,0,NULL,NULL,'mysquestion','myanswer','2011-09-26 12:57:22','testmerchant2@wigime.com','2011-10-01 20:08:07','testmerchant2@wigime.com',6,'2011-09-26 12:57:22',NULL,'1','2011-10-01 16:08:07','64.135.32.26',NULL,NULL,NULL,NULL),(121,'testmerchant3@wigime.com',2,'cff7edca2a8c28fb5bb5a9f47de93116',0,'chris','baechle','',1,0,'273526',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-28 06:55:13','testmerchant3@wigime.com','2011-09-28 10:55:13','testmerchant3@wigime.com',6,'2011-09-28 06:55:13',NULL,'1',NULL,NULL,1,'testbiz','12345','1231231234'),(122,'testmerchant4@wigime.com',2,'cff7edca2a8c28fb5bb5a9f47de93116',0,'chris','baechle','',1,0,'244825',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-28 06:59:18','testmerchant4@wigime.com','2011-09-28 10:59:18','testmerchant4@wigime.com',6,'2011-09-28 06:59:18',NULL,'1',NULL,NULL,1,'testbiz','12345','1231231234'),(123,'testmerchant5@wigime.com',2,'cff7edca2a8c28fb5bb5a9f47de93116',0,'chris','baechle','',1,0,'713199',0,0,NULL,NULL,'mysquestion','myanswer','2011-09-28 07:12:15','testmerchant5@wigime.com','2011-09-28 11:12:15','testmerchant5@wigime.com',6,'2011-09-28 07:12:15',NULL,'1',NULL,NULL,1,'testbiz','12345','1231231234'),(124,'info@sasadam.hu',1,'21c181519aa67dd51275ed80b9561507',0,'Adam','Sas','',1,0,'703001',0,0,NULL,NULL,'What?','What.','2011-10-01 10:32:44','info@sasadam.hu','2011-10-01 17:30:14','info@sasadam.hu',6,'2011-10-01 10:32:44',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(125,'test@testing.tester.tt',1,'21c181519aa67dd51275ed80b9561507',0,'Adam','Test','',1,0,'794560',0,0,NULL,NULL,'What?','What.','2011-10-01 11:16:08','test@testing.tester.tt','2011-10-01 17:30:14','test@testing.tester.tt',6,'2011-10-01 11:16:08',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(126,'blabla@testing.tester.tt',1,'21c181519aa67dd51275ed80b9561507',1,'Adam','Test','',1,1,'148189',1,0,NULL,NULL,'What?','What.','2011-10-01 11:21:15','blabla@testing.tester.tt','2011-10-01 17:30:14','blabla@testing.tester.tt',6,'2011-10-01 11:21:15',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(127,'r@g.com',1,'f1b8f3931d125f9631d22e866927b612',1,'Raghavendra','Guru','',1,1,'483226',1,0,'311663','2011-10-01 12:18:25','what','test','2011-10-01 11:57:21','r@g.com','2011-10-01 17:30:14','r@g.com',6,'2011-10-01 11:57:21',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(128,'chrisbaechle@gmail.com',1,'cff7edca2a8c28fb5bb5a9f47de93116',1,'Chris','Baechle','',1,1,'821119',1,0,'737692','2011-10-03 07:50:35','myquestion','myanswer','2011-10-01 13:24:50','chrisbaechle@gmail.com','2011-10-03 11:36:39','chrisbaechle@gmail.com',6,'2011-10-01 13:24:50',NULL,'1','2011-10-03 07:36:39','99.32.183.42',NULL,NULL,NULL,NULL),(141,'r@pos.com',2,'665b31b9c0621911033e678f5580c9f5',0,'Raghu',NULL,'',1,0,'326333',0,0,NULL,NULL,NULL,NULL,'2011-10-01 15:59:50','r@pos.com','2011-10-01 21:57:57','r@pos.com',6,'2011-10-01 15:59:50',NULL,'USA','2011-10-01 17:57:57','108.74.23.63',NULL,'','',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_address` (
  `user_address_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `address_type` tinyint(3) unsigned NOT NULL,
  `addr_line1` varchar(100) DEFAULT NULL,
  `addr_line2` varchar(100) DEFAULT NULL,
  `addr_line3` varchar(100) DEFAULT NULL,
  `addr_line4` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `country_code` char(3) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_address_id`),
  UNIQUE KEY `uix_user_address_type` (`user_id`,`address_type`),
  UNIQUE KEY `uix_user_address` (`user_id`,`addr_line1`,`addr_line2`,`addr_line3`,`addr_line4`,`city`,`state`,`zip`,`country_code`),
  KEY `ix_email` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_address`
--

LOCK TABLES `user_address` WRITE;
/*!40000 ALTER TABLE `user_address` DISABLE KEYS */;
INSERT INTO `user_address` VALUES (1,1,1,'576406 Arbor Club Way','','','','Boca Raton','Florida','33433','1',0,'2011-08-25 18:35:09','jcarmign@wigime.com','2011-08-25 22:35:09','jcarmign@wigime.com'),(2,2,1,'address','','','','city','st','12345','1',0,'2011-08-25 19:31:04','chrisbaechle@gmail.com','2011-08-25 23:31:04','chrisbaechle@gmail.com'),(3,3,1,'6172 NW 88th Ave','','','','Parkland','Florida','33067','1',0,'2011-08-25 20:08:36','escalantea@gmail.com','2011-08-26 00:08:36','escalantea@gmail.com'),(4,4,1,'6998 SE Harbor Circle','','','','Stuart','Florida','34996','1',0,'2011-08-27 11:12:31','john@wigime.com','2011-08-27 15:12:31','john@wigime.com'),(5,5,1,'123 main','','','','Boca','Alabama','33433','1',0,'2011-08-29 18:44:43','jcarmign@','2011-08-29 22:44:43','jcarmign@'),(6,6,1,'address','','','','city','st','12345','1',0,'2011-08-30 17:29:01','cbaechle@wigime.com','2011-08-30 21:29:01','cbaechle@wigime.com'),(7,10,1,'','','','','123','Glades','FL','123',0,'2011-08-30 17:56:17','cbaechle@wigime.com','2011-08-30 21:56:17','cbaechle@wigime.com'),(8,11,1,'Yy','','','','Huh','Alaska','22222','1',0,'2011-08-30 21:38:04','armando@tio.com','2011-08-31 01:38:04','armando@tio.com'),(9,12,1,'3505 S ocean','','','','Hollywood','Florida','33019','1',0,'2011-09-03 09:35:52','info@adamsas.com','2011-09-03 13:35:52','info@adamsas.com'),(10,13,1,'ggg','','','','ggg','FL','gggg','US',0,'2011-09-03 22:13:17','test@test.com','2011-09-04 02:13:17','test@test.com'),(11,14,1,'6172 NW 88th Ave','','','','North Coral Spri','FL','33067','US',0,'2011-09-04 11:41:00','aescalante@wigime.com','2011-09-04 15:41:00','aescalante@wigime.com'),(21,32,1,'testaddress',NULL,NULL,NULL,'bocatest','fl','33433','1',0,'2011-09-04 14:41:59','a@b.com','2011-09-04 18:41:59','a@b.com'),(22,33,1,'testaddress',NULL,NULL,NULL,'bocatest','fl','33433','1',0,'2011-09-04 18:06:19','aa@b.com','2011-09-04 22:06:19','aa@b.com'),(23,36,1,'6172 NW 88th Ave','','','','North Coral Spri','FL','33067','US',0,'2011-09-04 18:37:00','armando.escalante@lexisnexis.com','2011-09-04 22:37:00','armando.escalante@lexisnexis.com'),(24,39,1,'3505 S Ocean Dr','','','','Hollywood','FL','33019','US',0,'2011-09-04 23:05:21','adam.sas@freemail.hu','2011-09-05 03:05:21','adam.sas@freemail.hu'),(25,41,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-08 09:28:46','test@aol.com','2011-09-08 13:28:46','test@aol.com'),(26,44,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-08 09:39:12','test2@aol.com','2011-09-08 13:39:12','test2@aol.com'),(27,46,1,'testaddy',NULL,NULL,NULL,'mycity','FL','34876','1',0,'2011-09-08 14:00:10','test3@aol.com','2011-09-08 18:00:10','test3@aol.com'),(28,48,1,'addy',NULL,NULL,NULL,'psl','fl','34984','1',0,'2011-09-08 14:57:34','Bob@DVD.cim','2011-09-08 18:57:34','Bob@DVD.cim'),(29,49,1,'',NULL,NULL,NULL,'','','','',0,'2011-09-08 15:05:29','','2011-09-08 19:05:29',''),(30,55,1,'eee',NULL,NULL,NULL,'hhh','FL','33067','1',0,'2011-09-08 17:40:21','aescalante@wigime.com','2011-09-08 21:40:21','aescalante@wigime.com'),(38,63,1,'Tty',NULL,NULL,NULL,'Miami','FL','33067','1',0,'2011-09-08 23:12:27','armando@tio.com','2011-09-09 03:12:27','armando@tio.com'),(39,64,1,'Deft','','','','Sfhh','Florida','12375','506',0,'2011-09-09 07:29:04','ffgg@aol.com','2011-09-09 11:29:04','ffgg@aol.com'),(40,65,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-09 07:46:59','test6@aol.com','2011-09-09 11:46:59','test6@aol.com'),(41,66,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-09 07:47:39','test7@aol.com','2011-09-09 11:47:39','test7@aol.com'),(42,67,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-09 07:53:13','test17@aol.com','2011-09-09 11:53:13','test17@aol.com'),(43,68,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-09 11:40:28','testi217@aol.com','2011-09-09 15:40:28','testi217@aol.com'),(44,69,1,'',NULL,NULL,NULL,'','','','Uni',0,'2011-09-09 13:11:04','asdf','2011-09-09 17:11:04','asdf'),(45,70,1,'',NULL,NULL,NULL,'','','','Uni',0,'2011-09-09 13:16:50','z@z.com','2011-09-09 17:16:50','z@z.com'),(46,71,1,'',NULL,NULL,NULL,'','','','Uni',0,'2011-09-09 13:24:52','g@g.com','2011-09-09 17:24:52','g@g.com'),(47,72,1,'',NULL,NULL,NULL,'','','','Uni',0,'2011-09-09 13:27:43','chrisbaechle@gmail.com','2011-09-09 17:27:43','chrisbaechle@gmail.com'),(48,73,1,'',NULL,NULL,NULL,'','','','Uni',0,'2011-09-09 13:42:26','chrisbaechle@gmail.com','2011-09-09 17:42:26','chrisbaechle@gmail.com'),(49,74,1,'',NULL,NULL,NULL,'','','','Uni',0,'2011-09-09 14:55:05','chrisbaechle@gmail.com','2011-09-09 18:55:05','chrisbaechle@gmail.com'),(50,75,1,'as',NULL,NULL,NULL,'sd','fl','','Uni',0,'2011-09-09 15:22:22','chrisbaechle@gmail.com','2011-09-09 19:22:22','chrisbaechle@gmail.com'),(51,76,1,'Qqqwq',NULL,NULL,NULL,'Boca','Fl','33433','Uni',0,'2011-09-09 17:34:45','armando@tio.com','2011-09-09 21:34:45','armando@tio.com'),(52,77,1,'576406 Arbor Club Way',NULL,NULL,NULL,'Boca Raton','Florida','33433','1',0,'2011-09-10 14:32:15','jcarmign@wigime.com','2011-09-10 18:32:15','jcarmign@wigime.com'),(53,78,1,'576406 Arbor Club Way',NULL,NULL,NULL,'Boca Raton','Florida','33433','1',0,'2011-09-10 15:20:51','jcarmign@wigime.com','2011-09-10 19:20:51','jcarmign@wigime.com'),(54,79,1,'576406 Arbor Club Way',NULL,NULL,NULL,'Boca Raton','Florida','33433','1',0,'2011-09-10 15:22:43','jcarmign@wigime.com','2011-09-10 19:22:43','jcarmign@wigime.com'),(55,80,1,'576406 Arbor Club Way',NULL,NULL,NULL,'Boca Raton','Florida','33433','1',0,'2011-09-10 15:24:41','jcarmign@wigime.com','2011-09-10 19:24:41','jcarmign@wigime.com'),(56,81,1,'576406 Arbor Club Way',NULL,NULL,NULL,'Boca Raton','Florida','33433','1',0,'2011-09-10 15:28:21','jcarmign@wigime.com','2011-09-10 19:28:21','jcarmign@wigime.com'),(57,82,1,'6172 NW 88th Ave','','','','North Coral Spri','FL','33067','US',0,'2011-09-11 16:49:14','aescalante@wigime.com','2011-09-11 20:49:14','aescalante@wigime.com'),(58,83,1,'testaddress',NULL,NULL,NULL,'bocatest','fl','33433','1',0,'2011-09-12 10:47:33','aaba@b.com','2011-09-12 14:47:33','aaba@b.com'),(59,87,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 12:50:46','chrisbaechle@gmail.com','2011-09-13 16:50:46','chrisbaechle@gmail.com'),(60,88,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 12:57:07','chrisbaechle@gmail.com','2011-09-13 16:57:07','chrisbaechle@gmail.com'),(61,89,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 13:00:15','chrisbaechle@gmail.com','2011-09-13 17:00:15','chrisbaechle@gmail.com'),(62,90,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 13:05:30','chrisbaechle@gmail.com','2011-09-13 17:05:30','chrisbaechle@gmail.com'),(63,91,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 13:06:37','chrisbaechle@gmail.com','2011-09-13 17:06:37','chrisbaechle@gmail.com'),(64,92,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 13:08:50','chrisbaechle@gmail.com','2011-09-13 17:08:50','chrisbaechle@gmail.com'),(65,93,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 13:10:42','chrisbaechle@gmail.com','2011-09-13 17:10:42','chrisbaechle@gmail.com'),(66,94,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 13:11:43','chrisbaechle@gmail.com','2011-09-13 17:11:43','chrisbaechle@gmail.com'),(67,95,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-13 13:12:20','chrisbaechle@gmail.com','2011-09-13 17:12:20','chrisbaechle@gmail.com'),(68,96,1,'ss',NULL,NULL,NULL,'sss','fl','123456','Uni',0,'2011-09-20 16:31:59','af@aol.co','2011-09-20 20:31:59','af@aol.co'),(69,97,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-20 16:33:04','chrisbaechle4@gmail.com','2011-09-20 20:33:04','chrisbaechle4@gmail.com'),(70,98,1,'d',NULL,NULL,NULL,'f','fk','123456','Uni',0,'2011-09-20 23:28:28','p@aol.com','2011-09-21 03:28:28','p@aol.com'),(71,99,1,'ddr',NULL,NULL,NULL,'edd','fl','','1',0,'2011-09-20 23:54:54','w','2011-09-21 03:54:54','w'),(72,100,1,'sdrf',NULL,NULL,NULL,'dd','fx','5','1',0,'2011-09-20 23:59:01','u','2011-09-21 03:59:01','u'),(73,101,1,'d',NULL,NULL,NULL,'d','dd','5','1',0,'2011-09-21 00:02:59','z','2011-09-21 04:02:59','z'),(74,102,1,'f',NULL,NULL,NULL,'g','f','2','1',0,'2011-09-21 00:11:55','t','2011-09-21 04:11:55','t'),(75,103,1,'e',NULL,NULL,NULL,'f','5f','','1',0,'2011-09-21 00:17:51','qq','2011-09-21 04:17:51','qq'),(76,104,1,'dd',NULL,NULL,NULL,'ff','5','5','1',0,'2011-09-21 00:20:52','qw','2011-09-21 04:20:52','qw'),(77,105,1,'ff',NULL,NULL,NULL,'ddd','dd','545','1',0,'2011-09-21 00:27:28','qqw','2011-09-21 04:27:28','qqw'),(78,106,1,'ff',NULL,NULL,NULL,'gs','dd','25','1',0,'2011-09-21 00:36:10','yy','2011-09-21 04:36:10','yy'),(79,107,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345',NULL,0,'2011-09-21 01:01:59','chrisbaechle6@gmail.com','2011-09-21 05:01:59','chrisbaechle6@gmail.com'),(80,108,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345',NULL,0,'2011-09-21 01:23:51','chrisbaechl6@gmail.com','2011-09-21 05:23:51','chrisbaechl6@gmail.com'),(81,109,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345',NULL,0,'2011-09-21 01:25:27','chrisbaecl6@gmail.com','2011-09-21 05:25:27','chrisbaecl6@gmail.com'),(82,110,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-21 01:35:22','chisbaecl6@gmail.com','2011-09-21 05:35:22','chisbaecl6@gmail.com'),(83,111,1,'6172 NW 88th Ave',NULL,NULL,NULL,'Parkland','FL','33067','1',0,'2011-09-21 10:08:04','armando@tio.com','2011-09-21 14:08:04','armando@tio.com'),(84,112,1,'Glades',NULL,NULL,NULL,'Boca','Florida','33431','1',0,'2011-09-22 15:21:36','ankuragarwal1977@gmail.com','2011-09-22 19:21:36','ankuragarwal1977@gmail.com'),(85,113,1,'D',NULL,NULL,NULL,'D','AZ','','1',0,'2011-09-24 03:38:30','qg','2011-09-24 07:38:30','qg'),(86,114,1,'A',NULL,NULL,NULL,'D','AR','1','1',0,'2011-09-24 03:44:09','vv','2011-09-24 07:44:09','vv'),(87,115,1,'D',NULL,NULL,NULL,'G','AZ','19','1',0,'2011-09-24 03:45:08','oo','2011-09-24 07:45:08','oo'),(88,116,1,'6172 NW 88th Ave',NULL,NULL,NULL,'Parkland','FL','33067','1',0,'2011-09-24 12:32:13','aescalante@wigime.com','2011-09-24 16:32:13','aescalante@wigime.com'),(89,117,1,'testaddress',NULL,NULL,NULL,'bocatest','fl','33433','1',0,'2011-09-24 18:00:14','graghave@gmail.com','2011-09-24 22:00:14','graghave@gmail.com'),(90,118,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-26 12:46:05','testmerch@wigime.com','2011-09-26 16:46:05','testmerch@wigime.com'),(91,119,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-26 12:56:18','testmerchant@wigime.com','2011-09-26 16:56:18','testmerchant@wigime.com'),(92,120,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-26 12:57:22','testmerchant2@wigime.com','2011-09-26 16:57:22','testmerchant2@wigime.com'),(93,121,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-28 06:55:13','testmerchant3@wigime.com','2011-09-28 10:55:13','testmerchant3@wigime.com'),(94,122,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-28 06:59:18','testmerchant4@wigime.com','2011-09-28 10:59:18','testmerchant4@wigime.com'),(95,123,1,'123testst',NULL,NULL,NULL,'psl',NULL,'12345','1',0,'2011-09-28 07:12:15','testmerchant5@wigime.com','2011-09-28 11:12:15','testmerchant5@wigime.com'),(96,124,1,'3505 S Ocean Dr',NULL,NULL,NULL,'Hollywood','FL','33019','US',0,'2011-10-01 10:32:44','info@sasadam.hu','2011-10-01 14:32:44','info@sasadam.hu'),(97,125,1,'3505 S Ocean Dr',NULL,NULL,NULL,'Hollywood','FL','33019','US',0,'2011-10-01 11:16:08','test@testing.tester.tt','2011-10-01 15:16:08','test@testing.tester.tt'),(98,126,1,'3505 S Ocean Dr',NULL,NULL,NULL,'Hollywood','FL','33019','US',0,'2011-10-01 11:21:15','blabla@testing.tester.tt','2011-10-01 15:21:15','blabla@testing.tester.tt'),(99,127,1,'dsfasd',NULL,NULL,NULL,'sdfas','FL','12345','US',0,'2011-10-01 11:57:21','r@g.com','2011-10-01 15:57:21','r@g.com'),(100,128,1,'123 test st',NULL,NULL,NULL,'psl','FL','12345','US',0,'2011-10-01 13:24:50','chrisbaechle@gmail.com','2011-10-01 17:24:50','chrisbaechle@gmail.com'),(101,129,1,'Eee',NULL,NULL,NULL,'Dddd','Florida','22222','USA',0,'2011-10-01 14:06:00','aac@b..com','2011-10-01 18:06:00','aac@b..com'),(102,130,1,'Eee',NULL,NULL,NULL,'Dddd','Florida','22222','USA',0,'2011-10-01 14:13:11','aac@db..com','2011-10-01 18:13:11','aac@db..com'),(103,131,1,'Eee',NULL,NULL,NULL,'Dddd','Florida','22222','USA',0,'2011-10-01 15:09:58','aacq@db..com','2011-10-01 19:09:58','aacq@db..com'),(104,132,1,'Eee',NULL,NULL,NULL,'Dddd','Florida','22222','USA',0,'2011-10-01 15:19:18','aacqw@db..com','2011-10-01 19:19:18','aacqw@db..com'),(105,133,1,'Eee',NULL,NULL,NULL,'Dddd','Florida','22222','USA',0,'2011-10-01 15:21:05','aacq@db..com','2011-10-01 19:21:05','aacq@db..com'),(106,134,1,'Eee',NULL,NULL,NULL,'Dddd','Florida','22222','USA',0,'2011-10-01 15:21:43','aac@db..com','2011-10-01 19:21:43','aac@db..com'),(107,135,1,'Eee',NULL,NULL,NULL,'Dddd','Florida','22222','USA',0,'2011-10-01 15:24:16','aa@db..com','2011-10-01 19:24:16','aa@db..com'),(108,136,1,'Rrrr',NULL,NULL,NULL,'Dff','State','22332','Cou',0,'2011-10-01 15:27:12','acc@b.com','2011-10-01 19:27:12','acc@b.com'),(109,137,1,'Rrrr',NULL,NULL,NULL,'Dff','State','22332','Cou',0,'2011-10-01 15:39:32','acca@b.com','2011-10-01 19:39:32','acca@b.com'),(110,138,1,'Rrrr',NULL,NULL,NULL,'Dff','State','22332','Cou',0,'2011-10-01 15:43:46','accaa@b.com','2011-10-01 19:43:46','accaa@b.com'),(111,139,1,'Yy',NULL,NULL,NULL,'Ggg','State','55555','Cou',0,'2011-10-01 15:50:57','qq@a.com','2011-10-01 19:50:57','qq@a.com'),(112,140,1,'Qqg',NULL,NULL,NULL,'Ttt','Florida','44444','USA',0,'2011-10-01 15:57:32','r@pos.com','2011-10-01 19:57:32','r@pos.com'),(113,141,1,'Qqg',NULL,NULL,NULL,'Ttt','Florida','44444','USA',0,'2011-10-01 15:59:50','r@pos.com','2011-10-01 19:59:50','r@pos.com');
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_bank_account`
--

DROP TABLE IF EXISTS `user_bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_bank_account` (
  `user_bank_account_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `key_version` tinyint(3) unsigned NOT NULL,
  `last4` char(4) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  `bank_type` enum('C','S') DEFAULT NULL,
  `routing` varchar(255) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '0',
  `conf_amt` decimal(10,2) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_bank_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_bank_account`
--

LOCK TABLES `user_bank_account` WRITE;
/*!40000 ALTER TABLE `user_bank_account` DISABLE KEYS */;
INSERT INTO `user_bank_account` VALUES (0,95,1,'1111','mydescription','C','063000047',0,'0.07','2011-09-21 13:22:31',NULL,'2011-09-21 17:22:31',NULL),(8,3,1,'6789','SunTrust Savings','S','063103193',1,'0.00','2011-08-26 17:12:47','escalantea@gmail.com','2011-09-04 01:42:13','escalantea@gmail.com'),(9,1,1,'0277','BofA Account','C','063100277',0,'0.00','2011-08-26 18:21:05','jcarmign@wigime.com','2011-08-27 02:16:12','jcarmign@wigime.com'),(10,2,1,'0277','test checking','C','063100277',0,'0.00','2011-08-26 18:24:22','chrisbaechle@gmail.com','2011-08-27 19:46:52','chrisbaechle@gmail.com'),(11,1,1,'0277','Savings','S','063100277',0,'0.00','2011-08-26 18:27:25','jcarmign@wigime.com','2011-08-27 02:16:12','jcarmign@wigime.com'),(12,2,1,'2345','test checking 2','C','12345',0,'0.40','2011-08-27 14:17:26','chrisbaechle@gmail.com','2011-08-27 18:18:46','chrisbaechle@gmail.com'),(13,2,1,'1324','test checking 3','C','1234',0,'0.65','2011-08-27 14:17:41','chrisbaechle@gmail.com','2011-08-27 18:18:46','chrisbaechle@gmail.com'),(14,2,1,'1234','test checking 4','C','123456789',0,'0.83','2011-08-27 15:43:42','chrisbaechle@gmail.com','2011-08-27 19:46:52','chrisbaechle@gmail.com'),(15,2,1,'123','test checking 5','C','123456789',1,'0.03','2011-08-27 15:46:31','chrisbaechle@gmail.com','2011-08-27 19:48:44','chrisbaechle@gmail.com'),(16,2,1,'1234','test checking 6','C','12345679',0,'0.62','2011-08-27 15:54:36','chrisbaechle@gmail.com','2011-08-27 19:54:36','chrisbaechle@gmail.com'),(27,95,1,'1111','mydescription','C','063000047',0,'0.52','2011-09-21 14:08:06',NULL,'2011-09-21 18:08:06',NULL),(28,95,1,'1111','City Bank','C','063000047',0,'0.18','2011-09-21 18:01:29',NULL,'2011-09-21 22:01:29',NULL),(29,95,1,'1111','Citi Bank','C','063000047',0,'0.12','2011-09-21 18:01:42',NULL,'2011-09-21 22:01:42',NULL),(30,95,1,'1111','Wachovia','C','063000047',0,'0.23','2011-09-21 18:01:58',NULL,'2011-09-21 22:01:58',NULL),(31,95,1,'6789','My Description','C','063100277',0,'0.74','2011-10-01 01:50:45','chrisbaechle@gmail.com','2011-10-01 05:50:45','chrisbaechle@gmail.com'),(32,95,1,'6789','My Description','C','063100277',0,'0.84','2011-10-01 01:51:08','chrisbaechle@gmail.com','2011-10-01 05:51:08','chrisbaechle@gmail.com');
/*!40000 ALTER TABLE `user_bank_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_contact`
--

DROP TABLE IF EXISTS `user_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_contact` (
  `user_contact_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `contact_type` tinyint(3) unsigned NOT NULL,
  `contact_user_id` int(11) unsigned NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_contact_id`),
  UNIQUE KEY `ix_user_contact` (`user_id`,`contact_user_id`,`contact_type`),
  KEY `ix_contact_user_id` (`contact_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_contact`
--

LOCK TABLES `user_contact` WRITE;
/*!40000 ALTER TABLE `user_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_credit_card`
--

DROP TABLE IF EXISTS `user_credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_credit_card` (
  `user_credit_card_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `key_version` tinyint(3) unsigned NOT NULL,
  `last4` char(4) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  `card_type` enum('VISA','MAST','AMER','DISC','DINE','JCB') DEFAULT NULL,
  `expire_month` tinyint(3) unsigned DEFAULT NULL,
  `expire_year` smallint(5) unsigned DEFAULT NULL,
  `name_on_card` varchar(255) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '0',
  `conf_amt` decimal(10,2) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_credit_card_id`),
  KEY `ix_credit_card_user_id` (`user_id`),
  KEY `ix_bank_account_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_credit_card`
--

LOCK TABLES `user_credit_card` WRITE;
/*!40000 ALTER TABLE `user_credit_card` DISABLE KEYS */;
INSERT INTO `user_credit_card` VALUES (1,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.32','2011-09-20 18:24:33',NULL,'2011-09-20 22:24:33',NULL),(11,2,1,'1111','test card 1','VISA',1,12,'Chrisopher Baechle',0,'0.00','2011-08-26 17:06:34','chrisbaechle@gmail.com','2011-08-27 02:16:04','chrisbaechle@gmail.com'),(12,3,1,'1111','My BofA Visa','VISA',1,12,'Armando Escalante',0,'0.00','2011-08-26 17:09:42','escalantea@gmail.com','2011-08-27 02:16:04','escalantea@gmail.com'),(13,3,1,'4444','My Chase MC','MAST',1,12,'Armando Escalante',0,'0.00','2011-08-26 17:10:20','escalantea@gmail.com','2011-08-27 02:16:04','escalantea@gmail.com'),(14,1,1,'1111','VISA','VISA',7,13,'Julie Carmigniani',0,'0.00','2011-08-26 18:00:22','jcarmign@wigime.com','2011-08-27 02:16:04','jcarmign@wigime.com'),(15,1,1,'1111','BofA VISA','VISA',9,13,'Julie Carmigniani',0,'0.00','2011-08-26 18:01:57','jcarmign@wigime.com','2011-08-27 02:16:04','jcarmign@wigime.com'),(16,1,1,'1111','MASTER','MAST',9,13,'Julie Carmigniani',0,'0.00','2011-08-26 18:08:29','jcarmign@wigime.com','2011-08-27 02:16:04','jcarmign@wigime.com'),(17,2,1,'1111','test card 2','VISA',1,12,'Christopher Baechle',0,'0.14','2011-08-26 21:52:15','chrisbaechle@gmail.com','2011-08-27 02:16:04','chrisbaechle@gmail.com'),(18,2,1,'1111','test card 3','VISA',1,12,'Christopher Baechle',0,'0.78','2011-08-26 22:00:19','chrisbaechle@gmail.com','2011-08-27 02:16:04','chrisbaechle@gmail.com'),(19,2,1,'1111','My Card','VISA',1,13,'Christopher Baechle',0,'0.22','2011-08-31 11:07:59','chrisbaechle@gmail.com','2011-08-31 15:07:59','chrisbaechle@gmail.com'),(50,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.88','2011-09-20 18:56:45',NULL,'2011-09-20 22:56:45',NULL),(51,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.67','2011-09-20 18:56:47',NULL,'2011-09-20 22:56:47',NULL),(52,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.17','2011-09-20 18:56:54',NULL,'2011-09-20 22:56:54',NULL),(53,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.12','2011-09-20 18:57:19',NULL,'2011-09-20 22:57:19',NULL),(54,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.12','2011-09-20 19:00:21',NULL,'2011-09-20 23:00:21',NULL),(55,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.52','2011-09-20 19:01:38',NULL,'2011-09-20 23:01:38',NULL),(56,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.37','2011-09-20 19:29:42',NULL,'2011-09-20 23:29:42',NULL),(57,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.74','2011-09-20 19:36:58',NULL,'2011-09-20 23:36:58',NULL),(58,95,1,'1111','mydescription','VISA',1,2013,'mynameoncard',0,'0.28','2011-09-21 13:02:20',NULL,'2011-09-21 17:02:20',NULL),(59,95,1,'1111','mydescription','VISA',1,2013,'mynameoncard',0,'0.98','2011-09-21 14:35:51',NULL,'2011-09-21 18:35:51',NULL),(63,95,1,'1111','BOA Card','VISA',1,2013,'mynameoncard',0,'0.56','2011-09-21 18:00:19',NULL,'2011-09-21 22:00:19',NULL),(64,95,1,'1111','BOA Card','VISA',1,2013,'mynameoncard',0,'0.90','2011-09-21 18:00:23',NULL,'2011-09-21 22:00:23',NULL),(65,95,1,'1111','Wamu Card','VISA',1,2013,'mynameoncard',0,'0.25','2011-09-21 18:00:39',NULL,'2011-09-21 22:00:39',NULL),(66,95,1,'1111','PNC Card','VISA',1,2013,'mynameoncard',0,'0.16','2011-09-21 18:00:54',NULL,'2011-09-21 22:00:54',NULL),(67,95,1,'1111','My Description','VISA',2,2012,'My Name',0,'0.13','2011-10-01 01:46:33','chrisbaechle@gmail.com','2011-10-01 05:46:33','chrisbaechle@gmail.com'),(68,95,1,'1111','My Description','VISA',2,2012,'My Name',0,'0.29','2011-10-01 01:46:57','chrisbaechle@gmail.com','2011-10-01 05:46:57','chrisbaechle@gmail.com'),(400,95,1,'6789','mydescription','VISA',1,2013,'mynameoncard',0,'0.82','2011-09-20 17:17:07',NULL,'2011-09-20 21:17:07',NULL);
/*!40000 ALTER TABLE `user_credit_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_ext`
--

DROP TABLE IF EXISTS `user_ext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_ext` (
  `user_ext_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `val` varchar(100) NOT NULL,
  `category` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`user_ext_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_ext`
--

LOCK TABLES `user_ext` WRITE;
/*!40000 ALTER TABLE `user_ext` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_ext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mobile`
--

DROP TABLE IF EXISTS `user_mobile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_mobile` (
  `mobile_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `mobile_type` mediumint(6) unsigned NOT NULL,
  `cellphone` varchar(30) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `mobile_confirmation_code` varchar(10) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `pin` char(32) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `temp_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  `has_message` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `has_txn` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mobile_id`),
  UNIQUE KEY `uix_user_mobile` (`user_id`,`cellphone`),
  UNIQUE KEY `uix_mobile_type_id` (`mobile_type`,`cellphone`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mobile`
--

LOCK TABLES `user_mobile` WRITE;
/*!40000 ALTER TABLE `user_mobile` DISABLE KEYS */;
INSERT INTO `user_mobile` VALUES (3,3,1,'5618667413',1,'240031',1,'3852d6146a508ced74b345909b88aa2f','9000.00','9500.00','2011-08-25 20:08:36','escalantea@gmail.com','2011-10-01 19:49:01','escalantea@gmail.com',0,0),(4,4,1,'7723703352',1,'772534',1,'9b6c65a4a9cd171a3aef656bf7263dfb','9000.00','9000.00','2011-08-27 11:12:31','john@wigime.com','2011-10-03 18:29:01','john@wigime.com',0,0),(7,10,1,'1',1,'158246',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','2011-08-30 17:56:17','cbaechle@wigime.com','2011-10-01 19:26:24','cbaechle@wigime.com',1,0),(9,12,1,'3053359423',1,'283956',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','2011-09-03 09:35:52','info@adamsas.com','2011-10-01 19:26:24','info@adamsas.com',1,0),(20,32,1,'1234567890',1,'432580',1,'baa79a536e75c3d61e404c03320da1bd','9000.00','9000.00','0000-00-00 00:00:00','a@b.com','2011-10-01 19:26:24','a@b.com',0,0),(21,33,1,'1324567890',0,'723526',1,'baa79a536e75c3d61e404c03320da1bd','9000.00','9000.00','2018-06-19 00:00:00','aa@b.com','2011-10-01 19:26:24','aa@b.com',0,0),(22,44,1,'1231231238',0,'526012',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','test2@aol.com','2011-10-01 19:26:24','test2@aol.com',0,0),(23,48,1,'12331234',0,'279303',1,'baa79a536e75c3d61e404c03320da1bd','9000.00','9000.00','0000-00-00 00:00:00','Bob@DVD.cim','2011-10-01 19:26:24','Bob@DVD.cim',0,0),(24,49,1,'',0,'979972',1,'0144712dd81be0c3d9724f5e56ce6685','9000.00','9000.00','2015-05-29 00:00:00','','2011-10-01 19:26:24','',0,0),(34,64,1,'123123254',0,'482025',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','2011-09-09 07:29:04','ffgg@aol.com','2011-10-01 19:26:24','ffgg@aol.com',0,0),(36,66,1,'1231231538',0,'166615',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','test7@aol.com','2011-10-01 19:26:24','test7@aol.com',0,0),(37,67,1,'2231231538',0,'365987',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','test17@aol.com','2011-10-01 19:26:24','test17@aol.com',0,0),(38,68,1,'3231231538',0,'897767',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','testi217@aol.com','2011-10-01 19:26:24','testi217@aol.com',0,0),(40,70,1,'7728280085',0,'773195',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','z@z.com','2011-10-01 19:26:24','z@z.com',0,0),(41,71,1,'1112223434',0,'921397',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','g@g.com','2011-10-01 19:26:24','g@g.com',0,0),(51,81,1,'4079820087',1,'636879',1,'e3e4c79619a43976a666d1d3f483adc1','9000.00','9000.00','0000-00-00 00:00:00','jcarmign@wigime.com','2011-10-01 19:26:24','jcarmign@wigime.com',0,0),(53,83,1,'1424567890',0,'595766',1,'baa79a536e75c3d61e404c03320da1bd','9000.00','9000.00','0000-00-00 00:00:00','aaba@b.com','2011-10-01 19:26:24','aaba@b.com',0,0),(58,98,1,'1231231234',0,'970173',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','p@aol.com','2011-10-01 19:26:24','p@aol.com',0,0),(60,100,1,'1231231221',0,'124289',1,'4f6e5e4f2282a3f043771af529b61f98','9000.00','9000.00','0000-00-00 00:00:00','u','2011-10-01 19:26:24','u',0,0),(61,101,1,'5',0,'646086',1,'4f6e5e4f2282a3f043771af529b61f98','9000.00','9000.00','0000-00-00 00:00:00','z','2011-10-01 19:26:24','z',0,0),(62,102,1,'6',0,'251492',1,'439cd5a9dc6261711f15cfd85b350807','9000.00','9000.00','0000-00-00 00:00:00','t','2011-10-01 19:26:24','t',0,0),(63,103,1,'4',0,'693867',1,'4f6e5e4f2282a3f043771af529b61f98','9000.00','9000.00','0000-00-00 00:00:00','qq','2011-10-01 19:26:24','qq',0,0),(64,104,1,'11',0,'312168',1,'4f6e5e4f2282a3f043771af529b61f98','9000.00','9000.00','0000-00-00 00:00:00','qw','2011-10-01 19:26:24','qw',0,0),(65,105,1,'147',0,'601897',1,'4f6e5e4f2282a3f043771af529b61f98','9000.00','9000.00','0000-00-00 00:00:00','qqw','2011-10-01 19:26:24','qqw',0,0),(66,106,1,'495',0,'690896',1,'4f6e5e4f2282a3f043771af529b61f98','9000.00','9000.00','0000-00-00 00:00:00','yy','2011-10-01 19:26:24','yy',0,0),(67,107,1,'7728280084COUNTRY_CODE=1',0,'125093',1,'2b337c6436097e66a950689fda61dfff','9000.00','9000.00','0000-00-00 00:00:00','chrisbaechle6@gmail.com','2011-10-01 19:26:24','chrisbaechle6@gmail.com',0,0),(68,108,1,'772880084COUNTRY_CODE=1',0,'106190',1,'2b337c6436097e66a950689fda61dfff','9000.00','9000.00','0000-00-00 00:00:00','chrisbaechl6@gmail.com','2011-10-01 19:26:24','chrisbaechl6@gmail.com',0,0),(69,109,1,'77280084COUNTRY_CODE=1',0,'419940',1,'2b337c6436097e66a950689fda61dfff','9000.00','9000.00','0000-00-00 00:00:00','chrisbaecl6@gmail.com','2011-10-01 19:26:24','chrisbaecl6@gmail.com',0,0),(70,110,1,'77280084',0,'300543',1,'2b337c6436097e66a950689fda61dfff','9000.00','9000.00','0000-00-00 00:00:00','chisbaecl6@gmail.com','2011-10-01 19:26:24','chisbaecl6@gmail.com',0,0),(71,111,1,'6787086464',1,'154738',1,'3852d6146a508ced74b345909b88aa2f','9000.00','9000.00','2010-08-04 00:00:00','armando@tio.com','2011-10-01 19:26:24','armando@tio.com',0,0),(72,112,1,'7724187912',1,'657136',1,'bdf06e107b56aa045dabf41e49411c0f','9000.00','9000.00','0000-00-00 00:00:00','ankuragarwal1977@gmail.com','2011-10-03 14:56:01','ankuragarwal1977@gmail.com',0,0),(73,113,1,'122456',0,'938694',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','qg','2011-10-01 19:26:24','qg',0,0),(75,115,1,'154565',0,'544221',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','oo','2011-10-01 19:26:24','oo',0,0),(76,116,1,'5612135972',1,'434324',1,'3852d6146a508ced74b345909b88aa2f','9000.00','9000.00','0000-00-00 00:00:00','aescalante@wigime.com','2011-10-01 19:26:24','aescalante@wigime.com',0,0),(77,117,1,'5619974600',0,'383205',1,'baa79a536e75c3d61e404c03320da1bd','9000.00','9000.00','2018-00-14 00:00:00','graghave@gmail.com','2011-10-01 19:26:24','graghave@gmail.com',0,0),(79,120,1,'53775',0,'222555',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','testmerchant2@wigime.com','2011-10-01 19:26:24','testmerchant2@wigime.com',0,0),(80,120,2,'1234',0,'729136',1,'1234567','9000.00','9000.00','2001-00-14 00:00:00','testmerchant2@wigime.com','2011-10-01 19:26:24','testmerchant2@wigime.com',0,0),(81,120,2,'12345',0,'719001',1,'1234567','9000.00','9000.00','0000-00-00 00:00:00','testmerchant2@wigime.com','2011-10-01 19:26:24','testmerchant2@wigime.com',0,0),(83,120,2,'123456',0,'740388',1,'1234567','9000.00','9000.00','0000-00-00 00:00:00','testmerchant2@wigime.com','2011-10-01 19:26:24','testmerchant2@wigime.com',0,0),(84,120,2,'1234567',0,'650311',1,'1234567','9000.00','9000.00','0000-00-00 00:00:00','testmerchant2@wigime.com','2011-10-01 19:26:24','testmerchant2@wigime.com',0,0),(86,120,2,'12345678',1,'224926',1,'1234567','9004.00','9005.00','0000-00-00 00:00:00','testmerchant2@wigime.com','2011-10-01 20:10:43','testmerchant2@wigime.com',0,0),(87,121,1,'537475',0,'194895',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','testmerchant3@wigime.com','2011-10-01 19:26:24','testmerchant3@wigime.com',0,0),(88,122,1,'5537475',0,'345023',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','testmerchant4@wigime.com','2011-10-01 19:26:24','testmerchant4@wigime.com',0,0),(89,123,1,'25537475',0,'114208',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','2007-12-15 00:00:00','testmerchant5@wigime.com','2011-10-01 19:26:24','testmerchant5@wigime.com',0,0),(92,126,1,'0123456789',1,'826156',1,'2dc5b833d9ac4e4e24724aeea8b07de7','9000.00','9000.00','0000-00-00 00:00:00','blabla@testing.tester.tt','2011-10-01 19:26:24','blabla@testing.tester.tt',0,0),(93,127,1,'5612139598',1,'598668',1,'754be99132b37932926ba3a7eae78297','9000.00','9000.00','0000-00-00 00:00:00','r@g.com','2011-10-01 19:26:24','r@g.com',0,0),(94,128,1,'7728280084',1,'187905',1,'754be99132b37932926ba3a7eae78297','9000.00','8995.00','0000-00-00 00:00:00','chrisbaechle@gmail.com','2011-10-01 20:10:20','chrisbaechle@gmail.com',0,0),(98,139,1,'1234567888',0,'894119',0,'baa79a536e75c3d61e404c03320da1bd','0.00','0.00','0000-00-00 00:00:00','qq@a.com','2011-10-01 19:50:57','qq@a.com',0,0),(100,141,2,'5619974600',0,'376432',0,'baa79a536e75c3d61e404c03320da1bd','0.00','0.00','0000-00-00 00:00:00','r@pos.com','2011-10-01 19:59:50','r@pos.com',0,0);
/*!40000 ALTER TABLE `user_mobile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mobile_bank_account`
--

DROP TABLE IF EXISTS `user_mobile_bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_mobile_bank_account` (
  `user_mobile_bank_account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobile_id` int(11) unsigned NOT NULL,
  `user_bank_account_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_mobile_bank_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mobile_bank_account`
--

LOCK TABLES `user_mobile_bank_account` WRITE;
/*!40000 ALTER TABLE `user_mobile_bank_account` DISABLE KEYS */;
INSERT INTO `user_mobile_bank_account` VALUES (10,3,8),(11,1,9),(12,2,10),(13,1,11),(14,55,25),(15,55,27),(16,51,29),(17,51,30);
/*!40000 ALTER TABLE `user_mobile_bank_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mobile_credit_card`
--

DROP TABLE IF EXISTS `user_mobile_credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_mobile_credit_card` (
  `user_mobile_credit_card_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobile_id` int(11) unsigned NOT NULL,
  `user_credit_card_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_mobile_credit_card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mobile_credit_card`
--

LOCK TABLES `user_mobile_credit_card` WRITE;
/*!40000 ALTER TABLE `user_mobile_credit_card` DISABLE KEYS */;
INSERT INTO `user_mobile_credit_card` VALUES (11,2,11),(12,3,12),(13,3,13),(14,1,14),(15,1,15),(16,1,16),(17,2,19),(18,55,57),(19,55,59),(20,51,64),(21,51,65),(22,51,66);
/*!40000 ALTER TABLE `user_mobile_credit_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mobile_ext`
--

DROP TABLE IF EXISTS `user_mobile_ext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_mobile_ext` (
  `user_mobile_ext_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobile_id` int(11) unsigned DEFAULT NULL,
  `key` varchar(100) NOT NULL,
  `val` varchar(100) NOT NULL,
  `category` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`user_mobile_ext_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mobile_ext`
--

LOCK TABLES `user_mobile_ext` WRITE;
/*!40000 ALTER TABLE `user_mobile_ext` DISABLE KEYS */;
INSERT INTO `user_mobile_ext` VALUES (1,1,'minimum_balance','10',1),(2,1,'statement_method','email',1),(3,1,'receipt_method','sms',1),(4,1,'wigicode_timeout','10',1),(5,1,'international_trans','true',1),(6,1,'max_wigi_amt_txn','500',1),(7,1,'max_wigi_amt_day','3',1),(8,1,'max_gift_amt_txn','1000',1),(9,1,'max_gift_amt_day','60',1),(10,3,'minimum_balance','10',1),(11,3,'statement_method','email',1),(12,3,'receipt_method','sms',1),(13,3,'wigicode_timeout','60',1),(14,3,'international_trans','false',1),(15,3,'max_wigi_amt_txn','1000',1),(16,3,'max_wigi_amt_day','10',1),(17,3,'max_gift_amt_txn','2000',1),(18,3,'max_gift_amt_day','10',1),(19,1,'session_timeout','360',1),(20,3,'session_timeout','180',1),(21,4,'minimum_balance','2',1),(22,4,'statement_method','email',1),(23,4,'receipt_method','sms',1),(24,4,'wigicode_timeout','10',1),(25,4,'international_trans','true',1),(26,4,'max_wigi_amt_txn','500',1),(27,4,'max_wigi_amt_day','4',1),(28,4,'max_gift_amt_txn','100',1),(29,4,'max_gift_amt_day','5',1),(30,4,'session_timeout','60',1),(31,55,'minimum_balance','1',1),(32,55,'statement_method','sms',1),(33,55,'receipt_method','email',1),(34,55,'wigicode_timeout','4',1),(35,55,'international_trans','0',1),(36,55,'max_wigi_amt_txn','100',1),(37,55,'max_wigi_amt_day','1',1),(38,55,'max_gift_amt_txn','5',1),(39,55,'max_gift_amt_day','1',1),(40,55,'session_timeout','3',1),(41,51,'minimum_balance','100',1),(42,51,'statement_method','email',1),(43,51,'receipt_method','sms',1),(44,51,'wigicode_timeout','10',1),(45,51,'international_trans','true',1),(46,51,'max_wigi_amt_txn','10',1),(47,51,'max_wigi_amt_day','10',1),(48,51,'max_gift_amt_txn','150',1),(49,51,'max_gift_amt_day','5',1),(50,51,'session_timeout','240',1),(51,72,'minimum_balance','100',1),(52,72,'statement_method','email',1),(53,72,'receipt_method','sms',1),(54,72,'wigicode_timeout','10',1),(55,72,'international_trans','true',1),(56,72,'max_wigi_amt_txn','100',1),(57,72,'max_wigi_amt_day','10',1),(58,72,'max_gift_amt_txn','100',1),(59,72,'max_gift_amt_day','5',1),(60,72,'session_timeout','300',1),(61,111,'minimum_balance','1',1),(62,111,'statement_method','email',1),(63,111,'receipt_method','sms',1),(64,111,'international_trans','true',1),(65,111,'max_wigi_amt_txn','100',1),(66,111,'max_wigi_amt_day','100',1),(67,111,'max_gift_amt_txn','100',1),(68,111,'max_gift_amt_day','100',1),(69,111,'session_timeout','300',1),(70,111,'wigi_timeout','10',1),(71,94,'minimum_balance','10',1),(72,94,'statement_method','email',1),(73,94,'receipt_method','sms',1),(74,94,'wigicode_timeout','10',1),(75,94,'international_trans','true',1),(76,94,'max_wigi_amt_txn','25',1),(77,94,'max_wigi_amt_day','10',1),(78,94,'max_gift_amt_txn','10',1),(79,94,'max_gift_amt_day','5',1),(80,94,'session_timeout','300',1);
/*!40000 ALTER TABLE `user_mobile_ext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mobile_message`
--

DROP TABLE IF EXISTS `user_mobile_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_mobile_message` (
  `user_mobile_message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(11) unsigned NOT NULL,
  `mobile_id` int(11) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_mobile_message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mobile_message`
--

LOCK TABLES `user_mobile_message` WRITE;
/*!40000 ALTER TABLE `user_mobile_message` DISABLE KEYS */;
INSERT INTO `user_mobile_message` VALUES (1,0,2,0),(2,3,2,0),(3,4,2,0),(4,5,2,0),(5,6,2,0),(6,7,1,0),(7,8,2,0),(8,9,1,0),(13,14,3,1),(10,11,1,0),(11,12,3,1),(12,13,3,1),(14,12,55,1),(15,13,55,0),(16,14,55,0),(17,12,51,1),(18,13,51,1),(19,14,51,1),(20,12,4,1);
/*!40000 ALTER TABLE `user_mobile_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_account_summary`
--

DROP TABLE IF EXISTS `view_account_summary`;
/*!50001 DROP VIEW IF EXISTS `view_account_summary`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_account_summary` (
  `user_id` int(11) unsigned,
  `mobile_id` int(11) unsigned,
  `cellphone` varchar(30),
  `balance` decimal(32,2),
  `temp_balance` decimal(32,2)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_bank_accounts`
--

DROP TABLE IF EXISTS `view_bank_accounts`;
/*!50001 DROP VIEW IF EXISTS `view_bank_accounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_bank_accounts` (
  `id` int(11) unsigned,
  `user_id` int(11) unsigned,
  `last4` char(4),
  `description` varchar(30),
  `type` varchar(1)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_confirmed_users`
--

DROP TABLE IF EXISTS `view_confirmed_users`;
/*!50001 DROP VIEW IF EXISTS `view_confirmed_users`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_confirmed_users` (
  `user_id` int(11) unsigned,
  `email` varchar(100),
  `user_type` tinyint(3) unsigned,
  `password` char(32),
  `status` tinyint(3) unsigned,
  `first_name` varchar(100),
  `last_name` varchar(100),
  `middle_init` varchar(3),
  `message_method` tinyint(3),
  `email_confirmed` tinyint(1),
  `email_confirmation_code` varchar(10),
  `cellphone_confirmed` tinyint(1),
  `lock_count` tinyint(3),
  `login_code` varchar(10),
  `login_code_expires` datetime,
  `question` varchar(255),
  `answer` varchar(255),
  `date_added` datetime,
  `user_added` varchar(60),
  `date_changed` timestamp,
  `user_changed` varchar(60),
  `tos_id` tinyint(3) unsigned,
  `tos_accepted_date` datetime,
  `merchant_id` varchar(30),
  `country_code` varchar(10)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_credit_cards`
--

DROP TABLE IF EXISTS `view_credit_cards`;
/*!50001 DROP VIEW IF EXISTS `view_credit_cards`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_credit_cards` (
  `id` int(11) unsigned,
  `user_id` int(11) unsigned,
  `last4` char(4),
  `description` varchar(30),
  `type` varchar(1)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_current_tos`
--

DROP TABLE IF EXISTS `view_current_tos`;
/*!50001 DROP VIEW IF EXISTS `view_current_tos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_current_tos` (
  `tos_id` int(11) unsigned,
  `tos` text
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_get_messages`
--

DROP TABLE IF EXISTS `view_get_messages`;
/*!50001 DROP VIEW IF EXISTS `view_get_messages`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_get_messages` (
  `message` text,
  `subject` varchar(255),
  `message_type` tinyint(3) unsigned,
  `status` int(11) unsigned,
  `mobile_id` int(11) unsigned,
  `id` int(11) unsigned
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_linked_bank_accounts`
--

DROP TABLE IF EXISTS `view_linked_bank_accounts`;
/*!50001 DROP VIEW IF EXISTS `view_linked_bank_accounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_linked_bank_accounts` (
  `last4` char(4),
  `description` varchar(30),
  `id` int(11) unsigned,
  `type` int(1),
  `mobile_id` int(11) unsigned
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_linked_credit_cards`
--

DROP TABLE IF EXISTS `view_linked_credit_cards`;
/*!50001 DROP VIEW IF EXISTS `view_linked_credit_cards`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_linked_credit_cards` (
  `last4` char(4),
  `description` varchar(30),
  `id` int(11) unsigned,
  `type` int(1),
  `mobile_id` int(11) unsigned
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_mobile_prefs`
--

DROP TABLE IF EXISTS `view_mobile_prefs`;
/*!50001 DROP VIEW IF EXISTS `view_mobile_prefs`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_mobile_prefs` (
  `user_mobile_ext_id` int(11) unsigned,
  `mobile_id` int(11) unsigned,
  `key` varchar(100),
  `val` varchar(100),
  `category` tinyint(3)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_my_documents`
--

DROP TABLE IF EXISTS `view_my_documents`;
/*!50001 DROP VIEW IF EXISTS `view_my_documents`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_my_documents` (
  `doc_info_id` int(10) unsigned,
  `mobile_id` int(10) unsigned,
  `doc_type` tinyint(3) unsigned,
  `current_version` smallint(5) unsigned,
  `expiration` datetime,
  `description` varchar(100),
  `number` varchar(100)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_unconfirmed_bank_accounts`
--

DROP TABLE IF EXISTS `view_unconfirmed_bank_accounts`;
/*!50001 DROP VIEW IF EXISTS `view_unconfirmed_bank_accounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_unconfirmed_bank_accounts` (
  `user_bank_account_id` int(11) unsigned,
  `user_id` int(11) unsigned,
  `key_version` tinyint(3) unsigned,
  `last4` char(4),
  `description` varchar(30),
  `bank_type` enum('C','S'),
  `routing` varchar(255),
  `status` tinyint(3),
  `conf_amt` decimal(10,2),
  `date_added` datetime,
  `user_added` varchar(60),
  `date_changed` timestamp,
  `user_changed` varchar(60)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_unconfirmed_credit_cards`
--

DROP TABLE IF EXISTS `view_unconfirmed_credit_cards`;
/*!50001 DROP VIEW IF EXISTS `view_unconfirmed_credit_cards`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_unconfirmed_credit_cards` (
  `user_credit_card_id` int(11) unsigned,
  `user_id` int(11) unsigned,
  `key_version` tinyint(3) unsigned,
  `last4` char(4),
  `description` varchar(30),
  `card_type` enum('VISA','MAST','AMER','DISC','DINE','JCB'),
  `expire_month` tinyint(3) unsigned,
  `expire_year` smallint(5) unsigned,
  `name_on_card` varchar(255),
  `status` tinyint(3),
  `conf_amt` decimal(10,2),
  `date_added` datetime,
  `user_added` varchar(60),
  `date_changed` timestamp,
  `user_changed` varchar(60)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_user_cellphones`
--

DROP TABLE IF EXISTS `view_user_cellphones`;
/*!50001 DROP VIEW IF EXISTS `view_user_cellphones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_user_cellphones` (
  `user_id` int(11) unsigned,
  `mobile_id` int(11) unsigned,
  `cellphone` varchar(30)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `zip_codes`
--

DROP TABLE IF EXISTS `zip_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zip_codes` (
  `zip` varchar(5) NOT NULL DEFAULT '',
  `state` char(2) NOT NULL DEFAULT '',
  `latitude` varchar(10) NOT NULL DEFAULT '',
  `longitude` varchar(10) NOT NULL DEFAULT '',
  `city` varchar(50) DEFAULT NULL,
  `full_state` varchar(50) DEFAULT NULL,
  UNIQUE KEY `zip` (`zip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zip_codes`
--

LOCK TABLES `zip_codes` WRITE;
/*!40000 ALTER TABLE `zip_codes` DISABLE KEYS */;
INSERT INTO `zip_codes` VALUES ('54004','WI',' 45.319095',' -92.13016','Clayton','Wisconsin'),('54005','WI',' 45.237727',' -92.22901','Clear Lake','Wisconsin'),('54006','WI',' 45.586187',' -92.64165','Cushing','Wisconsin'),('54007','WI',' 45.189667',' -92.37018','Deer Park','Wisconsin'),('54009','WI',' 45.351585',' -92.60246','Dresser','Wisconsin'),('54011','WI',' 44.718955',' -92.46651','Ellsworth','Wisconsin'),('54012','WI',' 45.115377',' -92.28686','Emerald','Wisconsin'),('54013','WI',' 45.064610',' -92.18504','Glenwood City','Wisconsin'),('54014','WI',' 44.626915',' -92.54800','Hager City','Wisconsin'),('54015','WI',' 44.957487',' -92.44589','Hammond','Wisconsin'),('54016','WI',' 44.978518',' -92.71996','Hudson','Wisconsin'),('54017','WI',' 45.122052',' -92.53691','New Richmond','Wisconsin'),('54020','WI',' 45.299735',' -92.64222','Osceola','Wisconsin'),('54021','WI',' 44.752662',' -92.77958','Prescott','Wisconsin'),('54022','WI',' 44.854636',' -92.61729','River Falls','Wisconsin'),('54023','WI',' 44.970887',' -92.54780','Roberts','Wisconsin'),('54024','WI',' 45.469339',' -92.62088','Saint Croix Fall','Wisconsin'),('54025','WI',' 45.142151',' -92.68190','Somerset','Wisconsin'),('54026','WI',' 45.221875',' -92.53507','Star Prairie','Wisconsin'),('54027','WI',' 44.938989',' -92.18637','Wilson','Wisconsin'),('54028','WI',' 44.944206',' -92.27961','Woodville','Wisconsin'),('54082','WI',' 45.068411',' -92.74248','Saint Joseph','Wisconsin'),('540HH','WI',' 45.060695',' -92.64882','','Wisconsin'),('54101','WI',' 44.788898',' -88.04535','Abrams','Wisconsin'),('54102','WI',' 45.503625',' -88.08108','Amberg','Wisconsin'),('54103','WI',' 45.655708',' -88.48292','Armstrong Creek','Wisconsin'),('54104','WI',' 45.428789',' -88.25278','Athelstane','Wisconsin'),('54106','WI',' 44.472424',' -88.45746','Center Valley','Wisconsin'),('54107','WI',' 44.710588',' -88.45159','Navarino','Wisconsin'),('54110','WI',' 44.179504',' -88.07449','Brillion','Wisconsin'),('54111','WI',' 44.826617',' -88.40180','Cecil','Wisconsin'),('54112','WI',' 45.054842',' -88.05470','Coleman','Wisconsin'),('54113','WI',' 44.264904',' -88.31200','Combined Locks','Wisconsin'),('54114','WI',' 45.245131',' -88.15040','Beaver','Wisconsin'),('54115','WI',' 44.420420',' -88.07896','De Pere','Wisconsin'),('54119','WI',' 45.613142',' -88.17458','Dunbar','Wisconsin'),('54120','WI',' 45.755118',' -88.43264','Fence','Wisconsin'),('54121','WI',' 45.873589',' -88.27342','Florence','Wisconsin'),('54123','WI',' 44.205239',' -88.15899','Forest Junction','Wisconsin'),('54124','WI',' 44.904959',' -88.37822','Gillett','Wisconsin'),('54125','WI',' 45.634252',' -88.33667','Goodman','Wisconsin'),('54126','WI',' 44.291766',' -88.05059','Greenleaf','Wisconsin'),('54127','WI',' 44.795823',' -88.26895','Green Valley','Wisconsin'),('54128','WI',' 44.860223',' -88.79585','Gresham','Wisconsin'),('54129','WI',' 44.131149',' -88.19443','Hilbert','Wisconsin'),('54130','WI',' 44.293197',' -88.25922','Kaukauna','Wisconsin'),('54135','WI',' 44.901909',' -88.59535','Keshena','Wisconsin'),('54136','WI',' 44.268387',' -88.33656','Kimberly','Wisconsin'),('54137','WI',' 44.760220',' -88.25467','Krakow','Wisconsin'),('54138','WI',' 45.312629',' -88.47583','Lakewood','Wisconsin'),('54139','WI',' 44.943923',' -88.06843','Stiles','Wisconsin'),('54140','WI',' 44.286637',' -88.31001','Little Chute','Wisconsin'),('54141','WI',' 44.728341',' -88.00712','Little Suamico','Wisconsin'),('54143','WI',' 45.092448',' -87.64929','Marinette','Wisconsin'),('54149','WI',' 45.204046',' -88.51121','Mountain','Wisconsin'),('54150','WI',' 44.984514',' -88.85947','Neopit','Wisconsin'),('54151','WI',' 45.732689',' -87.96996','Niagara','Wisconsin'),('54152','WI',' 44.565437',' -88.46717','Nichols','Wisconsin'),('54153','WI',' 44.886571',' -87.89935','Oconto','Wisconsin'),('54154','WI',' 44.868020',' -88.16446','Oconto Falls','Wisconsin'),('54155','WI',' 44.522840',' -88.18008','Oneida','Wisconsin'),('54156','WI',' 45.595032',' -87.95018','Pembine','Wisconsin'),('54157','WI',' 45.057605',' -87.77449','Peshtigo','Wisconsin'),('54159','WI',' 45.207353',' -87.80061','Porterfield','Wisconsin'),('54160','WI',' 44.119600',' -88.09784','Potter','Wisconsin'),('54161','WI',' 45.116325',' -88.16811','Pound','Wisconsin'),('54162','WI',' 44.657110',' -88.24208','Pulaski','Wisconsin'),('54165','WI',' 44.515230',' -88.31075','Seymour','Wisconsin'),('54166','WI',' 44.779241',' -88.60636','Shawano','Wisconsin'),('54169','WI',' 44.173538',' -88.27525','Sherwood','Wisconsin'),('54170','WI',' 44.506022',' -88.56461','Shiocton','Wisconsin'),('54171','WI',' 44.718335',' -88.10117','Sobieski','Wisconsin'),('54173','WI',' 44.640367',' -88.03732','Suamico','Wisconsin'),('54174','WI',' 45.047766',' -88.37913','Suring','Wisconsin'),('54175','WI',' 45.309420',' -88.61753','Townsend','Wisconsin'),('54177','WI',' 45.370117',' -87.87769','Wausaukee','Wisconsin'),('54180','WI',' 44.325856',' -88.16205','Wrightstown','Wisconsin'),('541HH','WI',' 44.853474',' -88.09447','','Wisconsin'),('541XX','WI',' 45.049738',' -88.76507','','Wisconsin'),('54201','WI',' 44.613604',' -87.46502','Algoma','Wisconsin'),('54202','WI',' 45.059668',' -87.13196','Baileys Harbor','Wisconsin'),('54204','WI',' 44.753401',' -87.64628','Brussels','Wisconsin'),('54205','WI',' 44.589060',' -87.62271','Casco','Wisconsin'),('54207','WI',' 44.086144',' -87.98331','Collins','Wisconsin'),('54208','WI',' 44.358527',' -87.79747','Denmark','Wisconsin'),('54209','WI',' 45.027668',' -87.28234','Egg Harbor','Wisconsin'),('54210','WI',' 45.271782',' -87.04561','Ellison Bay','Wisconsin'),('54211','WI',' 45.158078',' -87.16796','Ephraim','Wisconsin'),('54212','WI',' 45.146473',' -87.24154','Fish Creek','Wisconsin'),('54213','WI',' 44.693392',' -87.51197','Forestville','Wisconsin'),('54214','WI',' 44.200758',' -87.71974','Francis Creek','Wisconsin'),('54215','WI',' 44.224851',' -87.79943','Kellnersville','Wisconsin'),('54216','WI',' 44.456022',' -87.54429','Kewaunee','Wisconsin'),('54217','WI',' 44.556810',' -87.71413','Luxemburg','Wisconsin'),('54220','WI',' 44.096194',' -87.68919','Manitowoc','Wisconsin'),('54227','WI',' 44.278090',' -87.79026','Maribel','Wisconsin'),('54228','WI',' 44.257289',' -87.64866','Mishicot','Wisconsin'),('54229','WI',' 44.559995',' -87.81553','New Franken','Wisconsin'),('54230','WI',' 44.142939',' -87.91310','Reedsville','Wisconsin'),('54232','WI',' 44.008575',' -87.92456','Saint Nazianz','Wisconsin'),('54234','WI',' 45.186528',' -87.11618','Sister Bay','Wisconsin'),('54235','WI',' 44.844133',' -87.38044','Sturgeon Bay','Wisconsin'),('54240','WI',' 44.326784',' -87.62239','Tisch Mills','Wisconsin'),('54241','WI',' 44.174245',' -87.58613','Two Rivers','Wisconsin'),('54245','WI',' 44.037618',' -87.90026','Valders','Wisconsin'),('54246','WI',' 45.365984',' -86.89946','Washington Islan','Wisconsin'),('54247','WI',' 44.190110',' -87.79109','Whitelaw','Wisconsin'),('542HH','WI',' 44.546498',' -87.46556','','Wisconsin'),('54301','WI',' 44.489059',' -88.01674','Allouez','Wisconsin'),('54302','WI',' 44.505782',' -87.97947','Green Bay','Wisconsin'),('54303','WI',' 44.530892',' -88.04482','Howard','Wisconsin'),('54304','WI',' 44.499346',' -88.06318','Ashwaubenon','Wisconsin'),('54311','WI',' 44.485243',' -87.92232','Green Bay','Wisconsin'),('54313','WI',' 44.564261',' -88.10326','Green Bay','Wisconsin'),('543HH','WI',' 44.518242',' -88.00693','','Wisconsin'),('54401','WI',' 44.958382',' -89.66930','Wausau','Wisconsin'),('54403','WI',' 44.976118',' -89.59209','Wausau','Wisconsin'),('54405','WI',' 44.950905',' -90.30486','Abbotsford','Wisconsin'),('54406','WI',' 44.421111',' -89.30618','Amherst','Wisconsin'),('54407','WI',' 44.513056',' -89.30422','Amherst Junction','Wisconsin'),('54408','WI',' 45.033240',' -89.28376','Aniwa','Wisconsin'),('54409','WI',' 45.121666',' -89.13388','Antigo','Wisconsin'),('54410','WI',' 44.536298',' -90.04317','Arpin','Wisconsin'),('54411','WI',' 45.040345',' -90.01829','Hamburg','Wisconsin'),('54412','WI',' 44.662975',' -89.99430','Auburndale','Wisconsin'),('54413','WI',' 44.283542',' -90.12791','Babcock','Wisconsin'),('54414','WI',' 44.952580',' -89.16252','Birnamwood','Wisconsin'),('54416','WI',' 44.879391',' -88.95511','Bowler','Wisconsin'),('54417','WI',' 45.025111',' -89.64609','Brokaw','Wisconsin'),('54418','WI',' 45.221567',' -88.96427','Bryant','Wisconsin'),('54420','WI',' 44.619487',' -90.36605','Chili','Wisconsin'),('54421','WI',' 44.903000',' -90.30657','Colby','Wisconsin'),('54422','WI',' 44.984128',' -90.44176','Curtiss','Wisconsin'),('54423','WI',' 44.585504',' -89.42139','Custer','Wisconsin'),('54424','WI',' 45.281420',' -89.20118','Deerbrook','Wisconsin'),('54425','WI',' 45.006072',' -90.33146','Dorchester','Wisconsin'),('54426','WI',' 44.907131',' -89.97770','Fenwood','Wisconsin'),('54427','WI',' 44.834167',' -89.23917','Eland','Wisconsin'),('54428','WI',' 45.440199',' -89.13837','Elcho','Wisconsin'),('54430','WI',' 45.138072',' -88.88498','Elton','Wisconsin'),('54433','WI',' 45.186932',' -90.81846','Gilman','Wisconsin'),('54435','WI',' 45.372921',' -89.43748','Gleason','Wisconsin'),('54436','WI',' 44.557846',' -90.44622','Granton','Wisconsin'),('54437','WI',' 44.775105',' -90.62639','Greenwood','Wisconsin'),('54440','WI',' 44.830734',' -89.37414','Hatley','Wisconsin'),('54441','WI',' 44.645158',' -90.10523','Hewitt','Wisconsin'),('54442','WI',' 45.345991',' -89.67087','Irma','Wisconsin'),('54443','WI',' 44.612879',' -89.74163','Junction City','Wisconsin'),('54446','WI',' 44.758265',' -90.48248','Loyal','Wisconsin'),('54447','WI',' 45.077541',' -90.73240','Lublin','Wisconsin'),('54448','WI',' 44.935076',' -89.83699','Marathon','Wisconsin'),('54449','WI',' 44.656686',' -90.18152','Marshfield','Wisconsin'),('54451','WI',' 45.171131',' -90.40527','Medford','Wisconsin'),('54452','WI',' 45.181311',' -89.70469','Merrill','Wisconsin'),('54454','WI',' 44.620203',' -89.87223','Milladore','Wisconsin'),('54455','WI',' 44.787003',' -89.69066','Mosinee','Wisconsin'),('54456','WI',' 44.553719',' -90.61457','Neillsville','Wisconsin'),('54457','WI',' 44.260056',' -89.88239','Nekoosa','Wisconsin'),('54459','WI',' 45.434426',' -90.26806','Ogema','Wisconsin'),('54460','WI',' 44.945107',' -90.53973','Owen','Wisconsin'),('54462','WI',' 45.392118',' -89.00510','Pearson','Wisconsin'),('54463','WI',' 45.516138',' -89.17824','Pelican Lake','Wisconsin'),('54465','WI',' 45.393536',' -88.88706','Pickerel','Wisconsin'),('54466','WI',' 44.404914',' -90.24246','Pittsville','Wisconsin'),('54467','WI',' 44.452277',' -89.54399','Plover','Wisconsin'),('54469','WI',' 44.348816',' -89.86368','Port Edwards','Wisconsin'),('54470','WI',' 45.297753',' -90.16658','Rib Lake','Wisconsin'),('54471','WI',' 44.918707',' -89.44139','Ringle','Wisconsin'),('54473','WI',' 44.641554',' -89.33596','Rosholt','Wisconsin'),('54474','WI',' 44.885168',' -89.61922','Rothschild','Wisconsin'),('54475','WI',' 44.484001',' -89.79403','Rudolph','Wisconsin'),('54476','WI',' 44.903194',' -89.57937','Schofield','Wisconsin'),('54479','WI',' 44.764411',' -90.33179','Spencer','Wisconsin'),('54480','WI',' 45.064903',' -90.29794','Stetsonville','Wisconsin'),('54481','WI',' 44.524054',' -89.55621','Stevens Point','Wisconsin'),('54484','WI',' 44.793747',' -90.06026','Stratford','Wisconsin'),('54485','WI',' 45.381803',' -89.20073','Summit Lake','Wisconsin'),('54486','WI',' 44.734445',' -89.04525','Tigerton','Wisconsin'),('54487','WI',' 45.510639',' -89.73162','Tomahawk','Wisconsin'),('54488','WI',' 44.844939',' -90.32891','Unity','Wisconsin'),('54489','WI',' 44.456798',' -89.99623','Vesper','Wisconsin'),('54490','WI',' 45.321034',' -90.40218','Westboro','Wisconsin'),('54491','WI',' 45.211554',' -88.74259','White Lake','Wisconsin'),('54493','WI',' 44.729524',' -90.79351','Willard','Wisconsin'),('54494','WI',' 44.373468',' -89.78761','Wisconsin Rapids','Wisconsin'),('54495','WI',' 44.376507',' -89.90771','Wisconsin Rapids','Wisconsin'),('54498','WI',' 45.034443',' -90.63063','Withee','Wisconsin'),('54499','WI',' 44.797279',' -89.18442','Wittenberg','Wisconsin'),('544HH','WI',' 44.832584',' -89.68362','','Wisconsin'),('544XX','WI',' 44.356703',' -90.15921','','Wisconsin'),('54501','WI',' 45.646720',' -89.39408','Monico','Wisconsin'),('54511','WI',' 45.696060',' -88.81274','Cavour','Wisconsin'),('54512','WI',' 46.083178',' -89.66605','Boulder Junction','Wisconsin'),('54513','WI',' 45.546080',' -90.13535','Brantwood','Wisconsin'),('54514','WI',' 46.024995',' -90.44778','Butternut','Wisconsin'),('54515','WI',' 45.536545',' -90.50935','Catawba','Wisconsin'),('54517','WI',' 46.136639',' -90.93065','Clam Lake','Wisconsin'),('54519','WI',' 46.040996',' -89.28591','Conover','Wisconsin'),('54520','WI',' 45.522208',' -88.91050','Crandon','Wisconsin'),('54521','WI',' 45.922669',' -89.24825','Eagle River','Wisconsin'),('54524','WI',' 45.852630',' -90.41709','Fifield','Wisconsin'),('54525','WI',' 46.429932',' -90.22247','Gile','Wisconsin'),('54526','WI',' 45.500701',' -90.85944','Ingram','Wisconsin'),('54527','WI',' 46.119661',' -90.64288','Glidden','Wisconsin'),('54529','WI',' 45.707456',' -89.68877','Harshaw','Wisconsin'),('54530','WI',' 45.549336',' -90.73047','Hawkins','Wisconsin'),('54531','WI',' 45.754415',' -89.79791','Hazelhurst','Wisconsin'),('54534','WI',' 46.405530',' -90.21811','Hurley','Wisconsin'),('54536','WI',' 46.346699',' -90.33543','Iron Belt','Wisconsin'),('54537','WI',' 45.527003',' -90.61228','Kennan','Wisconsin'),('54538','WI',' 45.964667',' -89.90731','Lac Du Flambeau','Wisconsin'),('54539','WI',' 45.811923',' -89.57988','Lake Tomahawk','Wisconsin'),('54540','WI',' 46.149936',' -89.36592','Land O Lakes','Wisconsin'),('54541','WI',' 45.553750',' -88.66240','Laona','Wisconsin'),('54542','WI',' 45.920035',' -88.68929','Alvin','Wisconsin'),('54543','WI',' 45.731478',' -89.52525','Mc Naughton','Wisconsin'),('54545','WI',' 46.122746',' -89.83996','Manitowish Water','Wisconsin'),('54546','WI',' 46.273618',' -90.70102','Mellen','Wisconsin'),('54547','WI',' 46.183572',' -90.05754','Mercer','Wisconsin'),('54548','WI',' 45.869921',' -89.79346','Minocqua','Wisconsin'),('54550','WI',' 46.410758',' -90.25072','Pence','Wisconsin'),('54552','WI',' 45.927783',' -90.34311','Park Falls','Wisconsin'),('54554','WI',' 46.056677',' -89.08234','Phelps','Wisconsin'),('54555','WI',' 45.716124',' -90.40013','Phillips','Wisconsin'),('54556','WI',' 45.549425',' -90.31571','Prentice','Wisconsin'),('54557','WI',' 46.221041',' -89.73707','Winchester','Wisconsin'),('54558','WI',' 45.914371',' -89.48970','Saint Germain','Wisconsin'),('54559','WI',' 46.495575',' -90.45101','Saxon','Wisconsin'),('54560','WI',' 45.995755',' -89.52565','Sayner','Wisconsin'),('54561','WI',' 46.058408',' -89.45160','Star Lake','Wisconsin'),('54562','WI',' 45.815926',' -89.10942','Three Lakes','Wisconsin'),('54563','WI',' 45.477056',' -90.98354','Tony','Wisconsin'),('54564','WI',' 45.632980',' -89.96658','Tripoli','Wisconsin'),('54565','WI',' 46.309371',' -90.43540','Upson','Wisconsin'),('54566','WI',' 45.432682',' -88.67339','Wabeno','Wisconsin'),('54568','WI',' 45.924341',' -89.68496','Woodruff','Wisconsin'),('545HH','WI',' 45.908298',' -89.85489','','Wisconsin'),('545XX','WI',' 45.657551',' -89.12737','','Wisconsin'),('54601','WI',' 43.797116',' -91.21141','La Crosse','Wisconsin'),('54603','WI',' 43.848665',' -91.24922','La Crosse','Wisconsin'),('54610','WI',' 44.362741',' -91.85287','Alma','Wisconsin'),('54611','WI',' 44.442020',' -90.93859','Alma Center','Wisconsin'),('54612','WI',' 44.253423',' -91.48885','Arcadia','Wisconsin'),('54613','WI',' 44.061018',' -89.90838','Arkdale','Wisconsin'),('54614','WI',' 43.894741',' -90.97441','Bangor','Wisconsin'),('54615','WI',' 44.277231',' -90.80066','Black River Fall','Wisconsin'),('54616','WI',' 44.293183',' -91.23075','Blair','Wisconsin'),('54618','WI',' 43.956850',' -90.29445','Cutler','Wisconsin'),('54619','WI',' 43.749142',' -90.78473','Cashton','Wisconsin'),('54621','WI',' 43.659389',' -91.08195','Chaseburg','Wisconsin'),('54622','WI',' 44.248179',' -91.83124','Waumandee','Wisconsin'),('54623','WI',' 43.713575',' -91.02348','Coon Valley','Wisconsin'),('54624','WI',' 43.433893',' -91.15949','Victory','Wisconsin'),('54625','WI',' 44.130528',' -91.52601','Dodge','Wisconsin'),('54626','WI',' 43.217285',' -91.05946','Eastman','Wisconsin'),('54627','WI',' 44.168986',' -91.25737','Ettrick','Wisconsin'),('54628','WI',' 43.373139',' -91.00250','Ferryville','Wisconsin'),('54629','WI',' 44.132880',' -91.67722','Fountain City','Wisconsin'),('54630','WI',' 44.087366',' -91.35965','Galesville','Wisconsin'),('54631','WI',' 43.291992',' -90.83048','Gays Mills','Wisconsin'),('54632','WI',' 43.559832',' -91.16957','Genoa','Wisconsin'),('54634','WI',' 43.610055',' -90.40896','Yuba','Wisconsin'),('54635','WI',' 44.400995',' -91.04608','Northfield','Wisconsin'),('54636','WI',' 43.978816',' -91.25120','Holmen','Wisconsin'),('54637','WI',' 43.880649',' -90.27423','Hustler','Wisconsin'),('54638','WI',' 43.795422',' -90.37609','Kendall','Wisconsin'),('54639','WI',' 43.610629',' -90.62108','West Lima','Wisconsin'),('54640','WI',' 43.246161',' -91.05429','Lynxville','Wisconsin'),('54642','WI',' 44.151750',' -91.04558','Melrose','Wisconsin'),('54644','WI',' 44.029269',' -91.06484','Mindoro','Wisconsin'),('54645','WI',' 43.314930',' -90.92870','Mount Sterling','Wisconsin'),('54646','WI',' 44.057528',' -90.07117','Necedah','Wisconsin'),('54648','WI',' 43.836783',' -90.62066','Norwalk','Wisconsin'),('54650','WI',' 43.899664',' -91.22963','Onalaska','Wisconsin'),('54651','WI',' 43.740893',' -90.56934','Ontario','Wisconsin'),('54652','WI',' 43.454264',' -90.76116','Readstown','Wisconsin'),('54653','WI',' 43.869244',' -90.91873','Rockland','Wisconsin'),('54654','WI',' 43.265154',' -90.95900','Seneca','Wisconsin'),('54655','WI',' 43.388055',' -90.76632','Soldiers Grove','Wisconsin'),('54656','WI',' 43.969770',' -90.80796','Sparta','Wisconsin'),('54657','WI',' 43.194284',' -90.89110','Steuben','Wisconsin'),('54658','WI',' 43.688040',' -91.19665','Stoddard','Wisconsin'),('54659','WI',' 44.309131',' -91.11676','Taylor','Wisconsin'),('54660','WI',' 43.984412',' -90.48416','Wyeville','Wisconsin'),('54661','WI',' 44.026843',' -91.45130','Trempealeau','Wisconsin'),('54664','WI',' 43.502238',' -90.65131','Viola','Wisconsin'),('54665','WI',' 43.543934',' -90.89904','Viroqua','Wisconsin'),('54666','WI',' 44.134587',' -90.43289','Warrens','Wisconsin'),('54667','WI',' 43.656393',' -90.85562','Westby','Wisconsin'),('54669','WI',' 43.903949',' -91.08847','West Salem','Wisconsin'),('54670','WI',' 43.833159',' -90.49044','Wilton','Wisconsin'),('546HH','WI',' 43.880831',' -91.23895','','Wisconsin'),('546XX','WI',' 44.199760',' -90.31286','','Wisconsin'),('54701','WI',' 44.780427',' -91.48065','Eau Claire','Wisconsin'),('54703','WI',' 44.829610',' -91.50521','Eau Claire','Wisconsin'),('54720','WI',' 44.804160',' -91.43963','Altoona','Wisconsin'),('54721','WI',' 44.624110',' -92.07828','Arkansaw','Wisconsin'),('54722','WI',' 44.699923',' -91.12509','Augusta','Wisconsin'),('54723','WI',' 44.608838',' -92.44607','Bay City','Wisconsin'),('54724','WI',' 45.101683',' -91.48415','Bloomer','Wisconsin'),('54725','WI',' 45.062111',' -92.02641','Boyceville','Wisconsin'),('54726','WI',' 44.946486',' -91.02282','Boyd','Wisconsin'),('54727','WI',' 44.963809',' -91.16181','Cadott','Wisconsin'),('54728','WI',' 45.312195',' -91.64173','Chetek','Wisconsin'),('54729','WI',' 44.932711',' -91.38877','Chippewa Falls','Wisconsin'),('54730','WI',' 45.012181',' -91.73021','Colfax','Wisconsin'),('54731','WI',' 45.364690',' -91.04968','Conrath','Wisconsin'),('54732','WI',' 45.155211',' -91.17005','Cornell','Wisconsin'),('54733','WI',' 45.275752',' -91.85084','Dallas','Wisconsin'),('54734','WI',' 45.086186',' -92.12453','Downing','Wisconsin'),('54736','WI',' 44.613891',' -91.92402','Durand','Wisconsin'),('54737','WI',' 44.718959',' -91.99704','Eau Galle','Wisconsin'),('54738','WI',' 44.586469',' -91.48873','Eleva','Wisconsin'),('54739','WI',' 44.872678',' -91.69231','Elk Mound','Wisconsin'),('54740','WI',' 44.763269',' -92.15170','Elmwood','Wisconsin'),('54741','WI',' 44.601345',' -90.98854','Fairchild','Wisconsin'),('54742','WI',' 44.763678',' -91.29172','Fall Creek','Wisconsin'),('54745','WI',' 45.253108',' -91.15590','Holcombe','Wisconsin'),('54746','WI',' 44.550251',' -90.89542','Humbird','Wisconsin'),('54747','WI',' 44.381610',' -91.47913','Independence','Wisconsin'),('54748','WI',' 45.074725',' -91.25630','Jim Falls','Wisconsin'),('54749','WI',' 44.949207',' -92.08073','Knapp','Wisconsin'),('54750','WI',' 44.615442',' -92.30798','Maiden Rock','Wisconsin'),('54751','WI',' 44.868770',' -91.92915','Menomonie','Wisconsin'),('54754','WI',' 44.434537',' -90.79473','Merrillan','Wisconsin'),('54755','WI',' 44.584633',' -91.68767','Modena','Wisconsin'),('54756','WI',' 44.451724',' -91.95785','Nelson','Wisconsin'),('54757','WI',' 45.235611',' -91.52127','New Auburn','Wisconsin'),('54758','WI',' 44.555876',' -91.21713','Osseo','Wisconsin'),('54759','WI',' 44.478326',' -92.14053','Pepin','Wisconsin'),('54760','WI',' 44.424662',' -91.20833','Pigeon Falls','Wisconsin'),('54761','WI',' 44.624559',' -92.17732','Plum City','Wisconsin'),('54762','WI',' 45.246470',' -91.99273','Prairie Farm','Wisconsin'),('54763','WI',' 45.186997',' -91.88073','Ridgeland','Wisconsin'),('54766','WI',' 45.323865',' -90.89376','Sheldon','Wisconsin'),('54767','WI',' 44.833746',' -92.25937','Spring Valley','Wisconsin'),('54768','WI',' 44.963528',' -90.93012','Stanley','Wisconsin'),('54769','WI',' 44.530201',' -92.23721','Stockholm','Wisconsin'),('54770','WI',' 44.545046',' -91.38753','Strum','Wisconsin'),('54771','WI',' 44.952980',' -90.79784','Thorp','Wisconsin'),('54772','WI',' 45.084813',' -91.89724','Wheeler','Wisconsin'),('54773','WI',' 44.377781',' -91.30948','Whitehall','Wisconsin'),('547HH','WI',' 44.917300',' -91.45521','','Wisconsin'),('547XX','WI',' 44.400531',' -90.63452','','Wisconsin'),('54801','WI',' 45.850775',' -91.94361','Spooner','Wisconsin'),('54805','WI',' 45.418325',' -92.02914','Almena','Wisconsin'),('54806','WI',' 46.577191',' -90.89707','Moquah','Wisconsin'),('54810','WI',' 45.455304',' -92.40153','Balsam Lake','Wisconsin'),('54812','WI',' 45.397010',' -91.86337','Barron','Wisconsin'),('54813','WI',' 45.646145',' -92.01923','Barronett','Wisconsin'),('54814','WI',' 46.856701',' -90.85401','Bayfield','Wisconsin'),('54817','WI',' 45.661506',' -91.54526','Birchwood','Wisconsin'),('54819','WI',' 45.452730',' -91.29437','Bruce','Wisconsin'),('54820','WI',' 46.588243',' -91.55208','Brule','Wisconsin'),('54821','WI',' 46.213138',' -91.13997','Cable','Wisconsin'),('54822','WI',' 45.401622',' -91.72727','Cameron','Wisconsin'),('54824','WI',' 45.454867',' -92.52701','Centuria','Wisconsin'),('54826','WI',' 45.505963',' -92.17646','Comstock','Wisconsin'),('54827','WI',' 46.802909',' -91.10944','Cornucopia','Wisconsin'),('54828','WI',' 45.858431',' -91.25765','New Post','Wisconsin'),('54829','WI',' 45.552434',' -92.05004','Cumberland','Wisconsin'),('54830','WI',' 46.036193',' -92.21802','Dairyland','Wisconsin'),('54832','WI',' 46.326236',' -91.29643','Drummond','Wisconsin'),('54834','WI',' 45.742668',' -91.47648','Edgewater','Wisconsin'),('54835','WI',' 45.671767',' -91.23317','Exeland','Wisconsin'),('54836','WI',' 46.449996',' -92.21831','Foxboro','Wisconsin'),('54837','WI',' 45.679878',' -92.42153','Clam Falls','Wisconsin'),('54838','WI',' 46.233591',' -91.81795','Gordon','Wisconsin'),('54839','WI',' 46.360155',' -91.14425','Grand View','Wisconsin'),('54840','WI',' 45.751180',' -92.67182','Evergreen','Wisconsin'),('54841','WI',' 45.612444',' -91.77624','Haugen','Wisconsin'),('54842','WI',' 46.513247',' -91.84824','Hawthorne','Wisconsin'),('54843','WI',' 46.005082',' -91.35255','North Woods Beac','Wisconsin'),('54844','WI',' 46.765166',' -91.21312','Herbster','Wisconsin'),('54845','WI',' 45.811685',' -92.13692','Hertel','Wisconsin'),('54846','WI',' 46.372151',' -90.74865','High Bridge','Wisconsin'),('54847','WI',' 46.553351',' -91.37996','Iron River','Wisconsin'),('54848','WI',' 45.477445',' -91.10500','Ladysmith','Wisconsin'),('54849','WI',' 46.476428',' -91.67634','Lake Nebagamon','Wisconsin'),('54850','WI',' 46.799835',' -90.73209','La Pointe','Wisconsin'),('54853','WI',' 45.577963',' -92.45652','Luck','Wisconsin'),('54854','WI',' 46.626518',' -91.69520','Maple','Wisconsin'),('54855','WI',' 46.396053',' -90.81506','Marengo','Wisconsin'),('54856','WI',' 46.433167',' -91.10883','Delta','Wisconsin'),('54857','WI',' 45.591546',' -91.60046','Mikana','Wisconsin'),('54858','WI',' 45.526240',' -92.46971','Milltown','Wisconsin'),('54859','WI',' 46.127976',' -91.84389','Minong','Wisconsin'),('54861','WI',' 46.599122',' -90.65361','Odanah','Wisconsin'),('54862','WI',' 45.766112',' -91.13603','Ojibwa','Wisconsin'),('54864','WI',' 46.587809',' -91.80740','Poplar','Wisconsin'),('54865','WI',' 46.757192',' -91.39611','Port Wing','Wisconsin'),('54867','WI',' 45.767489',' -91.22193','Radisson','Wisconsin'),('54868','WI',' 45.517226',' -91.72638','Canton','Wisconsin'),('54870','WI',' 45.714265',' -91.77498','Sarona','Wisconsin'),('54871','WI',' 45.750367',' -91.99048','Shell Lake','Wisconsin'),('54872','WI',' 45.780793',' -92.39152','Siren','Wisconsin'),('54873','WI',' 46.354613',' -91.71166','Barnes','Wisconsin'),('54874','WI',' 46.585210',' -91.95129','Wentworth','Wisconsin'),('54875','WI',' 45.947509',' -91.67526','Earl','Wisconsin'),('54876','WI',' 45.842713',' -91.47902','Stone Lake','Wisconsin'),('54880','WI',' 46.684273',' -92.09474','Superior','Wisconsin'),('54888','WI',' 45.967422',' -91.87907','Trego','Wisconsin'),('54889','WI',' 45.407855',' -92.15619','Turtle Lake','Wisconsin'),('54891','WI',' 46.692970',' -90.93744','Washburn','Wisconsin'),('54893','WI',' 45.870441',' -92.29416','Webster','Wisconsin'),('54895','WI',' 45.422669',' -91.42678','Weyerhaeuser','Wisconsin'),('54896','WI',' 45.843581',' -90.94323','Loretta','Wisconsin'),('548HH','WI',' 46.037964',' -91.59830','','Wisconsin'),('548XX','WI',' 46.502602',' -91.55294','','Wisconsin'),('54901','WI',' 44.043984',' -88.53528','Oshkosh','Wisconsin'),('54902','WI',' 43.988616',' -88.54699','Oshkosh','Wisconsin'),('54904','WI',' 44.018871',' -88.61324','Oshkosh','Wisconsin'),('54909','WI',' 44.280180',' -89.36002','Almond','Wisconsin'),('54911','WI',' 44.276986',' -88.39445','Appleton','Wisconsin'),('54913','WI',' 44.322836',' -88.40492','Appleton','Wisconsin'),('54914','WI',' 44.267411',' -88.43830','Appleton','Wisconsin'),('54915','WI',' 44.244753',' -88.37783','Appleton','Wisconsin'),('54921','WI',' 44.307561',' -89.54673','Bancroft','Wisconsin'),('54922','WI',' 44.538848',' -88.74381','Bear Creek','Wisconsin'),('54923','WI',' 43.978561',' -88.95413','Berlin','Wisconsin'),('54927','WI',' 44.101044',' -88.65531','Butte Des Morts','Wisconsin'),('54928','WI',' 44.732083',' -88.88507','Caroline','Wisconsin'),('54929','WI',' 44.636050',' -88.74673','Clintonville','Wisconsin'),('54930','WI',' 44.025668',' -89.52124','Coloma','Wisconsin'),('54932','WI',' 43.830749',' -88.62580','Eldorado','Wisconsin'),('54933','WI',' 44.666988',' -88.70686','Embarrass','Wisconsin'),('54934','WI',' 44.004430',' -88.84108','Eureka','Wisconsin'),('54935','WI',' 43.769889',' -88.42810','Taycheedah','Wisconsin'),('54937','WI',' 43.785391',' -88.48704','North Fond Du La','Wisconsin'),('54940','WI',' 44.237843',' -88.84998','Fremont','Wisconsin'),('54941','WI',' 43.841808',' -88.97443','Green Lake','Wisconsin'),('54942','WI',' 44.293820',' -88.53557','Greenville','Wisconsin'),('54943','WI',' 44.122177',' -89.57305','Hancock','Wisconsin'),('54944','WI',' 44.333183',' -88.61670','Hortonville','Wisconsin'),('54945','WI',' 44.558941',' -89.13383','Iola','Wisconsin'),('54947','WI',' 44.191271',' -88.68846','Larsen','Wisconsin'),('54948','WI',' 44.779838',' -88.87123','Leopolis','Wisconsin'),('54949','WI',' 44.472791',' -88.91625','Manawa','Wisconsin'),('54950','WI',' 44.669461',' -88.89693','Marion','Wisconsin'),('54952','WI',' 44.212448',' -88.40959','Menasha','Wisconsin'),('54956','WI',' 44.180085',' -88.48273','Neenah','Wisconsin'),('54960','WI',' 43.959371',' -89.22575','Neshkoro','Wisconsin'),('54961','WI',' 44.394143',' -88.75521','New London','Wisconsin'),('54962','WI',' 44.481372',' -89.03101','Ogdensburg','Wisconsin'),('54963','WI',' 44.042594',' -88.76270','Omro','Wisconsin'),('54964','WI',' 43.923141',' -88.72654','Pickett','Wisconsin'),('54965','WI',' 44.167646',' -89.04218','Pine River','Wisconsin'),('54966','WI',' 44.220945',' -89.51227','Plainfield','Wisconsin'),('54967','WI',' 44.137770',' -88.99443','Poy Sippi','Wisconsin'),('54968','WI',' 43.842646',' -89.13955','Princeton','Wisconsin'),('54970','WI',' 44.057375',' -89.09788','Redgranite','Wisconsin'),('54971','WI',' 43.849309',' -88.84494','Ripon','Wisconsin'),('54974','WI',' 43.797693',' -88.66261','Rosendale','Wisconsin'),('54976','WI',' 44.176716',' -89.11271','Saxeville','Wisconsin'),('54977','WI',' 44.454684',' -89.15371','Scandinavia','Wisconsin'),('54978','WI',' 44.805167',' -88.90060','Tilleda','Wisconsin'),('54979','WI',' 43.877109',' -88.52573','Van Dyne','Wisconsin'),('54980','WI',' 43.987186',' -88.77247','Waukau','Wisconsin'),('54981','WI',' 44.331217',' -89.11499','Waupaca','Wisconsin'),('54982','WI',' 44.064068',' -89.29417','Wautoma','Wisconsin'),('54983','WI',' 44.319005',' -88.94040','Weyauwega','Wisconsin'),('54984','WI',' 44.186455',' -89.20231','Wild Rose','Wisconsin'),('54985','WI',' 44.075084',' -88.51758','Winnebago','Wisconsin'),('54986','WI',' 44.110806',' -88.73155','Winneconne','Wisconsin'),('549HH','WI',' 44.082140',' -88.62501','','Wisconsin'),('82001','WY',' 41.141281','-104.80208','Cheyenne','Wyoming'),('82007','WY',' 41.101731','-104.80582','Cheyenne','Wyoming'),('82009','WY',' 41.275932','-104.88279','Cheyenne','Wyoming'),('82050','WY',' 41.425769','-104.18805','Albin','Wyoming'),('82051','WY',' 41.601379','-105.65207','Laramie','Wyoming'),('82052','WY',' 41.105595','-105.35490','Buford','Wyoming'),('82053','WY',' 41.209041','-104.35907','Burns','Wyoming'),('82054','WY',' 41.064212','-104.34107','Carpenter','Wyoming'),('82055','WY',' 41.331440','-106.17649','Centennial','Wyoming'),('82058','WY',' 42.227720','-105.66184','Garrett','Wyoming'),('82059','WY',' 41.051097','-105.19216','Granite Canon','Wyoming'),('82060','WY',' 41.210012','-104.48095','Hillsdale','Wyoming'),('82061','WY',' 41.422733','-105.19881','Horse Creek','Wyoming'),('82070','WY',' 41.232815','-105.75364','Laramie','Wyoming'),('82072','WY',' 41.344843','-105.58626','Laramie','Wyoming'),('82081','WY',' 41.552531','-104.39118','Meriden','Wyoming'),('82083','WY',' 41.724691','-105.99071','Rock River','Wyoming'),('82084','WY',' 41.024827','-105.46188','Tie Siding','Wyoming'),('82190','WY',' 44.890668','-110.89421','Fishing Bridge','Wyoming'),('82201','WY',' 42.038694','-105.05069','Wheatland','Wyoming'),('82210','WY',' 41.742212','-104.82923','Chugwater','Wyoming'),('82212','WY',' 42.321548','-104.53453','Fort Laramie','Wyoming'),('82213','WY',' 42.489239','-104.97591','Glendo','Wyoming'),('82214','WY',' 42.277740','-104.76034','Guernsey','Wyoming'),('82215','WY',' 42.382338','-104.71135','Hartville','Wyoming'),('82217','WY',' 41.769160','-104.24488','Hawk Springs','Wyoming'),('82218','WY',' 41.865935','-104.11451','Huntley','Wyoming'),('82219','WY',' 42.507335','-104.42420','Jay Em','Wyoming'),('82221','WY',' 41.646277','-104.28770','Lagrange','Wyoming'),('82222','WY',' 43.149226','-104.61635','Lance Creek','Wyoming'),('82223','WY',' 42.121155','-104.37708','Lingle','Wyoming'),('82224','WY',' 42.792664','-104.94156','Lost Springs','Wyoming'),('82225','WY',' 43.034269','-104.35784','Lusk','Wyoming'),('82227','WY',' 42.785056','-104.75034','Manville','Wyoming'),('82240','WY',' 42.119328','-104.19228','Torrington','Wyoming'),('82242','WY',' 42.706475','-104.12045','Van Tassell','Wyoming'),('82243','WY',' 41.979994','-104.38969','Veteran','Wyoming'),('82244','WY',' 41.907756','-104.37210','Yoder','Wyoming'),('822HH','WY',' 42.346724','-104.89475','','Wyoming'),('82301','WY',' 41.971581','-107.29475','Rawlins','Wyoming'),('82310','WY',' 42.444748','-107.76460','Jeffrey City','Wyoming'),('82321','WY',' 41.347337','-107.71062','Baggs','Wyoming'),('82322','WY',' 42.180259','-107.73911','Bairoil','Wyoming'),('82323','WY',' 41.034747','-107.53257','Dixon','Wyoming'),('82324','WY',' 41.620507','-106.43594','Elk Mountain','Wyoming'),('82325','WY',' 41.159654','-106.66284','Encampment','Wyoming'),('82327','WY',' 42.041677','-106.60352','Hanna','Wyoming'),('82329','WY',' 42.196315','-106.32113','Medicine Bow','Wyoming'),('82331','WY',' 41.475612','-106.75888','Ryan Park','Wyoming'),('82332','WY',' 41.330666','-107.23106','Savery','Wyoming'),('82335','WY',' 41.804594','-106.78063','Walcott','Wyoming'),('82336','WY',' 41.765078','-108.16076','Wamsutter','Wyoming'),('823HH','WY',' 41.914101','-106.89601','','Wyoming'),('82401','WY',' 43.993124','-107.97365','Worland','Wyoming'),('82410','WY',' 44.369517','-108.04905','Basin','Wyoming'),('82411','WY',' 44.436009','-108.44195','Burlington','Wyoming'),('82412','WY',' 44.794477','-108.53415','Byron','Wyoming'),('82414','WY',' 44.566114','-109.20826','Cody','Wyoming'),('82420','WY',' 44.929728','-108.45634','Cowley','Wyoming'),('82421','WY',' 44.909434','-108.58917','Deaver','Wyoming'),('82422','WY',' 44.498455','-108.38090','Emblem','Wyoming'),('82423','WY',' 44.979667','-108.64076','Frannie','Wyoming'),('82426','WY',' 44.500759','-108.03102','Greybull','Wyoming'),('82428','WY',' 44.255087','-107.63702','Hyattville','Wyoming'),('82430','WY',' 43.808024','-108.18385','Kirby','Wyoming'),('82431','WY',' 44.791974','-108.32833','Lovell','Wyoming'),('82432','WY',' 44.248250','-107.92630','Manderson','Wyoming'),('82433','WY',' 44.205280','-108.92718','Meeteetse','Wyoming'),('82434','WY',' 44.396661','-108.28605','Otto','Wyoming'),('82435','WY',' 44.789953','-108.86789','Powell','Wyoming'),('82440','WY',' 44.718546','-108.86538','Ralston','Wyoming'),('82441','WY',' 44.632199','-107.67034','Shell','Wyoming'),('82442','WY',' 43.885863','-107.36569','Ten Sleep','Wyoming'),('82443','WY',' 43.694009','-108.31942','Grass Creek','Wyoming'),('824HH','WY',' 44.383498','-108.03601','','Wyoming'),('824XX','WY',' 44.472454','-107.93250','','Wyoming'),('82501','WY',' 43.013826','-108.34879','Gas Hills','Wyoming'),('82510','WY',' 42.981091','-108.60194','Arapahoe','Wyoming'),('82512','WY',' 43.428698','-109.21806','Crowheart','Wyoming'),('82513','WY',' 43.557529','-109.70709','Dubois','Wyoming'),('82514','WY',' 42.971973','-108.92886','Fort Washakie','Wyoming'),('82515','WY',' 42.866820','-108.53339','Hudson','Wyoming'),('82516','WY',' 43.146870','-108.89349','Kinnear','Wyoming'),('82520','WY',' 42.729832','-108.63154','Ethete','Wyoming'),('82523','WY',' 43.312211','-108.56038','Pavillion','Wyoming'),('825HH','WY',' 43.154877','-108.73306','','Wyoming'),('82601','WY',' 42.896822','-106.29799','Casper','Wyoming'),('82604','WY',' 42.791242','-106.53986','Casper','Wyoming'),('82609','WY',' 42.844915','-106.27255','Casper','Wyoming'),('82620','WY',' 42.657230','-107.12523','Alcova','Wyoming'),('82633','WY',' 42.935874','-105.37303','Douglas','Wyoming'),('82635','WY',' 43.410459','-106.24210','Edgerton','Wyoming'),('82636','WY',' 42.828639','-106.15952','Evansville','Wyoming'),('82637','WY',' 42.796442','-105.91078','Glenrock','Wyoming'),('82639','WY',' 43.602698','-106.65945','Kaycee','Wyoming'),('82640','WY',' 43.551448','-106.14153','Linch','Wyoming'),('82642','WY',' 43.228052','-107.68195','Lysite','Wyoming'),('82643','WY',' 43.363864','-106.27476','Midwest','Wyoming'),('82644','WY',' 42.842615','-106.37103','Mills','Wyoming'),('82649','WY',' 43.232318','-108.15555','Shoshoni','Wyoming'),('826HH','WY',' 42.863878','-106.25913','','Wyoming'),('82701','WY',' 43.738237','-104.44387','Newcastle','Wyoming'),('82710','WY',' 44.776684','-104.22425','Aladdin','Wyoming'),('82711','WY',' 44.706167','-104.45138','Alva','Wyoming'),('82712','WY',' 44.447058','-104.12853','Beulah','Wyoming'),('82714','WY',' 44.553925','-104.68992','Devils Tower','Wyoming'),('82716','WY',' 44.356533','-105.52661','Gillette','Wyoming'),('82717','WY',' 44.374954','-105.38624','Gillette','Wyoming'),('82718','WY',' 43.939968','-105.52445','Gillette','Wyoming'),('82720','WY',' 44.811030','-104.72952','Hulett','Wyoming'),('82721','WY',' 44.453553','-104.92334','Pine Haven','Wyoming'),('82723','WY',' 43.992349','-104.45121','Osage','Wyoming'),('82725','WY',' 44.876211','-105.74228','Recluse','Wyoming'),('82727','WY',' 44.221574','-105.23842','Rozet','Wyoming'),('82729','WY',' 44.376421','-104.39800','Sundance','Wyoming'),('82730','WY',' 44.062053','-104.71043','Upton','Wyoming'),('82731','WY',' 44.799642','-105.24695','Gillette','Wyoming'),('82732','WY',' 43.715486','-105.35878','Wright','Wyoming'),('82801','WY',' 44.801249','-106.96782','Sheridan','Wyoming'),('82831','WY',' 44.681337','-106.08209','Arvada','Wyoming'),('82832','WY',' 44.602518','-106.76367','Banner','Wyoming'),('82833','WY',' 44.615453','-107.10625','Big Horn','Wyoming'),('82834','WY',' 44.301141','-106.67638','Buffalo','Wyoming'),('82835','WY',' 44.770838','-106.42404','Clearmont','Wyoming'),('82836','WY',' 44.787512','-107.48172','Dayton','Wyoming'),('82837','WY',' 44.743230','-106.23963','Leiter','Wyoming'),('82838','WY',' 44.947602','-107.38903','Parkman','Wyoming'),('82839','WY',' 44.889239','-107.14202','Acme','Wyoming'),('82842','WY',' 44.576978','-106.90810','Story','Wyoming'),('82844','WY',' 44.788759','-107.21937','Ranchester','Wyoming'),('82845','WY',' 44.725332','-106.66324','Wyarno','Wyoming'),('828HH','WY',' 44.484279','-106.75473','','Wyoming'),('82901','WY',' 41.594542','-109.16304','Rock Springs','Wyoming'),('82922','WY',' 43.185600','-110.38625','Bondurant','Wyoming'),('82923','WY',' 42.750730','-109.61933','Boulder','Wyoming'),('82925','WY',' 43.081275','-109.92672','Cora','Wyoming'),('82929','WY',' 41.587387','-109.82274','Little America','Wyoming'),('82930','WY',' 41.267546','-110.90607','Evanston','Wyoming'),('82932','WY',' 42.026986','-109.40903','Farson','Wyoming'),('82933','WY',' 41.299766','-110.43728','Fort Bridger','Wyoming'),('82934','WY',' 41.610852','-109.97361','Granger','Wyoming'),('82935','WY',' 41.659162','-109.63919','Green River','Wyoming'),('82936','WY',' 41.081086','-110.22391','Lonetree','Wyoming'),('82937','WY',' 41.399751','-110.36624','Lyman','Wyoming'),('82938','WY',' 41.181959','-109.48709','Mc Kinnon','Wyoming'),('82939','WY',' 41.246498','-110.33778','Mountain View','Wyoming'),('82941','WY',' 42.874606','-109.85694','Pinedale','Wyoming'),('82942','WY',' 41.689968','-108.81963','Point Of Rocks','Wyoming'),('82943','WY',' 41.702635','-109.22044','Reliance','Wyoming'),('82944','WY',' 41.104010','-110.53733','Robertson','Wyoming'),('82945','WY',' 41.761851','-108.97139','Superior','Wyoming'),('829HH','WY',' 41.830177','-109.79479','','Wyoming'),('829XX','WY',' 42.581143','-109.58660','','Wyoming'),('83001','WY',' 43.468383','-110.75714','Colter Bay','Wyoming'),('83011','WY',' 43.639867','-110.57908','Kelly','Wyoming'),('83012','WY',' 43.701492','-110.83215','Moose','Wyoming'),('83013','WY',' 44.042150','-110.97876','Moran','Wyoming'),('83014','WY',' 43.520413','-110.86418','Wilson','Wyoming'),('830HH','WY',' 43.615637','-110.77193','','Wyoming'),('830XX','WY',' 43.716263','-110.29381','','Wyoming'),('83101','WY',' 41.890875','-110.40687','Kemmerer','Wyoming'),('83110','WY',' 42.681301','-110.92196','Afton','Wyoming'),('83111','WY',' 42.801664','-111.00480','Auburn','Wyoming'),('83112','WY',' 42.877387','-110.92859','Bedford','Wyoming'),('83113','WY',' 42.557035','-110.11482','Marbleton','Wyoming'),('83114','WY',' 42.039281','-110.85188','Cokeville','Wyoming'),('83115','WY',' 42.926318','-110.18889','Daniel','Wyoming'),('83116','WY',' 41.779266','-110.53868','Diamondville','Wyoming'),('83118','WY',' 43.062245','-111.01917','Etna','Wyoming'),('83119','WY',' 42.683338','-110.99847','Fairview','Wyoming'),('83121','WY',' 41.814385','-110.53743','Frontier','Wyoming'),('83122','WY',' 42.803357','-110.93182','Grover','Wyoming'),('83123','WY',' 42.243979','-110.24195','La Barge','Wyoming'),('83124','WY',' 41.767699','-110.27732','Opal','Wyoming'),('83126','WY',' 42.607888','-110.91808','Smoot','Wyoming'),('83127','WY',' 42.960670','-110.98262','Thayne','Wyoming'),('83128','WY',' 43.129462','-110.93247','Alpine','Wyoming'),('831HH','WY',' 42.365602','-110.12133','','Wyoming'),('00601','PR',' 18.180103',' -66.74947','Adjuntas','Puerto Rico'),('00602','PR',' 18.363285',' -67.18024','Aguada','Puerto Rico'),('00603','PR',' 18.448619',' -67.13422','Aguadilla','Puerto Rico'),('00604','PR',' 18.498987',' -67.13699','Aguadilla','Puerto Rico'),('00606','PR',' 18.182151',' -66.95880','Maricao','Puerto Rico'),('00610','PR',' 18.288319',' -67.13604','Anasco','Puerto Rico'),('00612','PR',' 18.449732',' -66.69879','Arecibo','Puerto Rico'),('00616','PR',' 18.426748',' -66.67669','Bajadero','Puerto Rico'),('00617','PR',' 18.455499',' -66.55575','Barceloneta','Puerto Rico'),('00622','PR',' 18.003125',' -67.16745','Boqueron','Puerto Rico'),('00623','PR',' 18.086430',' -67.15222','Cabo Rojo','Puerto Rico'),('00624','PR',' 18.055399',' -66.72602','Penuelas','Puerto Rico'),('00627','PR',' 18.435246',' -66.85644','Camuy','Puerto Rico'),('00631','PR',' 18.186739',' -66.85174','Castaner','Puerto Rico'),('00637','PR',' 18.073078',' -66.94864','Sabana Grande','Puerto Rico'),('00638','PR',' 18.308139',' -66.49835','Ciales','Puerto Rico'),('00641','PR',' 18.268896',' -66.70519','Utuado','Puerto Rico'),('00646','PR',' 18.442798',' -66.27689','Dorado','Puerto Rico'),('00647','PR',' 17.964529',' -66.93993','Ensenada','Puerto Rico'),('00650','PR',' 18.363331',' -66.56773','Florida','Puerto Rico'),('00652','PR',' 18.457453',' -66.61217','Garrochales','Puerto Rico'),('00653','PR',' 17.992112',' -66.90097','Guanica','Puerto Rico'),('00656','PR',' 18.038866',' -66.79168','Guayanilla','Puerto Rico'),('00659','PR',' 18.432956',' -66.80039','Hatillo','Puerto Rico'),('00660','PR',' 18.139108',' -67.12085','Hormigueros','Puerto Rico'),('00662','PR',' 18.478855',' -67.01973','Isabela','Puerto Rico'),('00664','PR',' 18.212565',' -66.59243','Jayuya','Puerto Rico'),('00667','PR',' 18.017819',' -67.04226','Lajas','Puerto Rico'),('00669','PR',' 18.288418',' -66.87503','Lares','Puerto Rico'),('00670','PR',' 18.241343',' -66.97604','Las Marias','Puerto Rico'),('00674','PR',' 18.426137',' -66.48697','Manati','Puerto Rico'),('00676','PR',' 18.379560',' -67.08424','Moca','Puerto Rico'),('00677','PR',' 18.336121',' -67.23675','Rincon','Puerto Rico'),('00678','PR',' 18.442334',' -66.93275','Quebradillas','Puerto Rico'),('00680','PR',' 18.205232',' -67.12655','Mayaguez','Puerto Rico'),('00682','PR',' 18.208402',' -67.15428','Mayaguez','Puerto Rico'),('00683','PR',' 18.092807',' -67.04524','San German','Puerto Rico'),('00685','PR',' 18.332595',' -66.98104','San Sebastian','Puerto Rico'),('00687','PR',' 18.317080',' -66.41528','Morovis','Puerto Rico'),('00688','PR',' 18.404150',' -66.61348','Sabana Hoyos','Puerto Rico'),('00690','PR',' 18.495369',' -67.09867','San Antonio','Puerto Rico'),('00692','PR',' 18.419666',' -66.33186','Vega Alta','Puerto Rico'),('00693','PR',' 18.440667',' -66.39210','Vega Baja','Puerto Rico'),('00698','PR',' 18.065470',' -66.85587','Yauco','Puerto Rico'),('006HH','PR',' 18.473441',' -66.83452','','Puerto Rico'),('006XX','PR',' 18.102537',' -67.88803','','Puerto Rico'),('00703','PR',' 18.246205',' -66.12827','Aguas Buenas','Puerto Rico'),('00704','PR',' 17.970112',' -66.22291','Aguirre','Puerto Rico'),('00705','PR',' 18.129420',' -66.26541','Aibonito','Puerto Rico'),('00707','PR',' 18.014505',' -65.91018','Maunabo','Puerto Rico'),('00714','PR',' 17.987288',' -66.05552','Arroyo','Puerto Rico'),('00715','PR',' 18.003492',' -66.55868','Mercedita','Puerto Rico'),('00716','PR',' 17.999066',' -66.59965','Ponce','Puerto Rico'),('00717','PR',' 18.004303',' -66.61374','Ponce','Puerto Rico'),('00718','PR',' 18.220480',' -65.74293','Naguabo','Puerto Rico'),('00719','PR',' 18.294571',' -66.25098','Naranjito','Puerto Rico'),('00720','PR',' 18.217827',' -66.42265','Orocovis','Puerto Rico'),('00723','PR',' 18.023196',' -66.01310','Patillas','Puerto Rico'),('00725','PR',' 18.233927',' -66.04502','Caguas','Puerto Rico'),('00728','PR',' 18.013353',' -66.65218','Ponce','Puerto Rico'),('00729','PR',' 18.356150',' -65.89089','Canovanas','Puerto Rico'),('00730','PR',' 18.022626',' -66.61727','Ponce','Puerto Rico'),('00731','PR',' 18.077329',' -66.61192','Ponce','Puerto Rico'),('00735','PR',' 18.258444',' -65.65987','Ceiba','Puerto Rico'),('00736','PR',' 18.112895',' -66.15377','Cayey','Puerto Rico'),('00738','PR',' 18.322650',' -65.66116','Fajardo','Puerto Rico'),('00739','PR',' 18.169840',' -66.16271','Cidra','Puerto Rico'),('00740','PR',' 18.331711',' -65.62761','Puerto Real','Puerto Rico'),('00741','PR',' 18.160755',' -65.75765','Punta Santiago','Puerto Rico'),('00745','PR',' 18.366213',' -65.82277','Rio Grande','Puerto Rico'),('00751','PR',' 17.993803',' -66.26534','Salinas','Puerto Rico'),('00754','PR',' 18.156330',' -65.96831','San Lorenzo','Puerto Rico'),('00757','PR',' 17.986310',' -66.39457','Santa Isabel','Puerto Rico'),('00765','PR',' 18.125664',' -65.45603','Vieques','Puerto Rico'),('00766','PR',' 18.126023',' -66.48208','Villalba','Puerto Rico'),('00767','PR',' 18.072752',' -65.89703','Yabucoa','Puerto Rico'),('00769','PR',' 18.092813',' -66.36110','Coamo','Puerto Rico'),('00771','PR',' 18.187440',' -65.87088','Las Piedras','Puerto Rico'),('00772','PR',' 18.427674',' -65.87605','Loiza','Puerto Rico'),('00773','PR',' 18.361344',' -65.72133','Luquillo','Puerto Rico'),('00775','PR',' 18.311149',' -65.29257','Culebra','Puerto Rico'),('00777','PR',' 18.224088',' -65.91316','Juncos','Puerto Rico'),('00778','PR',' 18.258628',' -65.97791','Gurabo','Puerto Rico'),('00780','PR',' 18.068538',' -66.55939','Coto Laurel','Puerto Rico'),('00782','PR',' 18.223348',' -66.22670','Comerio','Puerto Rico'),('00783','PR',' 18.304874',' -66.32305','Corozal','Puerto Rico'),('00784','PR',' 17.984137',' -66.12779','Guayama','Puerto Rico'),('00791','PR',' 18.147257',' -65.82269','Humacao','Puerto Rico'),('00794','PR',' 18.204294',' -66.31058','Barranquitas','Puerto Rico'),('00795','PR',' 18.036253',' -66.50289','Juana Diaz','Puerto Rico'),('007HH','PR',' 17.981672',' -66.01459','','Puerto Rico'),('007XX','PR',' 17.962234',' -66.55546','','Puerto Rico'),('00901','PR',' 18.465426',' -66.10786','San Juan','Puerto Rico'),('00906','PR',' 18.464540',' -66.10079','San Juan','Puerto Rico'),('00907','PR',' 18.451131',' -66.07798','San Juan','Puerto Rico'),('00909','PR',' 18.442282',' -66.06764','San Juan','Puerto Rico'),('00911','PR',' 18.450090',' -66.05770','San Juan','Puerto Rico'),('00912','PR',' 18.445946',' -66.05928','San Juan','Puerto Rico'),('00913','PR',' 18.450907',' -66.04256','San Juan','Puerto Rico'),('00915','PR',' 18.436995',' -66.04888','San Juan','Puerto Rico'),('00917','PR',' 18.422263',' -66.05130','San Juan','Puerto Rico'),('00918','PR',' 18.417668',' -66.06494','San Juan','Puerto Rico'),('00920','PR',' 18.412420',' -66.09069','San Juan','Puerto Rico'),('00921','PR',' 18.394019',' -66.08633','San Juan','Puerto Rico'),('00923','PR',' 18.410681',' -66.03806','San Juan','Puerto Rico'),('00924','PR',' 18.401917',' -66.01194','San Juan','Puerto Rico'),('00925','PR',' 18.400006',' -66.05028','San Juan','Puerto Rico'),('00926','PR',' 18.361363',' -66.05620','San Juan','Puerto Rico'),('00927','PR',' 18.391840',' -66.06867','San Juan','Puerto Rico'),('00934','PR',' 18.413511',' -66.12198','Fort Buchanan','Puerto Rico'),('00949','PR',' 18.433173',' -66.20420','Toa Baja','Puerto Rico'),('00952','PR',' 18.429218',' -66.18014','Sabana Seca','Puerto Rico'),('00953','PR',' 18.368020',' -66.23414','Toa Alta','Puerto Rico'),('00956','PR',' 18.342160',' -66.16643','Bayamon','Puerto Rico'),('00957','PR',' 18.369674',' -66.18669','Bayamon','Puerto Rico'),('00959','PR',' 18.387063',' -66.15943','Bayamon','Puerto Rico'),('00961','PR',' 18.412462',' -66.16033','Bayamon','Puerto Rico'),('00962','PR',' 18.437683',' -66.13847','Catano','Puerto Rico'),('00965','PR',' 18.431453',' -66.11703','Guaynabo','Puerto Rico'),('00966','PR',' 18.398507',' -66.11522','Guaynabo','Puerto Rico'),('00968','PR',' 18.408479',' -66.10250','Guaynabo','Puerto Rico'),('00969','PR',' 18.366981',' -66.10889','Guaynabo','Puerto Rico'),('00971','PR',' 18.329688',' -66.11876','Guaynabo','Puerto Rico'),('00976','PR',' 18.346767',' -66.00561','Trujillo Alto','Puerto Rico'),('00979','PR',' 18.431885',' -66.01270','Carolina','Puerto Rico'),('00982','PR',' 18.409345',' -65.99313','Carolina','Puerto Rico'),('00983','PR',' 18.414408',' -65.97582','Carolina','Puerto Rico'),('00985','PR',' 18.374896',' -65.94691','Carolina','Puerto Rico'),('00987','PR',' 18.372228',' -65.96275','Carolina','Puerto Rico'),('009HH','PR',' 18.435287',' -66.06653','','Puerto Rico');
/*!40000 ALTER TABLE `zip_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'wigi'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_add_bank_account` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_add_bank_account`(
    IN p_user_bank_account_id int(11) unsigned,
    IN p_user_id int(11) unsigned,
    IN p_key_version tinyint(3) unsigned,
    IN p_last4 char(4),
    IN p_description varchar(30),
    IN p_bank_type varchar(10),
    IN p_routing varchar(30),
    IN p_conf_amt decimal(10,2),
    IN p_user_added varchar(60),
    OUT p_res boolean
)
BEGIN

    INSERT INTO user_bank_account (
      user_bank_account_id,
      user_id,
      key_version,
      last4,
      description,
      bank_type,
      routing,
      conf_amt,
      date_added,
      user_added,
      date_changed,
      user_changed
    ) VALUES (
      p_user_bank_account_id,
      p_user_id,
      p_key_version,
      p_last4,
      p_description,
      p_bank_type,
      p_routing,
      p_conf_amt,
      now(),
      p_user_added,
      now(),
      p_user_added
    );

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_add_credit_card` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_add_credit_card`(
    IN p_user_credit_card_id int(11) unsigned,
    IN p_user_id int(11) unsigned,
    IN p_key_version tinyint(3) unsigned,
    IN p_last4 char(4),
    IN p_description varchar(30),
    IN p_card_type varchar(10),
    IN p_expire_month tinyint unsigned,
    IN p_expire_year  smallint unsigned,
    IN p_name_on_card varchar(255),
    IN p_conf_amt decimal(10,2),
    IN p_user_added varchar(60),
    OUT p_res boolean
)
BEGIN

    INSERT INTO user_credit_card (
      user_credit_card_id,
      user_id,
      key_version,
      last4,
      description,
      card_type,
      expire_month,
      expire_year,
      name_on_card,
      conf_amt,
      date_added,
      user_added,
      date_changed,
      user_changed
    ) VALUES (
      p_user_credit_card_id,
      p_user_id,
      p_key_version,
      p_last4,
      p_description,
      p_card_type,
      p_expire_month,
      p_expire_year,
      p_name_on_card,
      p_conf_amt,
      now(),
      p_user_added,
      now(),
      p_user_added
    );

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_auth1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_auth1`(
    IN p_user_id int(11) unsigned,
    IN p_password char(32),
    OUT p_code varchar(10)
)
BEGIN

    declare res boolean;
    declare code varchar(10);

    select count(*) into res from user where `user_id` = p_user_id and `password` = p_password and status = '1';

    if (res = 1) then
        call sp_get_confirmation_code(@code);
        update user set `login_code` = @code,`login_code_expires` = (now() + INTERVAL 15 minute) where `user_id` = p_user_id;
        set p_code = @code;
    end if;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_auth2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_auth2`(
    IN p_user_id int(11) unsigned,
    IN p_password char(32),
    IN p_code varchar(10),
    OUT p_res boolean
)
BEGIN

    select count(*) into p_res from user where `user_id` = p_user_id and `password` = p_password and `login_code` = p_code and (login_code_expires > now()) and status = '1';

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_auth_mobile` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_auth_mobile`(
    IN p_mobile_id int(11) unsigned,
    IN p_pin char(32),
    OUT p_res boolean
)
BEGIN
    select count(*) into p_res from user_mobile where `mobile_id` = p_mobile_id and `pin` = p_pin;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_bank_account_is_linked` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_bank_account_is_linked`(
    IN p_mobile_id int(11) unsigned,
    IN p_user_bank_account_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_mobile_bank_account where `mobile_id` = p_mobile_id and `user_bank_account_id` = p_user_bank_account_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_confirm_bank_account` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_confirm_bank_account`(
    IN p_id int(11) unsigned
)
BEGIN
  update user_bank_account set status = '1' where user_bank_account_id = p_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_confirm_credit_card` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_confirm_credit_card`(
    IN p_id int(11) unsigned
)
BEGIN
  update user_credit_card set status = '1' where user_credit_card_id = p_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_create_document` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_create_document`(
  IN p_mobile_id int unsigned,
  IN p_doc_type tinyint unsigned,
  IN p_current_version smallint unsigned,
  IN p_expiration datetime,
  IN p_description varchar(100),
  IN p_number varchar(100),
  IN p_user_added varchar(60),
  OUT p_res int unsigned
)
BEGIN
  INSERT INTO doc_info (mobile_id,doc_type,current_version,expiration,date_added,user_added,date_changed,user_changed,description,`number`) 
                values (p_mobile_id,p_doc_type,p_current_version,p_expiration,now(),p_user_added,now(),p_user_added,p_description,p_number);
  set p_res = last_insert_id();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_create_message` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_create_message`(
    IN p_message text,
    IN p_subject varchar(255),
    IN p_status tinyint unsigned,
    IN p_message_type tinyint unsigned,
    OUT p_res int unsigned
)
BEGIN
    INSERT INTO message (`message`,`subject`,`status`,`message_type`) values (p_message,p_subject,p_status,p_message_type);
    set p_res = last_insert_id();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_create_tos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_create_tos`(
    IN p_username varchar(60),
    IN p_tos text
)
BEGIN
    INSERT INTO tos (`tos`,`date_added`,`user_added`,`user_changed`) values (p_tos,now(),p_username,p_username);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_credit_card_is_linked` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_credit_card_is_linked`(
    IN p_mobile_id int(11) unsigned,
    IN p_user_credit_card_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_mobile_credit_card where `mobile_id` = p_mobile_id and `user_credit_card_id` = p_user_credit_card_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_delete_unconfirmed_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_delete_unconfirmed_user`(
    IN p_user_id int(11) unsigned
)
BEGIN
    delete from user where user_id = p_user_id;
    delete from user_mobile where user_id = p_user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_accepted_tos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_get_accepted_tos`(
    IN p_user_id int(11) unsigned,
    OUT p_tos_id int(11) unsigned
)
BEGIN
    select tos_id into p_tos_id from user where user_id = p_user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_confirmation_code` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_get_confirmation_code`(
    OUT p_code varchar(10)
)
BEGIN
    select FLOOR(100000 + (RAND() * 888888)) into p_code;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_mobile_ext` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_get_mobile_ext`(
    IN p_key varchar(100),
    IN p_category tinyint(3),
    IN p_mobile_id int(11) unsigned,
    OUT p_val varchar(100)
)
BEGIN
    SELECT `val` into p_val from user_mobile_ext where `mobile_id` = p_mobile_id and `category` = p_category and `key` = p_key;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_mobile_id_from_cellphone` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_get_mobile_id_from_cellphone`(
    IN p_cellphone varchar(30),
    IN p_country_code varchar(30),
    OUT p_mobile_id int(11) unsigned
)
BEGIN
    
    select mobile_id into p_mobile_id from user_mobile as um, user as u where um.`cellphone` = p_cellphone and u.`country_code` = p_country_code and u.user_id = um.user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_user_balance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_get_user_balance`(
    IN p_user_id INT(11) unsigned,
    OUT p_res decimal(10,2)
)
BEGIN
   select sum(balance) into p_res from user_mobile where `user_id` = p_user_id group by user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_user_id_from_mobile_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_get_user_id_from_mobile_id`(
    IN p_mobile_id int(11) unsigned,
    OUT p_user_id int(11) unsigned
)
BEGIN
    select user_id into p_user_id from user_mobile where `mobile_id` = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_user_temp_balance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_get_user_temp_balance`(
    IN p_user_id INT(11) unsigned,
    OUT p_res decimal(10,2)
)
BEGIN
   select sum(temp_balance) into p_res from user_mobile where `user_id` = p_user_id group by user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_increase_balance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_increase_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare new_tempbalance decimal(10,2);
    declare new_balance decimal(10,2);

    select (balance + p_amount)      into new_balance from user_mobile where `mobile_id` = p_mobile_id;
    select (temp_balance + p_amount) into new_tempbalance from user_mobile where `mobile_id` = p_mobile_id;

    
    update user_mobile set `temp_balance` = new_tempbalance where `mobile_id` = p_mobile_id;
    
    update user_mobile set `balance` = new_balance where `mobile_id` = p_mobile_id;

    set @p_res = true;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_increase_temp_balance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_increase_temp_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare new_tempbalance decimal(10,2);

    select (temp_balance + p_amount) into new_tempbalance from user_mobile where `mobile_id` = p_mobile_id;

    
    update user_mobile set `temp_balance` = new_tempbalance where `mobile_id` = p_mobile_id;

    set @p_res = true;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_link_bank_account` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_link_bank_account`(
    p_mobile_id int(11) unsigned,
    p_user_bank_account_id int(11) unsigned
)
BEGIN
    insert into user_mobile_bank_account (`mobile_id`,`user_bank_account_id`) values (p_mobile_id,p_user_bank_account_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_link_credit_card` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_link_credit_card`(
    p_mobile_id int(11) unsigned,
    p_user_credit_card_id int(11) unsigned
)
BEGIN
    insert into user_mobile_credit_card (`mobile_id`,`user_credit_card_id`) values (p_mobile_id,p_user_credit_card_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_merchant_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_merchant_create`(
        IN p_email varCHAR(100),
        IN p_user_type TINYINT(3),
        IN p_password char(32),
        IN p_status tinYINT(3),
        IN p_first_name varCHAR(100),
        IN p_last_name varCHAR(100),
        IN p_middle_init varCHAR(3),
        IN p_question varchar(255),
        IN p_answer varchar(255),
        IN p_country_code varchar(10),
        IN p_business_type tinyint unsigned,
        IN p_business_name varchar(100),
        IN p_business_tax_id varchar(50),
        IN p_business_phone varchar(50),
        IN p_date_added datetime,
        IN p_user_added varCHAR(60),
        IN p_user_changed varCHAR(60),
        OUT p_user_id INTEGER(11) unsigned,
        OUT p_email_code varchar(10)
    )
BEGIN
    call sp_get_confirmation_code(@code);
    INSERT INTO `user`(
        `email`,
        `user_type`,
        `password`,
        `status`,
        `first_name`,
        `last_name`,
        `middle_init`,
        `email_confirmation_code`,
        `question`,
        `answer`,
        `country_code`,
        `business_type`,
        `business_name`,
        `business_tax_id`,
        `business_phone`,
        `date_added`,
        `user_added`,
        `user_changed`
                ) 
        VALUE (
        p_email,
        p_user_type,
        p_password,
        p_status,
        p_first_name,
        p_last_name,
        p_middle_init,
        @code,
        p_question,
        p_answer,
        p_country_code,
        p_business_type,
        p_business_name,
        p_business_tax_id,
        p_business_phone,
        p_date_added,
        p_user_added,
        p_user_changed

        );

       set p_user_id = last_insert_id();
       select @code into p_email_code;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_auth` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_auth`(
    IN p_mobile_id int(11) unsigned,
    IN p_pin char(32),
    OUT p_result smallint
)
BEGIN

  select count(*) into p_result from user_mobile where mobile_id=p_mobile_id and pin=p_pin;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_authorize_os_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_authorize_os_id`(
    IN p_mobile_id int(11) unsigned,
    IN p_os_id varchar(255)
)
BEGIN
    insert into authorized_device (`mobile_id`,`os_id`) values (p_mobile_id,p_os_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_id_exists` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_id_exists`(
    IN p_mobile_id int(11) unsigned,
    OUT p_res boolean
)
BEGIN
    select count(*) into p_res from user_mobile where `mobile_id` = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_id_from_os_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_id_from_os_id`(
  IN p_os_id varchar(255),
  OUT p_mobile_id int(11) unsigned
)
BEGIN
  select `mobile_id` into p_mobile_id from user_mobile where `os_id`=p_os_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_os_id_is_authorized` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_os_id_is_authorized`(
    IN p_mobile_id int(11) unsigned,
    IN p_os_id varchar(255),
    OUT p_result boolean
)
BEGIN
    select count(*) into p_result from authorized_device where mobile_id = p_mobile_id and os_id = p_os_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_set_message_flag` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_set_message_flag`(
    IN p_mobile_id int unsigned
)
BEGIN
    UPDATE user_mobile set has_message = '1' where mobile_id = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_set_new_txn_flag` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_set_new_txn_flag`(
    IN p_mobile_id int unsigned
)
BEGIN
    UPDATE user_mobile set has_txn = '1' where mobile_id = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_set_os_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_set_os_id`(
    IN p_mobile_id int(11) unsigned,
    IN p_os_id varchar(255)
)
BEGIN
    update user_mobile set `os_id` = p_os_id where `mobile_id` = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_mobile_unset_message_flag` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_mobile_unset_message_flag`(
    IN p_mobile_id int unsigned
)
BEGIN
    UPDATE user_mobile set has_message = has_message-1 where mobile_id = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_os_id_is_set` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_os_id_is_set`(
    IN p_mobile_id int(11) unsigned,
    OUT res boolean
)
BEGIN
    select count(*) into res from user_mobile where os_id is not null and `mobile_id` = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_reduce_balance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_reduce_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare newbalance decimal(10,2);

    
    select (balance - p_amount) into newbalance from user_mobile where `mobile_id` = p_mobile_id;

    if (newbalance >= 0) then
      update user_mobile set `balance` = newbalance where `mobile_id` = p_mobile_id;
      set @p_res = true;
    else
      set @p_res = false;
    end if;



END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_reduce_temp_balance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_reduce_temp_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare newbalance decimal(10,2);

    
    select (temp_balance - p_amount) into newbalance from user_mobile where `mobile_id` = p_mobile_id;

    if (newbalance >= 0) then
      update user_mobile set `temp_balance` = newbalance where `mobile_id` = p_mobile_id;
      set @p_res = true;
    else
      set @p_res = false;
    end if;
    


END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_reset_pin` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_reset_pin`(
  IN p_mobile_id int(11) unsigned,
  IN p_pin char(32)
)
BEGIN
  update user_mobile set pin = p_pin where mobile_id = p_mobile_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_send_message` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_send_message`(
    IN p_message_id int unsigned,
    IN p_mobile_id int unsigned
)
BEGIN
    INSERT INTO user_mobile_message (message_id,mobile_id) values (p_message_id,p_mobile_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_set_accepted_tos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_set_accepted_tos`(
    IN p_user_id int(11) unsigned,
    IN p_tos_id  int(11) unsigned
)
BEGIN
    update user set `tos_id`=p_tos_id,`tos_accepted_date`=now() where `user_id` = p_user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_set_message_viewed` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_set_message_viewed`(
    IN p_message_id int unsigned
)
BEGIN
    UPDATE user_mobile_message set status = '1' where user_mobile_message_id = p_message_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_set_mobile_ext` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_set_mobile_ext`(
    IN p_key varchar(100),
    IN p_val varchar(100),
    IN p_category tinyint(3),
    IN p_mobile_id int(11) unsigned
)
BEGIN
    declare p_exists boolean;

    select count(*) into p_exists from user_mobile_ext where `key` = p_key and `mobile_id` = p_mobile_id and `category` = p_category;

    if (p_exists = 1) then
      update user_mobile_ext set `val` = p_val where `key` = p_key and `mobile_id` = p_mobile_id and `category` = p_category;
    else
      insert into user_mobile_ext (`key`,`val`,`category`,`mobile_id`) values (p_key,p_val,p_category,p_mobile_id);
    end if;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_address_set_default` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_address_set_default`(
    IN p_address_id INT(11) unsigned
    )
BEGIN
    declare uid INT(11) unsigned;
    SELECT user_id into uid from user_address where `user_address_id`=p_address_id;
    UPDATE user_address SET `is_default`='0' where `user_id`=uid;
    UPDATE user_address SET `is_default`='1' where `user_address_id`=p_address_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_add_address` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_add_address`(
    IN p_user_id int(11) unsigned,
    IN p_address_type tinyint(3) unsigned,
    IN p_addr_line1 varchar(100),
    IN p_addr_line2 varchar(100),
    IN p_addr_line3 varchar(100),
    IN p_addr_line4 varchar(100),
    IN p_city varchar(100),
    IN p_state varchar(50),
    IN p_zip varchar(15),
    IN p_country_code char(3),
    IN p_date_added datetime,
    IN p_user_added varchar(60),
    IN p_date_changed timestamp,
    IN p_user_changed varchar(60),
    OUT p_address_id int(11) unsigned
)
BEGIN
    INSERT INTO `user_address`(
          `user_id`,
          `address_type`,
          `addr_line1`,
          `addr_line2`,
          `addr_line3`,
          `addr_line4`,
          `city`,
          `state`,
          `zip`,
          `country_code`,
          `date_added`,
          `user_added`,
          `date_changed`,
          `user_changed`

    ) values (
           p_user_id,
           p_address_type,
           p_addr_line1,
           p_addr_line2,
           p_addr_line3,
           p_addr_line4,
           p_city,
           p_state,
           p_zip,
           p_country_code,
           p_date_added,
           p_user_added,
           p_date_changed,
           p_user_changed
    ); 

    set p_user_id = last_insert_id();

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_add_mobile` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_add_mobile`(
    IN p_user_id int(11) unsigned,
    IN p_mobile_type mediumint(6) unsigned,
    IN p_cellphone varchar(30),
    IN p_pin char(32),
    IN p_date_added datetime,
    IN p_user_added varchar(60),
    IN p_date_changed timestamp,
    IN p_user_changed varchar(60),
    OUT p_id int(11) unsigned

)
BEGIN

    call sp_get_confirmation_code(@code);

    INSERT INTO `user_mobile`(
        `user_id`,
        `mobile_type`,
        `cellphone`,
        `pin`,
        `mobile_confirmation_code`,
        `date_added`,
        `user_added`,
        `date_changed`,
        `user_changed`
    ) VALUES (
        p_user_id,
        p_mobile_type,
        p_cellphone,
        p_pin,
        @code,
        p_date_added,
        p_user_added,
        p_date_changed,
        p_user_changed
    );
    
    set p_id = @code;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_auth` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_auth`(
    IN p_user_id int(11) unsigned,
    IN p_password char(32),
    OUT p_result smallint
)
BEGIN

  select count(*) into p_result from user where user_id=p_user_id and password=p_password;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_cellphone_is_confirmed` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_cellphone_is_confirmed`(
    IN p_mobile_id int(11) unsigned,
    OUT res boolean
)
BEGIN
    select count(*) into res from user_mobile where `mobile_id` = p_mobile_id and status = '1';
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_cellphone_remove` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_cellphone_remove`(
    IN p_user_id int(11) unsigned,
    IN p_mobile_id varchar(30)
)
BEGIN
    delete from user_mobile where `user_id` = p_user_id and `mobile_id` = p_mobile_id limit 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_confirm_cellphone` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_confirm_cellphone`(
        IN p_mobile_id int(11) unsigned,
        IN p_code varchar(10),
        OUT p_result tinyint(1) unsigned
)
BEGIN

  declare c smallint(1);
  declare p_user_id int(11) unsigned;
 
  select count(*) into p_result from user_mobile where `mobile_confirmation_code` = p_code and `mobile_id` = p_mobile_id;
  
  if (p_result = 1) then
  
      select user_id into p_user_id from user_mobile where `mobile_id` = p_mobile_id;

      update user_mobile set `status` = '1' where `mobile_id` = p_mobile_id;
      update user set cellphone_confirmed = true where `user_id` = p_user_id;

      select email_confirmed into c from user where `user_id` = p_user_id;

      if (c = 1) then
          update user set `status` = 1 where `user_id` = p_user_id;
      end if;

   end if;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_confirm_email` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_confirm_email`(
        IN p_user_id int(11) unsigned,
        IN p_code varchar(10),
        OUT p_result tinyint(1) unsigned
)
BEGIN

    declare c smallint(1);

    select count(*) into p_result from user where `user_id` = p_user_id and `email_confirmation_code` = p_code;

    if (p_result = 1) then

        update user set `email_confirmed` = true where `user_id` = p_user_id;
  
        select cellphone_confirmed into c from user where `user_id` = p_user_id;

        if (c = 1) then
            update user set `status` = 1 where `user_id` = p_user_id;
        end if;
     
     end if;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_create`(
        IN p_email varCHAR(100),
        IN p_user_type TINYINT(3),
        IN p_password char(32),
        IN p_status tinYINT(3),
        IN p_first_name varCHAR(100),
        IN p_last_name varCHAR(100),
        IN p_middle_init varCHAR(3),
        IN p_question varchar(255),
        IN p_answer varchar(255),
        IN p_country_code varchar(10),
        IN p_date_added datetime,
        IN p_user_added varCHAR(60),
        IN p_user_changed varCHAR(60),
        OUT p_user_id INTEGER(11) unsigned,
        OUT p_email_code varchar(10)
    )
BEGIN
    call sp_get_confirmation_code(@code);
    INSERT INTO `user`(
        `email`,
        `user_type`,
        `password`,
        `status`,
        `first_name`,
        `last_name`,
        `middle_init`,
        `email_confirmation_code`,
        `question`,
        `answer`,
        `country_code`,
        `date_added`,
        `user_added`,
        `user_changed`
                )
        VALUE (
        p_email,
        p_user_type,
        p_password,
        p_status,
        p_first_name,
        p_last_name,
        p_middle_init,
        @code,
        p_question,
        p_answer,
        p_country_code,
        p_date_added,
        p_user_added,
        p_user_changed

        );

       set p_user_id = last_insert_id();
       select @code into p_email_code;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_exists` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_exists`(
        IN p_email varCHAR(100),
        OUT p_user_exists smallint
    )
BEGIN

  select count(*) into p_user_exists from user where email=p_email;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_get_default_cellphone` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_get_default_cellphone`(
    IN p_user_id int(11) unsigned,
    OUT p_mobile_id int(11)
)
BEGIN

	select `mobile_id` into p_mobile_id from user_mobile where `user_id` = p_user_id and is_default = '1';

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_get_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_get_id`(
    IN  p_email varchar(100),
    OUT p_user_id int(11) unsigned
    )
BEGIN
  declare exist smallint;

  select count(*) into @exist from user where email=p_email;

  if (@exist > 0) then
    select user_id into p_user_id from user where email=p_email;
  else
    set @p_user_id = 0;
  end if;


END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_id_exists` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_id_exists`(
    IN p_user_id int(11) unsigned,
    OUT p_res boolean
)
BEGIN
    select count(*) into p_res from user where `user_id` = p_user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_id_from_os_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_id_from_os_id`(
  IN p_os_id varchar(255),
  OUT p_user_id int(11) unsigned
)
BEGIN
  select `user_id` into p_user_id from user_mobile where `os_id` = p_os_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_is_bank_account_owner` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_is_bank_account_owner`(
    IN p_user_id int(11) unsigned,
    IN p_user_bank_account_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_bank_account where `user_id` = p_user_id and `user_bank_account_id` = p_user_bank_account_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_is_cellphone_owner` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_is_cellphone_owner`(
    IN p_user_id int(11) unsigned,
    IN p_mobile_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_mobile where `mobile_id` = p_mobile_id and `user_id` = p_user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_is_credit_card_owner` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_is_credit_card_owner`(
    IN p_user_id int(11) unsigned,
    IN p_user_credit_card_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_credit_card where `user_id` = p_user_id and `user_credit_card_id` = p_user_credit_card_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_no_cellphones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_no_cellphones`(
    IN p_user_id int(11) unsigned,
    OUT p_count int unsigned
)
BEGIN
    select count(*) into p_count from user_mobile where `user_id` = p_user_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_set_default_cellphone` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_set_default_cellphone`(
    IN p_mobile_id int(11) unsigned
)
BEGIN

    declare p_user_id int(11) unsigned;

    select user_id into p_user_id from user_mobile where `mobile_id` = p_mobile_id;

    
    update user_mobile set is_default = '0' where `user_id` = p_user_id;
    
    update user_mobile set is_default = '1' where `user_id` = p_user_id and `mobile_id` = p_mobile_id;
    	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_user_update`(
        IN p_user_id int(11) unsigned,
        IN p_first_name varCHAR(100),
        IN p_last_name varCHAR(100),
        IN p_middle_init varCHAR(3)
    )
BEGIN

    UPDATE user SET `first_name` = p_first_name, `middle_init` = p_middle_init, `last_name` = p_last_name where `user_id` = p_user_id;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_zip_get`(
    IN p_zip varchar(5),
    OUT p_city varchar(50),
    OUT p_state char(2)
)
BEGIN
  select city into p_city from zip_codes where zip=p_zip;
  select state into p_state from zip_codes where zip=p_zip;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `view_account_summary`
--

/*!50001 DROP TABLE IF EXISTS `view_account_summary`*/;
/*!50001 DROP VIEW IF EXISTS `view_account_summary`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_account_summary` AS select `user_mobile`.`user_id` AS `user_id`,`user_mobile`.`mobile_id` AS `mobile_id`,`user_mobile`.`cellphone` AS `cellphone`,sum(`user_mobile`.`balance`) AS `balance`,sum(`user_mobile`.`temp_balance`) AS `temp_balance` from `user_mobile` group by `user_mobile`.`mobile_id`,`user_mobile`.`user_id`,`user_mobile`.`cellphone` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_bank_accounts`
--

/*!50001 DROP TABLE IF EXISTS `view_bank_accounts`*/;
/*!50001 DROP VIEW IF EXISTS `view_bank_accounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_bank_accounts` AS select `user_bank_account`.`user_bank_account_id` AS `id`,`user_bank_account`.`user_id` AS `user_id`,`user_bank_account`.`last4` AS `last4`,`user_bank_account`.`description` AS `description`,'2' AS `type` from `user_bank_account` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_confirmed_users`
--

/*!50001 DROP TABLE IF EXISTS `view_confirmed_users`*/;
/*!50001 DROP VIEW IF EXISTS `view_confirmed_users`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_confirmed_users` AS select `user`.`user_id` AS `user_id`,`user`.`email` AS `email`,`user`.`user_type` AS `user_type`,`user`.`password` AS `password`,`user`.`status` AS `status`,`user`.`first_name` AS `first_name`,`user`.`last_name` AS `last_name`,`user`.`middle_init` AS `middle_init`,`user`.`message_method` AS `message_method`,`user`.`email_confirmed` AS `email_confirmed`,`user`.`email_confirmation_code` AS `email_confirmation_code`,`user`.`cellphone_confirmed` AS `cellphone_confirmed`,`user`.`lock_count` AS `lock_count`,`user`.`login_code` AS `login_code`,`user`.`login_code_expires` AS `login_code_expires`,`user`.`question` AS `question`,`user`.`answer` AS `answer`,`user`.`date_added` AS `date_added`,`user`.`user_added` AS `user_added`,`user`.`date_changed` AS `date_changed`,`user`.`user_changed` AS `user_changed`,`user`.`tos_id` AS `tos_id`,`user`.`tos_accepted_date` AS `tos_accepted_date`,`user`.`merchant_id` AS `merchant_id`,`user`.`country_code` AS `country_code` from `user` where ((`user`.`date_added` < (now() + interval -(12) hour)) and (`user`.`status` = '0')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_credit_cards`
--

/*!50001 DROP TABLE IF EXISTS `view_credit_cards`*/;
/*!50001 DROP VIEW IF EXISTS `view_credit_cards`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_credit_cards` AS select `user_credit_card`.`user_credit_card_id` AS `id`,`user_credit_card`.`user_id` AS `user_id`,`user_credit_card`.`last4` AS `last4`,`user_credit_card`.`description` AS `description`,'1' AS `type` from `user_credit_card` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_current_tos`
--

/*!50001 DROP TABLE IF EXISTS `view_current_tos`*/;
/*!50001 DROP VIEW IF EXISTS `view_current_tos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_current_tos` AS select `tos`.`tos_id` AS `tos_id`,`tos`.`tos` AS `tos` from `tos` order by `tos`.`tos_id` desc limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_get_messages`
--

/*!50001 DROP TABLE IF EXISTS `view_get_messages`*/;
/*!50001 DROP VIEW IF EXISTS `view_get_messages`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_get_messages` AS select `m`.`message` AS `message`,`m`.`subject` AS `subject`,`m`.`message_type` AS `message_type`,`um`.`status` AS `status`,`um`.`mobile_id` AS `mobile_id`,`um`.`user_mobile_message_id` AS `id` from (`message` `m` join `user_mobile_message` `um`) where (`m`.`message_id` = `um`.`message_id`) limit 20 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_linked_bank_accounts`
--

/*!50001 DROP TABLE IF EXISTS `view_linked_bank_accounts`*/;
/*!50001 DROP VIEW IF EXISTS `view_linked_bank_accounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_linked_bank_accounts` AS select `ba`.`last4` AS `last4`,`ba`.`description` AS `description`,`ba`.`user_bank_account_id` AS `id`,2 AS `type`,`mc`.`mobile_id` AS `mobile_id` from (`user_mobile_bank_account` `mc` join `user_bank_account` `ba`) where (`mc`.`user_bank_account_id` = `ba`.`user_bank_account_id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_linked_credit_cards`
--

/*!50001 DROP TABLE IF EXISTS `view_linked_credit_cards`*/;
/*!50001 DROP VIEW IF EXISTS `view_linked_credit_cards`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_linked_credit_cards` AS select `cc`.`last4` AS `last4`,`cc`.`description` AS `description`,`cc`.`user_credit_card_id` AS `id`,1 AS `type`,`mc`.`mobile_id` AS `mobile_id` from (`user_mobile_credit_card` `mc` join `user_credit_card` `cc`) where (`mc`.`user_credit_card_id` = `cc`.`user_credit_card_id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_mobile_prefs`
--

/*!50001 DROP TABLE IF EXISTS `view_mobile_prefs`*/;
/*!50001 DROP VIEW IF EXISTS `view_mobile_prefs`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_mobile_prefs` AS select `user_mobile_ext`.`user_mobile_ext_id` AS `user_mobile_ext_id`,`user_mobile_ext`.`mobile_id` AS `mobile_id`,`user_mobile_ext`.`key` AS `key`,`user_mobile_ext`.`val` AS `val`,`user_mobile_ext`.`category` AS `category` from `user_mobile_ext` where (`user_mobile_ext`.`category` = '1') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_my_documents`
--

/*!50001 DROP TABLE IF EXISTS `view_my_documents`*/;
/*!50001 DROP VIEW IF EXISTS `view_my_documents`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_my_documents` AS select `doc_info`.`doc_info_id` AS `doc_info_id`,`doc_info`.`mobile_id` AS `mobile_id`,`doc_info`.`doc_type` AS `doc_type`,`doc_info`.`current_version` AS `current_version`,`doc_info`.`expiration` AS `expiration`,`doc_info`.`description` AS `description`,`doc_info`.`number` AS `number` from `doc_info` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_unconfirmed_bank_accounts`
--

/*!50001 DROP TABLE IF EXISTS `view_unconfirmed_bank_accounts`*/;
/*!50001 DROP VIEW IF EXISTS `view_unconfirmed_bank_accounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_unconfirmed_bank_accounts` AS select `user_bank_account`.`user_bank_account_id` AS `user_bank_account_id`,`user_bank_account`.`user_id` AS `user_id`,`user_bank_account`.`key_version` AS `key_version`,`user_bank_account`.`last4` AS `last4`,`user_bank_account`.`description` AS `description`,`user_bank_account`.`bank_type` AS `bank_type`,`user_bank_account`.`routing` AS `routing`,`user_bank_account`.`status` AS `status`,`user_bank_account`.`conf_amt` AS `conf_amt`,`user_bank_account`.`date_added` AS `date_added`,`user_bank_account`.`user_added` AS `user_added`,`user_bank_account`.`date_changed` AS `date_changed`,`user_bank_account`.`user_changed` AS `user_changed` from `user_bank_account` where (`user_bank_account`.`status` = '0') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_unconfirmed_credit_cards`
--

/*!50001 DROP TABLE IF EXISTS `view_unconfirmed_credit_cards`*/;
/*!50001 DROP VIEW IF EXISTS `view_unconfirmed_credit_cards`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_unconfirmed_credit_cards` AS select `user_credit_card`.`user_credit_card_id` AS `user_credit_card_id`,`user_credit_card`.`user_id` AS `user_id`,`user_credit_card`.`key_version` AS `key_version`,`user_credit_card`.`last4` AS `last4`,`user_credit_card`.`description` AS `description`,`user_credit_card`.`card_type` AS `card_type`,`user_credit_card`.`expire_month` AS `expire_month`,`user_credit_card`.`expire_year` AS `expire_year`,`user_credit_card`.`name_on_card` AS `name_on_card`,`user_credit_card`.`status` AS `status`,`user_credit_card`.`conf_amt` AS `conf_amt`,`user_credit_card`.`date_added` AS `date_added`,`user_credit_card`.`user_added` AS `user_added`,`user_credit_card`.`date_changed` AS `date_changed`,`user_credit_card`.`user_changed` AS `user_changed` from `user_credit_card` where (`user_credit_card`.`status` = '0') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_user_cellphones`
--

/*!50001 DROP TABLE IF EXISTS `view_user_cellphones`*/;
/*!50001 DROP VIEW IF EXISTS `view_user_cellphones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_user_cellphones` AS select `user_mobile`.`user_id` AS `user_id`,`user_mobile`.`mobile_id` AS `mobile_id`,`user_mobile`.`cellphone` AS `cellphone` from `user_mobile` where (`user_mobile`.`status` = '1') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-10-03 15:36:31