@extends('layouts.app')

@section('content')
  <section class="hero yellow-swish" role="region" aria-labelledby="hero1">
    <div class="row parallax-container">
      <div class="col s12 m4 l3 push-l1 valign-wrapper">
        <p id="hero1" class="h1">You do good for the world.<br />Your website can too.</p>
      </div>
      <div class="col s12 m7 push-l2">
        <div class="parallax-faster right-align">
          <img src="@asset('images/people.jpg')"
               alt="Diverse group of people working together on strategy board."
               class="z-depth-2" />
        </div>
      </div>
    </div>
  </section>

  <section class="vertical-padding-3 services" role="region" aria-labelledby="services1">
    <div class="row">
      <div class="col l9 align-center">
        <h1 class="center">Unity creates mission-aligned websites for nonprofits and socially responsible businesses.</h1>
      </div>
    </div>
    <div class="row vertical-padding-1">
      <div class="col l9 align-center">
        <p class="h5 center" id="services1"><span class="strong underline">We believe every website should:</span></p>
      </div>
    </div>
    <div class="row vertical-padding-2">
      @include('partials.content-services', [
      'columns'   => [
          [
            'svg'     => 'mission',
            'title'   => 'Amplify Your Mission',
            'desc'   => 'Our team works collaboratively with yours to design custom websites that are strategically aligned to super-charge your mission and meet your goals.'
          ],
          [
            'svg'     => 'access',
            'title'   => 'Open Doors to Everyone',
            'desc'   => 'We intentionally design with accessibility in mind. Our inclusive design process means everyone will be able to use your website regardless of disability.'
          ],
          [
            'svg'     => 'world',
            'title'   => 'Save the World',
            'desc'   => 'As a Certified B Corporation, we are committed to building a sustainable web that is powered by renewable energy and equitable employment.'
          ],
        ]
      ])
    </div>
  </section>

  <section class="has-mega-back parallax-container vertical-padding-3 flex-grid small-center" role="region" aria-labelledby="awesome1">
    <div class="low-poly-dark mega-back parallax-wayback"></div>
    <div class="row valign-wrapper flex-center flex-grow-0">
      <div class="col s12 m6">
        <p class="strong font-size-h4" id="awesome1">You deserve an agency that works as hard for you as you do for your community.</p>
      </div>
      <div class="col s12 m5 l5 push-l1">
        <a class="btn btn-large icon-appear-right" href="/contact/">Free Consultation <i class="material-icons">arrow_forward</i></a>
      </div>
    </div>
  </section>

  <section class="client-logos vertical-padding-3">
    <div class="row valign-wrapper flex-center flex-grow-0">
      <div class="col l8 align-center">
        <p class="h5 center"><span class="strong underline">Saving the world one happy client at a time.</span></p>
      </div>
    </div>
    @php(
      $clients = new WP_Query([
        'post_type' => 'client',
        'posts_per_page' => -1,
        'orderby' => 'menu-order',
        'order' => 'ASC'
      ])
    )
    @if ($clients->have_posts())
      <div class="valign-wrapper flex-center flex-wrap">
        @while ($clients->have_posts()) @php($clients->the_post())
          @include ('partials.content-client')
        @endwhile
      </div>
    @endif @php (wp_reset_postdata())
  </section>

  <section class="blog-grid" role="region" aria-label="Recent Blog Posts">
    <div class="row collapse">
      @php(
        $blog = new WP_Query([
          'post_type' => 'post',
          'posts_per_page' => 4
        ])
      )
      @if ($blog->have_posts()) @while ($blog->have_posts()) @php($blog->the_post())
        <div class="col s12 l6">
          <div class="ratio-4-3">
            @include ('partials.content-'.(get_post_type() !== 'post' ? get_post_type() : get_post_format()))
          </div>
        </div>
      @endwhile @endif @php(wp_reset_postdata())
    </div>
  </section>

@endsection
