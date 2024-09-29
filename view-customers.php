<h1>Customers</h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Orders</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($customer = $customers->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $customer['customer_id']; ?></td>
            <td><?php echo $customer['firstname'] . ' ' . $customer['lastname']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td><a href="orders-by-customer.php?id=<?php echo $customer['customer_id']; ?>">View Orders</a></td>
          </tr>
          <?php
      }
      ?>
    </tbody>
  </table>
</div>
