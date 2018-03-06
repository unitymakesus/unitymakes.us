@if ($i == 1)
  <article {{ post_class('hero yellow-swish') }} role="article" aria-labelledby="title-{{ get_the_id() }}">
    <div class="row parallax-container">
      <div class="col s12 m6">
        <div class="parallax-faster left-align">
          <a href="{{ get_permalink() }}">
            @php
              $thumb_id = get_post_thumbnail_id(get_the_id());
              $alt = trim( strip_tags( get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ) );
            @endphp
            {!! get_the_post_thumbnail(get_the_id(), 'large', ['class' => "z-depth-2", 'alt' => $alt]) !!}
          </a>
        </div>
      </div>
      <div class="col s12 m6">
        <header>
          @include('partials/entry-meta-date')
          <h2 class="entry-title" id="title-{{ get_the_id() }}"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
          @include('partials/entry-meta-byline')
        </header>
        <p>
          @php(the_excerpt())
        </p>
        <a class="btn secondary" href="{{ get_permalink() }}">Read More</a>
      </div>
    </div>
  </article>
@else
  <article {{ post_class('card horizontal hoverable') }} role="article" aria-labelledby="title-{{ get_the_id() }}">
    <div class="card-image">
      <a href="{{ get_permalink() }}">
        @php
          $thumb_id = get_post_thumbnail_id(get_the_id());
          $alt = trim( strip_tags( get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ) );
        @endphp
        {!! get_the_post_thumbnail(get_the_id(), 'medium', ['alt' => $alt]) !!}
      </a>
    </div>
    <div class="card-stacked">
      <div class="card-content">
        <header>
          @include('partials/entry-meta-date')
          <h2 class="card-title entry-title" id="title-{{ get_the_id() }}"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
          @include('partials/entry-meta-byline')
        </header>
        @php(the_excerpt())
      </div>
      <div class="card-action">
        <a class="btn primary" href="{{ get_permalink() }}">Read More</a>
      </div>
    </div>
  </article>
@endif
