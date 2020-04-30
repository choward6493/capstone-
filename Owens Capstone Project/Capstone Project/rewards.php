<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
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
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    /*
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    */
    //get buy stats
    $sql='SELECT * FROM Products';
    $result = $conn->query($sql);
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        $products[]=$row;
    }
    $sql='SELECT * FROM OrderDetails';
    $result = $conn->query($sql);
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        $orderd[]=$row;
    }
    //console_log($orderd);
    foreach($products as $product){
        $numBought[]=0;
    }
    foreach($orderd as $orderS){
        $numBought[((int)$orderS["ProductID"]-1)]+=1;
    }
    
    function getMostPopular(){
        //get biggest amount of bought, returns array item with most
        $big=array(0,0);
        for($i=0;$i<count($numBought);$i++){
            if($numBought[$i]>=$big[1]){
                $big[0]=$i;
                $big[1]=$numBought[$i];
            }
        }
        //console_log($big[0]);
        return $big[0];
    }
    //if login data is stored, check that it is actual
    if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
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
    
    ?>
<body>
<div class="header">
  <h1>Rewards</h1>
  
</div>

<div class="topnav">
  <a href="main.php">Home</a>
  <a href="menu.php">Menu</a>
  <a href="rewards.php">Rewards</a>
  <div class="cart"><a href="cart.php"><img border="0" alt="Cart" src="pictures/cart4.png" style="width:auto;height:20px;float:right;font-family: Arial;"></a></div>
  <script>
            function logMeOut(){
                document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                document.cookie = "user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                document.cookie = "cart= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                location.reload();
            }
            </script>
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
                if((getCookie("token")=="")){
                    document.getElementById('logB').style.display='inline';
                }else{
                    document.getElementById('logOut').style.display='inline';
                    document.getElementById('welcomeP').style.display='inline';
                }
            </script>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
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

<div class="card">
<h2>Stats</h2>
<h5>Most Popular</h5>
<p>The most popular item is the <?php echo $products[getMostPopular()]["ProductName"];?>, which costs $<?php echo $products[getMostPopular()]["Cost"];?>, and is <?php if($products[getMostPopular()]["Availible"]!="1"){echo "not";}?> availible</p>

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