<?php
//-- first create new field in Orders\
//-- then new in OrderDetails for each item
//-- then a new Payment
//-- then put together to create CustomerTransactions
$servername = "capstone.cfwnz1g6jqbd.us-east-1.rds.amazonaws.com:3306";
$username = "admin";
$password = "SixGuys1CapstoneProject";
$dbname="Capstone";

date_default_timezone_set('America/New_York');
$orderDate=date('Ymd h:i:s A');
//$date=$_POST["date"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//need validation for all inputs`


$sql = 'INSERT INTO Orders(StoreName,OrderDate,OrderStatus)values("'.$storeLocation.'","'.$orderDate.'",0)';
$result = $conn->query($sql);
console_log($result);

/*
For each item in cart:
$productID
$productQuantity

foreach addon add to addon
$addOns

*/
$orderID=$conn->insert_id;


$sql2 = 'INSERT INTO OrderDetails(ProductID,OrderID,ItemQuantity,AddOns)values("'.$productID.'","'.$orderID.'",'$productQuantity','$addOns')';
$result2 = $conn->query($sql2);
console_log($result);


?>