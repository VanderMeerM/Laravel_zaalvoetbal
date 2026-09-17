@extends( 'CSS.app')
 
<script src="https://cdn.tailwindcss.com"></script> 
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>

<x-header> </x-header>

<html>
<body style="margin-left: 1%;">

<form action= '' method="post"> 
@csrf 

<div class="season_selection">

Seizoen 
<select name="selected_season" onchange="this.form.submit()">

<option disabled>Selecteer seizoen</option>

@foreach ($all_seasons as $as)

<option style="text-align: center;" value="{{ $as->season }}"
@if ($as->season == $selected_season) selected @endif >
{{ $as->season }} - {{ $as->season+1 }}</option> 

@endforeach

</select>
</form>

</div>

<div class="main_container_up">

 <div class="container_table">

<div class="center">
<canvas id="chart_presence"></canvas>
</div>


<script>

const chartPresence = document.getElementById('chart_presence');

const presenceOnDate = <?php echo json_encode($presence_on_date);?>;

datesArray = [];

const lineChart = new Chart(chartPresence, { 
    type: 'line',
    data: { 
          
      datasets: [
        {    
          label: "Aantal aanwezigen",    
          borderColor: 'orange',
          data: presenceOnDate,
        }
      ]
    },
    options: {     
      plugins: {
        labels: {
          fontColor: 'black',
          fontStyle: 'bolder',
           }
      }
    },
    plugins: [ChartDataLabels]
  });

  </script>

<div style="text-align: left; margin: 3% 0 0 1%">
Totaal aantal doelpunten:

<div style="font-size: 40px;" class="flex"> 
<div class="text-orange-500 m-2"> {{ $total_goals_orange }} </div>
<div class="m-2"> - </div>
<div class="text-yellow-300 m-2"> {{ $total_goals_yellow }} </div>
</div>

</div>

 <div style="text-align: left; margin: 3% 0 0 1%">

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
 
<script>

const chartTeam = document.getElementById('chart_team');

const teamOrange = <?php echo json_encode($num_team_orange_won);?>;
const teamYellow = <?php echo json_encode($num_team_yellow_won);?>;
const numDraw = <?php echo json_encode($num_draw);?>;

const pieChart = new Chart(chartTeam, { 
    type: 'pie',
    data: {
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

<h1> Winst speler</h1> <h3>(o.b.v. aanwezigheid) </h3>

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

@foreach ($array_player_orange as $name => $orange) 

<tr>
<td> {{ $name }} </td>
<td class="text-orange-500"> {{  $orange }}% </td>
<td class="text-yellow-500"> {{ 100 - $orange }}%</td>
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

