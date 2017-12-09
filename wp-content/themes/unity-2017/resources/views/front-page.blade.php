@extends('layouts.app')

@section('content')
  <section class="hero">
    <div class="row parallax-container">
      <div class="col m8 push-m4">
        <div class="parallax-faster">
          <img class="z-depth-2" src="{{ App\asset_path('images/vibrancy.jpg') }}" alt="Woman with orange hair and clothing standing in front of a brightly painted mural.">
        </div>
      </div>
      <div class="col m3 pull-m7">
        <p>Working together to spark vibrancy in our community.</p>
      </div>
    </div>
  </section>

  <section class="clearfix row vertical-padding-1">
    <div class="col l9 align-center">
      <h1 class="center">We are a digital agency for community-focused businesses.</h1>
    </div>
  </section>

  @include('partials.content-clients', [
    'clients'   => [
      [
        'img'    => App\asset_path('images/redhat.png'),
        'img2x'  => App\asset_path('images/redhat@2x.png'),
        'alt'    => 'Red Hat',
        'width'  => '126',
        'height' => '40'
      ],
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

  <section class="background-dark vertical-padding-1">
    <div class="row valign-wrapper flex-center">
      <div class="col m6 push-m1">
        <p class="strong font-size-h2">Together, we make awesome happen.</p>
      </div>
      <div class="col m5">
        <a class="btn btn-large" href="#">Let's Do It</a>
      </div>
    </div>
  </section>

  <section class="blog">

  </section>
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

  <section class="blog-grid">
    <div class="row collapse">
      @php(
        $blog = new WP_Query([
          'post_type' => 'post',
          'posts_per_page' => 4
        ])
      )
      @if ($blog->have_posts()) @while ($blog->have_posts()) @php($blog->the_post())
        <div class="col m6">
          <div class="ratio-4-3">
            @include ('partials.content-'.(get_post_type() !== 'post' ? get_post_type() : get_post_format()))
          </div>
        </div>
      @endwhile @endif @php(wp_reset_postdata())
    </div>
  </section>

@endsection
