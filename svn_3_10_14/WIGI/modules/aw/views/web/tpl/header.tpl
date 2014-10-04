<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />
{if $logged_in == 1}
<meta name="robots" content="noindex, nofollow">
{/if}
<title>InCashMe&#8482; - Admin Web Access</title>
<link rel="shortcut icon" type="image/x-icon" href="/templates/rt_affinity_j15/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/style-page.css" />
<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/style-forms.css" />
<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/utility-icons.css" />
<script type="text/javascript" src="{$jspath}/jquery.min.js"></script>
<script type="text/javascript" src="{$jspath}/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="{$jspath}/jquery.watermark.min.js"></script>
<script type="text/javascript" src="{$jspath}/jquery.cookie.js"></script>
<script tyoe="text/javascript" src="{$jspath}/jquery.lightbox_me.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-page.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-forms.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-login.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-signup.js"></script>
{if $logged_in == 1}
<script type="text/javascript" src="{$jspath}/scripts-home.js"></script>
{/if}
</head>
<body>

<div id="main">
	
	<div id="top">
		<div class="center">
			<ul>
				{if $logged_in == 0}
				<li><a href="{$formbase}login/home/" class="login">Login</a></li>
				{/if}
				{if $logged_in == 1}
				<li><a href="{$formbase}index/logout/" class="login">Logout</a></li>
				{/if}
			</ul>
		</div>
	</div>
	<div id="header">
		<div class="center">
			<div id="logo">
				<h1><a href="{$orig_basehref}">InCashMe&#8482;<img src="{$csspath}/images/logo.png" alt="InCashMe&#8482;" /></a></h1>
			</div>
			<div id="navigation">
				{include file='menus.tpl'}
			</div>
		</div>
	</div>
	<div id="content">
		<div class="center">
			<div class="post">
				
				<div class="title_box_wide">
					<ul>
						<li><a href="{$formbase}dashboard/home">Home</a> &rsaquo;</li>
					</ul>
					<h2>InCashMe&#8482; Admin</h2>
				</div>
