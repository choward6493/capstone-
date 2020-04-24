<?php
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
function alertJS($message, $with_script_tags = true){
  $js_code = 'alert(' . json_encode($output, JSON_HEX_TAG) . 
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
$loggedIn=false;
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$location="";
echo $location;
try{
$location=$_POST['location'];
setcookie("location",$location, time() + (86400/24), "/");
            
}catch(Exception $e){

}
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
if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
  $usernamePP=$_COOKIE['user'];
  //console_log($usernamePP);
  $hashPass=$_COOKIE['token'];
  $userID=0;
  $sql = 'SELECT EmployeeID FROM Employees WHERE Email="'.$usernamePP.'"';
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output userID from email
      $userID=$result->fetch_assoc()["EmployeeID"];
      //echo $result->fetch_assoc()["CustomerID"].'<br>';
      $sql2 = 'SELECT PasswordHash FROM EmployeeLOG WHERE EmployeeID='.$userID;
      //echo $sql2;
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
          // output userID from email
          $hashedData=$result2->fetch_assoc()["PasswordHash"];
          //echo '<br>'.$hashedData.'<br>';
          //echo '<br>'.$hashPass;
          if($hashPass==$hashedData){
            //get employee name
              $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
              $result = $conn->query($sql);
              $employeeName=$result->fetch_assoc()["FirstName"];
              //get employee title
              $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
              $result = $conn->query($sql);
              $employeeTitle=$result->fetch_assoc()["Title"];
              $loggedIn=true;
              //echo 'test';

          }else {
              //echo "Password not right";
          }
      } else {
        //echo "nothing found";
      }
  } else {
      //echo "0 results";

  }
}else{
  $loggedIn=false;
}
/*

$sql = '';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $variableName=$result->fetch_assoc()["ColumnName"];
}

*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
var screenSwitch=function(screenNum){
if(screenNum==0){
document.getElementById('viewNews').style.display='none';
document.getElementById('viewOrders').style.display='block';
}else if(screenNum==1){
document.getElementById('viewNews').style.display='block';
document.getElementById('viewOrders').style.display='none';
}
}
</script>
<title>Montgomery Cup Coffee</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="index.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="The Montgomery Cup was founded in 2003 by owners Lex and Milli Montgomery as a family owned, quality coffee shop located in central Ohio. Since then they have expanded and grown into three shops.">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
</head>
<body>
<div id="wrapper">
<header>
<h1>Montgomery Cup Coffee</h1>

</header>
<div class="topnav">
 <a class="active" href="javascript:screenSwitch(0);">Home</a>
 <a id="news" href="javascript:screenSwitch(1);">News</a>
 <a id="files" href="/files/">Files</a>
 <!--
 <button id="login"onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
-->
<script>
            function logMeOut(){
                document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                document.cookie = "user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                document.cookie = "cart= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                location.reload();
            }
    </script>
<button id="logOut" class="login" onclick="logMeOut();" style="display:block;width:auto;float:right;font-family: Arial;">Log Out</button>
            
</div> 
 <div id="id01" class="modal" style="display:block"> 
    <form class="modal-content animate" action="/login.php" method="post">
    

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      
    </div>
    
  </form>
</div>

<nav>
  <div class="navLinks">
  <button class="dropdown-btn">Status 
    <i class="fa fa-caret-down"></i>
  </button>
  <!-- what do we want this to be?? is this supposed to be an employee check in system? -->
  <div class="dropdown-container">
    <a href="#">ready</a>
    <a href="#">break1</a>
    <a href="#">break2</a>
    <a href="#">restroom</a>
    <a href="#">lunch</a>
    <a href="#">meeting </a>
    <a href="#">restroom</a>
    <a href="#">shift-end</a>
    <a href="#">training </a>
  </div>
   
   <!--
   <a href="javascript:alert('View Orders');">View orders</a>
   -->
   <button class="dropdown-btn">View Orders 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <form class="dropF" action="/" method="post" onsubmit="return false">
          <a type="submit">
          <input type="hidden" id="custId" name="location" value="CO">
            <a href="javascript:{}" onclick="this.closest('form').submit();return false;">Columbus</a>
          </a>
        </form>
        <form class="dropF" action="/" method="post">
          <a type="submit">
          <input type="hidden" id="custId" name="location" value="GC">
            <a href="javascript:{}" onclick="this.closest('form').submit();return false;">Grove City</a>
          </a>
        </form> 
        <form class="dropF" action="/" method="post">
          <a type="submit">
          <input type="hidden" id="custId" name="location" value="NA">
            <a href="javascript:{}" onclick="this.closest('form').submit();return false;">New Albany</a>
          </a>
        </form>
      
    </div>
   <a href="Employee_Portal.php">Employee Portal</a>
   <br/>
   <a href="<?php if($location!=null){
     echo 'order.php?location='.$location;
   }else{echo 'index.php?message=Need%20Location';}?>">New order</a>
  </div>
  <main>
    

    <div id="viewNews" style="display:none">
    <h1 stlye="clear:right">NEWS:</h1>
    <?php 
                $sql5='SELECT * FROM NewsArticle';
                $result5=$conn->query($sql5);
                $newsArray=[];
                while($row = $result5->fetch_array(MYSQLI_ASSOC)){
                    array_push($newsArray,$row);
                }
                $newsArray=array_reverse($newsArray);
                foreach($newsArray as $newsArticle){
                    echo '<div class="card" style="clear:right;display:table;">';
                    echo '<h2>'.$newsArticle["Title"].'</h2>';
                    echo '<h5>'.$newsArticle["Description"].', '.$newsArticle["NewsDate"].'</h5>';
                    //HAVE CODE FOR IMAGE??
                    echo '<p>'.$newsArticle["NewsText"].'</p>';
                    echo '</div>';
                }
                ?>
  
  </div>

  <div id="viewOrders" style="display:block">
  -- Online Orders -- <p id="onlineOrders"></p>
    <h1 id="locationTag">Location: <?php echo $location;?></h1>
      <table>
        <tr>
          <th>Order #</th>
          <th>Items</th>
          <th>Order Date</th>
          <th>Order Status</th>
          <th>Complete</th>
        </tr>
        <!--
        <tr>
          <th>0</th>
          <th>Iced Macchiato<br/>Espresso</th>
          <th>2020-4-8</th>
          <th>Not completed</th>
          <th>
            <button style="width:75%">Completed</button>
          </th>
        </tr>
            -->
        <?php
        function console_log2($output, $with_script_tags = true) {
          $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
      ');';
          if ($with_script_tags) {
              $js_code = '<script>' . $js_code . '</script>';
          }
          echo $js_code;
      }
        //if person selects a location 
        if($location=="CO"||$location=="GC"||$location=="NA"){
          //echo 'test';
          $sql = 'SELECT * from Orders WHERE OrderStatus=1';
          $result = $conn->query($sql);
          $ordersArray=[];
          while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($ordersArray,$row);
          }

          
          $orderStatusText="Not Completed";
          
          foreach($ordersArray as $singleOrder){
            console_log($singleOrder['StoreName']);
            console_log($location);
            if($singleOrder['StoreName']==$location){
              echo '<tr><th>'.$singleOrder["OrderID"].'</th>';
              //for each orderdetails with that order ID
              $sql3= 'SELECT * FROM OrderDetails WHERE OrderID='.$singleOrder["OrderID"];
              $result3=$conn->query($sql3);
              $itemsArray=[];
              echo '<th>';
              while($row2 = $result3->fetch_array(MYSQLI_ASSOC)){
                array_push($itemsArray,$row2);
              }
              console_log($itemsArray);
              foreach($itemsArray as $itemSingle){
                //ask products where productID
                $sql4= 'SELECT ProductName FROM Products WHERE ProductID='.$itemSingle["ProductID"].'';
                $result4= $conn->query($sql4);
                $productName= $result4->fetch_assoc()["ProductName"];
                $itemsString=$itemSingle["OrderSize"].' - '.$productName.' x '.strval($itemSingle["ItemQuantity"]);
                echo $itemsString.'<br/><br/>';
              }
              echo '</th>';
              echo '<th>'.$singleOrder["OrderDate"].'</th>';
              echo '<th>'.$orderStatusText.'</th>';
              //also put in items as hidden input for extra validation/checking
              echo '<th><form action="completeOrder.php" style="padding:0;margins:0;" method="post"><input type="hidden" id="locationVal" name="locationVal" value="'.$singleOrder["StoreName"].'"><input type="hidden" id="orderVal" name="orderID" value="'.$singleOrder["OrderID"].'"><button style="width:75%%;" type="submit">Completed</button></form></th>';
              echo '</tr>';
            }
            
          }
          //$variableName=$result->fetch_assoc()["OrderID"];
          
        }else{
          echo '<p>Please select a location on the side</p>';
        }
        //else tell them to select location
        
        ?>
      </table>
    </div>
    </main>
</nav>

<form id="reloadForm" method="post">
  <input type="hidden" id="custId" name="location" value="<?php echo $location;?>">
        
</form>
<script>
 
  var locationValue= "<?php echo $location;?>";
  if(locationValue=="CO"||locationValue=="GC"||locationValue=="NA")
  {
    //automatically reload page every 10 seconds to get new online orders
    //maybe make it so that only the order part reloads???
    window.onload = function() {
      // Onload event of Javascript
      // Initializing timer variable
      var x = 10;
      var orderTag=document.getElementById("onlineOrders");
      y.innerHTML = "Refreshing in: " + x + "seconds";
      //timer
      setInterval(function() {
        if (x <= 11 && x >= 1) {
          x--;
          if (x == 1) {
            x = 11;
          }
        }
        }, 1000);
    //submit on timer end
      var auto_refresh = setInterval(function() {
        submitform();
        }, 20000);
      // Form submit function
      function submitform() {
        document.getElementById("reloadForm").submit();
      }
    };
  }
  
</script>

<footer>
Copyright &copy; 2016 Montgomery Cup Coffee <br>
<a href="mailto:yourfirstname@yourlastname.com">contact.us@MontgomeryCup.com</a>
</footer>
</div>
<script src="index.js"></script>
<script>
// Get the modal
var modal = document.getElementById('id01');
<?php 
if($loggedIn){
  echo 'modal.style.display="none";/*';
}
?>

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target ===modal) {
      
        modal.style.display = "block";
    }
};
/*
<?php if($loggedIn){
  echo "/*";}?>
*/
//dont do this anymore: user must log into website so see anything at all 

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
var dropdown2 = document.getElementsByClassName("dropdown-btn2");
var i;

for (i = 0; i < dropdown2.length; i++) {
  dropdown2[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html>