<?php

namespace App;
use BladeSVGSage;

// Section shortcode
add_shortcode('section', function($atts, $content = null) {
  extract( shortcode_atts([
    'background' => ''
  ], $atts ) );

  switch ($background) {
    case 'low-poly-dark':
      $classes = "has-mega-back parallax-container vertical-padding-3 flex-grid small-center";
      $bg_div = '<div class="low-poly-dark mega-back parallax-wayback"></div>';
      break;
    default:
      $classes = "";
      $bg_div = "";
      break;
  }

  $output = '</div></div></section><section class="' . $classes . '">';
  $output .= $bg_div;
  $output .= do_shortcode($content);
  $output .= '</section><section><div class="vertical-padding-2"><div class="container">';

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

// Card shortcode
add_shortcode('card', function($atts, $content = null) {
  extract( shortcode_atts([
    'class' => ''
  ], $atts ) );

  $output = '<div class="card square z-depth-2 ' . $class . '"><div class="card-inner">';
  $output .= do_shortcode($content);
  $output .= '</div></div>';

  return $output;
});

// SVG shortcode
add_shortcode('svg', function($atts, $content = null) {
  extract( shortcode_atts([
    'icon' => ''
  ], $atts ) );

  $output = e(\App\svg_image($icon . '-icon'));

  return $output;
});

// Client logos shortcode
// add_shortcode('clients', function($atts, $content = null) {
//   ob_start();
//
//   include(get_template_directory() . '/views/partials/client-icons.php');
//
//   return ob_get_clean();
// });

// Client logos shortcode
add_shortcode('team', function($atts, $content = null) {
  extract( shortcode_atts([
    'section' => ''
  ], $atts ) );

  $team_query = new \WP_User_Query([
    'number' => -1,
    'orderby' => 'meta_value_num',
    'meta_key' => 'display_order',
    'meta_query' => [
      [
        'key' => 'team_member',
        'value' => TRUE
      ]
    ]
  ]);

  $team = $team_query->get_results();

  $output = '</div></div></section><section class="flex-grid ' . $classes . '"><div class="row people">';
  ob_start();

  $i = 0;
  if (!empty($team)) : foreach ($team as $member) :
    if ($i > 0 && $i % 2 == 0) echo '</div><div class="row people">';
    include(get_template_directory() . '/views/partials/content-team-member.php');
    $i ++;
  endforeach; endif;

  $output .= ob_get_clean();

  if ($section !== 'last') {
    $output .= '</div></section><section><div class="vertical-padding-2"><div class="container">';
  } else {
    $output .= '<div>';
  }

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
