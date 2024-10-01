<h1>Order Details</h1>
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
      while ($detail = $orderDetails->fetch_assoc()) { 
      ?>
        <tr>
          <td><?php echo $detail['order_id']; ?></td>
          <td><?php echo number_format($detail['total_amount'], 2); ?></td> <!-- Added comma for two decimal points -->
          <td><?php echo $detail['status']; ?></td>
          <td><?php echo $detail['quantity']; ?></td>
          <td><?php echo number_format($detail['price'], 2); ?></td> <!-- Added comma for two decimal points -->
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
