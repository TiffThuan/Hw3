
<?php
$pageTitle= "Contact Result";

include "view-header.php";
?>
    <h1>Thank You for Reaching Out!</h1>
<?php
echo getDisplay();
include "view-footer.php";

function getDisplay() {
    if (isset($_POST['customer-name']) && isset($_POST['message'])) {
        return "<p>Thank you, " . htmlspecialchars($_POST['customer-name']) . ", for your message:</p><p><em>" . htmlspecialchars($_POST['message']) . "</em></p>";
    } else {
        return "<p>Message not sent. Please try again.</p>";
    }
}
?>
