<?php 
if(!get_option('owm_font_icons_api')||empty(get_option('owm_font_icons_api'))):?>
	<?php _e('Please, enter API key before start using informers.', 'owm-ficons');?> <a href="<?php echo esc_url( get_admin_url(null, 'admin.php?page=owm_font_icons_settings') )?>"><?php _e('Enter it here.', 'owm-ficons');?></a>
<?php else:?>
	
<?php endif;?>