<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
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
}if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
  $usernamePP=$_COOKIE['user'];
  console_log($usernamePP);
  $hashPass=$_COOKIE['token'];
  $userID=0;
  $sql = 'SELECT CustomerID FROM Customers WHERE Email="'.$usernamePP.'"';
  //echo $sql;
  //$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output userID from email
      $userID=$result->fetch_assoc()["CustomerID"];
      //echo $result->fetch_assoc()["CustomerID"].'<br>';
  } else {
      //echo "0 results";
  }
  $sql2 = 'SELECT CustomerPasswordHash FROM CustomerLOG WHERE CustomerID='.$userID;
  //echo $sql2;
  $result2 = $conn->query($sql2);
  if ($result2->num_rows > 0) {
      // output userID from email
      $hashedData=$result2->fetch_assoc()["CustomerPasswordHash"];
      //echo '<br>'.$hashedData.'<br>';
      //echo '<br>'.$hashPass;
      if($hashPass==$hashedData){
          //echo "You're in";
          $sql = 'SELECT * FROM Customers WHERE CustomerID='.$userID;
          $result = $conn->query($sql);
          $customerName=$result->fetch_assoc()["FirstName"];
          
      }else {
          //echo "Password not right";
      }
  } else {
      //echo "nothing found";
  }
}

$item=$_POST["item"];
$VALIDITEMS=array("Cappuccino", "IcedLatte", "Espresso", "CaramelMacchiato","Americano","CaffeMocha","caffeMacchiato","CaramelLatte","CaffeMacciato2","DarkChocolateMocha","HavanaCappuccino","HoneyLavenderLatte","IcedCaffeMocha","IcedVanillaLatte","WhiteChocolateMocha");
if(in_array($item,$VALIDITEMS)){
    //nothing
    console_log($item);
}else{
    //because it is get request, super quick questioning
    echo '<script>window.location.replace("main.php");</script>';
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
//echo '<script>window.location.replace("main.php");</script>';
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
  <a href="/main.php">Home</a>
  <a href="menu.php">Menu</a>
  <a href="rewards.php">Stats</a>
  <div class="cart">
                <a href="cart.php"><img border="0" alt="Cart" src="pictures/cart4.png" width="20" height="20" style="width:auto;height:20px;float:right;font-family: Arial;"></a>
            </div>
  <script>
            function logMeOut(){
                document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                document.cookie = "user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                document.cookie = "cart= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                location.reload();
            }
    </script><button id="logB" display="none" class="login" onclick="document.getElementById('id01').style.display='block'" style="display:none;width:auto;float:right;font-family: Arial;">Login</button>
            <button id="logOut" display="none" class="login" onclick="logMeOut();" style="display:none;width:auto;float:right;font-family: Arial;">Log Out</button>
            <button id="welcomeP" display="none" class="login" onclick="#" style="display:none;width:auto;float:right;font-family: Arial;">Welcome, <?php echo $customerName;?></button>
            
  <!-- fix this part -->
  <button id="logB" display="none" class="login" onclick="document.getElementById('id01').style.display='block'" style="display:none;width:auto;float:right;font-family: Arial;">Login</button>
            <button id="logOut" display="none" class="login" onclick="logMeOut();" style="display:none;width:auto;float:right;font-family: Arial;">Log Out</button>
            <button id="welcomeP" display="none" class="login" onclick="#" style="display:none;width:auto;float:right;font-family: Arial;">Welcome, <?php echo $customerName;?></button>
            <script>
                //get cookie values
                function getCookie(cname) {
                    var name = cname + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var ca = decodedCookie.split(';');
                    for(var i = 0; i <ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                    }
                //if user logged in token doesn't exist, show log in button
                if((getCookie("token")=="")||"<?php echo $loginStatus;?>"=="Not Correct"){
                    document.getElementById('logB').style.display='inline';
                }else{
                    document.getElementById('logOut').style.display='inline';
                    document.getElementById('welcomeP').style.display='inline';
                }
            </script>
 
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/login.php" method="post">
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
  <form action="cartItem.php" method="post">
  <div class = "pic" style="float:left">
  <img src="images/<?php echo $item?>.jpg" alt="<?php echo $item?>" width="auto">
<br>
  </div>
  <div class="description" style="margin-left:850px; padding-top:100px;font-size:20px;">
  <h2><?php 
  $sql4='SELECT * FROM Products';
  console_log($sql4);
  $result4 = $conn->query($sql4);
  console_log($result4);
  if ($result4->num_rows > 0) {
      console_log("stuff");
      $descInfo=$result4->fetch_assoc()["DescriptionInfo"];
  } else {
      //echo "0 results";
  }
  echo $descInfo;
  ?></h2>
  </div>
    <input type="hidden" id="custId" name="item" value="<?php echo $item?>">
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
  <input type="radio" id="2%" name="milk" value="2">
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