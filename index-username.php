
<?php
//storing the username for this session
session_start();

//if variable existiert und ob sie nicht NULL ist
if (!isset($_SESSION['username'])) {
  $_SESSION['username'] = 0;
  if (empty($_POST['name'])){
  echo '<div class="container" style="text-align:center">please choose a username</div>';
  }
} else {
  $_SESSION['username'] = $_POST["name"];
  $_SESSION['count'] =0;
  $_SESSION['token'] =0;
  $_SESSION['land'] = 0;
  //create an array and shuffle it for each user once
  $_SESSION['array'] = range(0,109);
  shuffle($_SESSION['array']);
  header("Location: index.php");
}

   
// if ($_SESSION['username']!=0) echo '<div id="form-submit-alert">Form Submitted!</div>';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Leaflet to CartoDB - Point Collection Tool intropage</title>
    <link rel="stylesheet" href="css/leaflet.css" />
    <link rel="stylesheet" href="css/leaflet.draw.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>

  <div class="container" style="text-align:center">
    <div class="col-md-4 col-md-offset-4">
       <div id="header">
        <h1>user intro page</h1>
        </div>
        <form method="post">
        enter your playername: <br>
        <input type="text" name="name"><br>
        <input type="submit">
        </form>
    </div>
  </div>

    <script src="js/leaflet.js"></script>
    <script src="js/leaflet.draw.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>

    </script>
  </body>
</html>