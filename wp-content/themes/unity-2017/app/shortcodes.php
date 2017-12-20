<?php

namespace App;

// Section shortcode
add_shortcode('section', function($atts, $content = null) {
  extract( shortcode_atts([
    'background' => ''
  ], $atts ) );

  switch ($background) {
    case 'low-poly-dark':
      $classes = "background-dark parallax-container overflow-hidden vertical-padding-3 flex-grid small-center";
      $bg_div = '<div class="low-poly-dark mega-back parallax-wayback"></div>';
      break;
    default:
      $classes = "";
      $bg_div = "";
      break;
  }

  $output = '</div></section><section class="' . $classes . '">';
  $output .= $bg_div;
  $output .= do_shortcode($content);
  $output .= '</section><section class="vertical-padding-2"><div class="container">';

  return $output;
});

// Row shortcode
add_shortcode('row', function($atts, $content = null) {
  extract( shortcode_atts([
    'class' => ''
  ], $atts ) );

  $output = '<div class="row ' . $class . '">';
  $output .= do_shortcode($content);
  $output .= '</div>';

  return $output;
});

// Column shortcode
add_shortcode('col', function($atts, $content = null) {
  extract( shortcode_atts([
    'width' => ''
  ], $atts ) );

  $output = '<div class="col ' . $width . '">';
  $output .= do_shortcode($content);
  $output .= '</div>';

  return $output;
});

// Client logos shortcode
add_shortcode('clients', function($atts, $content = null) {
  ob_start();

  include(get_template_directory() . '/views/partials/client-icons.php');

  return ob_get_clean();
});

// Client logos shortcode
add_shortcode('team', function($atts, $content = null) {

  $output = '</div></section><section class="container ' . $classes . '">';
  ob_start();
  include(get_template_directory() . '/views/partials/team-members.php');
  $output .= ob_get_clean();
  $output .= '</section><section class="vertical-padding-2"><div class="container">';

  return $output;
});

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
