@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>


<x-header>
</x-header>

<x-addbtn>
Nieuwe speler toevoegen
</x-addbtn>


<body>

@foreach ($users as $user)

<div style="display: flex; justify-content: center;">

<x-block>

<a href= "{{ route('users.show', ['user' => $user->id])}}" >

{{  $user->firstname }} {{ $user->lastname }}   

</a>

</x-block>

 <button form="delete_user" class="flex-initial text-red-500 mr-20"> X </button>

 <form action='/users/{{ $user->id }}' method="post">
 @csrf
 @method('POST')
  <input name="hasBall" @if ($user->hasBall) checked @endif id="hasBall" type="checkbox">
  <label for="hasBall"> heeft een bal</label> 

 </form>


</div>

<form id="delete_user" method="post" action='/users/{{ $user->id }}' class="hidden">
@csrf
@method('DELETE')

</form>

@endforeach

</body>