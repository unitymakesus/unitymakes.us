@foreach ($columns as $column)
  <div class="col s12 m6 l4">
    <div class="center">
      <div class="flex-height-115">
        {{ App\svg_image($column['svg']) }}
      </div>
      <h2 class="font-size-h4">{{ $column['title'] }}</h2>
    </div>
    <p class="center">{{ $column['desc'] }}</p>
  </div>
@endforeach
