@extends('layouts.app')

@section('content')
  <section class="page-header hero yellow-swish" role="region" aria-label="Page Header">
    <div class="row parallax-container">
      <div class="col s12 m4 l3 push-l1 valign-wrapper">
        <div>
          <h1>You're lost too?</h1>
        </div>
      </div>
      <div class="col s12 m8 push-l1">
        <div class="parallax-faster right-align">
          <img src="@asset('images/booplesnoot.jpg')"
               alt="Booplesnoot: (noun) A rabbit with a very boop-able nose."
               class="z-depth-2" />
        </div>
      </div>
    </div>
  </section>

  <section class="vertical-padding-2 clearfix">
    <div class="container">
      @if (!have_posts())
        <div class="alert alert-warning">
          {{ __('Sorry, but the page you were trying to view does not exist. Want to try searching instead?', 'sage') }}
        </div>
        {!! get_search_form(false) !!}
      @endif
    </div>
  </section>
@endsection
