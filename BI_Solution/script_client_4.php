<?php 
          include ('session2.php');
          include ('ConvertIntToDuration.php');
          include('connexion.php');
          Connect();
?>
<html>
  <head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php
             
              $query='SELECT `priv_user`.login as user , (AVG(`ticket_request`.real_time_spent) DIV 60) as total FROM `ticket`,`ticket_request`,`priv_user` where `ticket_request`.real_time_spent is not null and `ticket_request`.resolution_date BETWEEN "'.$date_min.'" and "'.$date_max.'" and `ticket_request`.id = `ticket`.id and `ticket`.agent_id = `priv_user`.contactid group by `priv_user`.login ';
             $qresult = mysql_query($query); 
              if(!$qresult) {
                        $message  = 'Requête invalide : ' . mysql_error() . "\n";
                       $message .= 'Requête complète : ' . $query;
                       die($message);
                        }

                $results = array();
                  while ($res = mysql_fetch_assoc($qresult)){$results[] = $res;}
                    $pie_chart_data = array();
                      foreach($results as $result)
                          {$pie_chart_data[] = array($result["user"],(int)$result["total"]);}
                            $arrlength = count($pie_chart_data);
                            echo "['Agent','Durée moyenne de résolution'],";
                                  for($x = 0; $x < $arrlength; $x++) {
                                   echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                                    }
              
            
?>
        ]);

        var options = {
          chart: {
            title: <?php $query ='select (AVG(`ticket_request`.real_time_spent) DIV 60) as sum from `ticket`,`ticket_request` where `ticket_request`.real_time_spent is not null and `ticket_request`.resolution_date between "'.$date_min.'" and "'.$date_max.'";'; $qresult = mysql_query($query);$a=(float)(mysql_fetch_row($qresult)[0]);$b=ConvertToDurationHour($a); echo "'Durée moyenne de résolution en Minutes : ".$b."'"; ?>,
            subtitle: <?php echo "'De ".$date_min." à ".$date_max."'";Disconnect();?>,
          },
          legend:{position:'none'}
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 100%; height: 95%;"></div>
    <Button onClick="window.print()">Imprimer</Button>
  </body>
</html>