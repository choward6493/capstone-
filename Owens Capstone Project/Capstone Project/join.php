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
                        <select id='states'name="states">
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