<article @php(post_class('valign-wrapper')) style="background-image: url('{{ get_the_post_thumbnail_url(null, 'large') }}')">
  <header class="center">
    <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date('M j, Y') }}</time>
    <h2 class="entry-title">{{ get_the_title() }}</h2>
    <a class="btn floating" href="{{ get_permalink() }}">Read More</a>
  </header>
  <a class="mega-link" href="{{ get_permalink() }}" aria-hidden="hidden"></a>
</article>
