<div class="text-center mt-5">

@php

$url = explode('/', url()->current())[3];

@endphp

<a href= " ./{{ $url }}/create" class="rounded-md bg-orange-500 px-3 py-2 text-sm font-medium text-yellow-300"> {{ $slot }}</a>
</div>