<?php

$item="Cap";
$size="yes";
$milk="yes";
if(isset($_COOKIE['cart']){
    $cart=json_decode($_COOKIE['cart']);
    $age = array("item"=>$item, "size"=>$size, "milk"=>$milk);
    array_push($item,$cart,$age);
    //setcookie('cart',json_encode(array($age)), time() + (86400/24), "/");
}else{
    
    console_log("before array creation");
    //setcookie('cart',json_encode(array($age)), time() + (86400/24), "/");
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




$conn->close();
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