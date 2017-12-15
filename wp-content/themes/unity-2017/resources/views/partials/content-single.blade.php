<article @php(post_class()) role="article" aria-labelledby="title-{{ get_the_id() }}">
  <header class="hero yellow-swish">
    <div class="row parallax-container">
      <div class="col s12 m8 push-m4">
        <div class="parallax-faster right-align">
          {!! get_the_post_thumbnail(get_the_id(), 'large', ['class' => "z-depth-2"]) !!}
        </div>
      </div>
      <div class="col s12 m4 l3 pull-m8 pull-l7 valign-wrapper">
        <div>
          <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F j, Y') }}</time>
          <h1 class="entry-title" id="title-{{ get_the_id() }}">{{ get_the_title() }}</h1>
          <p class="byline author vcard">
            {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">
              {{ get_the_author() }}
            </a>
          </p>
        </div>
      </div>
    </div>
  </header>
  <div class="entry-content">
    @php(the_content())
  </div>
  <footer class="background-dark parallax-container overflow-hidden vertical-padding-3 flex-grid small-center">
    <div class="low-poly-dark mega-back parallax-wayback"></div>
    <div class="row valign-wrapper flex-center">
      <div>
        <h4>Love this? We'd love for you to share!</h4>
        {!! do_shortcode('[share]') !!}
      </div>
    </div>
  </footer>
</article>
