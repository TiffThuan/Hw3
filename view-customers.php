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
      if ($customers->num_rows === 0) {
          echo "<tr><td colspan='4'>No customers found.</td></tr>";
      } else {
          while ($customer = $customers->fetch_assoc()) {
              ?>
              <tr>
                <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
                <td><?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?></td>
                <td><?php echo htmlspecialchars($customer['address']); ?></td>
                <td><a href="orders-by-customer.php?id=<?php echo htmlspecialchars($customer['customer_id']); ?>">View Orders</a></td>
              </tr>
              <?php
          }
      }
      ?>
    </tbody>
  </table>
</div>
