@extends( 'CSS.app')
 

 <script src="https://cdn.tailwindcss.com"></script> 

<x-header> </x-header>

<html>
<body>

<form action= '' method="post"> 
@csrf 

<div class="season_selection">

Seizoen 
<select name="selected_season" onchange="this.form.submit()">

<option disabled>Selecteer seizoen</option>

@foreach ($all_seasons as $as)

<option value="{{ $as->season }}"
@if ($as->season == $selected_season) selected @endif >
{{ $as->season }} - {{ $as->season+1 }}</option> 

@endforeach

</select>
</form>

</div>

<div class="main_container_up">

 <div class="container_table">

 <div style="text-align: center; margin-top: 3%">

Wedstrijdpercentage met minimaal 10 eigen spelers: 

<div style="font-size: 30px;">
{{ round(($matches_with_min_10_players/$numgames) * 100, 0) }}% 
({{ $matches_with_min_10_players }}/{{ $numgames }})

</div>
</div>
</div>

 <div class="container_table">


<h1> Winst oranje/geel </h1>

<div class="center">

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



 </div>

 <div class="main_container_down">

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

<h1> Winst speler</h1> <h3>(obv aanwezigheid) </h3>

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
<td> {{  $valuable }} </td>
</tr>

@endforeach

</table>

</div>

</body>
</html>

