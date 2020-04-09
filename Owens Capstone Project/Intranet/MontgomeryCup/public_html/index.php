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
$loggedIn=false;
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$location="";
try{
$location=$_POST['location'];
}catch(Exception $e){

}
if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
  $usernamePP=$_COOKIE['user'];
  console_log($usernamePP);
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
              $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
              $result = $conn->query($sql);
              $employeeName=$result->fetch_assoc()["FirstName"];
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
<title>JavaJam Coffee House</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="index.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Javajam is a coffee shop that serves a locally roasted free-trade coffee and Tea
with a smooth aroma, Bagels, Muffins and Organic Snacks.">
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
 <a class="active" href="/">Home</a>
 <a id="news" href="javascript:alert('News');">News</a>
 <!--
 <button id="login"onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
-->
</div> 
 <div id="id01" class="modal" style="display:block"> 
    <form class="modal-content animate" action="/login.php" method="post">
    

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>

<nav>
  <div class="navLinks">
  <button class="dropdown-btn">Status 
    <i class="fa fa-caret-down"></i>
  </button>
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
        <form class="dropF" action="/" method="post">
          <a type="submit">
          <input type="hidden" id="custId" name="location" value="Columbus">
            <a href="javascript:{}" onclick="this.closest('form').submit();return false;">Columbus</a>
          </a>
        </form>
        <form class="dropF" action="/" method="post">
          <a type="submit">
          <input type="hidden" id="custId" name="location" value="GroveCity">
            <a href="javascript:{}" onclick="this.closest('form').submit();return false;">Grove City</a>
          </a>
        </form> 
        <form class="dropF" action="/" method="post">
          <a type="submit">
          <input type="hidden" id="custId" name="location" value="NewAlbany">
            <a href="javascript:{}" onclick="this.closest('form').submit();return false;">New Albany</a>
          </a>
        </form>
      
    </div>
   <a href="Employee_Portal.php">Employee Portal</a>
   <br/>
   <a href="order.php">New order</a>
  </div>
  <main>
    



  <div id="viewOrders" style="display:block">
    <h1 id="locationTag">Location: </h1>
      <table>
        <tr>
          <th>Order #</th>
          <th>Items</th>
          <th>Order Date</th>
          <th>Order Status</th>
          <th>Complete</th>
        </tr>
        <tr>
          <th>0</th>
          <th>Iced Macchiato<br/>Espresso</th>
          <th>2020-4-8</th>
          <th>Not completed</th>
          <th>
            <button style="width:75%">Completed</button>
          </th>
        </tr>
        <?php
        //if person selects a location 
        if(location!=""){
          $sql = 'SELECT * from Orders WHERE OrderStatus=1';
          $result = $conn->query($sql);
          $ordersArray=[];
          while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($row);
          }

          if($singleOrder["OrderStatus"]==1){
            $orderStatusText="Not Completed";
          }
          foreach($ordersArray as $singleOrder){
          echo '<tr><th>'.$singleOrder["OrderID"].'</th>';
          echo '<th>'.$singleOrder["OrderDate"].'</th>';
          echo '<th>'.$orderStatusText.'</th>';
          echo '<th><form action="completeOrder.php" method="post"><input type="hidden" id="locationVal" name="locationVal" value="'.$location.'"><input type="hidden" id="orderVal" name="orderID" value="'.$singleOrder["OrderID"].'"><button style="width:75%" type="submit">Completed</button></form></th>';
          echo '</tr>';
          }
          //$variableName=$result->fetch_assoc()["OrderID"];
          
        }
        //else tell them to select location
        echo '<p>Please select a location on the side</p>';
        ?>
      </table>
    </div>
    </main>
</nav>



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