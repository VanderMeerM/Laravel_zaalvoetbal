
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>


<div class="center">

<a href="{{ route('voetballers.index') }}">Terug naar overzicht </a>


<table>

<tr>
<th>Speler</th>
<th>Aanwezigheid</th>
<th>Kleur</th>


</tr>

@foreach($matchround as $match)
    
<tr>

<td>
 {{  $match->player->name }} 
</td>

<td> 

@if ($match->present) 

<a style="color:green" href="/voetballers/{{ $match->id }}/edit">Aanwezig </a> 

@else
<a style="color:red" href="/voetballers/{{ $match->id }}/edit">Afwezig </a> 

@endif

</td>


<td>

<select>
    @foreach($teams as $team) 
     <option> {{ $team->color }} </option> 
     @endforeach
</select>

</td>

</tr>     

@endforeach

</table> 

</div>