<?php
$servername = "capstone2.cxiblbeokqky.us-east-1.rds.amazonaws.com:1433";
$username = "admin";
$password = "SixGuys1CapstoneProject";
$dbname="Capstone";


//INSERT INTO Employees(FirstName,LastName,PhoneNumber,Email,Status,HireDate,Title,AccessCode)Values("Test","Dummy","614-999-9999","arenninger@student.cscc.edu","Hired","2020-01-01","Manager","123456")
//INSERT INTO EmployeeLOG(EmployeeID,PasswordHash)values(1,"343b1c4a3ea721b2d640fc8700db0f36")



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
$userID=0;
$sql = 'SELECT EmployeeID FROM Employees WHERE Email="'.$usernamePP.'"';
//echo $sql;
//$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output userID from email
    $userID=$result->fetch_assoc()["EmployeeID"];
    //echo $result->fetch_assoc()["CustomerID"].'<br>';
} else {
    //echo "0 results";
}
$sql2 = 'SELECT PasswordHash FROM EmployeeLOG WHERE EmployeeID='.$userID;
//echo $sql2;
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output userID from email
    $hashedData=$result2->fetch_assoc()["PasswordHash"];
    //echo '<br>'.$hashedData.'<br>';
    //echo '<br>'.$hashPass;
    if($hashPass==$hashedData){
        //echo "You're in";
        $userCookie="user";
        $userCookieVal=$usernamePP;
        $passCookie="token";
        $passCookieVal=$hashedData;
        
        if(!($_POST["remember"]=="on")){
            
            setcookie($userCookie,$userCookieVal, time() + (86400/24), "/");
            setcookie($passCookie,$passCookieVal,time()+(86400/24),"/");
            //echo '<script>alert("dont remember");</script>';
        }else{
            //echo '<script>alert("remembr");</script>';
            setcookie($userCookie, $userCookieVal, time() + (86400*30), "/");
            setcookie($passCookie,$passCookieVal,time()+(86400*30),"/");
            //echo '<script>alert("remembr");</script>';
        }
        
    }else {
        //echo "Password not right";
    }
} else {
    //echo "nothing found";
}


$conn->close();
?>
<html>
<script>window.location.replace("/");</script>
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->




</body>
</html>