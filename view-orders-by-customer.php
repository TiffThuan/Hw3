<h1>Orders by Customer</h1>
<div class="table-responsive">
  <table class="table">
   <thead>
     <tr>
       <th>Order ID</th>
       <th>Total Amount</th>
       <th>Status</th>
       <th>Quantity</th>
       <th>Price</th>
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
         <td><?php echo $order['quantity']; ?></td>
         <td><?php echo $order['price']; ?></td>
       </tr>
     <?php
     }
     ?>  
   </tbody>
  </table>
</div>
