@foreach ($results as $result)
    <div>
        <strong>{{ $result['type'] }}</strong>
        {{ $result['title'] }}
    </div>
@endforeach
