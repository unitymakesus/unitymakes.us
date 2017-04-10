<footer class="page-footer">
  <div class="container">
    <div class="row">
      <div class="col s12 m6 l3">
        @php
          $icon = get_site_icon_url(75);
          $icon2x = get_site_icon_url(150);
        @endphp
        <img src="{{ $icon }}" srcset="{{ $icon }} 1x, {{ $icon2x }} 2x" alt="Unity Digital Agency" />
        <h5>Get In Touch</h5>
        <p>
          <tel>919-391-4961</tel><br />
          <a href="mailto:{{ eae_encode_str('hello@unitymakes.us') }}">
            {{ eae_encode_str('hello@unitymakes.us') }}
          </a>
        </p>
        <p>
          <a href="https://twitter.com/unitymakesus"><i class="fa fa-lg fa-twitter"></i></a>&nbsp;&nbsp;
          <a href="https://www.facebook.com/unitymakesus/"><i class="fa fa-lg fa-facebook"></i></a>&nbsp;&nbsp;
          <a href="https://www.linkedin.com/company/unity-digital-agency"><i class="fa fa-lg fa-linkedin"></i></a>&nbsp;&nbsp;
        </p>
      </div>
      <div class="col s12 m6 l3">
        @php(dynamic_sidebar('sidebar-footer-1'))
      </div>
      <div class="col s12 m6 l3">
        @php(dynamic_sidebar('sidebar-footer-2'))
      </div>
      <div class="col s12 m6 l3">
        @php(dynamic_sidebar('sidebar-footer-3'))
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    <i class="cc cc-by"></i> {{ current_time('Y') }} Unity Digital Agency. <a href="/privacy-policy/">Privacy Policy.</a> Photo credits <a href="http://www.wocintechchat.com/" target="_blank">#WOCinTech</a> and <a href="https://unsplash.com/" target="_blank">Unsplash</a>.
    </div>
  </div>
</footer>
