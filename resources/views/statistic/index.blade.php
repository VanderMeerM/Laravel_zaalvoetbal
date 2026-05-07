@extends( 'CSS.app')
 

 <script src="https://cdn.tailwindcss.com"></script> 
 <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.0/chart.js"></script>

<x-header>    </x-header>

<html>
<body>

<div class="main_container_up">

<div class="container_table">

<h1> Aanwezigheid</h1>

<div class="center">

<table>

@foreach ($array_present as $name => $present) 

<tr>
<td> {{ $name }} </td>
<td> {{  $present }}% </td>
</tr>

@endforeach

</table>
 </div>
 </div>

 <div class="container_table">


<h1> Winst oranje/geel </h1>

<div class="center">

<p></p>
<!--present = 1 and team =0/1 and result = W/L/D 

<canvas id="chart_team"></canvas>-->

<table>
<tr>
<td>
Oranje 
</td>
<td>{{ $num_team_orange_won }} ({{ round(($num_team_orange_won/$numgames) * 100, 0) }}%)
</td>
</tr>

<tr>
<td>
Geel
</td>
<td>{{ $num_team_yellow_won }} ({{ round(($num_team_yellow_won/$numgames) * 100, 0) }}%)
</td>
</tr>
<tr>
<td>
Gelijk
</td>
<td>{{ $num_draw }} ( {{round(($num_draw/$numgames) * 100, 0) }}%)
</td>
</tr>
</table>
</div>
</div>

<div class="container_table">

<h1> Winst speler (obv aanwezigheid) </h1>

<div class="center">
  
<table>

@foreach ($array_player_won as $name => $won) 

<tr>
<td> {{ $name }} </td>
<td> {{ $won }}% </td>
</tr>

@endforeach

</table>
 </div> 
 </div>

 </div>

 <div class="main_container_down">

<div class="container_table">

<h1> In welk team? </h1>

<div class="center">
  
<table>
  <tr>
    <th>Speler</th>
    <th>Oranje</th>
    <th>Geel</th>
  </tr>

@foreach ($array_player_orange as $name => $orange) 

<tr>
<td> {{ $name }} </td>
<td> {{  $orange }}% </td>
<td> {{ 100 - $orange }}%</td>
</tr>

@endforeach

</table>
</div> 
</div>

<p></p>


<div class="container_table">
  
<h1> Meest waardevolle speler <br>(obv aanwezigheid + winstpotjes)</h1>

<div class="center">
<p></p>

<table>


@foreach ($array_most_valuable_player as $name => $valuable) 

<tr>
<td> {{ $name }} </td>
<td> {{  $valuable }}% </td>
</tr>

@endforeach

</table>

</div>

<script defer>
  let chartTeam = document.getElementById('chart_team').getContext('2d');

  let pieChart = new Chart(chartTeam, 
  { 
    type: 'pie',
    data: {
      labels: ['Oranje', 'Geel'],
      datasets: [13, 18]
    },
    options: {}

  });

</script>

</body>
</html>

