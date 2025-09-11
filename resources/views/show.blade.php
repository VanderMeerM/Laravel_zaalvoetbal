
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>


<x-center>

<a href="."> Terug naar overzicht speeldata</a>

</x-center>

 <div class="text-4xl font-bold ml-5"> {{ $current_date->date }} </div>

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

<a style="color:green" href="/change_presence/{{ $match->id }}"> {{  $match->user->firstname }} </a>
</td>

<td></td>

@else

<td></td>

<td>
<a style="color:red" href="/change_presence/{{ $match->id }}">{{  $match->user->firstname }} </a> 
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


 <div class="text-4xl font-bold ml-5">  Uitslag </div>

 <div class="h-10 w-10 mb-10 bg-orange-500"></div>

  <div class="h-10 w-10 mb-10 bg-yellow-300"></div>


