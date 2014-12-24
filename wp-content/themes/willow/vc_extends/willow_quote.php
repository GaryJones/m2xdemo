<?php

class WPBakeryShortCode_VC_WILLOW_Quote extends WPBakeryShortCode {

        public function contentAdmin($atts, $content) {
            $element = $this->shortcode;
            $output  = $custom_markup = $width = $el_position = '';

            if ( $content != NULL ) { $content = wpautop(stripslashes($content)); }

            if ( isset($this->settings['params']) ) {
                $shortcode_attributes = array('width' => '1/1');
                foreach ( $this->settings['params'] as $param ) {
                    if ( $param['param_name'] != 'content' ) {
                        if ( isset($param['value']) ) {
                            $shortcode_attributes[$param['param_name']] = is_string($param['value']) ? __($param['value'], "js_composer") : $param['value'];
                        } else {
                            $shortcode_attributes[$param['param_name']] = '';
                        }
                    } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                        $content = __($param['value'], "js_composer");
                    }
                }
                extract(shortcode_atts(
                    $shortcode_attributes
                    , $atts));
                $elem = $this->getElementHolder($width);
                if(isset($atts['el_position'])) $el_position = $atts['el_position'];
                $iner = $this->outputTitle($this->settings['name']);
                foreach ($this->settings['params'] as $param) {
                    $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
                    if ( is_array($param_value)) {
                        // Get first element from the array
                        reset($param_value);
                        $first_key = key($param_value);
                        $param_value = $param_value[$first_key];
                    }
                    $iner .= $this->singleParamHtmlHolder($param, $param_value);
                }
                $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
                $output .= $elem;
            }
            return $output;
        }

}