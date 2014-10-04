<?php

session_start();
include('wp-config.php');
mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
mysql_select_db(DB_NAME);

$select=mysql_query("select * from plug_article_manager where articleId='15137'");



  
?>