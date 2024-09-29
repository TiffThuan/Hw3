<h1>Sections By Course</h1>
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
      while ($section = $sections->fetch_assoc()) { 
      ?>
        <tr>
          <td><?php echo $section['order_id']; ?></td>
          <td><?php echo $section['total_amount']; ?></td>
          <td><?php echo $section['status']; ?></td>
          <td><?php echo $section['quantity']; ?></td>
          <td><?php echo $section['price']; ?></td>
        </tr>
      <?php
      } // Close while loop
      ?>
    </tbody>
  </table>
</div>
