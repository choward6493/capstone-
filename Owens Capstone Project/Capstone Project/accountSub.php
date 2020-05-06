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

$usernamePP = $_POST["uname"];
//echo $usernamePP."<br/>";
//$_POST["psw"];
//echo $_POST["remember"]."<br/>";

$hashPass = hash("md5",$_POST["psw"]);
$npsw1=$_POST["npsw1"];
$npsw2=$_POST["npsw2"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$phoneNumber = $_POST["phoneNumber"];
$address = $_POST["address"];
$aptNumber = $_POST["aptNumber"];
$city = $_POST["city"];
$state = $_POST["states"];
//console_log($state);
$zipCode = $_POST["zipCode"];
$date=$_POST["date"];
$userID=0;

try{
$sql = 'SELECT * FROM Customers WHERE Email="'.$usernamePP.'"';
//echo $sql;
//$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
$result = $conn->query($sql);
//check duplicate email
if ($result->num_rows > 0) {
    //echo '<script>alert("That email has been used before. Please use a different one");window.location.replace("join.php");</script>';
    $userInfo=$result->fetch_array(MYSQLI_ASSOC);
    $sql2 = 'SELECT CustomerPasswordHash FROM CustomerLOG WHERE CustomerID='.$userInfo["CustomerID"];
        //echo $sql2;
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            // output userID from email
            $hashedData=$result2->fetch_assoc()["CustomerPasswordHash"];
            //echo '<br>'.$hashedData.'<br>';
            //echo '<br>'.$hashPass;
            if($hashPass==$hashedData){
                //echo "You're in";
                if(isset($firstName) && $firstName!=$userInfo["FirstName"]){
                    $sql='UPDATE Customers SET FirstName="'.$firstName.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }
                if(isset($lastName) && $lastName!=$userInfo["LastName"]){
                    $sql='UPDATE Customers SET LastName="'.$lastName.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }
                if(isset($phoneNumber) && $phoneNumber!=$userInfo["PhoneNumber"]){
                    $sql='UPDATE Customers SET PhoneNumber="'.$phoneNumber.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }
                if(isset($address) && $address!=$userInfo["Address"]){
                    $sql='UPDATE Customers SET Address="'.$address.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }
                if(isset($zipCode) && $zipCode!=$userInfo["ZipCode"]){
                    $sql='UPDATE Customers SET ZipCode="'.$zipCode.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }
                if(isset($city) && $city!=$userInfo["City"]){
                    $sql='UPDATE Customers SET City="'.$city.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }
                if(isset($state) && $state!=$userInfo["State"]){
                    $sql='UPDATE Customers SET State="'.$state.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }
                if(isset($date) && $date!=$userInfo["DOB"]){
                    try{
                        $sql='UPDATE Customers SET DOB="'.$date.'" WHERE CustomerID='.$userInfo["CustomerID"];
                        $result = $conn->query($sql);
                    }catch(Exception $e){

                    }
                }
                if(isset($aptNumber)){
                    $sql='UPDATE Customers SET APTNumber="'.$aptNumber.'" WHERE CustomerID='.$userInfo["CustomerID"];
                    $result = $conn->query($sql);
                }

                if(isset($npsw1)&&isset($npsw2)){
                    if($npsw1==$npsw2){
                        $npswHash=hash("md5",$npsw1);
                        $sql='UPDATE CustomerLOG SET CustomerPasswordHash="'.$npswHash.'" WHERE CustomerID='.$userInfo["CustomerID"];
                        $result = $conn->query($sql);
                    }
                }
            }else {
                //echo "Password not right";
            }
        } else {
            //echo "nothing found";
        }
} else {
    /*
    //if not duplicate insert into customers
    $sql = 'INSERT INTO Customers(FirstName,LastName,PhoneNumber,Email,Address,APTNumber,City,State,ZipCode,DOB)values("'.$firstName.'","'.$lastName.'","'.$phoneNumber.'","'.$usernamePP.'","'.$address.'","'.$aptNumber.'","'.$city.'","'.$state.'","'.$zipCode.'","'.$date.'")';
    $result = $conn->query($sql);
    console_log($result);

    //get customer ID for password storage
    $userID=$conn->insert_id;

    //insert hashed password into database
    //password is sent over as clear text??? somehow fix this
    $sql2 = 'INSERT INTO CustomerLOG(CustomerID,CustomerPasswordHash)values("'.$userID.'","'.$hashPass.'")';
    $result2 = $conn->query($sql2);
    console_log($result2);

    //store user info as cookie in browser
    //change this as well.... some other unique format
    $userCookie="user";
    $userCookieVal=$usernamePP;
    $passCookie="token";
    $passCookieVal=$hashPass;
    setcookie($userCookie,$userCookieVal, time() + (86400/24), "/");
    setcookie($passCookie,$passCookieVal,time() + (86400/24),"/");
        
    echo '<script>window.location.replace("main.php");</script>';
    */
}
}catch(Exception $e){
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


$conn->close();
//window.location.replace("main.php");
?>
<html>
<script>alert("Successfully updated Fields");window.location.replace("main.php");</script>
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->




</body>
</html>