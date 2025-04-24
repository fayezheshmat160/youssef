@php
$optionValue = null;
$optionText = null;
@endphp
<select name="{{ $name }}"
    @foreach ($options as $key => $val) @if (is_numeric($key)) {{ $val }} @else @php echo $key.'="'.$val.'"'; @endphp @endif
    @endforeach>



    @if (!isset($selected))
        <option disabled selected>{{ trans('global.choose') }}</option>
    @endif

    @foreach ($list as $opt)

     

    @endforeach

</select>



@foreach ($list as $key => $val)




        {{ $key }}
        {{ $val }}
@endforeach
