<section class="vertical-padding-3 client-logos">
  <div class="valign-wrapper center-align flex-wrap">
    @foreach ($clients as $client)
      <span class="vertical-padding-1">
        <img class="valign horizontal-padding-1 {{ $client['class'] }}"
             src="{{ $client['img'] }}"
             alt="{{ $client['alt'] }}"
             @if ($client['width']) width="{{ $client['width'] }}" @endif />
      </span>
    @endforeach
  </div>
</section>
