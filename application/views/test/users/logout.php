<html>
<title>Test web service</title>
<body>

<a href="<?= site_url("test")?>">back to menu</a>

<h1>url: <?= site_url("mobileservice/".$action)?></h1>

<form encType="multipart/form-data" method="post" id="edit_form" target="result" action="<?= site_url("mobileservice/".$action)?>">
	<table class="contents_edit" id="public_profile">
		<tr>
			<td>userid</td>
			<td class="edit">
				<input type="text" name="userid" style="width: 300px;" value="<?= $this->test_appid?>" />
			</td>
		</tr>
		
		<tr>
			<td>appsecurity</td>
			<td class="edit">
				<input type="text" name="appsecurity" style="width: 300px;" value="<?= $this->test_appsecurity?>" />
			</td>
		</tr>
		
		<tr height="35px">
			<td></td>
			<td class="edit">
				<input type="submit" value="  Logout " />
			</td>
		</tr>
	</table>

</form>

<b>Result: </b>
<iframe name="result" style="width: 100%; height: 400px;"></iframe>

</body>
</html>