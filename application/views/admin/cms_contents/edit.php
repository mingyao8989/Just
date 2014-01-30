<article class="module width_full">
	<header>
		<h3 class="tabs_involved"><?= $cms_content?></h3>
		<div class="submit_link">
			<input type="button" value="Back" onclick="location.href='<?php echo site_url("admin/cms_contents")?>'">
		</div>
	</header>
<?php
	echo $cms_content->render_form(array(
			'key',
			'value'=>array("type"=>'textarea', 'rows'=>20),
		)
	);
?>
</article>