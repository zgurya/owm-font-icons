<?php
class owm_font_icons_widget extends WP_Widget{
  public function __construct(){
    parent::__construct(
      'owm_font_icons_widget',
      __('OWM Font Icons Widget', 'owm-font-icons'),
      array( 'description' => __('Sample widget based on OWM Font Icons', 'owm-font-icons'), )
    );
  }
  
  public function form($instance){
    if (isset($instance[ 'title' ])){
      $title = $instance[ 'title' ];
    }else{
      $title = __('Title', 'owm-font-icons');
    }
    $output='<p><label for="'.$this->get_field_id('title').'">'.__('Title:').'</label>';
    $output.='<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($title).'" /></p>';
    echo $output;
  }

  public function update($new_instance, $old_instance){
    $instance = array();
    $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    return $instance;
  }

  public function widget($args, $instance){
    $title = apply_filters('widget_title', $instance['title']);
    echo $args['before_widget'];
    if (! empty($title)) {
        echo $args['before_title'] . $title . $args['after_title'];
    }
    echo __('Hello, World!', 'wpb_widget_domain');
    echo $args['after_widget'];
  }
}
 ?>
