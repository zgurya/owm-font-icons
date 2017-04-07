<?php
if($_REQUEST['informer_action']=='create'){
  if(get_option('owm_font_icons_informers')){
    if(isset($_POST['owm-title'])&&!empty($_POST['owm-title'])){
      $informer_id=count(get_option('owm_font_icons_informers'));
    }else{
      $informer_id=count(get_option('owm_font_icons_informers'))+1;
    }
  }else{
    $informer_id=1;
  }
}else{
  $informer_id=$_REQUEST['informer_id'];
}
if(get_option('owm_font_icons_informers')){
  $informers=get_option('owm_font_icons_informers');
  if(isset($informers[$informer_id])) $informer=$informers[$informer_id];
}
//print_r(get_option('owm_font_icons_informers'));
?>
<div class="wrap">
  <form method="POST" id="owm-font-icons">
    <input name="informer_id" type="hidden" value="<?php echo $informer_id;?>">
    <table class="form-table">
      <tr>
        <th scope="row" align="right"><label for="owm-title"><?php _e('Name', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="text" name="owm-title" id="owm-title" value="<?php if(isset($informer['owm-title'])) echo $informer['owm-title'];?>" data-msg="<?php _e('Enter informer name', 'owm-font-icons')?>" required>
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-city"><?php _e('City', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="hidden" name="owm-city-lat" id="owm-city-lat" value="<?php if(isset($informer['owm-city-lat'])) echo $informer['owm-city-lat'];?>">
          <input type="hidden" name="owm-city-lng" id="owm-city-lng" value="<?php if(isset($informer['owm-city-lng'])) echo $informer['owm-city-lng'];?>">
          <div id="owm-city" data-msg="<?php _e('Choose your location', 'owm-font-icons')?>"></div>
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-display"><?php _e('Information display', 'owm-font-icons')?>:</label></th>
        <td>
          <select name="owm-display" id="owm-display">
            <option value="vertical" <?php if(isset($informer['owm-display'])) selected( $informer['owm-display'], 'vertical' ); ?>><?php _e('Vertical', 'owm-font-icons')?></option>
            <option value="horizontal" <?php if(isset($informer['owm-display'])) selected( $informer['owm-display'], 'horizontal' ); ?>><?php _e('Horizontal', 'owm-font-icons')?></option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-font-color"><?php _e('Font color', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="text" name="owm-font-color" id="owm-font-color" value="<?php echo (isset($informer['owm-font-color']))? $informer['owm-font-color']:'#000';?>">
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-bg-color"><?php _e('Background color', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="text" name="owm-bg-color" id="owm-bg-color" value="<?php echo (isset($informer['owm-bg-color']))? $informer['owm-bg-color']:'#000';?>">
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-border-color"><?php _e('Border color', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="text" name="owm-border-color" id="owm-border-color" value="<?php echo (isset($informer['owm-border-color']))? $informer['owm-border-color']:'#000';?>">
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-color"><?php _e('Weather icon color', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="text" name="owm-color" id="owm-color" value="<?php echo (isset($informer['owm-color']))? $informer['owm-color']:'#000';?>">
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-size"><?php _e('Weather icon size', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="number" name="owm-size" id="owm-size" value="<?php echo (isset($informer['owm-size']))? $informer['owm-size']:'14';?>" size="5">px
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-style"><?php _e('Weather icon style', 'owm-font-icons')?>:</label></th>
        <td>
          <select name="owm-style" id="owm-style">
            <option value="default" <?php if(isset($informer['owm-style'])) selected( $informer['owm-style'], 'default' ); ?>><?php _e('Default', 'owm-font-icons')?></option>
            <option value="filled" <?php if(isset($informer['owm-style'])) selected( $informer['owm-style'], 'filled' ); ?>><?php _e('Filled', 'owm-font-icons')?></option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-style"><?php _e('Data show', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="checkbox" name="owm-data[]" value="name" <?php if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("name", $informer['owm-data'])) echo 'checked';?>><?php _e('Name', 'owm-font-icons')?>
          <input type="checkbox" name="owm-data[]" value="icon" <?php if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("icon", $informer['owm-data'])) echo 'checked';?>><?php _e('Icon', 'owm-font-icons')?>
          <input type="checkbox" name="owm-data[]" value="temp" <?php if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("temp", $informer['owm-data'])) echo 'checked';?>><?php _e('Temperature', 'owm-font-icons')?>
          <input type="checkbox" name="owm-data[]" value="desc" <?php if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("desc", $informer['owm-data'])) echo 'checked';?>><?php _e('Description', 'owm-font-icons')?>
          <input type="checkbox" name="owm-data[]" value="wind" <?php if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("wind", $informer['owm-data'])) echo 'checked';?>><?php _e('Wind', 'owm-font-icons')?>
          <input type="checkbox" name="owm-data[]" value="humidity" <?php if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("humidity", $informer['owm-data'])) echo 'checked';?>><?php _e('Humidity', 'owm-font-icons')?>
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-data-style"><?php _e('Data style', 'owm-font-icons')?>:</label></th>
        <td>
          <select name="owm-data-style" id="owm-data-style">
            <option value="icon" <?php if(isset($informer['owm-data-style'])) selected( $informer['owm-data-style'], 'icon' ); ?>><?php _e('Icon', 'owm-font-icons')?></option>
            <option value="text" <?php if(isset($informer['owm-data-style'])) selected( $informer['owm-data-style'], 'text' ); ?>><?php _e('Text', 'owm-font-icons')?></option>
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-icons-color"><?php _e('Icons color', 'owm-font-icons')?>:</label></th>
        <td>
          <input type="text" name="owm-icons-color" id="owm-icons-color" value="<?php echo (isset($informer['owm-icons-color']))? $informer['owm-icons-color']:'#000';?>">
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-units"><?php _e('Units', 'owm-font-icons')?>:</label></th>
        <td>
          <select name="owm-units" id="owm-units">
            <option value="default" <?php if(isset($informer['owm-units'])) selected( $informer['owm-units'], 'default' ); ?>><?php _e('Kelvin | meter/sec', 'owm-font-icons')?></option>
            <option value="imperial" <?php if(isset($informer['owm-units'])) selected( $informer['owm-units'], 'imperial' ); ?>><?php _e('Fahrenheit | miles/hour', 'owm-font-icons')?></option>
            <option value="metric" <?php if(isset($informer['owm-units'])) selected( $informer['owm-units'], 'metric' ); ?>><?php _e('Celsius | meter/sec', 'owm-font-icons')?></option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row" align="right"><label for="owm-lang"><?php _e('Description language', 'owm-font-icons')?>:</label></th>
        <td>
          <select name="owm-lang" id="owm-lang">
            <option value="bg" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'bg' ); ?>><?php _e('Bulgarian', 'owm-font-icons')?></option>
            <option value="ca" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'ca' ); ?>><?php _e('Catalan', 'owm-font-icons')?></option>
            <option value="zh" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'zh' ); ?>><?php _e('Chinese', 'owm-font-icons')?></option>
            <option value="hr" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'hr' ); ?>><?php _e('Croatian', 'owm-font-icons')?></option>
            <option value="nl" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'nl' ); ?>><?php _e('Dutch', 'owm-font-icons')?></option>
            <option value="en" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'en' ); ?>><?php _e('English', 'owm-font-icons')?></option>
            <option value="fi" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'fi' ); ?>><?php _e('Finnish', 'owm-font-icons')?></option>
            <option value="fr" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'fr' ); ?>><?php _e('French', 'owm-font-icons')?></option>
            <option value="de" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'de' ); ?>><?php _e('German', 'owm-font-icons')?></option>
            <option value="it" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'it' ); ?>><?php _e('Italian', 'owm-font-icons')?></option>
            <option value="pl" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'pl' ); ?>><?php _e('Polish', 'owm-font-icons')?></option>
            <option value="pt" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'pt' ); ?>><?php _e('Portuguese', 'owm-font-icons')?></option>
            <option value="ro" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'ro' ); ?>><?php _e('Romanian', 'owm-font-icons')?></option>
            <option value="ru" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'ru' ); ?>><?php _e('Russian', 'owm-font-icons')?></option>
            <option value="es" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'es' ); ?>><?php _e('Spanish', 'owm-font-icons')?></option>
            <option value="sv" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'sv' ); ?>><?php _e('Swedish', 'owm-font-icons')?></option>
            <option value="tr" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'tr' ); ?>><?php _e('Turkish', 'owm-font-icons')?></option>
            <option value="uk" <?php if(isset($informer['owm-lang'])) selected( $informer['owm-lang'], 'uk' ); ?>><?php _e('Ukrainian', 'owm-font-icons')?></option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <input type="submit" value="<?php _e('Save', 'ip-users');?>" class="button button-primary button-large">
          <a href="<?php echo esc_url(get_admin_url(null,'admin.php?page=owm_font_icons'));?>" class="button-secondary"><?php _e('Cancel','owm-font-icons');?></a>
        </th>
      </tr>
    </table>
  </form>
</div>
