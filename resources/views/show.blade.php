
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>


<div class="center">

<x-center>

<a href="{{ route('voetballers.index') }}">Terug naar overzicht </a>

</x-center>


<table>


<tr>
<th>Aanwezig ({{ $num_present }})</th>
<th>Afwezig ({{ $num_absent }})</th>
<th>Team</th>
</tr>

@foreach($matchround as $match)
    
<tr>

@if ($match->present) 

<td> 
<a style="color:green" href="/voetballers/{{ $match->id }}/edit">{{  $match->player->firstname }} </a> 
</td>
<td></td>

@else

<td></td>

<td>
<a style="color:red" href="/voetballers/{{ $match->id }}/edit">{{  $match->player->firstname }} </a> 
</td>

@endif

<td>

@if ($match->present) 

<a href="/voetballers/change_team/{{ $match->id }}"> {{ $match->team_id == 1 ? 'oranje' : 'geel' }} </a> 

@endif

</td>

</tr>     

@endforeach

</table> 

</div>