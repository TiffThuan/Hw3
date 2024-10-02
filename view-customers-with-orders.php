<h1>Customers with Orders</h1>

<div class="row">
    <?php
    if ($customers->num_rows == 0) {
        echo "<div class='col-12'><p>No customers found.</p></div>";
    } else {
        while ($customer = $customers->fetch_assoc()) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Customer Name -->
                        <h5 class="card-title"><?php echo $customer['firstname'] . ' ' . $customer['lastname']; ?></h5>

                        <!-- Customer Address -->
                        <p class="card-text">
                            <small class="text-muted">Address: <?php echo $customer['address']; ?></small>
                        </p>

                        <!-- Order List -->
                        <div class="order-list">
                            <?php
                            // Fetch the orders for each customer using selectCustomersWithOrders()
                            $orders = selectCustomersWithOrders($customer['customer_id']);
                            if ($orders->num_rows == 0) {
                                echo "<p>No orders found for this customer.</p>";
                            } else {
                                ?>
                                <table class="table table-sm table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Status</th>
                                            <th>Total Amount</th>
                                            <th>Order Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($order = $orders->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $order['order_id']; ?></td>
                                                <td><?php echo $order['status']; ?></td>
                                                <td><?php echo $order['total_amount']; ?></td>
                                                <td><?php echo $order['order_date']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
