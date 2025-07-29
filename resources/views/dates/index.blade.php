


<div class="center">

@foreach ($dates as $date)


<div class="dateblock"> 

<div>

{{  $date->date }}


</div>

@endforeach

<form action="/dates/create" method="post">
    @csrf
    
<input type="submit" value="Voeg datum toe"></input>


</form>


</div>