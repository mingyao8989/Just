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
		
		<tr>
			<td>parent_id</td>
			<td class="edit">
				<textarea name="parent_id"></textarea>
			</td>
		</tr>
		
		<tr>
			<td>contents</td>
			<td class="edit">
				<textarea name="contents"></textarea>
			</td>
		</tr>
		
		<tr>
			<td>photo</td>
			<td class="edit">
				<input type="text" name="photo" />
			</td>
		</tr>
		
		<tr>
			<td>audio</td>
			<td class="edit">
				<input type="text" name="audio" />
			</td>
		</tr>
		
		<tr>
			<td>audio_time</td>
			<td class="edit">
				<input type="text" name="audio_time" />
			</td>
		</tr>
		
		<tr>
			<td>video</td>
			<td class="edit">
				<input type="text" name="video" />
			</td>
		</tr>
		
		<tr>
			<td>video_time</td>
			<td class="edit">
				<input type="text" name="video_time" />
			</td>
		</tr>
		
		<tr>
			<td>location</td>
			<td class="edit">
				<input type="text" name="location" />
			</td>
		</tr>
		
		<tr>
			<td>latitude</td>
			<td class="edit">
				<input type="text" name="latitude" />
			</td>
		</tr>
		
		<tr>
			<td>longitude</td>
			<td class="edit">
				<input type="text" name="longitude" />
			</td>
		</tr>
		
		<tr>
			<td>share_faceboook</td>
			<td class="edit">
				<select name="share_facebook">
					<option value="Y">Y</option>
					<option value="N" selected="selected">N</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>share_twitter</td>
			<td class="edit">
				<select name="share_twitter">
					<option value="Y">Y</option>
					<option value="N" selected="selected">N</option>
				</select>
			</td>
		</tr>
		
		<tr height="35px">
			<td></td>
			<td class="edit">
				<input type="submit" value="  Upload " />
			</td>
		</tr>
	</table>

</form>

<b>Result: </b>
<iframe name="result" style="width: 100%; height: 400px;"></iframe>

</body>
</html>