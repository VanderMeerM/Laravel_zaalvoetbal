
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script> 

<x-header></x-header>


<div class="place-items-end mt-6 mr-4">

<form action="/dates/store" method="post"> 
@csrf 

<input id="date" name="date" class="block w-1/8 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

<div class="mt-5">
<x-addbtn>
<button type="submit">Voeg datum toe</button>
</x-addbtn>
</div>

</div>

</form>

@foreach ($dates as $date)

<div style="display: flex; justify-content: center;">

<x-block>

<a href=" {{ route('dates.show', ['date' => $date->id])}}" >

{{  $date->date }}

</a>

</x-block>

<form method="post" action=" {{ route('dates.delete', ['date' => $date->id]) }}">
    @csrf
@method('DELETE')

<input type="submit" class="flex-initial text-red-500 mr-20" value="Verwijder"> 

</form>


<!-- <button form="delete_date" class="flex-initial text-red-500 mr-20">Verwijder </button> -->

</div>

<!--
<form id="delete_date" method="post" action='/dates/{{ $date->id }}' class="hidden">
@csrf
@method('DELETE')

</form>
-->

@endforeach


</body>