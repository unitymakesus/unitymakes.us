<article @php(post_class()) role="article" aria-labelledby="title-{{ get_the_id() }}">
  <header class="hero yellow-swish">
    <div class="row parallax-container">
      <div class="col s12 m5 l3 push-l1 valign-wrapper">
        <div>
          @include('partials/entry-meta-date')
          <h1 class="entry-title" id="title-{{ get_the_id() }}">{{ get_the_title() }}</h1>
          @include('partials/entry-meta-byline')
        </div>
      </div>
      <div class="col s12 m7 push-l2">
        <div class="parallax-faster right-align">
          {!! get_the_post_thumbnail(get_the_id(), 'large', ['class' => "z-depth-2"]) !!}
        </div>
      </div>
    </div>
  </header>
  <div class="entry-content">
    <div class="container clearfix">
      @php(the_content())
    </div>
  </div>
  <footer class="has-mega-back parallax-container vertical-padding-3 flex-grid small-center">
    <div class="low-poly-dark mega-back parallax-wayback"></div>
    <div class="row valign-wrapper flex-center">
      <div>
        <h4>Love this? We'd love for you to share!</h4>
        {!! do_shortcode('[share]') !!}
      </div>
    </div>
  </footer>
</article>
