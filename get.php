

<?php
$pageTitle = "Order Coffee";

include "view-header.php";
?>
    <h1>Order Your Coffee</h1>
<form method="get" action="get-result.php">
  <label for="coffee-type">Select your favorite coffee:</label>
  <select name="coffee-type" id="coffee-type">
    <option value="Cafe Sua Da">Cafe Sua Da - $4.00</option>
    <option value="Cafe Den Da">Cafe Den Da - $3.50</option>
    <option value="Hot Coffee">Hot Coffee - $3.00</option>
    <option value="Espresso">Espresso - $2.50</option>
    <option value="Cappuccino">Cappuccino - $4.50</option>
  </select>
  <br><br>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary" value="Order">
  </div>
  
</form> 
<?php
include "view-footer.php";
?>
