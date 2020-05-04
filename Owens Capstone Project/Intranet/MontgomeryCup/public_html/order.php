
<!DOCTYPE html>
<html lang="en">
<head>
<title>Montgomery Cup Coffee</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="index.css">
<script src="processing.min.js"></script>
<?php 
$location=array_values($_GET);
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>

var costDict={
  CaffeMacchiato:2, Americano:2
};
//setcookie($userCookie,$userCookieVal, time() + (86400/24), "/");
function submitCart(tcart){
  //MAKE THIS MAKE A COOKIE INSTEAD
  console.log("submitted");
  //document.cookie="cart="+tcart;
  //console.log(tcart);
  var form = document.createElement("form");
    
    var element1 = document.createElement("input"); 
    var element2 = document.createElement("input");  

    form.method = "POST";
    form.action = "orderSub.php";   

    element1.value=tcart;
    element1.name="cart";

    element2.value=<?php echo $location;?>;
    element2.name="location";
    form.appendChild(element1);  
    form.appendChild(element2);

    

    document.body.appendChild(form);

    form.submit();
}
</script>
</head>
<body>
<div id="wrapper">
<div class="toplink">
   <a href="index.php">Home</a>
   <a href="order.php">New order</a>
   <a href="Employee_Portal.php">Employee Portal</a>
</div>

<canvas id="canvas1" width="1000" height="2000" data-processing-sources="orderForm.pde"></canvas>
<script id="script1">

</script>

 <aside>
     <h2>Food</h2>
        <div class="drinks">
              <div class="row">
  <div class="column">
    <div class="content">
      <a href="food_form.html">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>DANISH</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="food_form.php">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>BAGEL</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
   <a href="food_form.php">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>CAKE_POP</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="food_form.php">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>EGG_SANDWICH</h3>
    </div>
  </div>
                    <div class="row">
  <div class="column">
    <div class="content">
      <a href="food_form.php">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>YOGURT</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="food_form.php">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>BLUEBERRY_MUF</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
   <a href="food_form.html">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>FRUIT_CUP</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="food_form.php">
      <img src="images/steak.png" alt="food" style="width:100%">
    </a>
      <h3>COMING SOON</h3>
    </div>
  </div>
<!-- END GRID -->
</div>
<!-- END GRID -->
</div>
         </div>
 </aside>
    <section>
        <h2>Drinks</h2>
     <div class="drinks">
              <div class="row">
  <div class="column">
    <div class="content">
      <a href="drink_form.php">
      <img src="images/cappuccino.jpg" alt="Cappuccino" style="width:100%">
    </a>
      <h3>Cappuccino</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="drink_form.php">
      <img src="images/iced-latte.jpg" alt="Iced Latte" style="width:100%">
    </a>
      <h3>Iced Latte</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
  <a href="drink_form.php">
      <img src="images/espresso.jpg" alt="Espresso" style="width:100%">
    </a>
      <h3>Espresso</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="drink_form.php">
      <img src="images/caramel_macchiato.jpg" alt="Caramel Macchiato" style="width:100%">
    </a>
      <h3>Caramel Macchiato</h3>
    </div>
  </div>
                    <div class="row">
  <div class="column">
    <div class="content">
      <a href="drink_form.php">
      <img src="images/americano.jpg" alt="Americano" style="width:100%">
    </a>
      <h3>Americano</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="drink_form.php">
      <img src="images/darkchocolatemocha.jpg" alt="Dark Chocolate Mocha" style="width:100%">
    </a>
      <h3>Dark Chocolate Mocha</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
   <a href="drink_form.php">
      <img src="images/caramel_latte.jpg" alt="Caramel Latte" style="width:100%">
    </a>
      <h3>Caramel Latte</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
     <a href="drink_form.php">
      <img src="images/caffe_mocha.jpg" alt="Caffe Mocha" style="width:100%">
    </a>
      <h3>Caffe Mocha</h3>
    </div>
  </div>
<!-- END GRID -->
</div>
<!-- END GRID -->
</div>
         </div>   
    </section>



</div>
<script src="index.js"></script>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target ===modal) {
        modal.style.display = "none";
    }
};

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html>


