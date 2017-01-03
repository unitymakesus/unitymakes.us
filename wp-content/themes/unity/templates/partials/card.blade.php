<div @php(post_class())>
  <article class="card horizontal hoverable">
    @if (has_post_thumbnail())
      <div class="card-image">
        <a href="{{ get_permalink() }}">
          {!! get_the_post_thumbnail(get_the_id(), 'medium') !!}
        </a>
      </div>
    @endif
    <div class="card-stacked">
      <div class="card-content">
        <header>
          <h2 class="card-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
        </header>
        @include('partials/entry-meta')
        @php(the_excerpt())
      </div>

      <div class="card-action">
        <a href="{{ the_permalink() }}">Read More</a>
      </div>
    </div>
  </article>
</div>
