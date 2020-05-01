<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
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
    $userID=0;
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    /*
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    */

    //if login data is stored, check that it is actual
    if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
        $usernamePP=$_COOKIE['user'];
        console_log($usernamePP);
        $hashPass=$_COOKIE['token'];
        $userID=0;
        $sql = 'SELECT CustomerID FROM Customers WHERE Email="'.$usernamePP.'"';
        //echo $sql;
        //$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output userID from email
            $userID=$result->fetch_assoc()["CustomerID"];
            //echo $result->fetch_assoc()["CustomerID"].'<br>';
        } else {
            //echo "0 results";
        }
        $sql2 = 'SELECT CustomerPasswordHash FROM CustomerLOG WHERE CustomerID='.$userID;
        //echo $sql2;
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            // output userID from email
            $hashedData=$result2->fetch_assoc()["CustomerPasswordHash"];
            //echo '<br>'.$hashedData.'<br>';
            //echo '<br>'.$hashPass;
            if($hashPass==$hashedData){
                //echo "You're in";
                $sql = 'SELECT * FROM Customers WHERE CustomerID='.$userID;
                $result = $conn->query($sql);
                $userInfo=$result->fetch_array(MYSQLI_ASSOC);
                
            }else {
                //echo "Password not right";
            }
        } else {
            //echo "nothing found";
        }
    }
    
    ?>
<body class="coffee">

  <div id="id01" class="modal"style="display:block;">
  <form class="modal-content animate" action="/joinSub.php" method="post">
                    

                    <div class="container">
                        <label for="uname"><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="uname"  value="<?php echo $userInfo["Email"];?>" required>

                        <label for="firstName"><b>First Name</b></label>
                        <input type="text" placeholder="Enter first name" name="firstName" value="<?php echo $userInfo["FirstName"];?>" required>

                        <label for="lastName"><b>Last Name</b></label>
                        <input type="text" placeholder="Enter last name" name="lastName" value="<?php echo $userInfo["LastName"];?>" required>

                        <label for="phoneNumber"><b>Phone Number</b></label>
                        <input type="text" pattern="^([\+][0-9]{1,3}([ \.\-])?)?([\(]{1}[0-9]{3}[\)])?([0-9A-Z \.\-]{1,32})((x|ext|extension)?[0-9]{1,4}?)$" placeholder="Enter phone number" name="phoneNumber" value="<?php echo $userInfo["PhoneNumber"];?>" required>
                        <!-- https://stackoverflow.com/questions/123559/how-to-validate-phone-numbers-using-regex thank you!!!!!!-->
                        <label for="address"><b>Address</b></label>
                        <input type="text" placeholder="Enter address" name="address" value="<?php echo $userInfo["Address"];?>" required>

                        <label for="aptNumber"><b>Apartment Number (if applicable)</b></label>
                        <input type="text" placeholder="Enter apartment number" name="aptNumber" value="<?php echo $userInfo["APTNumber"];?>" >

                        <label for="city"><b>City</b></label>
                        <input type="text" placeholder="Enter city" name="city" value="<?php echo $userInfo["City"];?>" required>

                        <label for="states"><b>State</b></label>
                        <select id='states' name="states" required value="<?php echo $userInfo["State"];?>">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>				<br/><br/>

                        <label for="zipCode"><b>Zip Code</b></label>
                        <input type="text" placeholder="Enter ZIP Code" name="zipCode" value="<?php echo $userInfo["ZipCode"];?>" required>

                        <label for="date"><b>Birth Date</b></label>
                        <input type="date" pattern="^\d{1,2}\/\d{1,2}\/\d{4}$" placeholder="Enter Date" name="date" value="<?php echo $userInfo["DOB"];?>" required>
<br/>
                        <label for="psw"><b>Old Password (Required to change details)</b></label>
                        <input type="password" placeholder="Enter Old Password" name="psw" required>
                        <label for="psw"><b>New Password (Don't enter anything if not changing password)</b></label>
                        <input type="password" placeholder="Enter New Password" name="npsw1" pattern="^(?=.*\d).{6,20}$">
                        <label for="psw"><b>Repeat New Password</b></label>
                        <input type="password" placeholder="Enter New Password" name="npsw2" pattern="^(?=.*\d).{6,20}$">
                        <button class="login" type="submit">Update</button>
                        
                    </div>

                    
                </form>
                </div>

</body>
</html>