<section class="vertical-padding-3 client-logos">
  <div class="valign-wrapper center-align flex-wrap">
    @foreach ($clients as $client)
      <span class="vertical-padding-1">
        <img class="valign horizontal-padding-2 {{ $client['class'] }}"
             alt="{{ $client['alt'] }}"
             src="{{ $client['img'] }}"
             srcset="{{ $client['img'] }} 1x, {{ $client['img2x'] }} 2x"
             @if ($client['width']) width="{{ $client['width'] }}" @endif />
      </span>
    @endforeach
  </div>
</section>
