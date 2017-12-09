<section class="vertical-padding-3">
  <p class="center"><span class="strong underline">Leading our clients to inspire action with:</span></p>
  <div class="row vertical-padding-2">
    @foreach ($columns as $column)
      <div class="col m3">
        <div class="center">
          {!! file_get_contents($column['img']) !!}
          <h2 class="font-size-h4">{{ $column['title'] }}</h2>
        </div>
        <ul>
          @foreach ($column['items'] as $li)
            <li>{{ $li }}</li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>
</section>
