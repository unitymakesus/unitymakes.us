{{-- This is actually the blog page template --}}

@extends('layouts.app')

@section('content')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  @php ($i = 1)
  @while (have_posts()) @php(the_post())
    @if ($i == 2)
      <div class="container">
    @endif
    @include('partials.content-'.get_post_type())
    @php ($i++)
  @endwhile

  @if ($i > 2)
    </div><!-- .container -->
  @endif

  @php
    the_posts_pagination([
      'prev_text' => '&laquo; Previous <span class="screen-reader-text">page</span>',
      'next_text' => 'Next <span class="screen-reader-text">page</span> &raquo;',
      'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>',
    ]);
  @endphp
@endsection
