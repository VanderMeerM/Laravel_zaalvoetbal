
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script> 

<x-header></x-header>

<x-addbtn>
Nieuwe datum
</x-addbtn>


<div class="place-items-end mt-6 mr-4">

<form action="/dates/store" method="post"> 
@csrf 

<input id="date" name="date" class="block w-1/8 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

<button type="submit">Voeg toe </button>

</div>

</form>

@foreach ($dates as $date)

<x-block>

<a href=" {{ route('dates.show', ['date' => $date->id])}}" >

{{  $date->date }}

</a>

</x-block>

@endforeach


</form>


</div>