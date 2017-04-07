<?php
if(isset($_POST['api_key'])) update_option('owm_font_icons_api', $_POST['api_key']);
if(isset($_POST['owm-title'])&&!empty($_POST['owm-title'])){
  $informers=get_option('owm_font_icons_informers');
  if(get_option('owm_font_icons_informers')){
    $informers=get_option('owm_font_icons_informers');
  }else{
    $informers=array();
  }
  $informer=array();
  $informer_options=array('owm-title', 'owm-city-lat', 'owm-city-lng', 'owm-display', 'owm-color', 'owm-border-color', 'owm-style', 'owm-data', 'owm-units', 'owm-lang', 'owm-data-style', 'owm-size', 'owm-font-color', 'owm-icons-color', 'owm-bg-color');
  foreach ($informer_options as $informer_option) {
    if(isset($_POST[$informer_option])&&!empty($_POST[$informer_option])) $informer[$informer_option]=$_POST[$informer_option];
  }
  if(!empty($informer)){
    if(isset($_POST['informer_id'])&&!empty($_POST['informer_id'])){
      $informers[$_POST['informer_id']]=$informer;
    }
  }
  update_option('owm_font_icons_informers',$informers);
}
if(isset($_GET['informer_action'])&&$_GET['informer_action']=='delete'&&isset($_GET['informer_id'])){
  $informers=get_option('owm_font_icons_informers');
  if(isset($informers[$_GET['informer_id']])) unset($informers[$_GET['informer_id']]);
  update_option('owm_font_icons_informers',$informers);
}
?>
