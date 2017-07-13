<?php

namespace App;

use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, '1');
    wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    // add_theme_support('soil-google-analytics', 'UA-82394427-1');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Enable logo uploader in customizer
     */
     add_image_size('unity-logo', 300, 60, false);
     add_image_size('unity-logo-2x', 600, 120, false);
     add_theme_support('custom-logo', array(
       'size' => 'unity-logo-2x'
     ));

    /**
     * Use main stylesheet for visual editor
     * @see assets/styles/layouts/_tinymce.scss
     */
    // add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer 1', 'sage'),
        'id'            => 'sidebar-footer-1'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer 2', 'sage'),
        'id'            => 'sidebar-footer-2'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer 3', 'sage'),
        'id'            => 'sidebar-footer-3'
    ] + $config);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Sage config
     */
    sage()->bindIf('config', function () {
        return [
            'view.paths'      => [TEMPLATEPATH, STYLESHEETPATH],
            'view.compiled'   => wp_upload_dir()['basedir'].'/cache/compiled',
            'view.namespaces' => ['App' => WP_CONTENT_DIR],
            'assets.manifest' => get_stylesheet_directory().'/dist/assets.json',
            'assets.uri'      => get_stylesheet_directory_uri().'/dist'
        ];
    });

    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function ($app) {
        $config = $app['config'];
        return new JsonManifest($config['assets.manifest'], $config['assets.uri']);
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function ($app) {
        $config = $app['config'];
        $cachePath = $config['view.compiled'];
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view'], $app);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return '<?= App\\asset_path(\''.trim($asset, '\'"').'\'); ?>';
    });
});
