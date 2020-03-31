<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
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
    $userID=0;
    $loginStatus ="Not Correct";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    /*
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    */

    //if login data is stored, check that it is actual
    if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
        $usernamePP=$_COOKIE['user'];
        console_log($usernamePP);
        $hashPass=$_COOKIE['token'];
        $userID=0;
        $customerName="Invalid Credentials";
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
                /*
                $userCookie="user";
                $userCookieVal=$usernamePP;
                $passCookie="token";
                $passCookieVal=$hashedData;
                if(!($_POST["remember"]=="on")){
                    setcookie($userCookie,$userCookieVal, time() + (86400/24), "/");
                    setcookie($passCookie,$passCookieVal,time()+(86400/24),"/");
                }else{
                    setcookie($userCookie, $userCookieVal, time() + (86400*30), "/");
                    setcookie($passCookie,$passCookieVal,time()+(86400*30),"/");
                }
                */
                $sql = 'SELECT * FROM Customers WHERE CustomerID='.$userID;
                $result = $conn->query($sql);
                $customerName=$result->fetch_assoc()["FirstName"];
            }else {
                //echo "Password not right";
                $loginStatus="Correct";
            }
        } else {
            //echo "nothing found";
        }
    }
    
    ?>
</head>

<body>
 <div class="header">
  <h1>Menu</h1>
  
</div>

<div class="topnav">
  <a href="home.html">Home</a>
  <a href="menu.html">Menu</a>
  <a href="rewards.html">Rewards</a>
  <a href="cart.php"><img border="0" alt="Cart" src="pictures/cart.png" width="20" height="20" style="width:auto;float:right;font-family: Arial;"></a>

  <script>
            function logMeOut(){
                document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                document.cookie = "user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                location.reload();
            }
    </script>
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
                if((getCookie("token")=="")||<?php echo $loginStatus;?>=="Not Correct"){
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
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</div>

<div style="padding:20px;">

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="menuItem.php?item=Cappuccino">
      <img src="pictures/cappuccino.jpg" alt="Cappuccino" width="600" height="400">
    </a>
    <div class="desc">Cappuccino</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="menuItem.php?item=IcedLatte">
      <img src="pictures/iced-latte.jpg" alt="Iced Latte" width="600" height="400">
    </a>
    <div class="desc">Iced Latte</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="menuItem.php?item=Espresso">
      <img src="pictures/espresso.jpg" alt="Espresso" width="600" height="400">
    </a>
    <div class="desc">Espresso</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="menuItem.php?item=CaramelMacchiato">
      <img src="pictures/caramel_macchiato.jpg" alt="Caramel Macchiato" width="600" height="400">
    </a>
    <div class="desc">Caramel Macchiato</div>
  </div>
</div>

<div class="clearfix"></div>

<div style="padding:6px;">

<div class="footer">
		<form class="form-inline" action="#">
  <label for="email">Join our mailing list:</label>
  <input type="email" id="email" placeholder="Enter email" name="email">
  <button class="email" type="submit">Submit</button>
</form>
		</div>
</body>
</html>