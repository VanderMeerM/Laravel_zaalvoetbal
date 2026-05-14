@extends( 'CSS.app')
 

 <script src="https://cdn.tailwindcss.com"></script> 

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

<!--present = 1 and team =0/1 and result = W/L/D -->

<!--
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
-->

</div>

<div class="center">
<canvas id="chart_team"></canvas>
</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
  
<script>

const chartTeam = document.getElementById('chart_team');

const teamOrange = <?php echo json_encode($num_team_orange_won);?>;
const teamYellow = <?php echo json_encode($num_team_yellow_won);?>;
const numDraw = <?php echo json_encode($num_draw);?>;

const pieChart = new Chart(chartTeam, { 
    type: 'pie',
    data: {
      //labels: ['Oranje', 'Geel'],
      datasets: [
        {
            backgroundColor: ['orange', 'yellow', 'white'],
            data: [teamOrange, teamYellow, numDraw]
        }
      ]
    },
    options: {     
      plugins: {
        labels: {
          render: 'percentage', 
          fontColor: 'black',
          fontStyle: 'bolder',
           }
      }
    },
    plugins: [ChartDataLabels]
  });

  </script>

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
  
<h1> Meest waardevolle speler </h1><h3>(obv aanwezigheid + winstpotjes)</h3> 

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

</body>
</html>

