

<h1>Courses-by-Instructor</h1>
<div class="table-responsive">
  <table class="table">
   <thead>
     <tr>
       <th>ID</th>
       <th>Total Amount</th>
       <th>Status</th>
       <th>Quantity</th>
       <th>Price</th>
     </tr>
   </thead> 
   <tbody>
     <?php
while ($instructor = $instructors->fetch_assoc()) { // Fixed parentheses
    ?>
       <tr>
         <td><?php echo $instructor['order_id']; ?></td>
         <td><?php echo $instructor['total_amount']; ?></td>
         <td><?php echo $instructor['status']; ?></td>
         <td><?php echo $instructor['quantity']; ?></td>
         <td><?php echo $instructor['price']; ?></td>
       </tr>
     <?php
}
     ?>  
   </tbody>
  </table>
</div>

