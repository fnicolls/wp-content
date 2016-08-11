<div class="wrap">

	<h1>Fern Say Hello! Announcement Bar</h1>
	<p>thank you for joining me here today, i'm so glad you could make it</p>
	<form action="options.php" method="post">
	<?php 
	//connect this form to the settings group in the db
	settings_fields('fern_ab_group'); 
	$values = get_option( 'fern_bar' );
	?>
	<table>
		<tr>
		<th scope="row">
			<label>Text for bar</label>
		</th>
		</tr>
		<tr><td>
			<input type="text" name="fern_bar[bartext]" value="<?php echo $values['bartext'] ?>">
		</td></tr>
		
		<tr>
		<th scope="row">
			<label>Url for button</label>
		</th>
		</tr>
		<tr><td>
			<input type="url" name="fern_bar[url]" value="<?php echo $values['url'] ?>">
		</td></tr>

		<tr>
		<th scope="row">
			<label>Link text</label>
		</th>
		</tr>
		<tr><td>
			<input type="text" name="fern_bar[urltext]" value="<?php echo $values['urltext'] ?>">
		</td></tr>

		<tr>
		<th scope="row">
			<label>Bar color</label>
		</th>
		</tr>
		<tr><td>
			<input type="color" name="fern_bar[bgcolor]" value="<?php echo $values['bgcolor'] ?>">
		</td></tr>

	</table>
		<?php submit_button( 'Save Settings' ); ?>
	</form>

</div>