<?php
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

$item=$_POST["item"];
console_log("after item");
$size=$_POST["size"];
$milk=$_POST["milk"];
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