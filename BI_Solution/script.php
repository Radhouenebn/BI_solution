<?php 
include ('session2.php');
include('connexion.php');
Connect();

$query = "SELECT `priv_user`.login as agent,count(*) as number_of_request FROM `ticket`,`ticket_request`,`priv_user` where `ticket_request`.status='resolved' and `ticket_request`.resolution_date BETWEEN '".$date_min."' and '".$date_max."' and `ticket_request`.id=`ticket`.id and `priv_user`.contactid = `ticket`.agent_id group by `ticket`.agent_id";
$qresult = mysql_query($query); 
$results = array();
while ($res = mysql_fetch_assoc($qresult)){$results[] = $res;}

$pie_chart_data = array();
foreach($results as $result)
  {$pie_chart_data[] = array($result["agent"],(int)$result["number_of_request"]);}

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
          ['Agent', 'Nombre de tickets résolus'],
          <?php 
          $arrlength = count($pie_chart_data);

            for($x = 0; $x < $arrlength; $x++) {
              echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                  }
          ?>
        ]);

        var options = {
          title:<?php $query ='select count(*) as sum from `ticket`,`ticket_request` where `ticket_request`.status = "resolved" and `ticket_request`.resolution_date between "'.$date_min.'" and "'.$date_max.'" and `ticket_request`.id=`ticket`.id;'; $qresult = mysql_query($query); echo "'Nombre de tickets résolus : ".mysql_fetch_row($qresult)[0]."'"; ?>,
          subtitle:  <?php echo "'De ".$date_min." à ".$date_max."'"; Disconnect();?>,
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