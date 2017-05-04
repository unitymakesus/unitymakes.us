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

    @include('partials.content-clients', [
      'clients'   => [
        [
          'img'   => App\asset_path('images/client-logos/rtp.png'),
          'img2x' => App\asset_path('images/client-logos/rtp@2x.png'),
          'alt'   => 'Research Triangle Park',
          'width' => '200'
        ],
        [
          'img'   => App\asset_path('images/client-logos/nc-rural-center.png'),
          'img2x' => App\asset_path('images/client-logos/nc-rural-center@2x.png'),
          'alt'   => 'North Carolina Rural Center',
          'width' => '151'
        ],
        [
          'img'   => App\asset_path('images/client-logos/clean-air-carolina.png'),
          'img2x' => App\asset_path('images/client-logos/clean-air-carolina@2x.png'),
          'alt'   => 'Clean Air Carolina',
          'width' => '201'
        ],
        [
          'img'   => App\asset_path('images/client-logos/evh-logo.png'),
          'img2x' => App\asset_path('images/client-logos/evh-logo@2x.png'),
          'alt'   => 'The Hispanic Liaison El Vínculo Hispano',
          'width' => '101'
        ],
        [
          'img'   => App\asset_path('images/client-logos/nc-initiative.png'),
          'img2x' => App\asset_path('images/client-logos/nc-initiative@2x.png'),
          'alt'   => 'North Carolina Community Development Initiative',
          'width' => '201'
        ],
        [
          'img'   => App\asset_path('images/client-logos/nc-housing-coalition.png'),
          'img2x' => App\asset_path('images/client-logos/nc-housing-coalition@2x.png'),
          'alt'   => 'North Carolina Housing Coalition',
          'width' => '200'
        ],
        [
          'img'   => App\asset_path('images/client-logos/miraclefeet.png'),
          'img2x' => App\asset_path('images/client-logos/miraclefeet@2x.png'),
          'alt'   => 'Miraclefeet',
          'width' => '230'
        ],
        [
          'img'   => App\asset_path('images/client-logos/my-friend-teresa.png'),
          'img2x' => App\asset_path('images/client-logos/my-friend-teresa@2x.png'),
          'alt'   => 'My Friend Teresa Studios',
          'width' => '200'
        ],
        [
          'img'   => App\asset_path('images/client-logos/padgett-nc.png'),
          'img2x' => App\asset_path('images/client-logos/padgett-nc@2x.png'),
          'alt'   => 'Padgett Business Services North Carolina',
          'width' => '201'
        ],
        [
          'img'   => App\asset_path('images/client-logos/everett-gaskins-hancock.png'),
          'img2x' => App\asset_path('images/client-logos/everett-gaskins-hancock@2x.png'),
          'alt'   => 'Everett Gaskins Hancock LLP',
          'width' => '341'
        ],
        [
          'img'   => App\asset_path('images/client-logos/transloc.png'),
          'img2x' => App\asset_path('images/client-logos/transloc@2x.png'),
          'alt'   => 'TransLoc',
          'width' => '200'
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
          'link'  => '//www.unitymakes.us/2017/05/web-accessibility-everyone/'
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
      'content'   => '<div class="row valign-wrapper flex-wrap">
                        <div class="col s12 m6">
                          <img src="' . App\asset_path('images/quote-kid-president.svg') . '" alt="Create something that will make the world awesome. Kid President" />
                        </div>
                        <div class="col s12 m6 valign center center-align">
                          <a href="' . get_permalink(get_page_by_path('mission-values')) . '" class="btn btn-ghost">See Our Core Values</a>
                        </div>
                      </div>'
    ])

    <section class="container vertical-padding-3">
      <div class="valign-wrapper center-align flex-wrap">
        <a class="valign horizontal-padding-1" href="https://www.bcorporation.net/what-are-b-corps" target="_blank">
          <img class=""
               src="{{ App\asset_path('images/pending-b-corp.png') }}"
               srcset="{{ App\asset_path('images/pending-b-corp.png') }} 1x, {{ App\asset_path('images/pending-b-corp@2x.png') }} 2x"
               alt="B Corporation - Pending"
               width="59" height="104" />
        </a>
        <a class="valign horizontal-padding-1" href="{{ get_permalink(get_page_by_path('hosting')) }}">
          <img class=""
               src="{{ App\asset_path('images/eco-friendly-website.png') }}"
               srcset="{{ App\asset_path('images/eco-friendly-website.png') }} 1x, {{ App\asset_path('images/eco-friendly-website@2x.png') }} 2x"
               alt="300% eco-friendly website"
               width="160" height="103" />
        </a>
        <span class="valign horizontal-padding-1">
          <img class=""
               src="{{ App\asset_path('images/wcag.png') }}"
               srcset="{{ App\asset_path('images/wcag.png') }} 1x, {{ App\asset_path('images/wcag@2x.png') }} 2x"
               alt="WCAG version 2.0 level AA"
               width="110" height="80" />
        </span>
        <a class="valign horizontal-padding-1" href="http://www.supplier-connection.net" target="_blank">
          <img class=""
               src="{{ App\asset_path('images/nc-newsroom-logo.png') }}"
               alt="North Carolina Newsroom Cooperative Member Organization"
               width="140" height="100" />
        </a>
        <a class="valign horizontal-padding-1" href="https://ncnewsroom.org/" target="_blank">
          <img class=""
               src="{{ App\asset_path('images/sc_badge_supporter.png') }}"
               alt="Supplier Collection. Connect with this growing network"
               width="160" height="100" />
        </a>
      </div>
    </section>
  @endwhile
@endsection
