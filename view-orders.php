<h1>Orders</h1>
<div class="table-responsive">
  <table class="table">
   <thead>
     <tr>
       <th>Order ID</th>
       <th>Total Amount</th>
       <th>Status</th>
       <th></th>
     </tr>
   </thead> 
    <tbody>
      <?php
      while ($order = $orders->fetch_assoc()) {
      ?>
       <tr>
         <td><?php echo $order['order_id']; ?></td>
         <td><?php echo $order['total_amount']; ?></td>
         <td><?php echo $order['status']; ?></td>
         <td>
           <form method="post" action="sections-by-order.php">
            <input type="hidden" name="oid" value="<?php echo $order['order_id']; ?>">
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">View Details</button>
            </div>
          </form>
         </td>
       </tr>
       <?php
      }
      ?>  
    </tbody>
  </table>
</div>
