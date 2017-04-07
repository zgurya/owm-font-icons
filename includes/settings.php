<form method="POST">
	<table class="form-table">
		<tr>
			<th scope="row">
				<label for="api_key"><?php _e('Open Weather Map API', 'owm-ficons')?>: </label>
			</th>
			<td>
				<input type="text" name="api_key" value="<?php echo esc_attr(get_option('owm_font_icons_api')); ?>" size="30"> <a href="https://openweathermap.org/appid" target="_blank"><?php _e('Get it here', 'owm-ficons')?></a>
			</td>
		</tr>
	</table>
	<input type="submit" value="Save" class="button button-primary button-large">
</form>
