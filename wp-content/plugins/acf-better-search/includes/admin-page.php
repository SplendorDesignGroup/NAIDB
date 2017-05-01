<div class="wrap acfbs_option_page">
	<h1 class="wp-heading-inline">ACF: Better Search</h1>
	<div class="acf-columns-2">
		<div class="acf-column-1">
			<form method="post">
				<table class="widefat">
					<thead>
						<tr>
							<th colspan="2"><?php _e('List of supported field\'s types <span>(leave blank to use all types of fields)</span>:', 'acfbs'); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<label for="acfbs_fields_text"><?php _e('Text', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_text" name="acfbs_fields_types[]" value="text" <?php echo in_array('text', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_textarea"><?php _e('Text Area', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_textarea" name="acfbs_fields_types[]" value="textarea" <?php echo in_array('textarea', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_number"><?php _e('Number', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_number" name="acfbs_fields_types[]" value="number" <?php echo in_array('number', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_email"><?php _e('Email', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_email" name="acfbs_fields_types[]" value="email" <?php echo in_array('email', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_url"><?php _e('Url', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_url" name="acfbs_fields_types[]" value="url" <?php echo in_array('url', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_wysiwyg"><?php _e('Wysiwyg Editor', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_wysiwyg" name="acfbs_fields_types[]" value="wysiwyg" <?php echo in_array('wysiwyg', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_select"><?php _e('Select', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_select" name="acfbs_fields_types[]" value="select" <?php echo in_array('select', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_checkbox"><?php _e('Checkbox', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_checkbox" name="acfbs_fields_types[]" value="checkbox" <?php echo in_array('checkbox', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
						<tr>
							<td>
								<label for="acfbs_fields_radio"><?php _e('Radio Button', 'acfbs'); ?></label>
							</td>
							<td>
								<input type="checkbox" id="acfbs_fields_radio" name="acfbs_fields_types[]" value="radio" <?php echo in_array('radio', $this->fieldsTypes) ? 'checked=checked' : ''; ?>>
							</td>
						</tr>
					</tbody>
				</table>
				<input type="submit" class="button button-primary" name="acfbs_save" value="<?php _e('Save Changes', 'acfbs'); ?>">
			</form>
		</div>
		<div class="acf-column-2">
			<div class="acf-box">
				<table class="widefat">
					<thead>
						<tr>
							<th><?php _e('How does this work?', 'acfbs'); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p><?php _e('Plugin changes all SQL queries by extending the standard search to selected fields of Advanced Custom Fields.', 'acfbs'); ?></p>
								<p><?php _e('Advanced search works for both WP_Query class and get_posts functions.', 'acfbs'); ?></p>
								<p><?php _e('On search page this works automatically.', 'acfbs'); ?></p>
								<p><?php _e('For custom queries and get_posts function you need add <a href="https://codex.wordpress.org/Class_Reference/WP_Query#Search_Parameter" target="_blank">Search Parameter</a>.', 'acfbs'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="acf-box">
				<table class="widefat">
					<thead>
						<tr>
							<th><?php _e('Do you have an idea for a new feature?', 'acfbs'); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p><?php _e('Please let us know about it in the review. We will try to add it!', 'acfbs'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="acf-box">
				<table class="widefat">
					<thead>
						<tr>
							<th><?php _e('Like our plugin?', 'acfbs'); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p><?php _e('Thank you for all the ratings, reviews and donates.', 'acfbs'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="footer">
					<a href="https://www.paypal.me/mateuszgbiorczyk/" target="_blank">
						<img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" alt="<?php _e('Donate', 'acfbs'); ?>">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>