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


//INSERT INTO Employees(FirstName,LastName,PhoneNumber,Email,Status,HireDate,Title,AccessCode)Values("Test","Dummy","614-999-9999","arenninger@student.cscc.edu","Hired","2020-01-01","Manager","123456")
//INSERT INTO EmployeeLOG(EmployeeID,PasswordHash)values(1,"343b1c4a3ea721b2d640fc8700db0f36")



// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cart=$_POST["cart"];
$location=$_POST["location"];
console_log("cart object:");
console_log($cart);
$orderDate=date('Y-m-d h:i:s');
$totalCost=0;


if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
    $usernamePP=$_COOKIE['user'];
    //console_log($usernamePP);
    $hashPass=$_COOKIE['token'];
    $userID=0;
    $sql = 'SELECT EmployeeID FROM Employees WHERE Email="'.$usernamePP.'"';
    console_log($sql);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output userID from email
        $userID=$result->fetch_assoc()["EmployeeID"];
        //echo $result->fetch_assoc()["CustomerID"].'<br>';
        $sql2 = 'SELECT PasswordHash FROM EmployeeLOG WHERE EmployeeID='.$userID;
        //echo $sql2;
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            // output userID from email
            $hashedData=$result2->fetch_assoc()["PasswordHash"];
            //echo '<br>'.$hashedData.'<br>';
            //echo '<br>'.$hashPass;
            if($hashPass==$hashedData){
              //get employee name
                $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
                $result = $conn->query($sql);
                $employeeName=$result->fetch_assoc()["FirstName"];
                //get employee title
                $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
                $result = $conn->query($sql);
                $employeeTitle=$result->fetch_assoc()["Title"];
                $loggedIn=true;
                //echo 'test';
                //order status is 0 (completed) because person who takes order also makes it
                $sql = 'Insert into Orders(StoreName,OrderDate,OrderStatus)Values("'.$location.'","'.$orderDate.'",0)';
                console_log($sql);
                $result = $conn->query($sql);
                //console_log($result);
                $orderID=$conn->insert_id;

                $allItems=explode(",",$cart);
                foreach($allItems as $singleItem){
                    if($singleItem!=$allItems[(count($allItems)-1)]){
                        $itemSplit=explode(":",$singleItem);
                        //get product ID of product
                        //NEED TO FILTER OUT ANY OTHER CHARACTERS like ' or ;
                        $sql2 = 'Select * from Products where ProductName="'.$itemSplit[0].'"';
                        console_log($sql2);
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            $productID=$result2->fetch_assoc()["ProductID"];
                        }else{
                            //MAKE O COST ITEM THAT NOTES AN ERROR/TAMPERING
                            $productID=0;
                        }
                        //have to run this twice for some reason to get cost...... same as above
                        $sql2 = 'Select * from Products where ProductName="'.$itemSplit[0].'"';
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            $itemCost =$result2->fetch_assoc()["Cost"];
                        }else{
                            //MAKE O COST ITEM THAT NOTES AN ERROR/TAMPERING
                            $itemCost=0;
                        }
                        $totalCost+=$itemCost;
                        $sql2 = 'INSERT INTO OrderDetails(ProductID,OrderID,ItemQuantity,AddOns,OrderSize)Values('.$productID.','.$orderID.',1,"none","'.$itemSplit[1].'")';
                        //console_log($sql2);
                        $result2 = $conn->query($sql2);
                        console_log($result2);


                       
                    }
                    
                }
                 //onsite transactions will be all cash in this case
                 $sql3='INSERT INTO Payments(PaymentType)Values("Cash")';
                 $result3 = $conn->query($sql3);
                 console_log($sql3);
                 console_log($result3);
                 $paymentId=$conn->insert_id;

                 $sql4='INSERT INTO EmployeeTransactions(EmployeeTransactionDate,TransactionTotal,TransactionType,EmployeeID,OrderID,PaymentID)Values("'.$orderDate.'",'.$totalCost.',"Cash",'.$userID.','.$orderID.','.$paymentId.')';
                 console_log($sql4);
                 $result4 = $conn->query($sql4);
                 console_log($result4);



            }else {
                //echo "Password not right";
            }
        } else {
          //echo "nothing found";
        }
    } else {
        //echo "0 results";
  
    }
  }else{
    $loggedIn=false;
  }



?>
<script>alert("order Submitted");window.location.replace("order.php?location=<?php echo $location;?>");</script>