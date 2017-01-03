<section class="page-header">
  @if (has_post_thumbnail())
    @include('partials.content-parallax', [
      'type'      => 'hero',
      'img'       => get_the_post_thumbnail(),
      'content'   => '<h1>' . App\title() . '</h1>'
    ])
  @else
    <h1>{!! App\title() !!}</h1>
  @endif
</section>
