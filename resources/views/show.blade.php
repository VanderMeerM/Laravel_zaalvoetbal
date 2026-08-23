

@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>

<x-header></x-header>

<div class="text-4xl font-bold ml-5"> {{ date_format($date_create, 'd-m-Y') }} 

@if ($match_nr > 1) 
- potje {{ $match_nr }} 
@endif
</div>

 @if ( (Auth::user()->isAdmin === 'on') && (strtotime($current_date) + 86400) > strtotime(date('d-m-Y')) )

<div style="display: flex;">

<div style="width: 50%;">

<form action= {{ route('dates.copy', ['id' => $current_date_id]) }} method="post"> 
@csrf 

<input type="hidden" value= {{ $current_season }} name="current_season">
<input type="hidden" value= {{ $current_date }} name="current_date">


<button id="copy_button" type="submit">Kopieer dit potje</button>

</form>

</div>

<div class="place-items-end" style="width: 50%;">

<form action="../add_spare_player/{{$current_date_id->id}}" method="post">
@csrf
@method('POST')

<input name="spare_player" class="block m-3 ml-0 pl-2 border-2" type="text" placeholder="Naam speler"> 
<input class="rounded-md bg-orange-500 px-3 py-2 text-sm font-medium text-yellow-300" 
    type="submit" value="Invaller toevoegen">
<input type="hidden" name="season" value= {{ $current_season }}>

  </form>
  
</div>
</div>

 @endif 

<table style="margin: 2% auto">

<tr>
<th>Aanwezig ({{ $num_present + $num_present_spare}})</th>
<th>Afwezig ({{ $num_absent + $num_absent_spare }})</th>
<th>Team</th>
</tr>

@foreach($matchround as $match)

<tr>

@if ($match->present) 

<td> 

<a style="color:green; display:flex;" 

@if ( ( ($logged_in_user == $match->user_id) && (strtotime($current_date) + 86400) > strtotime(date('d-m-Y')) )
|| (Auth::user()->isAdmin === 'on')) 
href="/change_presence/{{ $match->id }}" 
@endif >  {{  $match->firstname }} 


@if  ($users_with_ball->contains($match->user_id)) <img id="ball" src= {{url('ball.png')}}> @endif </a>

</td>

<td></td>

@else

<td></td>

<td>
<a style="color:red; display:flex;" 

@if ( ( ($logged_in_user == $match->user_id) && (strtotime($current_date) + 86400) > strtotime(date('d-m-Y')) )
|| (Auth::user()->isAdmin === 'on')) 
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

@if ($num_present_spare > 0) 

@foreach($spareplayers as $sp)

<tr style="background-color: #e6e7df;">

@if ($sp->present) 

<td> 
<a style="color:green; display:flex;">{{  $sp->name }} </a> 
</td>

<td></td>

@else

<td></td>

<td>
<a style="color:red; display:flex;"> {{  $sp->name }} </a>

</td>

@endif

<td>
<a 
 
@if (Auth::user()->isAdmin === 'on') href="/change_team_spare/{{ $sp->id }}" 
@endif
> 
<span class= {{ $sp->team_id == 1 ? "orange_team_dot" : 'yellow_team_dot' }} ></span></a> 
</td>

</tr>

@endforeach

@endif

</table> 


@foreach ($comments_to_date as $ctd) 

<div class="flex flex-col justify-center m-auto" style="width:fit-content;">

<div> <i>{{ date('d-m-Y H:i', strtotime($ctd->date))}} - {{ App\Models\User::find($ctd->user_id)->firstname }} </i></div>
<div> <strong><i>{{ $ctd->description }}</i></strong></div>

</div>

@endforeach 

<div class="flex justify-center m-auto;">

<form action="../add_comment/{{$current_date_id->id}}" method="post">
@csrf 
@method('POST')

<input type="hidden" name="user_id" value={{ Auth::user()->id }}>
<input style="border: 1px black solid; padding:2%;" placeholder="Schrijf een reactie" name="description" id="description"> 
<input class="invisible" type="submit" value="+">

</form>
</div>

 <form method="post" action="/dates/{{ $current_date_id->id}}">
@csrf 
@method('PATCH')

<div class="flex items-center justify-center mt-2 bg-black p-5 w-64 m-auto">
 <div>

 <input 
 class="block w-16 m-4 rounded-md bg-orange-500 px-3 py-1.5 text-center text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
 type="number" id="goals_orange" name="goals_orange" value= {{ $current_date_id-> result_orange }}
 @if (Auth::user()->isAdmin !== 'on') disabled @endif
 >

 </div>

 <div>

 <input 
class="block w-16 rounded-md bg-yellow-300 px-3 py-1.5 text-center text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
type="number"  id="goals_yellow" name="goals_yellow" value= {{ $current_date_id-> result_yellow }} 
 @if (Auth::user()->isAdmin !== 'on') disabled @endif 
>

</div>

</div>

 @if (Auth::user()->isAdmin === 'on') 

<x-savebtn_data>
   <button type="submit">Opslaan</button>
</x-savebtn_data>

@endif

</form>

</body>
</html>
