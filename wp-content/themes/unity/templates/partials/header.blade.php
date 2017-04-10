<header class="banner navbar-fixed">
  <nav>
    <div class="nav-wrapper horizontal-padding-1">
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
        <a href="#" data-activates="mobile-menu" id="mobile-menu-button" class="right button-collapse"><i class="material-icons">menu</i></a>
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'right hide-on-med-and-down']) !!}
        <div aria-hidden="true">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'side-nav', 'menu_id' => 'mobile-menu', 'walker' => new App\MobileNavWalker()]) !!}
        </div>
      @endif
    </div>
  </nav>
</header>
