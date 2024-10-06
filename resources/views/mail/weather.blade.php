<h1>Przesyłam prognoze pogody na obcny dzień ({{ date('Y-m-d') }})</h1>
<ul>
    @if ($data)
        @foreach ($data as $hour)
            <li>{{ $hour }}</li>
        @endforeach
    @endif
</ul>
