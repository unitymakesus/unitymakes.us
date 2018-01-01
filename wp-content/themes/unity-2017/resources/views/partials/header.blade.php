<a href="#content" class="screen-reader-text">Skip to content</a>
<header class="banner" role="banner">
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
             alt="{{ get_bloginfo('name', 'display') }}"
             width="{{ $logo[1] }}" height="{{ $logo[2] }}" />
      @else
        {{ get_bloginfo('name', 'display') }}
      @endif
    </a>

    @if (has_nav_menu('primary_navigation'))
      <a href="#" class="right menu-trigger show-on-medium-and-down"><i class="material-icons">menu</i></a>
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav right', 'menu_id' => 'sidenav']) !!}
      <div class="sidenav-overlay"></div>
    @endif
  </nav>
</header>
