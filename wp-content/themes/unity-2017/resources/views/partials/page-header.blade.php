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
        @php
          $thumb_id = get_post_thumbnail_id(get_the_id());
          $alt = trim( strip_tags( get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ) );
        @endphp
        {!! get_the_post_thumbnail(get_the_id(), 'large', ['class' => "z-depth-2", 'alt' => $alt]) !!}
      </div>
    </div>
  </div>
</section>
