<?php
include 'php/cartoDBProxy.php';
ini_set('display_errors',true);
session_start();


//if username was submitted
if (isset($_POST["name"])) {
  //echo "username was entered"
  //currently, username doesn't allow quotation marks. throws error
  //$_SESSION["username"] = $_POST["name"];

  $_SESSION["username"]=iconv("ASCII" , "UTF-8//IGNORE" ,$_POST["name"]);
  $name = $_POST["name"];

  	//echo $_SESSION["username"];

//   if (strlen($_SESSION["username"]) != strlen(utf8_decode($_SESSION["username"])))
// {
//     echo 'is unicode';
// }
	//echo mb_check_encoding($name,"UTF-8");
	//$ord = unpack('N', mb_convert_encoding($name, 'UCS-4BE', 'UTF-8'));

	//echo $ord[1];
  echo mb_detect_encoding ($_SESSION["username"]);
  //$test = mb_convert_encoding($_SESSION["username"], "UTF-16");
  //echo mb_detect_encoding ($test);
  //check if user exists
  $queryURL = "SELECT playercolor,current_owner FROM data_game WHERE current_owner='$name' LIMIT 1";
  $return = goProxy($queryURL) or die('unable to connect');
  $return =  json_decode($return, true);
  //echo json_last_error_msg();
  //echo var_dump($return);
  //echo $return;

  //numbers are not recognized and true is returned
  if (!in_array($name ,$return)){
    echo 'name in array ';
    //echo var_dump($return);
    //assign existing color
    $_SESSION['usercolor'] = $return["rows"][0]["playercolor"];
    echo " oldcolor".$_SESSION['usercolor'];

  } else {
    //echo var_dump($return);
    echo 'not in array ';
    //make new color (....that doesn't exist yet!)
    $_SESSION['usercolor'] = "#9091ED";
    echo $_SESSION['usercolor'];
    // if(!in_array($_SESSION['usercolor'],$return)){ //extra: make sure that color is only used one
    //   echo ' color already exists';
    $_SESSION['usercolor'] = randCol(80,255);
    // }
  }
  $_SESSION['array'] = range(0,109);
  shuffle($_SESSION['array']);
  header("Location: map.php"); die();
}

//get an assigned color for user
function randCol($minVal = 0, $maxVal = 255){
    // Make sure the parameters will result in valid colours
    $minVal = $minVal < 0 || $minVal > 255 ? 0 : $minVal;
    $maxVal = $maxVal < 0 || $maxVal > 255 ? 255 : $maxVal;

    // Generate 3 values
    $r = mt_rand($minVal, $maxVal);
    $g = mt_rand($minVal, $maxVal);
    $b = mt_rand($minVal, $maxVal);
    
    // Return a hex colour ID string
    return sprintf('#%02X%02X%02X', $r, $g, $b);
}


// if ($_SESSION['username']!=0) echo '<div id="form-submit-alert">Form Submitted!</div>';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Spot-a-lot</title>
    <link rel="stylesheet" href="css/leaflet.css" />
    <link rel="stylesheet" href="css/leaflet.draw.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
  </head>
  <body>

	<div class="row" style="height:100%; align-items: center;">
	  <div class="container align-middle" style="text-align:center">
	    <div class="col-md-12 col-md-offset-12">
	       <div id="header">
	        <h1>Hi, please enter a name for this session</h1>
	        </div>
	        <form method="post">
	        Please only use letters<br>
	        <input type="text" name="name" required><br>
	        <!-- <input type="submit"> -->
	        <button type="submit" href="map.php" class="btn btn-primary" style="margin-top:1em">START</button>
	        </form>
	    </div>
	  </div>
	</div>

    <script src="js/leaflet.js"></script>
    <script src="js/leaflet.draw.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
  </body>
</html>