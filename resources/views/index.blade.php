
@extends( 'CSS.app')

   <!-- @vite('resources/css/app.css') -->

  <script src="https://cdn.tailwindcss.com"></script> 

<body>

@foreach ($dates as $date )


<x-dateblock> 

<a href= "{{ route('voetballers.show', ['voetballer' => $date->id])}}" >

{{  $date->date }}

</a>
</x-dateblock>

@endforeach


</body>
</html>