<section class="page-header hero yellow-swish" role="region" aria-label="Page Header">
  <div class="row parallax-container">
    <div class="col s12 m5 l4 push-l1 valign-wrapper">
      <div>
        <h1>{!! App::title() !!}</h1>
        <p class="subtitle">{{ the_field('subtitle') }}</p>
      </div>
    </div>
    <div class="col s12 m6 push-m1 push-l2">
      <div class="parallax-faster right-align">
        <a href="{{ get_permalink() }}">
          {!! get_the_post_thumbnail(get_the_id(), 'large', ['class' => "z-depth-2"]) !!}
        </a>
      </div>
    </div>
  </div>
</section>
