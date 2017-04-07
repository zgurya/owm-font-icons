<?php
if(!get_option('owm_font_icons_api')||empty(get_option('owm_font_icons_api'))):?>
	<?php _e('Please, enter API key before start using informers.', 'owm-font-icons');?> <a href="<?php echo esc_url( get_admin_url(null, 'admin.php?page=owm_font_icons_settings') )?>"><?php _e('Enter it here.', 'owm-ficons');?></a>
<?php else:?>
	<div class="wrap">
		<a href="<?php echo esc_url(get_admin_url(null,'admin.php?page=owm_font_icons&informer_action=create'));?>" class="button-secondary"><?php _e('New informer','owm-font-icons');?></a>
		<?php if(get_option('owm_font_icons_informers')):?>
			<table class="wp-list-table widefat fixed striped" id="owm-font-icons-informers">
				<thead>
					<tr>
						<th><?php _e('Name', 'owm-font-icons');?></th>
						<th><?php _e('Shortcode', 'owm-font-icons');?></th>
						<th><?php _e('Display', 'owm-font-icons');?></th>
						<th><?php _e('Style', 'owm-font-icons');?></th>
						<th><?php _e('Color', 'owm-font-icons');?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach (get_option('owm_font_icons_informers') as $id => $informer):?>
						<tr>
							<td class="column-title">
								<a href="<?php echo esc_url(get_admin_url(null, 'admin.php?page=owm_font_icons&informer_action=edit&informer_id='.$id));?>">
									<strong><?php echo $informer['owm-title'];?></strong>
								</a>
								<div class="row-actions">
									<span class="edit">
										<a href="<?php echo esc_url(get_admin_url(null, 'admin.php?page=owm_font_icons&informer_action=edit&informer_id='.$id));?>"><?php _e('Edit', 'owm-font-icons');?></a> |
									</span>
									<span class="trash">
										<a href="<?php echo esc_url(get_admin_url(null, 'admin.php?page=owm_font_icons&informer_action=delete&informer_id='.$id));?>"><?php _e('Remove', 'owm-font-icons');?></a>
									</span>
								</div>
							</td>
							<td>[owm-font-icons id="<?php echo $id;?>"]</td>
							<td><?php if($informer['owm-display']) echo $informer['owm-display'];?></td>
							<td><?php if($informer['owm-style']) echo $informer['owm-style'];?></td>
							<td><?php if($informer['owm-color']) echo '<i class="dashicons-before dashicons-cloud" style="color:'.$informer['owm-color'].'"></i>';?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		<?php endif;?>
	</div>
<?php endif;?>
