@extends('CSS.app')

<body>

<div class="center">

<a href = {{ route('users.index') }}>Alle spelers </a>
     
 <div>
{{ $user->name }}
</div>

<div>
{{ $user->email }}
</div>

</div>

</body>