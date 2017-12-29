<article @php(post_class('valign-wrapper')) style="background-image: url('{{ get_the_post_thumbnail_url(null, 'large') }}')">
  <header class="center">
    @include('partials/entry-meta-date')
    <h2 class="entry-title">{{ get_the_title() }}</h2>
    @include('partials/entry-meta-byline')
    <a class="btn floating" href="{{ get_permalink() }}">Read More</a>
  </header>
  <a class="mega-link" href="{{ get_permalink() }}" aria-hidden="true"></a>
</article>
