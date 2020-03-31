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
                try{
                    $fullName=$_POST["cardname"];
                    $cardNumber=$_POST["cardnumber"];
                    $expdate=$_POST["expdate"];
                    $cvv=$_POST["cvv"];
                    $location=$_POST["location"];
                    $orderDate=date('Ymd h:i:s A');
                    //create new Orders list, last BIT 1=needs fufilled
                    $sql = 'Insert into Orders(StoreName,OrderDate,OrderStatus)Values("'.$location.'","'.$orderDate.'",1)';
                    $result = $conn->query($sql);
                    console_log($result);

                    $orderID=$conn->insert_id;
                    //now add order details for each item in cart
                    $cart=json_decode($_COOKIE['cart']);
                    for($i=0; $i<sizeof($cart); $i++){
                        //console_log('in loop');
                        $itemName=(array)$cart[$i];

                        //console_log($itemName['item']);
                        $sql2 = 'Select * from Products where ProductName="'.$itemName['item'].'"';
                        $result2 = $conn->query($sql2);
                        $itemCost=$result2->fetch_assoc()["Cost"];
                        $productID=$result2->fetch_assoc()["ProductID"];
                        //echo '<p><a href="#">'.$itemName['item'].'</a> <span class="price">$'.$itemCost.'</span></p>';
                        $totalCost+=$itemCost;
                        
                        $sql2 = 'INSERT INTO OrderDetails(ProductID,OrderID,ItemQuantity,AddOns,OrderSize)Values('.$productID.','.$orderID.',1,"'.$itemName['milk'].'","'.$itemName['size'].'")';
                        console_log($sql2);
                        $result2 = $conn->query($sql2);
                        console_log($result2);
                    }
                    $cardTypeNumber=substr($cardNumber, 0, 1);
                    if($cardTypeNumber==3){
                        $cardType="AmEx";
                    }else if($cardTypeNumber==4){
                        $cardType="Visa";
                    }else if($cardTypeNumber==5){
                        $cardType="MasterCard";
                    }else if($cardTypeNumber==6){
                        $cardType="Discover Card";
                    }else{
                        throw new Exception('Invalid Card Number.');
                    }
                    console_log($cardType);
                    //now create new payment
                    $sql3='INSERT INTO Payments(PaymentType,CardType,CardNumber,FirstName,ExpirationDate)Values("Card","'.$cardType.'","'.$cardNumber.'","'.$customerName.'","'.$expdate.'-01")';
                    $result3 = $conn->query($sql3);
                    $paymentId=$conn->insert_id;
                    console_log($result3);
                    //now create CustomerTransactions
                    $sql4='INSERT INTO CustomerTransactions(TransactionDate,TransactionTotal,TransactionType,CustomerID,OrderID,PaymentID)Values("'.$orderDate.'","'.$totalCost.'","Card-online",'.$userID.','.$orderID.','.$paymentId.')';
                    $result4 = $conn->query($sql4);
                    console_log($sql4);
                    console_log($result4);
                }catch(Exception $e){
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
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