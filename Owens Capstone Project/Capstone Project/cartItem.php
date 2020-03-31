<?php

$item=$_POST["item"];
$dsize=$_POST["size"];
$milk=$_POST["milk"];

if(isset($_COOKIE['cart'])){
    $cart=json_decode($_COOKIE['cart']);
    $age = array("item"=>$item, "size"=>$dsize, "milk"=>$milk);
    array_push($cart,$age);
    setcookie('cart',json_encode($cart), time() + (86400), "/");
}else{
    $age = array("item"=>$item, "size"=>$dsize, "milk"=>$milk);
    setcookie('cart',json_encode(array($age)), time() + (86400), "/");
}

/*

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

*/

//$usernamePP = $_POST["uname"];
//echo $usernamePP."<br/>";
//$_POST["psw"];
//echo $_POST["remember"]."<br/>";




echo '<script>window.location.replace("main.php");</script>';
?><html>
<script></script>
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->




</body>
</html>