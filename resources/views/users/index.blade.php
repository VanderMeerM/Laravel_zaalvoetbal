@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>


<x-header>
</x-header>

<x-addbtn>
Nieuwe speler toevoegen
</x-addbtn>


<body>

@foreach ($users as $user)

<div style="display: flex">

<x-block>

<a href= "{{ route('users.show', ['user' => $user->id])}}" >

{{  $user->firstname }} {{ $user->lastname}}   

</a>

</x-block>

 <a class="flex-initial" href=" {{ route('delete_user', ['id' => $user->id]) }}">Verwijder</a>

</div>

@endforeach




</body>