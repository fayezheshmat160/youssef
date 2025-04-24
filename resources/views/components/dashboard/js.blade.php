@section('js')
    @foreach ($files as $file)
        @if (isset($file['external']))
            <script type="{{ $file['type'] }}" src="{{ $file['external'] }}"></script>
        @else
            @php
                $ext = strstr($file['link'], '.js') == true ? '' : '.js';
            @endphp
            <script type="{{ $file['type'] }}" src="{{ asset($file['link'] . $ext) }}"></script>
        @endif
    @endforeach
@endsection
