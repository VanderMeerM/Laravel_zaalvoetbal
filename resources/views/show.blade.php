

@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>

<x-header></x-header>


<div class="text-4xl font-bold ml-5"> {{ date_format($date_create, 'd-m-Y') }} 

@if ($match_nr > 1) 
- potje {{ $match_nr }} 
@endif
</div>

 @if (Auth::user()->isAdmin === 'on')

<form action= {{ route('dates.copy', ['id' => $current_date_id]) }} method="post"> 
@csrf 

<input type="hidden" value= {{ $current_season }} name="current_season">
<input type="hidden" value= {{ $current_date }} name="current_date">


<button id="copy_button" type="submit">Kopieer dit potje</button>

</form>

 @endif 

 

<table style="margin: 2% auto">

<tr>
<th>Aanwezig ({{ $num_present }})</th>
<th>Afwezig ({{ $num_absent }})</th>
<th>Team</th>
</tr>

@foreach($matchround as $match)

<tr>

@if ($match->present) 

<td> 

<a style="color:green; display:flex;" 

@if ( ($logged_in_user == $match->user_id) || (Auth::user()->isAdmin === 'on')) 
href="/change_presence/{{ $match->id }}" 
@endif >  {{  $match->firstname }} 


@if  ($users_with_ball->contains($match->user_id)) <img id="ball" src= {{url('ball.png')}}> @endif </a>

</td>

<td></td>

@else

<td></td>

<td>
<a style="color:red; display:flex;" 

@if ( ($logged_in_user == $match->user_id) || (Auth::user()->isAdmin === 'on')) 
href="/change_presence/{{ $match->id }}" 
@endif >{{  $match->firstname }} 


@if  ($users_with_ball->contains($match->user_id)) <img id="ball" src= {{url('ball.png')}}> @endif </a> 

</td>

@endif

<td>

@if ($match->present) 

<a 
 
@if (Auth::user()->isAdmin === 'on') href="/change_team/{{ $match->id }}" 
@endif
> 
<span class= {{ $match->team_id == 1 ? "orange_team_dot" : 'yellow_team_dot' }} ></span></a> 

@endif



</td>

</tr>     

@endforeach

</table> 

 <div class="text-4xl font-bold ml-5 mt-3 text-center"> Uitslag </div>


 <form method="post" action="/dates/{{ $current_date_id->id}}">
@csrf 
@method('PATCH')

<div class="flex items-center justify-center mt-2 bg-black p-5 w-64 m-auto">
 <div>

 <input 
 class="block w-16 m-4 rounded-md bg-orange-500 px-3 py-1.5 text-center text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
 type="number" id="goals_orange" name="goals_orange" value= {{ $current_date_id-> result_orange }}
 @if (Auth::user()->isAdmin !== 'on') disabled @endif 
  />

 </div>

 <div>

 <input 
class="block w-16 rounded-md bg-yellow-300 px-3 py-1.5 text-center text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
type="number"  id="goals_yellow" name="goals_yellow" value= {{ $current_date_id-> result_yellow }} 
 @if (Auth::user()->isAdmin !== 'on') disabled @endif 
/>

</div>

</div>

 @if (Auth::user()->isAdmin === 'on') 

<x-addbtn>
<button type="submit">Opslaan</button>
</x-addbtn>

@endif

</form>

</body>
</html>
