<?php

namespace App;

// Row shortcode
add_shortcode('row', __NAMESPACE__ . '\\row_shortcode');
function row_shortcode($atts, $content = null) {
  extract( shortcode_atts( array(
  ), $atts ) );

  $output = '<div class="row">';
  $output .= do_shortcode($content);
  $output .= '</div>';

  return $output;
}

// Column shortcode
add_shortcode('col', __NAMESPACE__ . '\\column_shortcode');
function column_shortcode($atts, $content = null) {
  extract( shortcode_atts( array(
    'width' => ''
  ), $atts ) );

  $output = '<div class="col ' . $width . '">';
  $output .= do_shortcode($content);
  $output .= '</div>';

  return $output;
}

// Clean auto p tags from around shortcodes

add_filter('the_content', function($content){
  $array = array (
      '<p>[' => '[',
      ']</p>' => ']',
      ']<br />' => ']'
  );
  $content = strtr($content, $array);
  return $content;
});
