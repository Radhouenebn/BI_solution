<?php include('login.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Page d'authentification</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="logo">
<img src="css/img/sifast.png" id="logo" width="241" height="80"/>
<h1 id="titre">Statistiques SiFAST iTop</h1>
  </div>
  <section class="container">
    <div class="login">
      <h1>Login page</h1>
      <form method="POST" action="login.php">
        <p><input type="text" name="username" value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>
  </section>

  <section class="about">
    <p class="about-author">
      &copy; 2016 Designed By<a href="https://tn.linkedin.com/in/radhouenebenncir" target="_blank">Radhouene Ben Ncir</a> -
      <a href="http://www.sifast.com/" target="_blank">SiFAST</a><br>
  </section>
</body>
</html>
