<nav class="bg-orange-500 w-full m-auto">
  <div class="mx-auto ml-64 px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
       
      </div>
     
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">

            <a href="../users"><x-menubutton> Spelers </x-menubutton></a>

            <a href="../dates"><x-menubutton> Speeldata </x-menubutton></a>

             <a href="../statistieken"><x-menubutton> Statistieken </x-menubutton></a>
           
             </div>

             @guest
             <form action=" {{ route('auth.login') }}" method="get">
              @csrf

            <button class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-yellow-100" type="submit">Inloggen </button>
            </form>
            @endguest

            @auth

          @php
          if (date('H') > 0 && date('H') < 7) { 
          $greet = 'Goedenacht';
          } elseif (date('H') >= 7 && date('H') < 12) {
          $greet= 'Goedemorgen';
          } elseif (date('H') >= 12 && date('H') < 18) {
          $greet = 'Goedemiddag';
          } else {
          $greet = 'Goedenavond';
          }
          @endphp

             <div class="flex space-x-4" style="position: absolute; right: 10%; margin-top: -2%;">

            <a class="rounded-md px-3 py-2 text-sm font-medium text-black-500"> @php echo $greet @endphp {{ Auth::user()->firstname }}!</a>

             
                       
              <form method="post" action= "../logout">
              @csrf
            <button type="submit"> <img class="logout" src="../logout.png"></button>
            </form>
            @endauth
       
          </div>
        </div>
      </div>
     
</nav>