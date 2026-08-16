@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>


<x-header>
</x-header>

<body>

<div style="text-align: center;">
   
 <div>

@if ($user->isActive === 'N' && $logged_in_user == $user->id)  

<x-note> Momenteel is je gebruikersstatus inactief. <br>Neem contact op met een beheerder.</x-note>

@elseif ($user->isActive === 'N')

<x-note> Deze gebruikers is momenteel niet actief.</x-note>

@endif  

<div class="center">

@auth

<div> 

<form action=" {{ route('upload.uploadprofileimg') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <input type="hidden" name="user_id" value = {{  $user->id }}>
    <button type="submit">Foto uploaden</button>
</form>

</div>

@endauth

<div class="container_form_player">

  <form method="post" action= {{ route('users.update', 
  ['user' => $user->id]) }}>

  @csrf 

@if ($user->image)
<div>
<img id="profile_img" src="/spelers/{{ $user->image }}">
 </div>
@endif


<div class="w-full max-w-lg mt-20">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Voornaam 
      </label>
      <input class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
      name="firstname" 
      id="grid-first-name" 
      type="text"
       @if ( ($logged_in_user != $user->id) && (Auth::user()->isAdmin !== 'on') ) disabled @endif

      value= "{{ $user->firstname }}" > 
      
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Achternaam
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
      name="lastname" 
      id="grid-last-name" 
      type="text" 
       @if ( ($logged_in_user != $user->id) && (Auth::user()->isAdmin !== 'on') ) disabled @endif
      value= "{{ $user->lastname }}"> 
      
    </div>
  </div>

   <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        E-mail 
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
      id="grid-password" 
      name="email" 
      type="text" 
       @if ( ($logged_in_user != $user->id) && (Auth::user()->isAdmin !== 'on') ) disabled @endif
      value= {{ $user->email }} >
    </div>
  </div>

    <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="birthdate">
        Geboortedatum 
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
      name="birthdate" 
      id="birthdate" 
      type="date" 
       @if ( ($logged_in_user != $user->id) && (Auth::user()->isAdmin !== 'on') ) disabled @endif
      value= {{ $user->birthdate }}>
    </div>
  </div>

 @if (Auth::user()->isAdmin === 'on')

  <div class="sm:col-span-4 flex flex-direction-row">
        <label for="isAdmin" class="block text-sm/6 font-medium text-gray-900">Is administrator</label>
          <div class="mt-2 ml-2">
            <input id="isAdmin" type="checkbox" name="isAdmin" 
            @if ($user->isAdmin === 'on') checked @endif />
          </div>
        </div> 

  @endif

  
 @if ( ($logged_in_user == $user->id) || (Auth::user()->isAdmin === 'on') ) 
  <button type="submit" class="rounded-md bg-orange-500 px-3 py-2 text-sm font-semibold text-yellow-300 shadow-sm mt-3 mb-10">Opslaan</button>
 @endif


  </form>

 @if ( ($logged_in_user == $user->id) || (Auth::user()->isAdmin === 'on') ) 
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Nieuw Wachtwoord (nog niet actief)
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password" id="grid-password" type="password" >
    </div>
  </div>

    <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Bevestig Nieuw Wachtwoord (nog niet actief)
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password_confirmation" id="grid-password" type="password" >
    </div>
  </div>
@endif

</div>

</div>

</div>

</body>