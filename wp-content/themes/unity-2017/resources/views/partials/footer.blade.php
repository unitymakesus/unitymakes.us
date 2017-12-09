<footer class="content-info background-darker pattern">
  <div class="row">
    <h2>Sign up for our monthly newsletter for updates, tips, &amp; inspiration:</h2>
    {!! do_shortcode( '[contact-form-7 id="588" title="Newsletter"]' ) !!}
  </div>

  <div class="row">
    <div class="col m6">
      <div class="valign-wrapper flex-wrap">
        <a class="valign horizontal-padding-1" href="https://www.bcorporation.net/what-are-b-corps" target="_blank" rel="noopener">
          <img class=""
               src="{{ App\asset_path('images/Certified_B_Corporation_PENDING_White.png') }}"
               srcset="{{ App\asset_path('images/Certified_B_Corporation_PENDING_White.png') }} 1x, {{ App\asset_path('images/Certified_B_Corporation_PENDING_White@2x.png') }} 2x"
               alt="B Corporation - Pending"
               width="56" height="100" />
        </a>
        <a class="valign horizontal-padding-1" href="http://www.durhamlivingwage.org/" target="_blank" rel="noopener">
          <img class=""
               src="{{ App\asset_path('images/dlwp-sticker.png') }}"
               srcset="{{ App\asset_path('images/dlwp-sticker.png') }} 1x, {{ App\asset_path('images/dlwp-sticker@2x.png') }} 2x"
               alt="Living Wages Paid Here. Certified by the Durham Living Wage Project"
               width="84" height="100" />
        </a>
        <a class="valign horizontal-padding-1" href="{{ get_permalink(get_page_by_path('hosting')) }}">
          <img class=""
               src="{{ App\asset_path('images/eco-friendly-website.png') }}"
               srcset="{{ App\asset_path('images/eco-friendly-website.png') }} 1x, {{ App\asset_path('images/eco-friendly-website@2x.png') }} 2x"
               alt="300% eco-friendly website"
               width="110" height="70" />
        </a>
      </div>
    </div>

    <div class="col m6 text-right">
      <p>
        <a class="social-media-icon" href="https://twitter.com/unitymakesus">
          {!! file_get_contents(App\asset_path('images/twitter.svg')) !!}
        </a>
        <a class="social-media-icon" href="https://www.facebook.com/unitymakesus/">
          {!! file_get_contents(App\asset_path('images/facebook.svg')) !!}
        </a>
        <a class="social-media-icon" href="https://www.linkedin.com/company/unity-digital-agency">
          {!! file_get_contents(App\asset_path('images/linkedin.svg')) !!}
        </a>

        <br />

        <a href="tel:+1-919-391-4961">
          919-391-4961
        </a>
        <span class="bullet">&bull;</span>
        <a href="mailto:{{ eae_encode_str('hello@unitymakes.us') }}">
          {{ eae_encode_str('hello@unitymakes.us') }}
        </a>

        <br />

        <a href="" target="_blank" rel="noopener">
          800 Park Offices Dr, Ste #3703, RTP, NC 27709
        </a>

        <br />

        <a aria-label="Creative Commons License CC BY-SA 2.0" href="https://creativecommons.org/licenses/by-sa/2.0/" target="_blank" rel="noopener">
          <i class="cc cc-cc"></i>
          <i class="cc cc-by"></i>
          <i class="cc cc-sa"></i>
        </a>
        <span class="bullet">&bull;</span>
        {{ current_time('Y') }} Unity Digital Agency
        <span class="bullet">&bull;</span>
        <a href="/privacy-policy/">Privacy Policy</a>
      </p>
    </div>
  </div>
</footer>
