@extends('CSS.app')

<body>

<div class="center">

<a href = {{ route('dates.index') }}>Alle data </a>
    
@foreach ($match as $mt)

@php

$player_name = \App\Models\User::find($mt->user_id);

@endphp 

<div>

{{ $player_name->firstname }} {{ $player_name->lastname }}

</div>

@endforeach


</div>

</body>