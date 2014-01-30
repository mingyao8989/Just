<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?=SITE_TITLE?> Dashboard Admin Panel</title>
	
	<link rel='stylesheet' href='static/css/jquery_ui/jquery-ui-1.8.16.custom.css' type='text/css' />
	<link rel="stylesheet" href="static/css/dashboard.css" type="text/css" media="screen" />
	<?php if ($this->agent->browser() == 'Internet Explorer'):?>
	<!--[if lt IE 9]> -->
	<link rel="stylesheet" href="static/css/ie.css" type="text/css" media="screen" />
	<script src="static/js/html5.js"></script>
	<!-- <![endif]-->
	<?php endif;?>
	<script type='text/javascript' src='static/js/jquery/jquery-1.6.2.js'></script>
	<script type='text/javascript' src='static/js/jquery/jquery-ui-1.8.16.custom.min.js'></script>
	<script type='text/javascript' src='static/js/jquery/jquery-ui-timepicker-addon.js'></script>
	<script type='text/javascript' src='static/js/jquery/jscript_jquery.validationEngine-en.js'></script>
	<script type='text/javascript' src='static/js/jquery/jscript_jquery.validationEngine.js'></script>
	
	<script src="static/js/hideshow.js>" type="text/javascript"></script>
	<script src="static/js/jquery/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="static/js/jquery/jquery.equalHeight.js"></script>
	
	<script type='text/javascript' src='static/js/general.js'></script>
	
	<script type='text/javascript'>
	/* <![CDATA[ */
		userSettings = {
			url: "<?=site_url("")?>/",
			uid: "1",
			time: "1235955367"
		}

		base_url = "<?=site_url("")?>/";
	/* ]]> */
	</script>
</head>


<body>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="<?=site_url("admin/home")?>"><?= SITE_TITLE?> Admin</a></h1>
			<h2 class="section_title">Dashboard</h2>
			<div class="btn_view_site"><a href="#">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?= $this->login_user->username?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
				<a href="<?=site_url("admin/home")?>">Admin Panel</a> 
				<?php if (is_array($this->title)):?>
					<?php for($i = 0; $i < count($this->title); $i ++):?>
						<div class="breadcrumb_divider"></div>
						<?php if(isset($this->title[$i]['url'])):?>
							<a href="<?=$this->title[$i]['url']?>"><?= $this->title[$i]['text']?></a>
						<?php else:?>
							<a class="current"><?= $this->title[$i]['text']?></a>
						<?php endif;?>
					<?php endfor;?>
				<?php else:?>
				<div class="breadcrumb_divider"></div> 
				<a class="current"><?= $this->title?></a>
				<?php endif;?>
			</article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<!-- 
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		-->
		<h3>General</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="<?= site_url("admin/users")?>">Users</a></li>
			<li class="icn_video"><a href="<?= site_url("admin/medias")?>">Medias</a></li>
			<!-- <li class="icn_categories"><a href="<?= site_url("admin/yoticons")?>">Yoticons</a></li> -->
			<li class="icn_categories"><a href="<?= site_url("admin/cms_contents")?>">CMS</a></li>
			<li class="icn_tags"><a href="<?= site_url("admin/featured_tags")?>">Featured Tags</a></li>
			<li class="icn_online_users"><a href="<?= site_url("admin/featured_users")?>">Featured Users</a></li>
			<li class="icn_sites"><a href="<?= site_url("admin/featured_urls")?>">URL Meta Data</a></li>
			<li class="icn_profile"><a href="<?= site_url("admin/users/onlineusers")?>">User Logins</a></li>
		</ul>
		<h3>Email</h3>
		<ul class="toggle">
			<li class="icn_email"><a href="#">Email Queue</a></li>
			<li class="icn_email_preview"><a href="#">Email Preview</a></li>
		</ul>
		<h3>System</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="<?= site_url("admin/configurations")?>">Options</a></li>
			<li class="icn_profile"><a href="<?= site_url("admin/profile")?>">Admin Profile</a></li>
			<li class="icn_jump_back"><a href="<?= site_url("admin/auth/logout")?>">Log Out</a></li>
		</ul>
		
		<footer>
			<!-- <hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.chengtong-yilin.com">Chengtong</a></p> -->
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		<?php my_show_error($this->session->flashdata('error'));?>
		<?php my_show_message($this->session->flashdata('message'));?>