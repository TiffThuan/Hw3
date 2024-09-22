<?php
$pageTitle = "Welcome to Our King Coffee Shop";

include "view-header.php";
?>

<h1>Welcome to Our King Coffee Shop!</h1>
<p><em>One of the best Vietnamese coffee in Oklahoma</em></p>
<p><em>Experience our signature coffee - Cafe Sua Da, coffee gourmet for everyone</em></p>

<!-- Coffee Menu Table -->
<h2>Our Coffee Menu</h2>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Coffee Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <tr style="background-color: #cce5ff;"> <!-- Light blue -->
            <td>Cafe Sua Da (Iced Coffee)</td>
            <td>$4.50</td>
        </tr>
        <tr style="background-color: #99ccff;"> <!-- Darker blue -->
            <td>Espresso</td>
            <td>$3.00</td>
        </tr>
        <tr style="background-color: #cce5ff;"> <!-- Light blue -->
            <td>Americano</td>
            <td>$3.50</td>
        </tr>
        <tr style="background-color: #99ccff;"> <!-- Darker blue -->
            <td>Latte</td>
            <td>$4.00</td>
        </tr>
        <tr style="background-color: #cce5ff;"> <!-- Light blue -->
            <td>Mocha</td>
            <td>$4.25</td>
        </tr>
    </tbody>
</table>

<?php
include "view-footer.php";
?>
