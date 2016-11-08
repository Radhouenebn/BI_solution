<?php 
          include ('session2.php');
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
              $date3=strtotime($date_min);
              $date4=strtotime($date_max);
              $nbJoursTimestamp = $date4 - $date3;
            $nbJours = $nbJoursTimestamp/86400;
             if($nbJours > 30)
              $query='SELECT monthname(`ticket`.close_date) as mois,count(*) as total FROM `ticket`,`ticket_request` where `ticket_request`.status="closed" and `ticket`.close_date BETWEEN "'.$date_min.'" and "'.$date_max.'" and `ticket_request`.id=`ticket`.id group by month(`ticket`.close_date),year(`ticket`.close_date) order by date(`ticket`.close_date)';
             else
              $query='SELECT concat(day(`ticket`.close_date),\'/\',month(`ticket`.close_date)) as mois,count(*) as total FROM `ticket`,`ticket_request` where `ticket_request`.status="closed" and `ticket`.close_date BETWEEN "'.$date_min.'" and "'.$date_max.'" and `ticket_request`.id=`ticket`.id group by date(`ticket`.close_date) order by date(`ticket`.close_date)';
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
                          {$pie_chart_data[] = array($result["mois"],(int)$result["total"]);}
                            $arrlength = count($pie_chart_data);
                            echo "['Date','Nombre de tickets fermés'],";
                                  for($x = 0; $x < $arrlength; $x++) {
                                   echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                                    }
              
            
?>
        ]);

        var options = {
          chart: {
            title: <?php $query ='select count(*) as sum from `ticket`,`ticket_request` where `ticket_request`.status = "closed" and `ticket`.close_date between "'.$date_min.'" and "'.$date_max.'" and `ticket_request`.id=`ticket`.id;'; $qresult = mysql_query($query); echo "'Nombre de tickets fermés : ".mysql_fetch_row($qresult)[0]."'"; ?>,
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