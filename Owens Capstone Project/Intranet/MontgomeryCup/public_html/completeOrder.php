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
$location=$_POST['locationVal'];
$orderID=$_POST['orderID'];

$sql='SELECT * FROM Orders WHERE OrderId='.$orderID;
$result3=$conn->query($sql);
//even though there is only going to be one result
$orderArray=[];
array_push($orderArray,$result3->fetch_array(MYSQLI_ASSOC));
// $orderArray[0]["VALUEHERE"]
$sqlUPDATE='UPDATE Orders SET OrderStatus=0 WHERE OrderID='.$orderID;

?>
<html>
<script>window.location.replace("/");</script></html>