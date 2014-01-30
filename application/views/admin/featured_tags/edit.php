<article class="module width_full">
	<header>
		<h3 class="tabs_involved"><?= $featured_tag?></h3>
		<div class="submit_link">
			<input type="button" value="Back" onclick="location.href='<?php echo site_url("admin/featured_tags")?>'">
		</div>
	</header>
<?php
	echo $featured_tag->render_form(array(
			'name',
		)
	);
?>
</article>