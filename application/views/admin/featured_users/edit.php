<article class="module width_full">
	<header>
		<h3 class="tabs_involved"><?= $featured_user?></h3>
		<div class="submit_link">
			<input type="button" value="Back" onclick="location.href='<?php echo site_url("admin/featured_users")?>'">
		</div>
	</header>
<?php
	echo $featured_user->render_form(array(
			'sort_num',
			'user_id'
		)
	);
?>
</article>