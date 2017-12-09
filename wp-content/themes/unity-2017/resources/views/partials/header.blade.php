@if (!is_user_logged_in())
  <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WWVMGLG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
@endif
<!--[if IE]>
  <div class="alert alert-warning">
    {!! __('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage') !!}
  </div>
<![endif]-->
<a href="#main" class="screen-reader-text">Skip to content</a>
<header class="banner">
  <nav role="navigation">
    <a class="brand-logo" href="{{ home_url('/') }}" rel="home">
      @if (has_custom_logo())
        @php
          $custom_logo_id = get_theme_mod( 'custom_logo' );
          $logo = wp_get_attachment_image_src( $custom_logo_id , 'unity-logo' );
          $logo_2x = wp_get_attachment_image_src( $custom_logo_id, 'unity-logo-2x' );
        @endphp
        <img src="{{ $logo[0] }}"
             srcset="{{ $logo[0] }} 1x, {{ $logo_2x[0] }} 2x"
             alt="{{ get_bloginfo('name', 'display') }}">
      @else
        {{ get_bloginfo('name', 'display') }}
      @endif
    </a>

    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav right']) !!}
    @endif
  </nav>
</header>
