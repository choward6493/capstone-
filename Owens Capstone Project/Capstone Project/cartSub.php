<?php
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
date_default_timezone_set("America/New_York");
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

//hopefully can make this so that sends to itself, on same php file


$totalCost=0;
$userID=0;
console_log($_POST["picktime"]);
//if login cookie is set
if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
    //get username and password from cookie
    $usernamePP=$_COOKIE['user'];
    //console_log($usernamePP);
    $hashPass=$_COOKIE['token'];

    $userID=0;
    
    //What is this doing here???
    //get customer name from ID
    /*
    $sql = 'SELECT * FROM Customers WHERE CustomerID='.$userID;
    $result = $conn->query($sql);
    $customerName=$result->fetch_assoc()["FirstName"]." ".$result->fetch_assoc()["LastName"];
    */

    //check to make sure that username and password stored are legit
    $sql = 'SELECT CustomerID FROM Customers WHERE Email="'.$usernamePP.'"';
    //echo $sql;
    //$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
    $result = $conn->query($sql);

    //if the email is stored in the database
    if ($result->num_rows > 0) {
        $userID=$result->fetch_assoc()["CustomerID"];
        //echo $result->fetch_assoc()["CustomerID"].'<br>';
        $sql2 = 'SELECT CustomerPasswordHash FROM CustomerLOG WHERE CustomerID='.$userID;
        //echo $sql2;
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            $hashedData=$result2->fetch_assoc()["CustomerPasswordHash"];
            if($hashPass==$hashedData){

                //LOg IN IS CORRECT; ALL CODE IN HERE
                if(isset($_COOKIE['cart'])){
                    //cart cookie exists/has information
                    try{
                        //get form submission variables
                        $fullName=$_POST["cardname"];
                        $cardNumber=$_POST["cardnumber"];
                        $expdate=$_POST["expdate"];
                        $cvv=$_POST["cvv"];
                        $location=$_POST["location"];
                        $orderDate=date('Y-m-d H:i:s');
                        //console_log($orderDate);

                        //create new Orders list, last BIT 1=needs fufilled
                        $sql = 'Insert into Orders(StoreName,OrderDate,OrderStatus,PickDate)Values("'.$location.'","'.$orderDate.'",1,"'.$_POST["picktime"].'")';
                        $result = $conn->query($sql);
                        //console_log($result);
                        $orderID=$conn->insert_id;

                        //now add order details for each item in cart
                        $cart=json_decode($_COOKIE['cart']);
                        //for each item in cart
                        for($i=0; $i<sizeof($cart); $i++){
                            //get cart item
                            $itemName=(array)$cart[$i];
                            
                            //get product ID of product
                            //NEED TO FILTER OUT ANY OTHER CHARACTERS like ' or ;
                            $sql2 = 'Select * from Products where ProductName="'.$itemName['item'].'"';
                            $result2 = $conn->query($sql2);
                            if ($result2->num_rows > 0) {
                                $productID=$result2->fetch_assoc()["ProductID"];
                            }else{
                                //MAKE O COST ITEM THAT NOTES AN ERROR/TAMPERING
                                $productID=0;
                            }
                            //have to run this twice for some reason to get cost...... same as above
                            $sql2 = 'Select * from Products where ProductName="'.$itemName['item'].'"';
                            $result2 = $conn->query($sql2);
                            if ($result2->num_rows > 0) {
                                $itemCost =$result2->fetch_assoc()["Cost"];
                            }else{
                                //MAKE O COST ITEM THAT NOTES AN ERROR/TAMPERING
                                $itemCost=0;
                            }



                            //console_log($productID);
                            //echo '<p><a href="#">'.$itemName['item'].'</a> <span class="price">$'.$itemCost.'</span></p>';
                            
                            //add cost of item into total cost
                            $totalCost+=$itemCost;
                            
                            //insert this item into order details
                            $sql2 = 'INSERT INTO OrderDetails(ProductID,OrderID,ItemQuantity,AddOns,OrderSize)Values('.$productID.','.$orderID.',1,"'.$itemName['milk'].'","'.$itemName['size'].'")';
                            //console_log($sql2);
                            $result2 = $conn->query($sql2);
                            console_log($result2);
                        }
                        //subsctring the cardnumber entered to get the first number (do this in realtime)
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

                        //console_log($cardType);
                        //now create new payment
                        $sql3='INSERT INTO Payments(PaymentType,CardType,CardNumber,CVV,FirstName,ExpirationDate)Values("Card","'.$cardType.'","'.$cardNumber.'","'.$cvv.'","'.$customerName.'","'.$expdate.'-01")';
                        $result3 = $conn->query($sql3);
                        $paymentId=$conn->insert_id;
                        //console_log($result3);
                        //now create CustomerTransactions
                        $sql4='INSERT INTO CustomerTransactions(TransactionDate,TransactionTotal,TransactionType,CustomerID,OrderID,PaymentID)Values("'.$orderDate.'","'.$totalCost.'","Card-online",'.$userID.','.$orderID.','.$paymentId.')';
                        $result4 = $conn->query($sql4);
                        //console_log($sql4);
                        //console_log($result4);
                    }catch(Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
                    echo '<script>document.cookie = "cart= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";</script>';
                    
                }
                
            }else {
                //alert that their password was wrong and also delete the cookie, effectively logging them outs
                echo '<script>alert("Your user password was wrong");window.location.replace("cart.php");document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";</script>';
                
            }
        } else {
            //alert that their password wasn't found in our logs and also delete the cookie, effectively logging them outs
            echo '<script>alert("Your password was not found in our records... please contact support");window.location.replace("cart.php");document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";</script>';

        }
    } else {
        //alert that their username/email isn't in our records and delete the cookie
        echo '<script>alert("Your account does not exist.... please sign up");window.location.replace("cart.php");document.cookie = "user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";</script>';

    }
}else{
    //if not logged in send back to cart
    echo '<script>alert("You must be logged in to order online!");window.location.replace("cart.php");</script>';
}


//close connection
$conn->close();
?>
<html>
<!-- always send back to cart-->

<script>window.location.replace("cart.php?subMessage=Order%20Submitted");</script>

<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->




</body>
</html>