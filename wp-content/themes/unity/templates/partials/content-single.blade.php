<article @php(post_class())>
  @if (has_post_thumbnail())
    @include('partials.content-parallax', [
      'type'      => 'single',
      'img'       => get_the_post_thumbnail(),
      'content'   => '<h1 class="entry-title">' . get_the_title() . '</h1>'
    ])
  @else
    <header class="container">
      <h1 class="entry-title">{{ get_the_title() }}</h1>
    </header>
  @endif

  <section class="container">
    @include('partials/entry-meta')

    <div class="divider"></div>

    <div class="entry-content">
      @php(the_content())
    </div>

    <div class="divider"></div>

    {!! do_shortcode('[share]') !!}

    <footer>
      {!! wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </footer>

    @php(comments_template('/templates/partials/comments.blade.php'))
  </section>
</article>
