<nav class="bg-cyan-800 w-1/2 m-auto">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
       
      </div>
     
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <a href= "../users" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Spelers</a>
            <a href="../dates" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Speeldata</a>
            <a href="../statistics" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Statistieken</a>

             @guest
             <form action=" {{ route('auth.login') }}" method="get">
              @csrf

            <button class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" type="submit">Inloggen </button>
              <!--<a href="../login" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Inloggen</a>-->
            </form>
            @endguest

            @auth
            <form method="post" action= "../logout">
              @csrf
            <button type="submit" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Uitloggen</button>
            </form>
            @endauth
            <!--<a href="./voetballers" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Rondes</a>-->
          </div>
        </div>
      </div>
     
</nav>