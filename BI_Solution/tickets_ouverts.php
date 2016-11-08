<?php 
          include ('session2.php');
          include ('connexion.php');
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
             if($user != "all") {
              $date3=strtotime($date_min);
              $date4=strtotime($date_max);
              $nbJoursTimestamp = $date4 - $date3;
              $nbJours = $nbJoursTimestamp/86400;
             if ($nbJours > 30)
              $query='select monthname(start_date) as mois, count(*) as total from `ticket` where caller_id in (select contactid from `priv_user` where login="'.$user.'") and start_date between "'.$date_min.'" and "'.$date_max.'" group by MONTH(start_date),year(start_date) order by date(start_date)';
             else
              $query='select concat(day(start_date),\'/\',month(start_date)) as mois, count(*) as total from `ticket` where caller_id in (select contactid from `priv_user` where login="'.$user.'") and start_date between "'.$date_min.'" and "'.$date_max.'" group by date(start_date) order by date(start_date)';

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
                            echo "['Date','Nombre de tickets ouverts'],";
                                  for($x = 0; $x < $arrlength; $x++) {
                                   echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                                    }}
              else if($team != "all")
              {
                if($graph =="period"){
              $date3=strtotime($date_min);
              $date4=strtotime($date_max);
              $nbJoursTimestamp = $date4 - $date3;
            $nbJours = $nbJoursTimestamp/86400;
             if ($nbJours > 30)
              $query='select monthname(start_date) as mois, count(*) as total from `ticket` where caller_id in (SELECT person_id FROM `lnkpersontoteam` WHERE team_id ="'.$team.'") and start_date between "'.$date_min.'" and "'.$date_max.'" group by MONTH(start_date),year(start_date) order by date(start_date)';
            else
             $query='select concat(day(start_date),\'/\',month(start_date)) as mois, count(*) as total from `ticket` where caller_id in (SELECT person_id FROM `lnkpersontoteam` WHERE team_id ="'.$team.'") and start_date between "'.$date_min.'" and "'.$date_max.'" group by date(start_date) order by date(start_date)';

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
                            echo "['Date','Nombre de tickets ouverts'],";
                                  for($x = 0; $x < $arrlength; $x++) {
                                   echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                                    }

                }
                  else {
                    $query='select `priv_user`.login as user, count(`ticket`.caller_id) as total from `priv_user`, `ticket`, `lnkpersontoteam` where `ticket`.caller_id is not null and `ticket`.caller_id in ( select person_id from `lnkpersontoteam` where team_id = "'.$team.'" )  and `ticket`.start_date between "'.$date_min.'" and "'.$date_max.'" and `ticket`.caller_id =`priv_user`.contactid group by `ticket`.caller_id';

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
                            echo "['Membre','Nombre de tickets ouverts'],";
                                  for($x = 0; $x < $arrlength; $x++) {
                                   echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                                    }

                  }

              }
                  else{
                    if ($graph=="person"){

                      $query='select `priv_user`.login as user, count(`ticket`.caller_id) as total from `priv_user`, `ticket` where `ticket`.caller_id is not null and `ticket`.start_date between "'.$date_min.'" and "'.$date_max.'" and `ticket`.caller_id =`priv_user`.contactid group by `ticket`.caller_id';

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
                            echo "['Utilisateurs','Nombre de tickets ouverts'],";
                                  for($x = 0; $x < $arrlength; $x++) {
                                   echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                                    } }
                                    else {
                                       $date3=strtotime($date_min);
                                        $date4=strtotime($date_max);
                                        $nbJoursTimestamp = $date4 - $date3;
                                        $nbJours = $nbJoursTimestamp/86400;
                                        if ($nbJours > 30)
                                      $query='select monthname(start_date) as mois, count(*) as total from `ticket` where caller_id is not null and start_date between "'.$date_min.'" and "'.$date_max.'" group by MONTH(start_date),year(start_date) order by date(start_date)';

                                        else
                                      $query='select concat(day(start_date),\'/\',month(start_date)) as mois, count(*) as total from `ticket` where caller_id is not null and start_date between "'.$date_min.'" and "'.$date_max.'" group by date(start_date) order by date(start_date)';


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
                                                echo "['Date','Nombre de tickets ouverts'],";
                                                    for($x = 0; $x < $arrlength; $x++) {
                                                          echo "['".$pie_chart_data[$x][0]."',".$pie_chart_data[$x][1]."],";
                                                      }

                                                    }
                  }

            
            
?>
        ]);

        var options = {
          chart: {
            title: <?php $query ='select count(*) as sum from `ticket` where start_date between "'.$date_min.'" and "'.$date_max.'";'; $qresult = mysql_query($query); echo "'Nombre tickets ouverts : ".mysql_fetch_row($qresult)[0]."'"; ?>,
            subtitle: <?php if ($user != "all") echo "' Utilisateur: ".$user." de ".$date_min." à ".$date_max."'"; else if ($team != "all") echo "' Groupe ".$team." de ".$date_min." à ".$date_max."'"; else echo "' De ".$date_min." à ".$date_max."'"; Disconnect();?>,
          },
          legend:{position:'none'},
          hAxis:{direction:-1, slantedText:true, slantedTextAngle:90},
          vAxis:{direction:-1, slantedText:true, slantedTextAngle:90}


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