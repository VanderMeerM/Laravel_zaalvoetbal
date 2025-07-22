@extends('CSS.app')

<body>

<div class="center">

<a href = {{ route('players.index') }}>Alle spelers </a>
     
 <div>
{{ $player->name }}
</div>

<div>
{{ $player->email }}
</div>

</div>

</body>