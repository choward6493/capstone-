<!DOCTYPE html>
<html>
<head>
<title>Montgomery Cup Coffee</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php

date_default_timezone_set("America/New_York");
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
    $servername = "capstone.cfwnz1g6jqbd.us-east-1.rds.amazonaws.com:3306";
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
    try{
      $testthing=array_values($_GET);
      if($testthing!=null){
      
      //console_log($testthing);
      //console_log($_GET);
      //console_log($testthing[0]);
      echo '<script>alert("'.$testthing[0].'");</script>';
      //console_log("Nee");
    //alertJS($testthing[0]);
    //$testtwo=$_GET;
    //print_r($testtwo['[message]']);
      }
    }catch(Exception $e){
    
    }
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
                //console_log($result);
                $loginStatus="Correct";
            }else {
                //echo "Password not right";
                $loginStatus="Not Correct";
            }
        } else {
            //echo "nothing found";
        }
    }

  
  
    ?>
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>
<div class="header">
  <h1>Checkout</h1>

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
            <button id="welcomeP" display="none" class="login" onclick="window.location.replace('account.php');" style="display:none;width:auto;float:right;font-family: Arial;">Welcome, <?php echo $customerName;?></button>
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
      <input type="email" placeholder="Enter Username" name="uname" required>

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
	  <a class="btn"href="join.php" style="text-decoration:none;float:right;padding: 10px 18px;background-color: #333;color: #f2f2f2;">Join now</a>
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

<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="cartSub.php" method="post">

        <div class="row">





          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John W Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" pattern="\d{4}-?\d{4}-?\d{4}-?\d{4}" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Expiration Date</label>
            <input type="month" pattern="^\d{1,2}\/\d{2,4}$"id="expmonth" name="expdate" placeholder="01/20" min="<?php echo date('Y-m');?>" required>


                <label for="cvv">CVV</label>
                <input type="text" pattern="^([0-9]{3,4})$" id="cvv" name="cvv" placeholder="111" required>

          </div>

        </div>
        <label for="picktime">Pickup Time</label>
        <input type="datetime-local" id="picktime" name="picktime" min="<?php echo date('Y-m-d\TH:i'); ?>">
        <label for="location">Pickup Location</label>
            <select id='location' name="location" required>
                            <option value="GC">Grove City</option>
                            <option value="CO" selected>Columbus</option>
                            <option value="NA">New Albany</option></select><br/>
        <input type="submit" value="Submit" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
        <?php  if(isset($_COOKIE['cart'])){
            //console_log($_COOKIE['cart']);
            $cart=json_decode($_COOKIE['cart']);
            $cartCount=0;
            foreach($cart as $singleItem){
                $cartCount+=1;
            }
        }?>
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $cartCount?></b></span></h4>
      <script>
        //remove cart item
        
        
        function removeItem(numT){
          cartJSON=JSON.parse(getCookie("cart"));
          console.log(cartJSON);
          for(var i=numT;i<=(cartJSON.length-1);i++){
            cartJSON[i]=cartJSON[i+1];
          }
          cartJSON.length-=1;
          console.log(cartJSON);
          //cartJSON[numT]
          var testeststsetsets=JSON.stringify(cartJSON);
          document.cookie="cart= "+testeststsetsets;
          window.location.reload();
        }
      </script>
      <?php
        if(isset($_COOKIE['cart'])){
            //console_log($_COOKIE['cart']);
            $cart=json_decode($_COOKIE['cart']);
            $cartCount=0;
            $totalCost=0;
            for($i=0; $i<sizeof($cart); $i++){
                //console_log('in loop');
                $itemName=(array)$cart[$i];
                //console_log($itemName['item']);
                $sql = 'Select Cost from Products where ProductName="'.$itemName['item'].'"';
                $result = $conn->query($sql);
                $itemCost=$result->fetch_assoc()["Cost"];
                echo '<p><a href="javascript:removeItem('.$i.')">'.$itemName['item'].' -- '.$itemName['size'].'</a> <span class="price">$'.$itemCost.'</span></p>';
                echo '<p style="margin-left:3em">'.$itemName['milk'].' milk</p>';
                $totalCost+=$itemCost;
            }
            /*
            foreach($cart as $singleItem){
                $cartCount+=1;
                console_log($singleItem);
                asort($singleItem)
                //console_log(array("item"=>))
                console_log($singleItem['item']);
                $itemName=$singleItem['item'];
                //itemArray=json_decode($singleItem);
                //$itemName=itemArray['item'];

                //$sql = 'Select Cost from Products where ProductName="'.$singleItem["item"].'"';
                console_log("before");
                console_log($itemName);
                console+log("after");
                //echo $sql;
                //$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
                //$result = $conn->query($sql);
                //$itemCost=$result->fetch_assoc()["cost"];
                $itemCost=1;
                echo '<p><a href="#">'.$itemName.'</a> <span class="price">$'.$itemCost.'</span></p>';
            }
            */
        }

      ?>


      <hr>
      <p>Total <span class="price" style="color:black"><b>$<?php echo $totalCost?></b></span></p>
    </div>
  </div>
</div>


<div class="footer">
		<form class="form-inline" action="#">
  <label for="email">Join our mailing list:</label>
  <input type="email" id="email" placeholder="Enter email" name="email">
  <button class="email" type="submit">Submit</button>
</form>
		</div>
</body>
</html>
