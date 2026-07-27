
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>

<form method="post" action= "">
  @csrf 
  
     <div class="m-auto border-b border-gray-900/10 pb-12 w-1/2">
     
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
    
        <div class="sm:col-span-4">
          <label for="email" class="block text-sm/6 font-medium text-gray-900">E-mailadres</label>
          <div class="mt-2">
    <input name="email" id="email" value= " {{ old('email') }}" type="email" class="form-control @error('email') red @enderror @error('error') red @enderror" id="floatingInput">
          </div>
        </div>

         <div class="sm:col-span-4">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Wachtwoord</label>
          <div class="mt-2">
      <input name= 'password' type="password" class="form-control @error('password') red @enderror  @error('error') red @enderror" id="floatingPassword">
          </div>
        </div>  
      </div>
        <div>     
        
            <x-nopassword></x-nopassword>
            <x-error> </x-error>
     </div>
             
 <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log in</button>
  </div>
</form>

<!--
<form action="./dates" method="get">
  <div class="mt-6 flex items-center justify-end gap-x-6">
  <button type="submit" class="text-sm/6 font-semibold text-gray-900">Annuleren</button>
  </form> 
-->

 
</body>

</html>