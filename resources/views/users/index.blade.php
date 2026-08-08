@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<x-header>
</x-header>

@if (Auth::user()->isAdmin === 'on') 

<x-addbtn>
Speler toevoegen
</x-addbtn>

@endif

<body>

@foreach ($users as $user)

<div style="display: flex; justify-content: center;">

@if (Auth::user()->isAdmin === 'on') 

<div class="container_activity">
  <a class="user_activity" href="../setactivity/{{ $user->id }}"> 
  {{ $user->isActive === 'Y' ?  "❌" : "✅" }}</a>
</div>
<!-- <button form="delete_user" class="flex-initial text-red-500 mr-20"> X </button> -->

 @endif

<x-playerblock>


    <img style="width: 50px; height: auto; align-items: center;" 
    @if ($user->image != '') src="/spelers/{{ $user->image }}" @endif >


<a class="player_img_name" href= "{{ route('users.show', ['user' => $user->id])}}" >

{{  $user->firstname }} {{ $user->lastname }}   

</a>

</x-playerblock>

 <div style="display: flex; align-content: center; flex-wrap: wrap;">

 <form action='../hasball/{{ $user->id }}' method="post">
 @csrf
 @method('POST')

 <div style="display:flex;">
  <input name="hasBall" @if ($user->hasBall) checked @endif type="checkbox" onclick="this.form.submit()">
   <img id="ball" src= {{url('ball.png')}} > 
</div>
 </form>

</div>


</div>

<form id="delete_user" method="post" action='/users/{{ $user->id }}' class="hidden">
@csrf
@method('DELETE')

</form>

@endforeach

</body>