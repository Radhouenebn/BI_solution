<?php 
include ('session2.php');
include('connexion.php');
Connect();

$query = "SELECT `priv_user`.login as user,count(*) as number_of_tickets FROM `ticket`,`ticket_request`,`priv_user` where `ticket_request`.status='closed' and `ticket`.close_date BETWEEN '".$date_min."' and '".$date_max."' and `ticket_request`.id=`ticket`.id and `priv_user`.contactid = `ticket`.caller_id group by `ticket`.caller_id";
$qresult = mysql_query($query); 
$results = array();
while ($res = mysql_fetch_assoc($qresult)){$results[] = $res;}

$pie_chart_data = array();
foreach($results as $result)
  {$pie_chart_data[] = array($result["user"],(int)$result["number_of_tickets"]);}

 ?>

<html>
  <head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Utilisateur', 'Nombre de tickets fermes'],
          <?php 
          $arrlength = count($pie_chart_data);

            for($x = 0; $x < $arrlength; $x++) {
              echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                  }
          ?>
        ]);

        var options = {
          title: <?php $query ='select count(*) as sum from `ticket`,`ticket_request` where `ticket_request`.status = "closed" and `ticket`.close_date between "'.$date_min.'" and "'.$date_max.'" and `ticket_request`.id=`ticket`.id;'; $qresult = mysql_query($query); echo "'Nombre de tickets fermés par utilisateur : ".mysql_fetch_row($qresult)[0]."'"; ?>,
          subtitle:  <?php echo "'De ".$date_min." à ".$date_max."'";Disconnect(); ?>,
          legend:{position:'none'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 100%; height: 95%;"></div>
    <Button onClick="window.print()">Imprimer</Button>
  </body>
</html>