<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
$servername = "capstone2.cxiblbeokqky.us-east-1.rds.amazonaws.com:1433";
$username = "admin";
$password = "SixGuys1CapstoneProject";
$dbname="Capstone";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$item=$_GET["item"];
$VALIDITEMS=array("Cappuccino", "IcedLatte", "Espresso", "CaramelMacchiato");
if(in_array($item,$VALIDITEMS)){
    //nothing
}else{
    //because it is get request, super quick questioning
    window.location.replace("menu.php");
}

/*

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

*/

//$usernamePP = $_POST["uname"];
//echo $usernamePP."<br/>";
//$_POST["psw"];
//echo $_POST["remember"]."<br/>";




$conn->close();
window.location.replace("menu.php");
?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>
 <div class="header">
   <h1>Customize Your Drink​</h1>
  
</div>

<div class="topnav">
  <a href="home.html">Home</a>
  <a href="menu.html">Menu</a>
  <a href="rewards.html">Rewards</a>
  <button class="login" onclick="document.getElementById('id01').style.display='block'" style="width:auto;float:right;font-family: Arial;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/cartItem.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="pictures/avatar.png" alt="Avatar" class="avatar" width="100%" height="100%">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button class="login" type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn"><b>Cancel</b></button>
      <a class="btn"href="#" style="float:right;padding: 10px 18px;background-color: #333;color: #f2f2f2;">Forgot password?</a>
	  <a class="btn"href="join.html" style="text-decoration:none;float:right;padding: 10px 18px;background-color: #333;color: #f2f2f2;">Join now</a>
    </div>
  </form>
</div>

<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</div>

<div style="padding:20px;">

<div class="container">
  <form action="cartItem.php" method="POST">
  <input type="hidden" id="custId" name="custId" value="<?php echo $item?>">
  <div class="drink_size" style="width: 600px; float: left;">
  <h2>Size</h2>
    <input type="radio" id="small" name="size" value="small" checked>
  <label for="small">Small</label><br>
  <input type="radio" id="medium" name="size" value="medium">
  <label for="medium">Medium</label><br>
  <input type="radio" id="large" name="size" value="large">
  <label for="large">Large</label>
  </div>
  <div class="drink_dairy" style="margin-left: 620px;">
  <h2>Dairy/Non-dairy</h2>
  <input type="radio" id="no" name="milk" value="no" checked>
  <label for="no">No Milk</label><br>
  <input type="radio" id="2%" name="milk" value="2%">
  <label for="2%">2% Milk</label><br>
  <input type="radio" id="whole" name="milk" value="whole">
  <label for="whole">Whole Milk</label><br>
  <input type="radio" id="soy" name="milk" value="soy">
  <label for="soy">Soy Milk</label><br>
  <input type="radio" id="almond" name="milk" value="almond">
  <label for="almond">Almond Milk</label><br>
  <input type="radio" id="non-fat" name="milk" value="non-fat">
  <label for="non-fat">Non-Fat Milk</label><br>
  <input type="radio" id="oat" name="milk" value="oat">
  <label for="oat">Oat Milk</label>
  </div>
    <input type="submit" value="Add to Cart">
  </form>
</div>

</body>
</html>