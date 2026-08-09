
@extends( 'CSS.app')

<script src="https://cdn.tailwindcss.com"></script> 

<body>

<x-header></x-header>

@foreach ($dates as $date )

<x-block>

<a href= "{{ route('voetballers.show', ['voetballer' => $date->id])}}" >

{{  $date->date }}

</a>

</x-block>

@endforeach


</body>
</html>