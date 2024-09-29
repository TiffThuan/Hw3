<h1>Customers with Orders</h1>
<div class="card-group">
  <?php

  // Loop through the list of customers
  while ($customer = $customers -> fetch_assoc()) {
  ?>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $customer['firstname'] . " " . $customer['lastname']; ?></h5>
        <p class="card-text">
          <ul class="list-group">
            <?php
            // Fetch orders for the current customer
            $orders = selectOrdersByCustomer($customer['customer_id']);
            while($order = $orders -> fetch_assoc()) {
              ?>
              <li class="list-group-item">
                Order ID: <?php echo $order['order_id']; ?> 
                - Status: <?php echo $order['status']; ?> 
                - Total: $<?php echo number_format($order['total_amount'], 2); ?>
              </li>
              <?php
            }
            ?>
          </ul>
        </p>
        <p class="card-text">
          <small class="text-body-secondary">Address: <?php echo $customer['address']; ?></small>
        </p>
      </div>
    </div>

  <?php
  }
  ?>
</div>
