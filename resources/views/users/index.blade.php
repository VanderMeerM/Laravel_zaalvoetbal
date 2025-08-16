@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>


<x-header>
</x-header>

<x-addbtn>
Nieuwe speler
</x-addbtn>


<body>

@foreach ($users as $user)

<x-block>

<a href= "{{ route('users.show', ['user' => $user->id])}}" >

{{  $user->firstname }} {{ $user->lastname}}   

</a>

</x-block>

 <a href=" {{ route('delete_user', ['id' => $user->id]) }}">Verwijder</a>


@endforeach


</body>