@extends('CSS.app')

 @vite('resources/css/app.css')

<x-header>
</x-header>

@if (Auth::user()->isAdmin === 'on') 

<x-addbtn>
Speler toevoegen
</x-addbtn>

@endif

<body>

@if ($players_with_ball > 2) 

<x-note>Er zijn meer dan twee spelers met een bal. <br> Verwijder het vinkje bij de speler die geen bal (meer) heeft.  
</x-note>

@endif

@foreach ($users as $user)

<div style="display: flex; justify-content: center; {{ $user->isActive === 'N'? "opacity: 50%;" : null }}">

@if (Auth::user()->isAdmin === 'on') 

<div class="container_activity">
  <a class="user_activity" href="../setactivity/{{ $user->id }}"> 
  {{ $user->isActive === 'Y' ?  "🔴" : "🟢" }}</a>
</div>

 @endif

<x-playerblock>


    <img style="width: 50px; height: auto; align-items: center;" 
    @if ($user->image != '') src="/spelers/{{ $user->image }}" @endif >


<a class="player_img_name" href= "{{ route('users.show', ['user' => $user->id])}}" >

{{  $user->firstname }} {{ $user->lastname }}   

</a>

</x-playerblock>


 <div style="display: flex; align-content: center; flex-wrap: wrap;">

 @if ($user->isActive === 'Y')

 <form action={{ route('user.hasball', ['id' => $user->id]) }} method="post">

 @csrf
 @method('POST')

 <div style="display:flex;">
  <input name="hasBall" @if ($user->hasBall) checked @endif type="checkbox" onclick=this.form.submit()>
   <img id="ball" src= {{url('ball.png')}} > 
</div>
 </form>

@endif

</div>
</div>

@endforeach

</body>