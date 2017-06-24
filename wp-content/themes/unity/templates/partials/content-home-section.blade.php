<section class="container vertical-padding-3">
  <div class="row">
    <div class="col m8 push-m2">
      <h2 class="h4 accent center-align"><span>{{ $title }}</span></h2>
      <p class="center-align flow-text">{{ $content }}</p>
    </div>
  </div>
  <div class="row">
    @foreach ($cards as $card)
      <div class="col s12 m4">
        <div class="card primary-color hoverable">
          <a href="{{ $card['link'] }}">
            <div class="card-image">
              <img src="{{ $card['img'] }}" alt="{{ $card['alt'] }}" />
            </div>
            <div class="card-action">
              {!! $card['title'] !!}
            </div>
          </a>
        </div>
      </div>
    @endforeach
  </div>
</section>
