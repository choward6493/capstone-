<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="coffee">

  <div id="id01" class="modal"style="display:block;">
  <form class="modal-content animate" action="/joinSub.php" method="post">
                    

                    <div class="container">
                        <label for="uname"><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="uname" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <label for="firstName"><b>First Name</b></label>
                        <input type="text" placeholder="Enter first name" name="firstName" required>

                        <label for="lastName"><b>Last Name</b></label>
                        <input type="text" placeholder="Enter last name" name="lastName" required>

                        <label for="phoneNumber"><b>Phone Number</b></label>
                        <input type="text" placeholder="Enter phone number" name="phoneNumber" required>

                        <label for="address"><b>Address</b></label>
                        <input type="text" placeholder="Enter address" name="address" required>

                        <label for="aptNumber"><b>Apartment Number (if applicable)</b></label>
                        <input type="text" placeholder="Enter apartment number" name="aptNumber">

                        <label for="city"><b>City</b></label>
                        <input type="text" placeholder="Enter city" name="city" required>

                        <label for="state"><b>State</b></label>
                        <select id='states'>
                            <option name="AL">Alabama</option>
                            <option name="AK">Alaska</option>
                            <option name="AZ">Arizona</option>
                            <option name="AR">Arkansas</option>
                            <option name="CA">California</option>
                            <option name="CO">Colorado</option>
                            <option name="CT">Connecticut</option>
                            <option name="DE">Delaware</option>
                            <option name="DC">District Of Columbia</option>
                            <option name="FL">Florida</option>
                            <option name="GA">Georgia</option>
                            <option name="HI">Hawaii</option>
                            <option name="ID">Idaho</option>
                            <option name="IL">Illinois</option>
                            <option name="IN">Indiana</option>
                            <option name="IA">Iowa</option>
                            <option name="KS">Kansas</option>
                            <option name="KY">Kentucky</option>
                            <option name="LA">Louisiana</option>
                            <option name="ME">Maine</option>
                            <option name="MD">Maryland</option>
                            <option name="MA">Massachusetts</option>
                            <option name="MI">Michigan</option>
                            <option name="MN">Minnesota</option>
                            <option name="MS">Mississippi</option>
                            <option name="MO">Missouri</option>
                            <option name="MT">Montana</option>
                            <option name="NE">Nebraska</option>
                            <option name="NV">Nevada</option>
                            <option name="NH">New Hampshire</option>
                            <option name="NJ">New Jersey</option>
                            <option name="NM">New Mexico</option>
                            <option name="NY">New York</option>
                            <option name="NC">North Carolina</option>
                            <option name="ND">North Dakota</option>
                            <option name="OH">Ohio</option>
                            <option name="OK">Oklahoma</option>
                            <option name="OR">Oregon</option>
                            <option name="PA">Pennsylvania</option>
                            <option name="RI">Rhode Island</option>
                            <option name="SC">South Carolina</option>
                            <option name="SD">South Dakota</option>
                            <option name="TN">Tennessee</option>
                            <option name="TX">Texas</option>
                            <option name="UT">Utah</option>
                            <option name="VT">Vermont</option>
                            <option name="VA">Virginia</option>
                            <option name="WA">Washington</option>
                            <option name="WV">West Virginia</option>
                            <option name="WI">Wisconsin</option>
                            <option name="WY">Wyoming</option>
                        </select>				<br/><br/>

                        <label for="zipCode"><b>Zip Code</b></label>
                        <input type="text" placeholder="Enter ZIP Code" name="zipCode" required>

                        <label for="date"><b>Date</b></label>
                        <input type="date" placeholder="Enter Date" name="date" required>
<br/>
                        <button class="login" type="submit">Register</button>
                        
                    </div>

                    
                </form>
                </div>

</body>
</html>