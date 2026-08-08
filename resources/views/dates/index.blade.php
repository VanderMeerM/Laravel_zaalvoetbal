
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script> 

<x-header></x-header>


<div class="place-items-end mt-6 mr-4">

<form action="/dates/store" method="post"> 
@csrf 

@if (Auth::user()->isAdmin === 'on') 

<input id="date" placeholder="JJJJ-MM-DD" name="date" class="block w-1/8 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
<input type="hidden" value= {{ $current_season }} name="current_season">



<div class="mt-5">
<x-addbtn>
<button type="submit">Voeg datum toe</button>
</x-addbtn>
</div>

@endif

</div>

</form>

<form action= {{ route('dates.change_season') }} method="post"> 
@csrf 

<div class="season_selection">

<select name="selected_season" onchange="this.form.submit()">

<option disabled>Selecteer seizoen</option>

@foreach ($all_seasons as $as)

<option value="{{ $as->season }}"
@if ($as->season == $selected_season) selected @endif >
{{ $as->season }}</option> 

@endforeach

</select>
</form>

</div>

@foreach ($dates as $date)

<div class="center" style="padding: 0%">

<x-dateblock>

<a href=" {{ route('dates.show', ['date' => $date->id])}}" >

@php 
$single_date = date_create($date->date);
echo date_format($single_date, "d-m-Y"); @endphp

</a>

</x-dateblock>

@if (Auth::user()->isAdmin === 'on') 

<div style="align-items: center; justify-content: center; display: flex">

<form method="post" action=" {{ route('dates.delete', ['date' => $date->id]) }}">
    @csrf
@method('DELETE')

<input type="submit" class="flex-initial text-red-500 mr-20" value="X"> 

</form>

</div>
@endif

</div>

<!--
<form id="delete_date" method="post" action='/dates/{{ $date->id }}' class="hidden">
@csrf
@method('DELETE')

</form>
-->

@endforeach


</body>