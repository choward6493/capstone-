<?php 
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