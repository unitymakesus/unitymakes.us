@extends('layouts.base')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-parallax', [
      'type'    => 'hero',
      'img'     => '<img src="' . App\asset_path('images/hero-banner.jpg') . '" alt="Potted mum flowers carpeting the street in front of small business in North Carolina">',
      'content' => '<h1>Working together to <span>spark vibrancy</span> in our community</h1>'
    ])

    @include('partials.content-home-section', [
      'type'      => 'audience',
      'title'     => 'Partnering For Good',
      'content'   => 'We elevate small businesses and nonprofits through beautiful design, clear messaging, and smart code.',
      'cards'     => [
        [
          'img'   => App\asset_path('images/open-source.jpg'),
          'alt'   => 'We are an open source shop, in code and in practice',
          'title' => 'Open Source',
          'link'  => '//www.unitymakes.us/2017/06/unity-open-source-agency/'
        ],
        [
          'img'   => App\asset_path('images/human-centered.jpg'),
          'alt'   => 'You are an inspiration and our goal is to help you succeed',
          'title' => 'Human Centered',
          'link'  => '//www.unitymakes.us/mission-values/'
        ],
        [
          'img'   => App\asset_path('images/accessibility.jpg'),
          'alt'   => 'We build accessible websites that are WCOG 2.0 compliant',
          'title' => 'Accessible websites',
          'link'  => '//www.unitymakes.us/2017/05/web-accessibility-everyone/'
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
      'img'     => '<img src="' . App\asset_path('images/testimonial-banner.jpg') . '" alt="">',
      'content' => '<blockquote class="flow-text">
                      <p>"Unity is more than just a digital agency, they are the best kind of partners — they get to the root of my business, help me identify my value, and continue to suggest strategy for how to dominate our virtual presence. When services provided are beyond your own scope of knowledge it can be scary to trust someone to take care of you ... Alisa and her team are people you can trust."</p>
                      <cite>&mdash; Teresa Porter, <a href="https://myfriendteresa.com/" target="_blank">My Friend Teresa Studios</a></cite>
                    </blockquote>'
    ])

    <section class="container vertical-padding-3">
      <div class="valign-wrapper center-align flex-wrap">
        <a class="valign horizontal-padding-1" href="http://summitawards.com/summit-creative-award/sca-winners/sca-winner-profiles/website/unity-digital-agency" target="_blank">
          <img class=""
               src="{{ App\asset_path('images/summit-2017.png') }}"
               srcset="{{ App\asset_path('images/summit-2017.png') }} 1x, {{ App\asset_path('images/summit-2017@2x.png') }} 2x"
               alt="Summit Creative Award 2017 Winner"
               width="104" height="104" />
        </a>
        <a class="valign horizontal-padding-1" href="{{ get_permalink(get_page_by_path('hosting')) }}">
          <img class=""
               src="{{ App\asset_path('images/eco-friendly-website.png') }}"
               srcset="{{ App\asset_path('images/eco-friendly-website.png') }} 1x, {{ App\asset_path('images/eco-friendly-website@2x.png') }} 2x"
               alt="300% eco-friendly website"
               width="160" height="103" />
        </a>
        <a class="valign horizontal-padding-1" href="https://www.bcorporation.net/what-are-b-corps" target="_blank">
          <img class=""
               src="{{ App\asset_path('images/pending-b-corp.png') }}"
               srcset="{{ App\asset_path('images/pending-b-corp.png') }} 1x, {{ App\asset_path('images/pending-b-corp@2x.png') }} 2x"
               alt="B Corporation - Pending"
               width="59" height="104" />
        </a>
        <span class="valign horizontal-padding-1">
          <img class=""
               src="{{ App\asset_path('images/wcag.png') }}"
               srcset="{{ App\asset_path('images/wcag.png') }} 1x, {{ App\asset_path('images/wcag@2x.png') }} 2x"
               alt="WCAG version 2.0 level AA"
               width="110" height="80" />
        </span>
        <!-- <a class="valign horizontal-padding-1" href="http://www.supplier-connection.net" target="_blank">
          <img class=""
               src="{{ App\asset_path('images/sc_badge_supporter.png') }}"
               alt="Supplier Collection. Connect with this growing network"
               width="160" height="100" />
        </a> -->
      </div>
    </section>
  @endwhile
@endsection
