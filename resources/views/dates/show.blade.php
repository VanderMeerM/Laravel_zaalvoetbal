@extends('CSS.app')

<body>

<div class="center">

<a href = {{ route('dates.index') }}>Alle data </a>
    
@foreach ($match as $mt )

 <div>

{{ $mt->date_id}}

</div>

@endforeach


</div>

</body>