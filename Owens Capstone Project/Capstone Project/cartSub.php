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
/*

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

*/

$totalCost=0;
$userID=0;

if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
    $usernamePP=$_COOKIE['user'];
    console_log($usernamePP);
    $hashPass=$_COOKIE['token'];
    $userID=0;
    $sql = 'SELECT * FROM Customers WHERE CustomerID='.$userID;
    $result = $conn->query($sql);
    $customerName=$result->fetch_assoc()["FirstName"]." ".$result->fetch_assoc()["LastName"];
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
            //LOg IN IS CORRECT; ALL CODE IN HERE
            if(isset($_COOKIE['cart'])){
                //cart cookie exists/has information
                

                //GOES HERE
            }
            
        }else {
            //echo "Password not right";
        }
    } else {
        //echo "nothing found";
    }
}else{
    //if not logged in send back to cart
    echo '<script>alert("You must be logged in to Order online");window.location.replace("cart.php");</script>';
}



$conn->close();
?>
<html>
<!--
<script>window.location.replace("/");</script>
-->
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->




</body>
</html>