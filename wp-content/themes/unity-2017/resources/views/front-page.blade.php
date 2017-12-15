@extends('layouts.app')

@section('content')
  <section class="hero yellow-swish" role="region" aria-labelledby="hero1">
    <div class="row parallax-container">
      <div class="col s12 m4 l3 push-l1">
        <p id="hero1">Working together to spark vibrancy in our community.</p>
      </div>
      <div class="col s12 m8 push-l1">
        <div class="parallax-faster right-align">
          <img class="z-depth-2" src="{{ App\asset_path('images/vibrancy.jpg') }}" alt="Woman with orange hair and clothing standing in front of a brightly painted mural.">
        </div>
      </div>
    </div>
  </section>

  <section class="clearfix row vertical-padding-1" role="region" aria-labelledby="h1">
    <div class="col l9 align-center">
      <h1 id="h1" class="center">We are a digital agency for community-focused businesses.</h1>
    </div>
  </section>

  @include('partials.content-clients', [
    'clients'   => [
      [
        'img'    => App\asset_path('images/rtp.png'),
        'img2x'  => App\asset_path('images/rtp@2x.png'),
        'alt'    => 'Research Triangle Park',
        'width'  => '100',
        'height' => '55'
      ],
      [
        'img'    => App\asset_path('images/nc-rural-center.png'),
        'img2x'  => App\asset_path('images/nc-rural-center@2x.png'),
        'alt'    => 'North Carolina Rural Center',
        'width'  => '113',
        'height' => '48'
      ],
      [
        'img'    => App\asset_path('images/redhat.png'),
        'img2x'  => App\asset_path('images/redhat@2x.png'),
        'alt'    => 'Red Hat',
        'width'  => '126',
        'height' => '40'
      ],
      [
        'img'    => App\asset_path('images/unc.png'),
        'img2x'  => App\asset_path('images/unc@2x.png'),
        'alt'    => 'University of North Carolina at Chapel Hill',
        'width'  => '140',
        'height' => '40'
      ],
      [
        'img'    => App\asset_path('images/tnca.png'),
        'img2x'  => App\asset_path('images/tnca@2x.png'),
        'alt'    => 'The NC Arboretum',
        'width'  => '140',
        'height' => '37'
      ],
      [
        'img'    => App\asset_path('images/padgett-nc.png'),
        'img2x'  => App\asset_path('images/padgett-nc@2x.png'),
        'alt'    => 'Padgett Business Services North Carolina',
        'width'  => '100',
        'height' => '50'
      ],
    ]
  ])

  <section class="background-dark parallax-container overflow-hidden vertical-padding-3 flex-grid small-center" role="region" aria-labelledby="awesome1">
    <div class="low-poly-dark mega-back parallax-wayback"></div>
    <div class="row valign-wrapper flex-center">
      <div class="col s12 m6 push-l1">
        <p class="strong font-size-h2" id="awesome1">Together, we make awesome happen.</p>
      </div>
      <div class="col s12 m5 push-l1">
        <a class="btn btn-large icon-appear-right" href="#">Let's Do It <i class="material-icons">arrow_forward</i></a>
      </div>
    </div>
  </section>

  <section class="vertical-padding-3 services" role="region" aria-labelledby="services1">
    <p class="center" id="services1"><span class="strong underline">Leading our clients to inspire action with:</span></p>
    <div class="row vertical-padding-2">
      @include('partials.content-services', [
      'columns'   => [
          [
            'img'     => App\asset_path('images/research-icon.svg'),
            'title'   => 'Research',
            'items'   => [
              'Mission immersion',
              'Historic benchmarking',
              'Stakeholder interviews',
              'Customer surveys',
              'Comparative analyses',
              'User persona workshops',
              'Keyword research'
            ]
          ],
          [
            'img'     => App\asset_path('images/strategy-icon.svg'),
            'title'   => 'Strategy',
            'items'   => [
              'Digital strategy',
              'Brand strategy',
              'Content strategy',
              'SEO strategy',
              'Information architecture',
              'Marketing strategy',
              'Web accessibility'
            ]
          ],
          [
            'img'     => App\asset_path('images/design-icon.svg'),
            'title'   => 'Design',
            'items'   => [
              'Logo and brand design',
              'Identity packages',
              'Marketing materials',
              'UX design',
              'Website design',
              'WordPress development',
              'Content writing',
              'Email campaigns'
            ]
          ],
          [
            'img'     => App\asset_path('images/support-icon.svg'),
            'title'   => 'Support',
            'items'   => [
              'Eco-friendly web hosting',
              'Website maintenance',
              'Website security',
              'Analytics reporting',
              'WordPress training',
              'Search engine optimization'
            ]
          ]
        ]
      ])
    </div>
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
        <div class="col s12 m6">
          <div class="ratio-4-3">
            @include ('partials.content-'.(get_post_type() !== 'post' ? get_post_type() : get_post_format()))
          </div>
        </div>
      @endwhile @endif @php(wp_reset_postdata())
    </div>
  </section>

@endsection
