@extends('CSS.app')

<body>

<div class="center">

<a href = {{ route('players.index') }}>Alle spelers </a>
     
 <div>
{{ $user->name }}
</div>

<div>
{{ $user->email }}
</div>

</div>

</body>