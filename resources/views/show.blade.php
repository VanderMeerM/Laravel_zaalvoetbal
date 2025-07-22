
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>


<div class="center">

<a href="{{ route('voetballers.index') }}">Terug naar overzicht </a>


<table>

<tr>
<th>Aanwezig</th>
<th>Afwezig</th>
<th></th>

</tr>

@foreach($matchround as $match)
    
<tr>

@if ($match->present) 

<td>
 {{  $match->player->name }} 
</td>

<td></td>

@else
<td></td>

<td>
{{  $match->player->name }} 
</td>

@endif

<td>

<a href="/voetballers/{{ $match->id }}/edit">Aan-/Afwezig </a> 

</td>

</tr>     

@endforeach

</table> 

</div>