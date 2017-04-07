<?php
add_shortcode('owm-font-icons', 'owm_font_icons_shortcode');
function owm_font_icons_shortcode($atts){
    $output='';
    extract(shortcode_atts(array('id' => null), $atts));
    if ($id&&get_option('owm_font_icons_api')) {
        $informers=get_option('owm_font_icons_informers');
        if ($informers[$id]) {
            $informer=$informers[$id];
            $owm_transient_name='owm_font_icons_'.$id;

            if (get_transient($owm_transient_name)) {
                $data = get_transient($owm_transient_name);
            } else {
                $url='http://api.openweathermap.org/data/2.5/weather?lat='.$informer['owm-city-lat'].'&lon='.$informer['owm-city-lng'].'&appid='.esc_attr(get_option('owm_font_icons_api'));
                if ($informer['owm-units']!='default') {
                    $url.='&units='.$informer['owm-units'];
                }
                if(isset($informer['owm-lang'])){
                    $url.='&lang='.$informer['owm-lang'];
                }
                $url_get = wp_remote_get($url);
                if (is_wp_error($url_get)) {
                    return $url_get->get_error_message();
                }
                $data = json_decode($url_get['body']);
                set_transient($owm_transient_name, $data, 7200);
            }
            $output.='<div class="owm-display '.$informer['owm-display'].'" style="color:'.$informer['owm-font-color'].';background:'.$informer['owm-bg-color'].'">';
            if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("name", $informer['owm-data'])){
              if($informer['owm-display']=='horizontal'){
                $output.='<span class="name" style="border-right: 1px solid '.$informer['owm-border-color'].'">'.$informer['owm-title'].'</span>';
              }else{
                $output.='<span class="name" style="border-bottom: 1px solid '.$informer['owm-border-color'].'">'.$informer['owm-title'].'</span>';
              }
            }
            if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("icon", $informer['owm-data'])){
                if($informer['owm-style']=='default'){
                    $output.='<span class="icon"><i class="owm-'.$data->weather[0]->icon.'" style="color:'.$informer['owm-color'].'; font-size:'.$informer['owm-size'].'px"></i></span>';
                }else{
                    $output.='<span class="icon"><i class="owm-'.$data->weather[0]->icon.'-filled" style="color:'.$informer['owm-color'].'; font-size:'.$informer['owm-size'].'px"></i></span>';
                }
            }
            if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("temp", $informer['owm-data'])){
                $temp=round($data->main->temp);
                if($temp=='-0')$temp=0;
                if($temp>'0')$temp='+'.$temp;
                if($informer['owm-units']=='default'){
                    $output.='<span class="temp">'.$temp.'&deg;K</span>';
                }
                if($informer['owm-units']=='metric'){
                    $output.='<span class="temp">'.$temp.'&deg;C</span>';
                }
                if($informer['owm-units']=='imperial'){
                    $output.='<span class="temp">'.$temp.'&deg;F</span>';
                }
            }
            if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("desc", $informer['owm-data'])){
                $output.='<span class="desc">'.$data->weather[0]->description.'</span>';
            }
            if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("wind", $informer['owm-data'])){
                $output.='<span class="wind">';
                if($informer['owm-data-style']=='icon'){
                    $output.='<i class="owm-wind" style="color:'.$informer['owm-icons-color'].';"></i>';
                }else{
                    $output.=__('w: ', 'owm-font-icons');
                }
                $output.=$wind=$data->wind->speed;
                if($informer['owm-units']=='imperial'){
                    $output.=' '.__('mph', 'owm-font-icons').'</span>';
                }else{
                    $output.=' '.__('m/s', 'owm-font-icons').'</span>';
                }
            }
            if(isset($informer['owm-data'])&&is_array($informer['owm-data'])&&in_array("humidity", $informer['owm-data'])){
                $output.='<span class="humidity">';
                if($informer['owm-data-style']=='icon'){
                    $output.='<i class="owm-humidity" style="color:'.$informer['owm-icons-color'].';"></i>';
                }else{
                    $output.=__('h: ', 'owm-font-icons');
                }
                $output.=round($data->main->humidity).'%</span>';
            }
            $output.='</div>';
        }
    }
    return $output;
}
