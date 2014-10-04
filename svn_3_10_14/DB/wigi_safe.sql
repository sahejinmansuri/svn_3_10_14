-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: wigi_safe
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
-- Table structure for table `doc_data`
--

DROP TABLE IF EXISTS `doc_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc_data` (
  `doc_data_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doc_info_id` int(10) unsigned DEFAULT NULL,
  `version` smallint(5) unsigned DEFAULT NULL,
  `key_version` tinyint(3) unsigned DEFAULT NULL,
  `doc_data` blob,
  PRIMARY KEY (`doc_data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_data`
--

LOCK TABLES `doc_data` WRITE;
/*!40000 ALTER TABLE `doc_data` DISABLE KEYS */;
INSERT INTO `doc_data` VALUES (1,2,3,1,'QUKk9vMfVUcnBIaJkl8JFGjHBhZBmZTXXN1a4wpoqH8OZpsxYAScO+QLcDDEOS5goooYY40Q9P3SNKMwztWHdRfKD/Id/RYpO5ys0ko97F6sW4QJ3NyHWsorv4rTf/9O/dMDXjUoAcIb5jXviaDbgLBCIbgPeyKsawAH0j/5UnI='),(2,3,2,1,'W2GTk6nt/e0M9M0Y1OFo79bLPTPsFAkBdUuY9jzba+I9nJkzKLHY9pjVycTgKSypQk60yH/yyMBDPdZe07RIF06Yvr1jK/nEWVCnfiCEvr/55Um5Cbs53KOTtKRltJhemXWkRUz5zwQb67GXeATrXNLNaZrv0eyY7T3yIAOdh8g='),(3,4,2,1,'oYB/Eba+5nmHi96qCCoRGoyW+lqMcr7udUPqHOzLLibjWAnuaNkleI+DMMCYFCRaO5M2UqN0tHHgVJcX0ZUReONOgoyyU7aBEWkfWqITn1yh37D34Orzoey9E8v48HmWekjv1W8A++PNDydvSZ3yruUT/d2ncNGRfQRnuDWM/dc='),(4,5,1,1,'w9OMtmqKBT1JNhg0w9MRAw223cHFDaCPJ5/sOAfQ0OjMDi/WqwuCgQwnEYFGyknQu8jojzgqZKkpnDgxwGZs+ucnTb64WL2LyUVPSYzNE9hr3gH0kiulFz1Og/zpoAJyNbhQJKabGiXUP6jiRHw0vKxs66KaOHzWzCImQgwMtY4='),(5,6,2,1,'EVt5nznGAG+lWMtN07KMlw/EcJ3Nf12QlrCHvGNbyIU/A2c/H5YgttsYBxYhdh9EObOU1zCNJ/wMhDqK3PqN6bRc/vUMnNeLXads3HpvjIp8gOWnHQTuy9rzZv4OrJdni/nHt/djI5EtgKIWXTHNP1VeqcQACwViG6JHR8S26+s='),(6,7,1,1,'ZLUXf3QSy+0mScOyINb9J409E22JWA8Lt8HSzJ6Apn90/aUMHrCmeszHaiCiV3KtOHv0ssDttzRDpaWKJOUnnP96grwLEr+C8LaR7B/PFLR/X6mLJEfjP9UrZ6r8pZ2CZyyRgECmg/72uAMK69zC6PlNJtFnTF7ygem3kPRPomU='),(7,8,1,1,'b1rJXU0bTwsRr3VVt2mTbp1tnnpmUxox5LNBUUoBvJnLxMTMAgqtQEEFxQBKQR4bKbhRUsSpf/KS0afSSA4Vm0WGuxFNIfkF3H1n4h5AdKAgNnnmzQB7zwjmJmuP7TL9KNBTAa5SynCc1by004lqWFeBwKfMZuf5bFAR1lBkFiA='),(8,9,1,1,'iAkEwTm4DRLJRlX/7wZ5iro9RoIS7gkA3Sf54gEX6Bsp+nPEDCSRP1nDn8Jxw4HBsnE3myLO1vjYcd4PJHmZ7D2lkO5Q5Wt6yBww9jI/j3UoErvFLgQorYFC5lUsOZS8ZsDsSBACY+zvXfWLPzS/CHq6lMM8WquXyVX8gc8QmUg='),(9,10,1,1,'lwwzhEYx2Ka/V7zP+cN4tI0Z+Z/uPFamfbkfa7OAgy0OfvF+COxTuFPaJcQnLTw9y5hzue1tTJkSnFg6YOcg5vcRJkvNjNP4gG1w3s3foUNRYCidL1OW92OZWm2BT/krq6z7gBbidVSjmpC2j0j6qLMQzZ6JSzMOIkOLXCBjEHE='),(10,11,1,1,'Lv2Kp6MjkjrYoQtMZG2Su0MIGktJ60SYdeUMzGwd+qedxKCvXaYM2Hw/FqeptZu6HYCoZ7CF6Z23WdlUvp4AyatjPj3vbVZxyO9fMsdpbAiN/0Uqln/4mGVizQ6Dek6m7eJPJYhwNU49iZ5TKhvDeq9/sJu/GNSa1ibo0j1D2dM='),(11,12,1,1,'HqD84n0/5nyBLNTPUK3xiWaToMpaXdMBaSaF+L5cwS8B+J1BCiP/ykvOrkLnRoJy0J+VBPsK42tZNNjXzPQbiRpi9S+j3yw6MlwWya82+QETruvYcpzWk/WsIAIv+qfgjDWDIMwLxVneJFooZxNdx1NT7Gp8zWA7MRY2iboiG0Q='),(12,13,1,1,'rOvtjiDr2TBqL6Y6aAmKzvGUGtHIWXOqk5bkGzUkQx2WSEsUKoZz0m24ocl23nvJPRNGMFYWy1Y6eq5IT3LMMaMK4vdMDl9BvlmhvK5Ec/aF0AFEo43Rs8Qa1o1LpTILLzX2YwZ3m/MYMSEC7DcFHXuM8EmWKD9uVBZOnOEqhbg='),(13,14,1,1,'G1Mbwy+b0V2utSHsDL2CfgfTqKckNaXImXSo7j4k0HYF5a7yJIbp1D48wCygpbz6wfHr8a1YQPYPkkskwrg+E7V3GGiIGwFi7gDulWzebPhsK642ABU3VNB74T/IzhIGnVnO3KFsr9ahHtBefNa3qX2QvMZuzySeQRIxmCC+Zb4='),(14,15,1,1,'nDCOCAfXeauR1GTi6jCjHLMRbefieYOXAQcUIP6ibNDc+XSUOYhdREyOd9eG9V9GAfmLDF5je+pUbQCuzj6TiXk2bm+r8GzREWR1t5LAgc2a0wq/9eg2F/Ofh+AYiZVU9ZqflcVcLSNSNF2AuM1WJksyt4MJTNoz/s2B9xgh+0k='),(15,16,1,1,'mLjxwqt64kC/lTkZYMMqI5ZtNVEknt8ateqPJ9qIgc/SZc+CexyJx/cUOhkySpElEbSJY+OdbF1iRfxQ+oeCLNfOScQAV6xfzRvioJu91PRU28Fjv5qwAJR6OI42u9OgyNYNCuDm74gDNS8m+HvaRC45bK+nwDb5JVWESKLhbsc='),(16,17,1,1,'IoSD/1av18/nuaTb71tjsX8YI9Fd409R5INoamK3lOBou2WUik8+vO5ek8p+xplUKACZWom6XSrkMnceHN/51Rd1tmsdyclcs0Ks68vwjx0GY6QyKRV20a9IjIY+Fb2CdU4XSaFu/u3BMp2vNq67h0WCvwK/rRGU8vVI8fvq5xA=');
/*!40000 ALTER TABLE `doc_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_bank_account`
--

DROP TABLE IF EXISTS `user_bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_bank_account` (
  `user_bank_account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `bank_account` varchar(1024) NOT NULL,
  `key_version` tinyint(3) unsigned NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_added` varchar(60) DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_bank_account_id`),
  KEY `ix_bank_account_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_bank_account`
--

LOCK TABLES `user_bank_account` WRITE;
/*!40000 ALTER TABLE `user_bank_account` DISABLE KEYS */;
INSERT INTO `user_bank_account` VALUES (8,3,'UGGluCbYwMWFnUUn17/2DNwGz6q5DnSX5hilI3/+sJmz40FLy3TNpJ22wKhwFit/4Y05jZsF6Pybi53Jt7gOMC23jS+Mp14tPotuEZ+5z/SiG8+UCKCge6m08iupyHr/J8Nrw0kZnySEXAJN9Gj40RuUtNaMxK9Z7J7N/rYQFGw=',1,'2011-08-26 17:12:47','USERNAME','2011-08-26 21:12:47','USERNAME'),(9,1,'sP6gAchsHv+274V56SPOzCtjJ+6VyMoIphhPoGFDwqCUGFHF42I5+mzYJAB5buORxY05rRAlpOnPnjJ/Iz+UhZRm1E0bO2iGxZDy4WjFqX7je4K9viPbDtFh+Gfs4Xu0PX5pBXtzPR18doM2bK0FyNJbH83SFbXQCjcJ2nz/76M=',1,'2011-08-26 18:21:05','USERNAME','2011-08-26 22:21:05','USERNAME'),(10,2,'XTq0zGxY9krgzDXpfdnKWyBEQUr3c3EZFletCkRpqqi/V8itxueWWoc4tDYQxOreV0D19D0ygFSDBaCTnGOQ9yD9nNUKsF0z6YZPpcBDqGFm1ci0OdIkrHfAPrkpk2os+tHGnaBKhw8/AKGbAUQ7cMNb9VJbYbzV3e3jrdNW1vU=',1,'2011-08-26 18:24:22','USERNAME','2011-08-26 22:24:22','USERNAME'),(11,1,'X6U2GGwt1ya6Zo0AKXrKLsGGeXDm5gA+Yb1y6XQ4U2tN5n3Atcfm4C+Q9w1mym5onOPOWfkSqcYh3KIvSu6puXumrX2rcgyoAlmjQl2dl1m2AKwOlXLH732wQ3KBHZ33Ti2xvPeYc11XBKNWDhLQM5hE71+ymQA9TQVL56hzX48=',1,'2011-08-26 18:27:25','USERNAME','2011-08-26 22:27:25','USERNAME'),(12,2,'vV0Y65c5UVeVrKPW0zVLBWRDYKoapBahNU9tDgXgv/w27JYMPuVSz/yI1LhhMgzMFEWUAIBJebTrGH4QbYb/t16skvNn6IOzweBGTkASlXZW/OUEJgEQTuEPj5EoJFkGFTKo1lO22SYZ4ADj2uqvg/5mPRkrw5J77H5TYuTvmeE=',1,'2011-08-27 14:17:26','USERNAME','2011-08-27 18:17:26','USERNAME'),(13,2,'tBykQ7wole0Eqniq7HRWzRNdTDl5OQOWT7BxR+7bQY5f/0T+GZxVeWtSeVFJvH26EIVeZiD5wLS8GHvnDVUeoQ6ZhjHSl8+KahXJr2akYjmmIhS28e6PMO+/8NkLqs/LjvXDOXsGDpP6oCOH4Me1LxwlImToH97DapeU2BQPZn8=',1,'2011-08-27 14:17:41','USERNAME','2011-08-27 18:17:41','USERNAME'),(14,2,'kpoXEz1/KY1GhZe6YCknwN3HxNsdAnVDpHxL5TvdUzxBsacimUHFeYfti9mnRB8nr0zMFgpIg7QXgEY5dvQsT7q1+CXrzSJWDM1Y1dLZOroe/vGcHSuB/3eAi5TcDqrTOfVOryAVQMP1f5WrnzDfYLO728/zeEguck8uJz/vP0A=',1,'2011-08-27 15:43:42','USERNAME','2011-08-27 19:43:42','USERNAME'),(15,2,'sg6VRPocolWVtO9kx92m886Yt3f1dBB8jGbJwHCutDhlRKP51liUJKeBakBoXsu4QboisvChr5Kvqrtf1HB9g6TgsEBvH6cbwLd9z0yQeq2GOTFvKf0Afkb1gkRtoxUzE9HiKfprSnfSQeZP4SGnI/UPrwK6IVuPj3qr0ufkc+I=',1,'2011-08-27 15:46:31','USERNAME','2011-08-27 19:46:31','USERNAME'),(16,2,'dmUE6W/Qf7LKu0Vt7XrS8TQ3FhcS2ecz26IA/6Qt+gBTFhy+Va6ZzUHVat00resdhf4GyDrfNZ9WGvxM7cMDEXJtTrEo/o+anAOL4WOZDlzqRAfTT1XU4jBurB9KgDGO8Rff1EmcM8SPP/uGrVqG0XihGVrZp+BpqE8n7QBma24=',1,'2011-08-27 15:54:36','USERNAME','2011-08-27 19:54:36','USERNAME'),(17,1,'4111111111111111',1,'2011-09-21 13:27:28','myusername','2011-09-21 17:27:28','myusername'),(18,1,'4111111111111111',1,'2011-09-21 13:31:49','myusername','2011-09-21 17:31:49','myusername'),(19,1,'4111111111111111',1,'2011-09-21 13:31:51','myusername','2011-09-21 17:31:51','myusername'),(20,1,'4111111111111111',1,'2011-09-21 13:31:52','myusername','2011-09-21 17:31:52','myusername'),(21,1,'4111111111111111',1,'2011-09-21 13:32:40','myusername','2011-09-21 17:32:40','myusername'),(22,1,'4111111111111111',1,'2011-09-21 13:32:48','myusername','2011-09-21 17:32:48','myusername'),(23,95,'Yp/BGRD4rN8Ix/ky/fcSfzHHD7OMbH0qG7qp/KzXAeE1FEsDR6Y1qpVwokRdAhF2n4fCqW9Bq4B2vLlpQTPZd7q5uyIqN9k0v2r+u6MaGToImhmgWGPEy7YTwoHLtzc2vIjqJrqTw/zb6JDl3q1tZp0QdvOU4HwqlpIW6FXIZl0=',1,'2011-09-21 13:33:42','USERNAME','2011-09-21 17:33:42','USERNAME'),(24,95,'h1eAGQx9IH5t+RKN2PlJh2iH021wyx1c0VCNJndDohNXiFBY0ypOUdr6lB7hdc+qQ3J2G9Ii0qWtvSIggwMyrc4vxNm9xdd7cS6sXMCq/chI8vq7sElqEJ2DNP/1EYljpT8I3slPIsD2mGSK6hiKLdKwSt3mj4TVkAEwf8TS1Rk=',1,'2011-09-21 13:33:45','USERNAME','2011-09-21 17:33:45','USERNAME'),(25,95,'M6n5ueWCEWyO+igQeAMZDhYKuqiPm3qSWNqtChX4jV96ZTDbwKZHyJmb5/28BmaCARd4gOaUCUlNq3bLyfusNxMdRGxfc+hJ36qJS+syiUtJ6Epw8MuF1EEydpjVflJyflqPVW2ksit+wner57gjvWKikDIKJSebew8gk90YsP8=',1,'2011-09-21 13:34:41','USERNAME','2011-09-21 17:34:41','USERNAME'),(26,95,'wvucqpGstyCg974HkvE9mvzsc2mHxASoM84MFTs9VwQsKBmN3vu3iflh9STHjLr+g1nCvoOG4Wi7pYBo6rbl1Ahx2+GmxjcHF0NpnxIcUAvI161MM3lH4/Ou6L7IK4ZDubTCmQVrdx0UACKcSkuMwB5Eff+PPfw+/XPxGq1NgNk=',1,'2011-09-21 14:06:24','USERNAME','2011-09-21 18:06:24','USERNAME'),(27,95,'YJ0NNAYebh1HdydJDDA+KGk6WFUoECkB/aEEFb73d0qnE8QesCzk0pgdnV+ghTd+/hfmhFx09peWcxmeYfjCRbo96XtJGMZKVHsvGKgEQEdynbLU3sVMRW/+GvWOHOU6qLWb7E5+45rUIvpy/nqdTjyc1it2GTSlHDJDQYxendg=',1,'2011-09-21 14:08:06','USERNAME','2011-09-21 18:08:06','USERNAME'),(28,95,'C6PmaWqNKG3vukzQSon+2XGNkZ+OQQ1OCK1zo5x15QNKKuDNjZ/WceK7VpYI5YPMk5gEsBwf2T2npx051PC7lCC2Th0qEcoR0tCpNLBKmyMtDGz2XF1NVRuiLC3Kq95q5PA3eLZyrDLHuPetQ/JPZWHKtJec3KXjewFqWQwV1Hw=',1,'2011-09-21 18:01:29','USERNAME','2011-09-21 22:01:29','USERNAME'),(29,95,'T2JmurBsd/OzOSV1WoVgeN80k8deInr0+zNtNrC525mpD1ObZ2eqE22LkY0XyHk9FxpNiAJtnpNFasNJxCa51vs+s8sMNVfL6u2jpRTJp/qunc6S5dyRsDget9sFj6ofg/BmwzYir6kjDesHmlV1QBGsNTVkAVKgvuBPhCwqd6o=',1,'2011-09-21 18:01:42','USERNAME','2011-09-21 22:01:42','USERNAME'),(30,95,'HsqxactADQja/U6dRYht385WQaIQt/5557Wc8+l5HLeRd8XKvv64wSZaXV/B7osnR2T9yMh1xLIbyxfrVb76RDEF6HJ00wsyOXWu2RArwLXJ8QmF2KVK/iHqFArTBX+GE3A4sl8hk4SVhWyHbh4WgXR751Kqnny8kefGzrD4ETs=',1,'2011-09-21 18:01:58','USERNAME','2011-09-21 22:01:58','USERNAME'),(31,95,'DT3oOYpi+j5vmjFBJHvkFbuScEUvGK6Kb2W/nG+UHIg5pcftt1IuyGf1IORwAZzvmF6ft6+6lgWvhVWMQ4ET5PEbDHB6nmxPZ3tEx8vsBV32TvB7ph7rRPEqPve25emKGUJXfRHcavUDpYUkUrZIh51mH4qqzqNMwwlucmJJScs=',1,'2011-10-01 01:50:45','chrisbaechle@gmail.com','2011-10-01 05:50:45','chrisbaechle@gmail.com'),(32,95,'R+qnlqxjp1l1uEXxZTiFUCtQLiDEIBdtjRYsQ5bVva0q4mEfZrL0yhcT8Gc97mGJ8evo9TrCwVXe090qdqqoZoqLoCgNEnq/SITKpQzzgIzDaDDjObrVSiI9d/I7PdZHRjBxxgmej7EguYNvnzC+fGUPR1hlnfjSf604w612S00=',1,'2011-10-01 01:51:08','chrisbaechle@gmail.com','2011-10-01 05:51:08','chrisbaechle@gmail.com');
/*!40000 ALTER TABLE `user_bank_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_credit_card`
--

DROP TABLE IF EXISTS `user_credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_credit_card` (
  `user_credit_card_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `credit_card` text NOT NULL,
  `key_version` tinyint(3) unsigned NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `user_added` text,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_changed` text,
  PRIMARY KEY (`user_credit_card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_credit_card`
--

LOCK TABLES `user_credit_card` WRITE;
/*!40000 ALTER TABLE `user_credit_card` DISABLE KEYS */;
INSERT INTO `user_credit_card` VALUES (11,2,'GrR+wU8MMzqaJI9IVj7i/F9SCPHDDDfAkMYCMKUr6pb8ApNoTuTx1vK/wHHjfGkH3w2nR3zb9LAA8CK7i6DbHvAiva98sp3HBAabu7sEXimgdXOx67XvaWY7S1c1U9ehcsnrCmwBgGIsmzjzN2mkbF5W9Bckbp0kLrbiQvFY4PY=',1,'2011-08-26 17:06:34','USERNAME','2011-08-26 21:06:34','USERNAME'),(12,3,'DEKRwFsisK9xSYXpHldCFwJTcCFlwrNJxy6Iz9PQhtfip3FY33vZwCU9Y6UCJEMqemiQjHxdDmS1Xa53C11lM7xuxGvhnlRYX8pgoLq+gLt9kWxiBWXL53UTtlgX+hFbMTZDYtxfdi/+8Ki5gyP5yIGrjhJC2t3QM8tOR/w3+cU=',1,'2011-08-26 17:09:42','USERNAME','2011-08-26 21:09:42','USERNAME'),(13,3,'b7xB/fmUaAHRnsekf9V1TnnP1j1Ujejdkhevxuwsx37kD3ohdPsoTktE+AOCeafjfKcH8ArHE92FPnaF9Q3EMTTKJiI66VdCgm0mtYndlOjpHJB8VvwDEZH8I1eTVuhlkDRz52b0AbBkYWpuA2bW/3+M2wkJSANTej5o25c554c=',1,'2011-08-26 17:10:20','USERNAME','2011-08-26 21:10:20','USERNAME'),(14,1,'m86PNZFSfv32umDqYssoX879yWAYD8xwlCeW8NW2lMe9hkDGAOoB4ngkFPDkorvBqPCgl1qdu8JaZX4MDoJCxyyy6hR06PD36bltE5fdSulswVtalvRrBM4XvanJcT6w9fjkYC32c8yrVFXtnfHyQ6Wys8c6ej1FvikoStBSyt0=',1,'2011-08-26 18:00:22','USERNAME','2011-08-26 22:00:22','USERNAME'),(15,1,'MmM6nZs0cVxuflIedc4r4sTjMUqKrTgj67vEISdkzcgy55CrLATvaLlVangrivIGhg0PzlC7nHF35mYJG7tkOdeWi0m1QGaZtwofbQ9+EgyTPwlFqIHC8i2HCpi0IIDlbDzbb8pYVinQ6PmzsQPYWCVUe0wYlpMPc1dSezqxNRM=',1,'2011-08-26 18:01:57','USERNAME','2011-08-26 22:01:57','USERNAME'),(16,1,'eiT8IfRRPHbZE479gFGo2z/QUb9zuhuj1MrUPlXE/gK/oc2Vz7syLVQLRhaXROdbjDv6BkgS7EunSqXH5vmTa3jt0lyx4QsM/HsjmcvL4iSJl41ENB/Ui+ot18UeU656vjo91lv7HEd2OK0lgALEJE0YxBfbiYwQD62lqx7byfE=',1,'2011-08-26 18:08:29','USERNAME','2011-08-26 22:08:29','USERNAME'),(17,2,'XqhbfOFROLFdTA01qIDsiESUI4AsyIK0gfL8mGFe6MmpeEDZSbGWmJXe5PX1Sk5aDK7rL6HPTJpJOypAO9jbomBu5HAsaT4ofLBezK5Q+eO8ObvnlWA9AXZeS0A4csYT0/UlGyECEC6iujpVHkSiMKEt0au+qwV1axB9YXUlMW4=',1,'2011-08-26 21:52:15','USERNAME','2011-08-27 01:52:15','USERNAME'),(18,2,'dIncxE53k7mYexJoRJP7uKnBVPKYjw89mxg2IGKwtnUuhP6BdnBoj++kw6FzouGqEGjZ33/KJz9bWMQyVDU9ZXwSbN50BhJZ+n2fWmlQ0ebMHcgTk39JfMPWw5NBI1bEMy2KimK7cuQ0w9dZziDmkJmtZj4s/i0M+CnhUOIIVfY=',1,'2011-08-26 22:00:19','USERNAME','2011-08-27 02:00:19','USERNAME'),(19,2,'pu0hUQSk8FomvbXf/91K+/uhaQk0LrpWMAISElR3kgsjCREkapc2pOpjClQv3RRWmlB6ypYBQlwiHpe1Ks2zxNU/og0r9qeu8dZmRGSJLfyB7fP0snQc0IR4BdUP4lh6jv2r32GFRUeKL7+D5sBQ/sAgObbNG9P59IY1TZ876yA=',1,'2011-08-31 11:07:59','USERNAME','2011-08-31 15:07:59','USERNAME'),(20,1,'12345678',1,'2011-09-20 15:17:11','chrisbaechle@gmail.com','2011-09-20 19:17:11','chrisbaechle@gmail.com'),(21,1,'12345678',1,'2011-09-20 15:17:34','chrisbaechle@gmail.com','2011-09-20 19:17:34','chrisbaechle@gmail.com'),(22,1,'12345678',1,'2011-09-20 15:26:01','chrisbaechle@gmail.com','2011-09-20 19:26:01','chrisbaechle@gmail.com'),(23,1,'12345678',1,'2011-09-20 15:26:03','chrisbaechle@gmail.com','2011-09-20 19:26:03','chrisbaechle@gmail.com'),(24,95,'123456789',1,'2011-09-20 18:17:04','USERNAME','2011-09-20 22:17:04','USERNAME'),(25,95,'123456789',1,'2011-09-20 18:22:44','USERNAME','2011-09-20 22:22:44','USERNAME'),(26,95,'123456789',1,'2011-09-20 18:23:14','USERNAME','2011-09-20 22:23:14','USERNAME'),(27,95,'123456789',1,'2011-09-20 18:23:44','USERNAME','2011-09-20 22:23:44','USERNAME'),(28,95,'123456789',1,'2011-09-20 18:24:13','USERNAME','2011-09-20 22:24:13','USERNAME'),(29,95,'123456789',1,'2011-09-20 18:24:33','USERNAME','2011-09-20 22:24:33','USERNAME'),(30,95,'123456789',1,'2011-09-20 18:25:54','USERNAME','2011-09-20 22:25:54','USERNAME'),(31,95,'123456789',1,'2011-09-20 18:26:55','USERNAME','2011-09-20 22:26:55','USERNAME'),(32,95,'123456789',1,'2011-09-20 18:27:02','USERNAME','2011-09-20 22:27:02','USERNAME'),(33,95,'123456789',1,'2011-09-20 18:28:25','USERNAME','2011-09-20 22:28:25','USERNAME'),(34,95,'123456789',1,'2011-09-20 18:31:30','USERNAME','2011-09-20 22:31:30','USERNAME'),(35,95,'123456789',1,'2011-09-20 18:32:50','USERNAME','2011-09-20 22:32:50','USERNAME'),(36,95,'123456789',1,'2011-09-20 18:35:55','USERNAME','2011-09-20 22:35:55','USERNAME'),(37,95,'123456789',1,'2011-09-20 18:35:57','USERNAME','2011-09-20 22:35:57','USERNAME'),(38,95,'123456789',1,'2011-09-20 18:38:20','USERNAME','2011-09-20 22:38:20','USERNAME'),(39,95,'123456789',1,'2011-09-20 18:38:34','USERNAME','2011-09-20 22:38:34','USERNAME'),(40,95,'123456789',1,'2011-09-20 18:40:24','USERNAME','2011-09-20 22:40:24','USERNAME'),(41,95,'123456789',1,'2011-09-20 18:44:57','USERNAME','2011-09-20 22:44:57','USERNAME'),(42,95,'123456789',1,'2011-09-20 18:49:00','USERNAME','2011-09-20 22:49:00','USERNAME'),(43,95,'123456789',1,'2011-09-20 18:49:43','USERNAME','2011-09-20 22:49:43','USERNAME'),(44,95,'123456789',1,'2011-09-20 18:52:21','USERNAME','2011-09-20 22:52:21','USERNAME'),(45,95,'123456789',1,'2011-09-20 18:52:54','USERNAME','2011-09-20 22:52:54','USERNAME'),(46,95,'123456789',1,'2011-09-20 18:52:58','USERNAME','2011-09-20 22:52:58','USERNAME'),(47,95,'123456789',1,'2011-09-20 18:53:45','USERNAME','2011-09-20 22:53:45','USERNAME'),(48,95,'123456789',1,'2011-09-20 18:55:58','USERNAME','2011-09-20 22:55:58','USERNAME'),(49,95,'123456789',1,'2011-09-20 18:56:14','USERNAME','2011-09-20 22:56:14','USERNAME'),(50,95,'123456789',1,'2011-09-20 18:56:45','USERNAME','2011-09-20 22:56:45','USERNAME'),(51,95,'123456789',1,'2011-09-20 18:56:47','USERNAME','2011-09-20 22:56:47','USERNAME'),(52,95,'123456789',1,'2011-09-20 18:56:54','USERNAME','2011-09-20 22:56:54','USERNAME'),(53,95,'123456789',1,'2011-09-20 18:57:19','USERNAME','2011-09-20 22:57:19','USERNAME'),(54,95,'123456789',1,'2011-09-20 19:01:36','USERNAME','2011-09-20 23:01:36','USERNAME'),(55,95,'123456789',1,'2011-09-20 19:01:38','USERNAME','2011-09-20 23:01:38','USERNAME'),(56,95,'123456789',1,'2011-09-20 19:29:42','USERNAME','2011-09-20 23:29:42','USERNAME'),(57,95,'TSJYPEeBltWaW0gbd1TsMzhyMagb4wWhEKY0oPCAFWyyBj6rsOkcZvAZiYRk1RaVAyi7IEv9ShrHPX+v6ixm75OXQBFcnCV9LKP3wfAQRQ7CbU5RmNpIkbJvIkbwTd9WuhMBpJQvnScNONuAiycMBqOLbRwm7bn8HZM1Tf+87dI=',1,'2011-09-20 19:36:58','USERNAME','2011-09-20 23:36:58','USERNAME'),(58,95,'ZBxjGhQVQDJ3TF7WyxQ8OZBOjtQBJe6BmvnOssmTS7tlxnvSg1bSo9qQaw+yKVt2LcthFJ+VLM4yGC+cB26oDtW+5gJkOahLP10KNXENw1CdSw9puwLt8fG06GMseNWk+pmeROZ3UW/C3AvTLtgFdU5uZmdwNLhgY7B+hJkLVGs=',1,'2011-09-21 13:02:20','USERNAME','2011-09-21 17:02:20','USERNAME'),(59,95,'hNT7Cifdozhcf2AC2HGljNwZOR6rUMYImgnYecbK557a8pstUOAaW9vu4K3GnkKmUoWL/XruNCLt/uuSxaxykkR21wXUskQSuw3vDQ7BbbqyRKzPpUVRgwmwPT+lXazdZOfr0gWQtgGPEsouf2ZnR/DuNEECieWa8ttUJikk1MU=',1,'2011-09-21 14:35:51','USERNAME','2011-09-21 18:35:51','USERNAME'),(60,95,'rb/25vaTYpT2vK9MhhKd3AYGZpzmetYJItLCEVCbNd+fHtKSQMyjXvXvTdWooxtoCtPUN0ukYPW+F0U94Oh8YTA4Q8S9hzsce+gdkU9I8y3Mnw5wWvKIbC83XBCl8IXi5SLGUWD2KiDJCuGIZxKDiYvUusSdRV8xKL+ZTkGcK/0=',1,'2011-09-21 14:38:21','USERNAME','2011-09-21 18:38:21','USERNAME'),(61,95,'tvk7D0wn+BdI3tC7vKges9emeHqHaTtLCZ1mQHUmqlva67XWhiWQtPIGVlztukgFuitKAh4piKvwOAIPrKbHE8pXOik3GenR+wxboMVKPK0MiLjT590XP7bikIb/LaYjMVY7Z9I9AgnudeRv3QtwOgWjS2WBlcY7r3qv++05EWk=',1,'2011-09-21 14:39:57','USERNAME','2011-09-21 18:39:57','USERNAME'),(62,95,'by2Mg/P7nMpE6i6m9zU5EzQdeBoIHwImc99R1Tu3e3hjdLDgpF7w7FDoYE0H/XDtxye2ELf4u2SDStMquvShZxEVLRZzqlZzrQU2TefRLDu/yUi9sEIKR+LrvnTWGO8hzFX+NeSYxTfs9KKE5n3FpA+GShm6P44SEecdl4MVrM4=',1,'2011-09-21 14:41:08','USERNAME','2011-09-21 18:41:08','USERNAME'),(63,95,'tVXxpaZeivuIEaIcFphDoE8WQk7JO1EA/7ou0/gzrN5TbiktD3gNBU/O8/C2oCbCli/4hkaP73ANOtwze2EDoA3AbWj/8zzptcmxunRIhVxZ4xiPE49/XHRu6khUQZTke70+YVym0PB9DK5cfNk2YwuJSg/wM56i+UuDA7fEvqo=',1,'2011-09-21 18:00:19','USERNAME','2011-09-21 22:00:19','USERNAME'),(64,95,'We+AVkojq0MPaSDL5C9YkRtxEzUbTSF9cgu26XCTE2q48FR1dchFxmHwvugsk6p8lABx4K2bwtWEzhVee9iBLgPHZJC/GW2JWs+aYXIXZxFCPn3a1iV4LGL4WjHU7A8c00KWBfw17Aht4aEuFRctcBdW6FmKucTu5AYyC/vZ/fc=',1,'2011-09-21 18:00:23','USERNAME','2011-09-21 22:00:23','USERNAME'),(65,95,'FJhrxQSkwucyQGcG/nNyOt/arnXVrOzNl7rzhu2XgbWpqCO7EoEYoJWbRCV8nOIH6ARJIA/ttl19vYqbZ9fW7YLSpYl0n2kN8CHpkijtkt3MfzorQtYzKBSwuHFvIhLnLDrZw3+I7ipX917olyo5rsgdgwZkOipXeTjOnCIbOcE=',1,'2011-09-21 18:00:39','USERNAME','2011-09-21 22:00:39','USERNAME'),(66,95,'LXsLzb3honTQ6dxtqnxwZjFtEIfmu0No9atRrbrFSPy4cLanokjcQQGsAQ84PZH/EqQGP9GG9RzmUeo8X0GR1HFslLPLBTDJHu6oeFCv7qyeAULey+MQf5pbJtbIZpgWNA0w/etY6jHTgiRA6wcwsRD2NFRwV4woNfSb/g2r378=',1,'2011-09-21 18:00:54','USERNAME','2011-09-21 22:00:54','USERNAME'),(67,95,'rGdRYHTWEqDOJfijwlr81jCWctbsy4MUm5ZTGs/KJOzfrH5QN6X2kwwqfDNjGJg0Gzh/A9X/4Ym3csKa2iYWDVIGJ1pxtI74CyUiyc2ttMv2m1+xD0QlXgN0baZAp3+naMaxub7rCyyu8z2RknByuqMhq2bAX19bD3O5uH5CKAk=',1,'2011-10-01 01:46:33','chrisbaechle@gmail.com','2011-10-01 05:46:33','chrisbaechle@gmail.com'),(68,95,'OpGqkkydRsbczUqGTq47G+pZ2hFBWBg3E/2leCKuChPYx8xmMtbI4dnPolR4ziiu2SoNei0Qz6Sq5Fzw1hU5S+8N1XvCkv7nfi+bPYPbljm44zSlGhC4d7CJm0qE7/zrmqxt6BO+Ue4ajTAv1AoJtDrWsP/7ZZRhlyZIoqlGZME=',1,'2011-10-01 01:46:57','chrisbaechle@gmail.com','2011-10-01 05:46:57','chrisbaechle@gmail.com');
/*!40000 ALTER TABLE `user_credit_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'wigi_safe'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_ba_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_ba_create`(
    IN p_user_id int(11) unsigned,
    IN p_bank_account text,
    IN p_key_version tinyint(3) unsigned,
    IN p_user_added text,
    OUT p_res int(11)
)
BEGIN

    INSERT INTO user_bank_account (
      `user_id`,
      `bank_account`,
      `key_version`,
      `date_added`,
      `user_added`,
      `date_changed`,
      `user_changed`
    ) values (
      p_user_id,
      p_bank_account,
      p_key_version,
      now(),
      p_user_added,
      now(),
      p_user_added
    );

    set p_res = last_insert_id();

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ba_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_ba_get`(
    IN p_user_bank_account_id int(11),
    OUT p_user_id int(11) unsigned,
    OUT p_bank_account text,
    OUT p_key_version tinyint(3) unsigned
)
BEGIN
    select     `user_id`,
               `bank_account`,
               `key_version`

    into 
               p_user_id,
               p_bank_account,
               p_key_version

     from user_bank_account where user_bank_account_id = p_user_bank_account_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cc_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_cc_create`(
    IN p_user_id int(11) unsigned,
    IN p_credit_card text,
    IN p_key_version tinyint(3) unsigned,
    IN p_user_added text,
    OUT p_res int(11)
)
BEGIN

    INSERT INTO user_credit_card (
      `user_id`,
      `credit_card`,
      `key_version`,
      `date_added`,
      `user_added`,
      `date_changed`,
      `user_changed`
    ) values (
      p_user_id,
      p_credit_card,
      p_key_version,
      now(),
      p_user_added,
      now(),
      p_user_added
    );

    set p_res = last_insert_id();

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cc_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_cc_get`(
    IN p_user_credit_card_id int(11),
    OUT p_user_id int(11) unsigned,
    OUT p_credit_card text,
    OUT p_key_version tinyint(3) unsigned
)
BEGIN
    select     `user_id`,
               `credit_card`,
               `key_version`

    into 
               p_user_id,
               p_credit_card,
               p_key_version

     from user_credit_card where user_credit_card_id = p_user_credit_card_id;
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
  IN p_doc_info_id int unsigned,
  IN p_version smallint unsigned,
  IN p_key_version tinyint unsigned,
  IN p_doc_data blob
)
BEGIN
  INSERT INTO doc_data (`doc_info_id`,`version`,`doc_data`,`key_version`) VALUES (p_doc_info_id,p_version,p_doc_data,p_key_version);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_doc_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_doc_get`(
    IN p_doc_id int(11) unsigned,
    OUT p_key_version tinyint unsigned,
    OUT p_doc_data blob
)
BEGIN
    select
               `doc_data`,`key_version`
    into 
               p_doc_data,p_key_version
     from doc_data where doc_info_id = p_doc_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-10-03 15:36:41
