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
$item=$_POST["item"];
$VALIDITEMS=array("Cappuccino", "IcedLatte", "Espresso", "CaramelMacchiato");
if(!in_array($item,$VALIDITEMS)){
    //because it is get request, super quick questioning
    echo '<script>window.location.replace("main.php");</script>';
}

console_log("after item");
$size=$_POST["size"];
$milk=$_POST["milk"];
if(isset($_COOKIE['cart']){
    $cart=json_decode($_COOKIE['cart']);
    $age = array("item"=>$item, "size"=>$size, "milk"=>$milk);
    array_push($item,$cart,$age);
    setcookie('cart',json_encode(array($age)), time() + (86400/24), "/");
}else{
    
    console_log("before array creation");
    setcookie('cart',json_encode(array($age)), time() + (86400/24), "/");
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




$conn->close();echo '<script>window.location.replace("main.php");</script>';
?>