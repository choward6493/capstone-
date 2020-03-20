<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script>
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
if((getCookie("token")=="")){
    document.getElementById('logB').style.visibility='inline';
}
</script>
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
	  <a href="menu.html">
      <div class="pop_img"><img src="pictures/cappuccino.jpg" alt="cappuccino" width="175" height="175"></a>
	  <a href="menu.html">
	  <img border="0" src="pictures/caramel_macchiato.jpg" alt="caramel macchiato" width="175" height="175" style="float:right"></a>
	  </div>
	  <a href="menu.html">
      <div class="pop_img"><img src="pictures/americano.jpg" alt="americano" width="175" height="175"></a>
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