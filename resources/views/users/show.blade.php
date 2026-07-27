@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>

<div style="text-align: center;">

<a href = {{ route('users.index') }}>Alle spelers </a>
     
 <div>

 
@if ( ($logged_in_user == $user->id) || ($user->isAdmin === 'on') )
 <p>Zelfde gebruiker als ingelogde gebruiker of admin </p>
@endif

<div style="display: flex; justify-content: center;">

  <form method="post" action= {{ route('users.update', 
  ['user' => $user->id]) }}>

  @csrf 

<div class="w-full max-w-lg mt-20">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Voornaam 
      </label>
      <input class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="firstname" id="grid-first-name" type="text" value= {{ $user->firstname }} > 
      
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Achternaam
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="lastname" id="grid-last-name" type="text" value= {{ $user->lastname }}> 
      
    </div>
  </div>

   <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        E-mail 
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" name="email" type="text" value= {{ $user->email }} >
    </div>
  </div>

    <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="birthdate">
        Geboortedatum 
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="birthdate" id="birthdate" type="date" value= {{ $user->birthdate }}>
    </div>
  </div>




  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Nieuw Wachtwoord 
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password" id="grid-password" type="password" >
    </div>
  </div>
<!--
    <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Bevestig Nieuw Wachtwoord 
      </label>
      <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password_confirmation" id="grid-password" type="password" >
    </div>
  </div>
-->

  @if ($user->hasBall) 
  <div> {{ $user->firstname }} heeft een bal. </div>
  @endif

 
     <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Opslaan</button>

  </form>

</div>

</div>

</body>