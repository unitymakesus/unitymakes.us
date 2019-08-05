<?php

namespace App;

/**
* Theme customizer
*/
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
  // Add postMessage support
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->selective_refresh->add_partial('blogname', [
    'selector' => '.brand',
    'render_callback' => function () {
      bloginfo('name');
    }
  ]);

  $wp_customize->add_section( 'simple_header' , array(
   'title'      => __( 'Header Settings', 'simple' ),
   'priority'   => 40,
   'capability'  => 'edit_theme_options',
   )
  );

  /**
   * Add logo resizing setting
   */
  $wp_customize->add_setting( 'header_logo_width',
    array(
      'default' => 200,
      'capability'  => 'edit_theme_options',
      'transport'  => 'refresh'
    )
  );

  $wp_customize->add_control( new \O2_Customizer_Range_Slider_Control(
    $wp_customize,
    'simple_logo_width', //Set a unique ID for the control
    array(
      'label'      => __( 'Logo Width', 'simple' ), //Admin-visible name of the control
      'section'    => 'simple_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
      'settings'   => 'header_logo_width', //Which setting to load and manipulate (serialized is okay)
      'input_attrs' => array(
        'priority'   => 10, //Determines the order this control appears in for the specified section
        'min'        => 100,
        'max'        => 300,
        'step'       => 1,
      )
    )
  ) );

  $wp_customize->add_setting( 'header_logo_align', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
     'default'    => 'float-left', //Default setting/value to save
     'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
     'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    )
  );

  $wp_customize->add_control(
    'simple_header_logo_align', //Set a unique ID for the control
    array(
     'label'      => __( 'Logo Alignment', 'simple' ), //Admin-visible name of the control
     'section'    => 'simple_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
     'settings'   => 'header_logo_align', //Which setting to load and manipulate (serialized is okay)
     'priority'   => 10, //Determines the order this control appears in for the specified section
     'type'       => 'radio',
     'choices'    => array(
       'inline-left'     => 'Inline Left',
       'float-left'      => 'Float Left',
       'float-center'    => 'Float Center',
       'no-logo'         => 'Hide Logo',
     )
    )
  );

  $wp_customize->add_setting( 'header_cta_headline', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
     'default'    => '', //Default setting/value to save
     'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
     'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    )
  );

  $wp_customize->add_control(
    'simple_header_cta_headline', //Set a unique ID for the control
    array(
     'label'      => __( 'CTA Headline (optional)', 'simple' ), //Admin-visible name of the control
     'section'    => 'simple_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
     'settings'   => 'header_cta_headline', //Which setting to load and manipulate (serialized is okay)
     'priority'   => 10, //Determines the order this control appears in for the specified section
     'type'       => 'text'
    )
  );

  $wp_customize->add_setting( 'header_cta_text', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
     'default'    => '', //Default setting/value to save
     'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
     'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    )
  );

  $wp_customize->add_control(
    'simple_header_cta_text', //Set a unique ID for the control
    array(
     'label'      => __( 'CTA Button Text', 'simple' ), //Admin-visible name of the control
     'section'    => 'simple_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
     'settings'   => 'header_cta_text', //Which setting to load and manipulate (serialized is okay)
     'priority'   => 10, //Determines the order this control appears in for the specified section
     'type'       => 'text'
    )
  );

  $wp_customize->add_setting( 'header_cta_link', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
     'default'    => '', //Default setting/value to save
     'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
     'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    )
  );

  $wp_customize->add_control(
    'simple_header_cta_link', //Set a unique ID for the control
    array(
     'label'      => __( 'CTA Button Link', 'simple' ), //Admin-visible name of the control
     'section'    => 'simple_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
     'settings'   => 'header_cta_link', //Which setting to load and manipulate (serialized is okay)
     'priority'   => 10, //Determines the order this control appears in for the specified section
     'type'       => 'url'
    )
  );

  $wp_customize->add_setting( 'header_cta_target',
    array(
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    )
  );

  $wp_customize->add_control(
    'simple_header_cta_target',
    array(
      'label'     => __( 'Open CTA in New Tab?', 'simple' ),
      'section'   => 'simple_header',
      'settings'  => 'header_cta_target',
      'priority'  => 10,
      'type'      => 'checkbox'
    )
  );

});

/**
* Customizer JS
*/
add_action('customize_preview_init', function () {
  wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

add_action('customize_controls_enqueue_scripts', function () {
  wp_enqueue_script('sage/customizer-panel.js', asset_path('scripts/customizer-panel.js'), [], null, true);
});
