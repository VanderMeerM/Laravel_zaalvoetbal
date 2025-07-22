
@extends('CSS.app')

<script src="https://cdn.tailwindcss.com"></script>

<body>

<div class="center">

@foreach ($dates as $date )


<div class="dateblock"> 

<a href= "{{ route('voetballers.show', ['voetballer' => $date->Id])}}" >

{{  $date->date }}

</a>
</div>

@endforeach


</div>

</body>
</html>