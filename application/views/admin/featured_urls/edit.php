<article class="module width_full">
	<header>
		<h3 class="tabs_involved"><?= $featured_url?></h3>
		<div class="submit_link">
			<input type="button" value="Back" onclick="location.href='<?php echo site_url("admin/featured_urls")?>'">
		</div>
	</header>
<?php
	echo $featured_url->render_form(array(
			'url',
		)
	);
?>
</article>