<?php 
$users = new User();
$users->where("group_id", 2);
?>

<article class="module width_half">
	<header><h3>Users</h3></header>
	<div class="module_content">
		<p>- <a href="<?= site_url("admin/users")?>">Total Count: <b><?= $users->count()?></b></a></p>
		<p>- <a href="<?= site_url("admin/profile")?>">Your Profile</a></p>
	</div>
</article>

<article class="module width_half">
	<header><h3>Admin</h3></header>
	<div class="module_content">
		<p><a href="<?= site_url("admin/configurations")?>">Options</a></p>
		<p><a href="<?= site_url("admin/auth/logout")?>">Logout</a></p>
	</div>
</article>