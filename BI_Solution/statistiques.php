<?php
include ('session2.php');
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jsPDF/jspdf.min.js"></script>
    <script type="text/javascript" src="jsPDF/html2canvas.js"></script>
    <script type="text/javascript" src="jsPDF/from_html.js"></script>

	<script type="text/javascript">
			function genPDF(){
			

				window.document.getElementById("dashboard").contentWindow.print();



			}

	</script>


	<style>
			#dashboard {
    			margin-top: 20px;
				}

			@media print {
    			.logout,.content {
        			display: none;
    				}
    				iframe
    				{
    					width: 80%;
    					height: 70%;
    					text-align: center;
    					margin-bottom: 23%;
    				}
				}

			.content{
				margin-top: -20px;
			}
			.logout{
				text-align: right;
				margin-top: -60px;
			}
			#retour,#print
			{
			background: #bfbfbf;
			background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e5e5e5), to(#bbb));
			background: -moz-linear-gradient(0% 100% 90deg,#bbb, #e5e5e5);
			border: 1px solid #ccc;
			border-radius: 3px;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			-moz-box-shadow: inset 0px 1px 3px #f5f5f5;
			-webkit-box-shadow: inset 0px 1px 3px #f5f5f5;
			color: #333;
			font-family: "lucida grande", sans-serif;
			font-size: 12px;
			font-weight: bold;
			line-height: 2;
			padding: 8px 0;
			text-align: center;
			text-shadow: 0 1px 0px #eee;
			width: 150px;
			}
	</style>
</head>
<body>
	<div id="ignore">
			<img src="css/img/sifast.png" id="logo" width="241" height="80"/>
			<div class="logout"><a href="logout.php" class="btn btn-info btn-lg">
		          <span class="glyphicon glyphicon-log-out"></span> Log out
		        </a></div>
 		<div class="content">
			<form align="center">
  				<input type="button" value="Retour" id="retour" onclick="history.go(-1)">
  				<input type="button" value="Imprimer tous" id="print" onclick="window.print()">
			</form>
		</div>
	</div>
	<div id="dashboard" align="center">
			<iframe  type="application/pdf" id="frame1" src="tickets_ouverts.php" width="45%" height="50%" scrolling="no" ></iframe>
			<iframe id="frame2" type="application/pdf" src="tickets_fermes.php" width="45%" height="50%" scrolling="no"></iframe>
			<iframe id="frame3" type="application/pdf" src="tickets_resolus.php" width="45%" height="50%" scrolling="no"></iframe>
			<iframe id="frame4" type="application/pdf" src="age_tickets.php"  width="45%" height="50%" scrolling="no"></iframe>
			<iframe id="frame5" type="application/pdf" src="duree_assignation.php" width="45%" height="50%" scrolling="no"></iframe>
			<iframe id="frame6" type="application/pdf" src="duree_resolution.php" width="45%" height="50%" scrolling="no"></iframe>
	</div>
</body>
</html>