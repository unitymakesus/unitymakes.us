<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
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
    <div class="fixed"></div>
    <div class="viewport">
      @php(do_action('get_header'))
      @include('partials.header')
      <div id="main" class="wrap" role="document">
        <div class="content">
          <main class="main" role="main">
            @yield('content')
          </main>
          @if (App\display_sidebar())
            <aside class="sidebar">
              @include('partials.sidebar')
            </aside>
          @endif
        </div>
      </div>
      @php(do_action('get_footer'))
      @include('partials.footer')
      @php(wp_footer())
    </div>
  </body>
</html>
