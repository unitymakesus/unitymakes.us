@extends('layouts.base')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-parallax', [
      'type'    => 'hero',
      'img'     => '<img src="' . App\asset_path('images/WOCbanner.jpg') . '" alt="">',
      'content' => '<h1>
                      <img src="' . App\asset_path('images/together.svg') . '" alt="Together"><br />
                      we can do <strong>so much</strong>
                    </h1>'
    ])

    @include('partials.content-home-section', [
      'type'      => 'audience',
      'title'     => 'Partnering For Good',
      'content'   => 'You are an inspiration and our goal is to help you succeed. Striving for sustainability and equity, we specialize in building beautiful, dynamic websites and providing thoughtful technical support for social enterprises and women owned businesses.',
      'cards'     => [
        [
          'img'   => App\asset_path('images/nonprofits.jpg'),
          'alt'   => 'We build websites for nonprofits',
          'title' => 'Nonprofits &amp;<br />Foundations',
          'link'  => '#'
        ],
        [
          'img'   => App\asset_path('images/socially-responsible.jpg'),
          'alt'   => 'We build websites for socially responsible businesses',
          'title' => 'Socially Responsible<br />Businesses',
          'link'  => '#'
        ],
        [
          'img'   => App\asset_path('images/woman-podcast.jpg'),
          'alt'   => 'We build websites for women owned businesses',
          'title' => 'Women Owned<br />Businesses',
          'link'  => '#'
        ],
      ]
    ])

    @include('partials.content-parallax', [
      'type'    => 'testimonial',
      'img'     => '<img src="' . App\asset_path('images/FVNC-banner.jpg') . '" alt="">',
      'content' => '<blockquote class="flow-text">
                      <p>"If your organization needs technology to enhance your mission, look no further than Unity."</p>
                      <cite>&mdash; Hunter Buxton, Executive Director of First Vote NC</cite>
                    </blockquote>'
    ])

    @include('partials.content-home-section', [
      'type'      => 'difference',
      'title'     => 'The Unity Difference',
      'content'   => 'We\'re not your typical web agency, and we are on a mission to build a better world through our work.',
      'cards'     => [
        [
          'img'   => App\asset_path('images/human-centered.jpg'),
          'alt'   => 'The most important element of your website is your audience',
          'title' => 'Human Centered',
          'link'  => '#'
        ],
        [
          'img'   => App\asset_path('images/accessibility.jpg'),
          'alt'   => 'We build accessible websites that are WCOG 2.0 compliant',
          'title' => 'Website Accessibility',
          'link'  => '#'
        ],
        [
          'img'   => App\asset_path('images/open-source.jpg'),
          'alt'   => 'We are an open source shop, in code and in practice',
          'title' => 'Open Source',
          'link'  => '#'
        ],
      ]
    ])

    @include('partials.content-parallax', [
      'type'      => 'overlay',
      'img'       => '<img src="' . App\asset_path('images/succulents.jpg') . '" alt="">',
      'content'   => '<div class="row valign-wrapper">
                        <div class="col m6">
                          <img src="' . App\asset_path('images/quote-kid-president.svg') . '" alt="Create something that will make the world awesome. Kid President" />
                        </div>
                        <div class="col m6 valign center center-align">
                          <a href="' . get_permalink(get_page_by_path('mission-values')) . '" class="btn btn-ghost">See Our Core Values</a>
                        </div>
                      </div>'
    ])
  @endwhile
  <section class="container vertical-padding-3">
    <p class="center-align valign-wrapper">
      <a href="https://www.bcorporation.net/what-are-b-corps" target="_blank">
        <img class="valign center inline-block horizontal-padding-1"
             src="{{ App\asset_path('images/pending-b-corp.png') }}"
             srcset="{{ App\asset_path('images/pending-b-corp.png') }} 1x, {{ App\asset_path('images/pending-b-corp@2x.png') }} 2x"
             alt="B Corporation - Pending" />
      </a>
      <a href="http://ncnewsroom.org/" target="_blank">
      <img class="valign center inline-block horizontal-padding-1"
           src="{{ App\asset_path('images/nc-newsroom-coop.png') }}"
           srcset="{{ App\asset_path('images/nc-newsroom-coop.png') }} 1x, {{ App\asset_path('images/nc-newsroom-coop@2x.png') }} 2x"
           alt="NC Newsroom Cooperative" />
      </a>
      <a href="{{ get_permalink(get_page_by_path('hosting')) }}" target="_blank">
        <img class="valign center inline-block horizontal-padding-1"
             src="{{ App\asset_path('images/eco-friendly-website.png') }}"
             srcset="{{ App\asset_path('images/eco-friendly-website.png') }} 1x, {{ App\asset_path('images/eco-friendly-website@2x.png') }} 2x"
             alt="300% eco-friendly website" />
      </a>
      <a href="#" target="_blank">
        <img class="valign center inline-block horizontal-padding-1"
             src="{{ App\asset_path('images/wcag.png') }}"
             srcset="{{ App\asset_path('images/wcag.png') }} 1x, {{ App\asset_path('images/wcag@2x.png') }} 2x"
             alt="WCAG version 2.0 level AA" />
      </a>
    </p>
  </section>
@endsection
