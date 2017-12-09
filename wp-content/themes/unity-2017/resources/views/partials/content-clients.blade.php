<section class="client-logos vertical-padding-3">
  <p class="center"><span class="strong underline">Elevating businesses as diverse as</span></p>
  <div class="valign-wrapper flex-center flex-wrap">
    @foreach ($clients as $client)
      <span class="vertical-padding-1 horizontal-padding-1 ">
        <img class="valign {{ $client['class'] }}"
             alt="{{ $client['alt'] }}"
             src="{{ $client['img'] }}"
             srcset="{{ $client['img'] }} 1x, {{ $client['img2x'] }} 2x"
             @if ($client['width']) width="{{ $client['width'] }}" @endif
             @if ($client['height']) height="{{ $client['height'] }}" @endif />
      </span>
    @endforeach
  </div>
</section>
