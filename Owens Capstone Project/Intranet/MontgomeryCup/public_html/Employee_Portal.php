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
   <a href="index.php">Home</a>
   <a href="order.php">New order</a>
   <a href="#">Employee Portal</a>
</div>
 <article>
    <div class="portal">
       <div class="row">
       <?php
 if($employeeTitle=="Manager" || $employeeTitle=="Owner"){
  echo '<div class="column">
  <div class="content">
<a href="manage.php">
    <img src="images/adp.png" alt="Manager" style="width:100%">
  </a>
    <h3>Manager Functions</h3>
  </div>
</div>';
 }
 
 ?>
  
  <div class="column">
    <div class="content">
    <a href="files/">
      <img src="images/trainning.png" alt="trainning" style="width:100%">
    </a>
      <h3>Trainings</h3>
    </div>
  </div>
  
</div> 
    </div>
</article>
</div>
<script>


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


