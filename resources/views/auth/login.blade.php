
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>

<div style="display:flex; justify-content: center;">
  
<img class="team_picture_login" src="./team.png">
</div>

<form method="post" action= "">
  @csrf 
  
       <div class="m-auto pb-12 w-1/2">
     
      <div class="m-10" style="display:flex; flex-direction:column; justify-content: center;">
    
        <div class="sm:col-span-4">
          <label for="email" class="block text-sm/6 font-medium text-gray-900">E-mailadres</label>
          <div class="mt-2">
    <input name="email" id="email" value= " {{ old('email') }}" type="email" class="
    block w-80 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6
    form-control @error('email') red @enderror @error('error') red @enderror" id="floatingInput">
          </div>
        </div>

         <div class="sm:col-span-4 mt-2">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Wachtwoord</label>
          <div class="mt-2">
      <input name= 'password' type="password" 
      
      class="block w-80 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6
      form-control @error('password') red @enderror  @error('error') red @enderror" id="floatingPassword">
          </div>
        </div>  

       </div>
       <div>     
        
            <x-nopassword></x-nopassword>
            <x-error> </x-error>
     </div>
             
 <button type="submit" class="rounded-md bg-orange-500 px-3 py-2 text-sm font-semibold text-yellow-300 shadow-sm">Log in</button>
  </div>
</form>

</body>

</html>