
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>

<div class="center">

<select>

<option> 4-9-2025</option>
<option> 11-9-2025</option>
<option> 18-9-2025</option>
</select>


<ul>


    @foreach($players as $player)

   <!-- <li> {{ $player->name }} </li> -->

       @foreach($matchround as $match)

        @if ($match->player_id == $player->id) <p> {{ $player->name }} <button> Aan-/Afwezig</button></p>
    @endif 
    
    @endforeach
    @endforeach

    
</ul>

</div>

</body>
</html>