<?php include('session.php');
      include('connexion.php');
      Connect();
 ?>

<!DOCTYPE>
<html>
  <head>
          <script type="text/javascript">
                  // script pour ajouter un attribut title au <span> de façon automatisée
                  function titlePercentage() {
                      // pour chaque élément de classe "percent"
                      $(".percent").each(function() {
                          // on définit son attribut "title" à partir du texte de l'élément
                          $(this).attr("title",$(this).html());
                      });
                  }

                  $(document).ready(function() {
                      titlePercentage();
                  });
          </script>
          <style type="text/css">
                  .stats { margin-top: 30px; margin-bottom: 30px;}
                  #statics {
                    border-radius: 15px 50px 30px 5px;
                    color: #73AD21;
                    padding: 20px; 
                  }
                  div.stats ul { list-style: none; }
                  div.stats .percent {
                      /* on passe l'élément span correspondant à la classe .percent
                      en affichage en bloc pour pouvoir lui donner une dimension.
                      Diverses autres choses sont modifiées ensuite à votre convenance. */
                      display: block;  /* on affiche le span sous forme de bloc pour lui affecter des dimensions */
                      height: 1.5em;
                      line-height: 1.5em;
                      margin: 5px 10px;
                      padding: 0 5px;
                      text-align: center;
                      color: #fff;
                      font-weight: bold;
                      font-family: monospace; 
                      -moz-border-radius: 5px;  /* un petit arrondi pour les navigateurs le supportant */
                      border-bottom: 1px solid #aaa;
                      border-right: 1px solid #aaa;
                      cursor: default;
                      }
                      .v100 { background: #970000; width:30%; }
                      .v90 { background: #ff0000; width: 30%; }
                      .v80 { background: #ff6600; width: 30%; }
                      .v70 { background: #ff9c00; width: 30%; }
                      .v60 { background: #ffd800; width: 30%; }
                      .v50 { background: #eaff00; width: 30%; }
                      .v40 { background: #baff00; width: 30%; }
                      .v30 { background: #78ff00; width: 30%; }
                      .v20 { background: #12ff00; width: 30%; }
                      .v10 { background: #00ff60; width: 30%; }
          </style>
          <link rel="stylesheet" type="text/css" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css"/>
          <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-1.7-development-only.js"></script>
          <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
          <script type="text/javascript" src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
          <script type="text/javascript" src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
          <script type="text/javascript" src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
           <script type="text/javascript">
                var datefield=document.createElement("input")
                datefield.setAttribute("type", "date")
                if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
                   document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
                  document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
                  document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
                }
             </script>

           <script>
              if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
                 jQuery(function($){ //on document.ready
                     $('#date_min').datepicker();
                     $('#date_max').datepicker();
                 })
              }
           </script>


      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <meta charset="utf-8">
      <title>Page d'accueil</title>
     <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <div class="logo">
          <img src="css/img/sifast.png" id="logo" width="241" height="80"/>
          <h1 id="titre">Statistiques SiFAST iTop</h1>
      </div>
      <section class="container2">  
          <div class="statics">
            <h2>État actuel de iTop</h2>
            <div class="stats" align="center">
                <ul>
                    <li>Tickets Ouverts&nbsp;: <span class="percent v60"><?php $qresult = mysql_query("select count(*) as total from ticket_request where status not in ('closed' , 'resolved');"); while($res = mysql_fetch_assoc($qresult)) {$results[] = $res;} foreach($results as $result) {echo $result['total'] ;} ?></span></li>
                    <li>Tickets non assignés dans les derniers 24 heures&nbsp;: <span class="percent v10"><?php $qresult1 = mysql_query("select count(*) as total from ticket_request where status ='new' and ttr_started < DATE_SUB(NOW(),INTERVAL 1 DAY);"); while($res1 = mysql_fetch_assoc($qresult1)) {$results1[] = $res1;} foreach($results1 as $result1) {echo $result1['total'] ;} ?></span></li>
                    <li>Tickets assignés non résolus dans les derniers 48 heures&nbsp;: <span class="percent v80"><?php $qresult2 = mysql_query("select count(*) as total from ticket_request where status = 'assigned' and ttr_started < DATE_SUB(NOW(),INTERVAL 48 HOUR);"); while($res2 = mysql_fetch_assoc($qresult2)) {$results2[] = $res2;} foreach($results2 as $result2) {echo $result2['total'] ;} ?></span></li>
                    <li>Tickets assignés non résolus dans les derniers 72 heures&nbsp;: <span class="percent v100"><?php $qresult3 = mysql_query("select count(*) as total from ticket_request where status = 'assigned' and ttr_started < DATE_SUB(NOW(),INTERVAL 72 HOUR);"); while($res3 = mysql_fetch_assoc($qresult3)) {$results3[] = $res3;} foreach($results3 as $result3) {echo $result3['total'] ;} ?></span></span></li>
                </ul>
            </div>

          </div>
      </section>
          <section class="container1">
            <div class="login1">
              <h1>Bienvenue: <i> <?php echo $login_session; ?></i></h1>
          <form method="POST" action="statics.php">
          <table class="search">
            <tr>
              <td><i><b>Demandeur :</b></i></td><td><select name="user">
                                    <option value="all">Tous les demandeurs</option>
                                                          <?php
                                                          $query = "SELECT login FROM `priv_user` where id != 1;";
                                                          $qresult = mysql_query($query); 
                                                          $results = array();
                                                          while ($res = mysql_fetch_assoc($qresult)){$results[] = $res;}

                                                          foreach($results as $result)
                                                            {echo '<option value="'.$result['login'].'">'.$result['login'].'</option>';}

                                                           ?> 
                            </select>
              </td>
              <td><i><b>Groupe :</i></b></td><td><select name="team">
                                    <option value="all">Tous les groupes</option>
                                                        <?php
                                                        $query = "select distinct team_id FROM `lnkpersontoteam`";
                                                        $qresult = mysql_query($query); 
                                                        $results = array();
                                                        while ($res = mysql_fetch_assoc($qresult)){$results[] = $res;}

                                                        foreach($results as $result)
                                                          {echo '<option value="'.$result['team_id'].'"> Groupe '.$result['team_id'].'</option>';}

                                                         ?> 
                          </select>
              </td>
              <td><i><b>Agent :</i></b></td><td><select name="agent">
                                  <option value="all">Tous les agents</option>
                                                        <?php
                                                        $query = "select login FROM `priv_user` where id IN ( select distinct userid from `priv_urp_userprofile` where profileid = 5 or profileid =6)";
                                                        $qresult = mysql_query($query); 
                                                        $results = array();
                                                        while ($res = mysql_fetch_assoc($qresult)){$results[] = $res;}

                                                        foreach($results as $result)
                                                          {echo '<option value="'.$result['login'].'">'.$result['login'].'</option>';}

                                                         ?> 


                        </select>
                </td>
              </tr>
            </table>
      
      <p>
        <table class="search">
          <tr>
            <td>Période:</td><td></td><td> de:<input type="date" id="date_min" style="font-size: 0.8rem" name="date_min" value="<?php echo date('Y-m-d'); ?>"></td>
            <td> à:  <input type="date" id="date_max" style="font-size: 0.8rem" name="date_max" value="<?php echo date('Y-m-d'); ?>"></td><td></td></tr>
        </table>
      </p>
        <table class="search">
          <tr>
          	<td><i><b><u>Résultats graphiques:</u></b></i> </td>
            <td><input type="radio" name="graph" value="period" checked> Par période</td>
            <td><input type="radio" name="graph" value="person"> Par utilisateur  </td> 
          </tr>
        </table>
        <p style="text-align:center;"><input type="submit" name="envoi" value="Valider"></p>
    </form>
      
      </div>
    </section>
      <div class="login-help-1"><a href="logout.php" class="btn btn-info btn-lg">
                <span class="glyphicon glyphicon-log-out"></span> Log out
              </a>
      </div>
  </body>
</html>
