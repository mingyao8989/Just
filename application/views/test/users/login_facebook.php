<html>
<title>Test web service</title>
<body>

<a href="<?= site_url("test")?>">back to menu</a>

<h1>url: <?= site_url("mobileservice/".$action)?></h1>

<form encType="multipart/form-data" method="post" id="edit_form" target="result" action="<?= site_url("mobileservice/".$action)?>">
	<table class="contents_edit" id="public_profile">
		<tr>
			<td>facebook_token</td>
			<td class="edit">
				<input type="text" name="facebook_token" style="width: 300px;" />
			</td>
		</tr>
		<tr>
			<td>os</td>
			<td class="edit">
				<select name="os">
					<option value="ios">ios</option>
					<option value="android">android</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>device</td>
			<td class="edit">
				<input type="text" name="device" style="width: 300px;" />
			</td>
		</tr>
		<tr>
			<td>timezone</td>
			<td class="edit">
				<input type="text" name="timezone" style="width: 300px;" />
			</td>
		</tr>
		
		<tr height="35px">
			<td></td>
			<td class="edit">
				<input type="submit" value="  login " />
			</td>
		</tr>
	</table>

</form>

<b>Result: </b>
<iframe name="result" style="width: 100%; height: 400px;"></iframe>

</body>
</html>