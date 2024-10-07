<h1>Przesyłam prognozę pogody na obecny dzień ({{ date('Y-m-d') }})</h1>
<ul style="list-style:none;margin-top:16px">
    @if ($data)
        @foreach ($data as $hour)
            <li>{{ $hour }}</li>
        @endforeach
    @endif
</ul>
