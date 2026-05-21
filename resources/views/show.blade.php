

@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<x-header></x-header>

<x-center>

<body>

<a></a>

</x-center>

 <div class="text-4xl font-bold ml-5"> {{ date_format($date_create, 'd-m-Y') }} </div>

<x-center> 

<table class="m-0 m-auto mt-3">

<tr>
<th>Aanwezig ({{ $num_present }})</th>
<th>Afwezig ({{ $num_absent }})</th>
<th>Team</th>
</tr>

@foreach($matchround as $match)

<tr>

@if ($match->present) 

<td> 

<a style="color:green; display:flex;" href="/change_presence/{{ $match->id }}"> {{  $match->user->firstname }} 
@if  ($users_with_ball->contains($match->user->id)) <img id="ball" src= {{url('ball.png')}}> @endif </a>

</td>

<td></td>

@else

<td></td>

<td>
<a style="color:red; display:flex;" href="/change_presence/{{ $match->id }}">{{  $match->user->firstname }} 
@if  ($users_with_ball->contains($match->user->id)) <img id="ball" src= {{url('ball.png')}}> @endif </a> 

</td>

@endif

<td>

@if ($match->present) 

<a href="/change_team/{{ $match->id }}"> {{ $match->team_id == 1 ? 'oranje' : 'geel' }} </a> 

@endif

</td>

</tr>     

@endforeach


</table> 

 <div class="text-4xl font-bold ml-5 mt-3"> Uitslag </div>

 </x-center>

 <form method="post" action="/dates/{{ $current_date_id->id}}">
@csrf 
@method('PATCH')

<div class="flex items-center">
 <div>

 <input 
 class="block w-16 rounded-md bg-orange-500 px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
 type="number" id="goals_orange" name="goals_orange" value= {{ $current_date_id-> result_orange }} />

 </div>

 <div>

 <input 
class="block w-16 rounded-md bg-yellow-300 px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
type="number"  id="goals_yellow" name="goals_yellow" value= {{ $current_date_id-> result_yellow }} />

</div>

</div>

<x-addbtn>
<button type="submit">Opslaan</button>
</x-addbtn>

</form>
