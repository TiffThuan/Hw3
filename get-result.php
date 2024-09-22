

<?php
$pageTitle = "Order Result";

include "view-header.php";
?>
    <h1>Your Coffee Order</h1>
<?php
if (isset($_GET['coffee-type'])) {
    $coffee_type = htmlspecialchars($_GET['coffee-type']);

    // Directly check and assign price based on the coffee type
    switch ($coffee_type) {
        case "Cafe Sua Da":
            $coffee_price = 4.00;
            break;
        case "Cafe Den Da":
            $coffee_price = 3.50;
            break;
        case "Hot Coffee":
            $coffee_price = 3.00;
            break;
        case "Espresso":
            $coffee_price = 2.50;
            break;
        case "Cappuccino":
            $coffee_price = 4.50;
            break;
        default:
            $coffee_price = null;
    }

    if ($coffee_price !== null) {
        echo "<p>Thank you for ordering: <strong>$coffee_type</strong> - $" . number_format($coffee_price, 2) . "</p>";
    } else {
        echo "<p>Sorry, we don't have that coffee on our menu.</p>";
    }
} else {
    echo "<p>No order was placed.</p>";
}
include "view-footer.php";
?>
