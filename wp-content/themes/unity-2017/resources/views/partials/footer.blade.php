@if (!is_page('contact'))
<section class="newsletter vertical-padding-2" role="region" aria-labelledby="community1">
  <div class="row center">
    <div class="col s12 m6 push-m3">
      <h2 class="h3" id="community1">Join the Unity Community</h2>
      <p>Get free tips, inspiration, & updates in our monthly newsletter.</p>
      {!! do_shortcode( '[contact-form-7 id="588" title="Newsletter"]' ) !!}
    </div>
  </div>
</section>
@endif

<footer class="content-info background-darker parallax-container overflow-hidden" role="contentinfo">
  <div class="dark-swish mega-back parallax-wayback"></div>
  <div>
    <div class="row center-align vertical-padding-2">
      <div class="col s12">
        <h2 class="h4">United in our mission. Driven by our values.</h2>
        <div class="valign-wrapper flex-center">
          <a class="valign horizontal-padding-1" href="https://www.bcorporation.net/what-are-b-corps" target="_blank" rel="noopener">
            <img class=""
                 src="@asset('images/Certified_B_Corporation_PENDING_White.png')"
                 srcset="@asset('images/Certified_B_Corporation_PENDING_White.png') 1x, @asset('images/Certified_B_Corporation_PENDING_White@2x.png') 2x"
                 alt="B Corporation - Pending"
                 width="56" height="100" />
          </a>
          <a class="valign" href="/2017/12/why-we-provide-free-web-hosting/">
            <img class=""
                 src="@asset('images/eco-friendly-website.png')"
                 srcset="@asset('images/eco-friendly-website.png') 1x, @asset('images/eco-friendly-website@2x.png') 2x"
                 alt="300% eco-friendly website"
                 width="110" height="70" />
          </a>
          <a class="valign horizontal-padding-1" href="http://www.durhamlivingwage.org/" target="_blank" rel="noopener">
            <img class=""
                 src="@asset('images/dlwp-sticker.png')"
                 srcset="@asset('images/dlwp-sticker.png') 1x, @asset('images/dlwp-sticker@2x.png') 2x"
                 alt="Living Wages Paid Here. Certified by the Durham Living Wage Project"
                 width="84" height="100" />
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m4">
        <p>
          <span class="strong bigger">Connect with us:</span>
          <br />
          <a class="social-media-icon circle z-depth-2" href="https://twitter.com/unitymakesus">
            @svg('twitter')
          </a>
          <a class="social-media-icon circle z-depth-2" href="https://www.facebook.com/unitymakesus/">
            @svg('facebook')
          </a>
          <a class="social-media-icon circle z-depth-2" href="https://www.linkedin.com/company/unity-digital-agency">
            @svg('linkedin')
          </a>
        </p>
      </div>
      <div class="col s12 m8 right-align">
        <p>
          <a href="tel:+1-919-391-4961">
            919-391-4961
          </a>
          <span class="bullet">&bull;</span>
          <a href="mailto:{{ eae_encode_str('hello@unitymakes.us') }}">
            {{ eae_encode_str('hello@unitymakes.us') }}
          </a>
          <br />
          800 Park Offices Dr, Ste #3703, RTP, NC 27709
          <br />
          <a class="cc" aria-label="Creative Commons License CC BY-SA 2.0" href="https://creativecommons.org/licenses/by-sa/2.0/" target="_blank" rel="noopener">
            <i class="cc cc-cc"></i>
            <i class="cc cc-by"></i>
            <i class="cc cc-sa"></i>
          </a>
          <span class="bullet">&bull;</span>
          {{ current_time('Y') }} Unity Digital Agency
          <span class="bullet">&bull;</span>
          <a class="privacy-policy" href="/privacy-policy/">Privacy Policy</a>
        </p>
      </div>
    </div>
  </div>
</footer>
