<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
<title>JavaJam Coffee House</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="index.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Javajam is a coffee shop that serves a locally roasted free-trade coffee and Tea
with a smooth aroma, Bagels, Muffins and Organic Snacks.">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
</head>
<body>
<div id="wrapper">
<div class="toplink">
   <a href="index.html">Home</a>
   <a href="order.html">New order</a>
   <a href="#Employee Portal">Employee Portal</a>
</div>
 <article>
    <div class="portal">
       <div class="row">
  <div class="column">
    <div class="content">
      <a href="drink_form.html">
      <img src="images/Profile.png" alt="Profile" style="width:100%">
    </a>
      <h3>Profile</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="drink_form.html">
      <img src="images/time_sheet.png" alt="time_sheet" style="width:100%">
    </a>
      <h3>Employee Time Sheet</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
  <a href="drink_form.html">
      <img src="images/adp.png" alt="adp" style="width:100%">
    </a>
      <h3>ADP Portal</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="drink_form.html">
      <img src="images/trainning.png" alt="trainning" style="width:100%">
    </a>
      <h3>Trainings</h3>
    </div>
  </div>
  
<!-- END GRID -->
</div> 
    </div>
</article>
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


