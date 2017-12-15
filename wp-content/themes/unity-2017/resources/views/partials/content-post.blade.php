@if ($i == 1)
  <article {{ post_class('featured yellow-swish') }} role="article" aria-labelledby="title-{{ get_the_id() }}">
    <div class="row parallax-container">
      <div class="col s12 m6">
        <div class="parallax-faster left-align">
          <a href="{{ get_permalink() }}">
            {!! get_the_post_thumbnail(get_the_id(), 'large', ['class' => "z-depth-2"]) !!}
          </a>
        </div>
      </div>
      <div class="col s12 m6">
        <header>
          <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F j, Y') }}</time>
          <h2 class="entry-title" id="title-{{ get_the_id() }}"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
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
        {!! get_the_post_thumbnail(get_the_id(), 'medium') !!}
      </a>
    </div>
    <div class="card-stacked">
      <div class="card-content">
        <header>
          <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F j, Y') }}</time>
          <h2 class="card-title entry-title" id="title-{{ get_the_id() }}"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
        </header>
        @php(the_excerpt())
      </div>
      <div class="card-action">
        <a class="btn primary" href="{{ get_permalink() }}">Read More</a>
      </div>
    </div>
  </article>
@endif