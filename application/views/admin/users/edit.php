<article class="module width_full">
	<header>
		<h3 class="tabs_involved"><?= $user?></h3>
		<div class="submit_link">
			<input type="button" value="Back" onclick="location.href='<?php echo site_url("admin/users")?>'">
		</div>
	</header>
<?php
	echo $user->render_form(array(
			'username',
			'name',
			'email',
			'phone',
			'password',
			'confirm_password'
		)
	);
?>
</article>