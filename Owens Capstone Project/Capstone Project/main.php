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
                $userCookie="user";
                $userCookieVal=$usernamePP;
                $passCookie="token";
                $passCookieVal=$hashedData;
                if(!($_POST["remember"]=="on")){
                    setcookie($userCookie,$userCookieVal, time() + (86400/24), "/");
                    setcookie($passCookie,$passCookieVal,time()+(86400/24),"/");
                }else{
                    setcookie($userCookie, $userCookieVal, time() + (86400*30), "/");
                    setcookie($passCookie,$passCookieVal,time()+(86400*30),"/");
                }
                
            }else {
                //echo "Password not right";
            }
        } else {
            //echo "nothing found";
        }
    }
    $sql = 'SELECT * FROM Customers WHERE CustomerID='.$userID;
    $result = $conn->query($sql);
    $customerName=$result->fetch_assoc()["FirstName"];
    ?>
    <body>

        <div class="header">
        <h1>Montgomery Cup Coffee​</h1>
        <h4><b>Our mission is to make the lives of guests better<br>through quality products, service, and innovation.</b></h4>
        </div>

        <div class="topnav">
            <a href="index.html">Home</a>
            <a href="menu.html">Menu</a>
            <a href="rewards.html">Rewards</a>
            <button id="logB" display="none" class="login" onclick="document.getElementById('id01').style.display='block'" style="display:none;width:auto;float:right;font-family: Arial;">Login</button>
            <p id="welcomeP" style="display:none;width:auto;float:right;font-family: Arial;">Welcome, <?php echo $customerName;?></p>
            <script>
                //get cookie values
                function getCookie(cname) {
                    var name = cname + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var ca = decodedCookie.split(';');
                    for(var i = 0; i <ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                    }
                //if user logged in token doesn't exist, show log in button
                if((getCookie("token")=="")){
                    document.getElementById('logB').style.display='inline';
                }else{
                    document.getElementById('welcomeP').style.display='inline';
                }
            </script>
            <div id="id01" class="modal">
                <form class="modal-content animate" action="/login.php" method="post">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <img src="pictures/avatar.png" alt="Avatar" class="avatar" width="100%" height="100%">
                    </div>

                    <div class="container">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>
            
                        <button class="login" type="submit">Login</button>
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> Remember me
                        </label>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn"><b>Cancel</b></button>
                        <a class="btn"href="#" style="float:right;padding: 10px 18px;background-color: #333;color: #f2f2f2;">Forgot password?</a>
                        <a class="btn"href="join.html" style="text-decoration:none;float:right;padding: 10px 18px;background-color: #333;color: #f2f2f2;">Join now</a>
                    </div>
                </form>
            </div>

            <script>
                // Get the modal
                var modal = document.getElementById('id01');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>
        </div>

        <div class="row">
            <div class="leftcolumn">
                <div class="card">
                    <h2>TITLE HEADING</h2>
                    <h5>Title description, Dec 7, 2017</h5>
                    <div class="img" style="height:200px;">Image</div>
                    <p>Some text..</p>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                </div>
                <div class="card">
                    <h2>TITLE HEADING</h2>
                    <h5>Title description, Sep 2, 2017</h5>
                    <div class="img" style="height:200px;">Image</div>
                    <p>Some text..</p>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                </div>
	            <div class="card">
                    <h2>TITLE HEADING</h2>
                    <h5>Title description, Sep 2, 2017</h5>
                    <div class="img" style="height:200px;">Image</div>
                    <p>Some text..</p>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                </div>
            </div>
            <div class="rightcolumn">
                <div class="card">
                    <h2>About Us</h2>
                    <div class="img" style="height:300px;"><img src="pictures/coffee-shop.jpg" alt="coffee shop" width="370" height="260"></div>
                    <p>The Montgomery Cup was founded in 2003 by owners Lex and Milli Montgomery as a family owned,  quality coffee shop located in central Ohio. Since then they have expanded and grown into three shops.</p>
                </div>
                <div class="card">
                    <h3>Popular Items</h3>
                    <div class="pop_img">
	                    <a href="menu.html">
	                    <img border="0" src="pictures/espresso.jpg" alt="espresso" width="175" height="175"></a>
	                    <a href="menu.html">
	                    <img border="0" src="pictures/darkchocolatemocha.jpg" alt="dark chocolate mocha" width="175" height="175" style="float:right"></a>
	                </div>
	                
                    <div class="pop_img">
                        <a href="menu.html">
                        <img src="pictures/cappuccino.jpg" alt="cappuccino" width="175" height="175"></a>
	                    <a href="menu.html">
	                    <img border="0" src="pictures/caramel_macchiato.jpg" alt="caramel macchiato" width="175" height="175" style="float:right"></a>
	                </div>
	                    
                    <div class="pop_img">
                        <a href="menu.html">
                        <img src="pictures/americano.jpg" alt="americano" width="175" height="175"></a>
	                    <a href="menu.html">
	                    <img border="0" src="pictures/iced-latte.jpg" alt="iced latte" width="175" height="175" style="float:right"></a>
	                </div>
                </div>
                <div class="card">
                    <h3>Follow Us</h3>
                    <ul class="social-icons">
                        <li><a href="http://www.facebook.com"><img src='pictures/Facebook_3.png' /></a></li>
                        <li><a href="http://www.twitter.com"><img src='pictures/Twitter_3.png' /></a></li>
                        <li><a href="http://www.instagram.com"><img src='pictures/Instagram_3.png' /></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer">
		    <form class="form-inline" action="#">
                <label for="email">Join our mailing list:</label>
                <input type="email" id="email" placeholder="Enter email" name="email">
                <button class="email" type="submit">Submit</button>
            </form>
		</div>
    </body>
</html>