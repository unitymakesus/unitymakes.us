@foreach ($columns as $column)
  <div class="col m3">
    <div class="center">
      <div class="flex-height-115">
        {!! file_get_contents($column['img']) !!}
      </div>
      <h2 class="font-size-h4">{{ $column['title'] }}</h2>
    </div>
    <ul>
      @foreach ($column['items'] as $li)
        <li>{{ $li }}</li>
      @endforeach
    </ul>
  </div>
@endforeach
