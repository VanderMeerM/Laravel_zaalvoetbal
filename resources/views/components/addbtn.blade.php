<div class="text-right mr-20">

@php

$url = explode('/', url()->current())[3];

@endphp

<a href= " ./{{ $url }}/create" class="rounded-md bg-green-600 px-3 py-2 text-sm font-medium text-white"> {{ $slot }}</a>
</div>