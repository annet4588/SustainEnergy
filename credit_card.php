<?php
include_once "header.php";

include_once "classes/dbh.classes.php";
include_once "classes/credit_card.classes.php";
include_once "classes/credit_card-contr.classes.php";
include_once "classes/credit_card-view.classes.php";

// Check if $_SESSION is set and not empty and Initialize variables
$userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
$cardType = $cardholderName = $cardNumber = $expirationDate = $cvv = $billingAddress = $city = $county = $postalCode = '';
$createdAt = date('Y-m-d');
$updatedAt = date('Y-m-d');
$deletedAt = date('Y-m-d');
$errorMessages = []; // Array to store error messages for each field

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Getting data from the POST request from profile page
    $userId = $_SESSION['userid'];

    // Sanitise data from $_POST
    $cardType = isset($_POST["card_type"]) ? $_POST["card_type"] : '';
    $cardholderName = isset($_POST["cardholder_name"]) ? $_POST["cardholder_name"] : '';
    $cardNumber = isset($_POST["card_number"]) ? $_POST["card_number"] : '';
    $expirationDate = isset($_POST["expiration_date"]) ? $_POST["expiration_date"] : '';
    $cvv = isset($_POST["cvv"]) ? $_POST["cvv"] : '';
    $billingAddress = isset($_POST["billing_address"]) ? $_POST["billing_address"] : '';
    $city = isset($_POST["city"]) ? $_POST["city"] : '';
    $county = isset($_POST["county"]) ? $_POST["county"] : '';
    $postalCode = isset($_POST["postal_code"]) ? $_POST["postal_code"] : '';


    // Validate card number (must be 16 digits)
    if (!preg_match('/^\d{16}$/', $cardNumber)&& ! $cardNumber) {
        $errorMessages['card_number'] = 'Card number must be exactly 16 digits.';
    }
     // Check not empty cardholder
     if (!$cardholderName) {
        $errorMessages['cardholder_name'] = 'Please enter cardholder name.';
    }
     // Check not empty expiration date
     if (!$expirationDate) {
        $errorMessages['expiration_date'] = 'Please enter expiration date.';
    }
    // Check notot empty cvv
    if (!$cvv) {
        $errorMessages['cvv'] = 'Please enter 3 last digits of your card.';
    }
    // Check not empty billing address
    if (!$billingAddress) {
        $errorMessages['billing_address'] = 'Please enter your billing address.';
    }
    // Check not empty city
    if (!$city) {
        $errorMessages['city'] = 'Please enter your city.';
    }
    // Check not empty county
    if (!$county) {
        $errorMessages['county'] = 'Please enter your county.';
    }
     // Check not empty postcode
     if (!$postalCode) {
        $errorMessages['postal_code'] = 'Please enter your postal code.';
    }



    // Process the form data
    if (empty($errorMessages)) {
    try {
        // Explode the expiration date to separate month and year
        $expirationDateParts = explode('/', $expirationDate);

        // Check if the expiration date has two parts (month and year)
        if (count($expirationDateParts) == 2) {
            $expirationMonth = $expirationDateParts[0];
            $expirationYear = $expirationDateParts[1];

            // Create a date string in YYYY-MM-DD format using the last day of the expiration month
            $expirationDate = date('Y-m-d', strtotime("last day of $expirationYear-$expirationMonth"));
        } else {
            // Handle invalid expiration date format
            throw new Exception("Invalid expiration date format - e.g 12/2025");
        }
        // Process the credit card data
        $creditCardContr = new CreditCardContr($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt);
        $creditCardContr->processCreditCard();

        // Display success message
        echo '<div class="container p-3">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="alert alert-success" role="alert">';
        echo 'Your card has been successfully added. To view it, simply click on "View my Cards" within your profile.';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Clear the form fields
        $cardType = $cardholderName = $cardNumber = $expirationDate = $cvv = $billingAddress = $city = $county = $postalCode = '';

    } catch (Exception $e) {
        // Handle any exceptions here
        echo '<div class="container p-3">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="alert alert-danger" role="alert">';
        echo 'An error occurred: ' . $e->getMessage();
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
}

// Display the card form
echo '<div class="container p-3">';
echo '<h3 class="text-center mt-4">Add Credit Card</h3>';
echo '<div class="row justify-content-center">';
echo '<div class="col-md-6">';
echo '<div class="card mt-3">';
echo '<div class="card-body">';
echo '<form action="credit_card.php" method="post">'; // Form opening tag

// Include userId as a hidden input
echo '<input type="hidden" id="userid" name="userid" value="' . $userId . '">';

// Card Type
echo '<div class="mb-3">';
echo '<label for="card_type" class="form-label">Card Type</label>';
echo '<select class="form-select" id="card_type" name="card_type" required>';
echo '<option value="visa" ' . ($cardType == 'visa' ? 'selected' : '') . '>Visa</option>';
echo '<option value="mastercard" ' . ($cardType == 'mastercard' ? 'selected' : '') . '>Mastercard</option>';
echo '<option value="amex" ' . ($cardType == 'amex' ? 'selected' : '') . '>American Express</option>';
echo '</select>';
echo '</div>';

// Cardholder Name
echo '<div class="mb-3">';
echo '<label for="cardholder_name" class="form-label">Cardholder Name</label>';
echo '<input type="text" class="form-control" id="cardholder_name" name="cardholder_name" placeholder="Enter Cardholder Name"  value="' . $cardholderName . '">';
if (isset($errorMessages['cardholder_name'])) {
    echo '<div class="text-danger">' . $errorMessages['cardholder_name'] . '</div>';
}
echo '</div>';

// Card Number
echo '<div class="mb-3">';
echo '<label for="card_number" class="form-label">Card Number</label>';
echo '<input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter Card Number"  value="' . $cardNumber . '">';
if (isset($errorMessages['card_number'])) {
    echo '<div class="text-danger">' . $errorMessages['card_number'] . '</div>';
}
echo '</div>';

// Expiration Date
echo '<div class="mb-3">';
echo '<label for="expiration_date" class="form-label">Expiration Date</label>';
echo '<input type="text" class="form-control" id="expiration_date" name="expiration_date" placeholder="MM/YYYY" value="' . $expirationDate . '">';
if (isset($errorMessages['expiration_date'])) {
    echo '<div class="text-danger">' . $errorMessages['expiration_date'] . '</div>';
}
echo '</div>';

// CVV
echo '<div class="mb-3">';
echo '<label for="cvv" class="form-label">CVV</label>';
echo '<input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV"  value="' . $cvv . '">';
if (isset($errorMessages['cvv'])) {
    echo '<div class="text-danger">' . $errorMessages['cvv'] . '</div>';
}
echo '</div>';

// Billing Address
echo '<div class="mb-3">';
echo '<label for="billing_address" class="form-label">Billing Address</label>';
echo '<input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Enter Billing Address" value="' . $billingAddress . '">';
if (isset($errorMessages['billing_address'])) {
    echo '<div class="text-danger">' . $errorMessages['billing_address'] . '</div>';
}
echo '</div>';

// City
echo '<div class="mb-3">';
echo '<label for="city" class="form-label">City</label>';
echo '<input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="' . $city . '">';
if (isset($errorMessages['city'])) {
    echo '<div class="text-danger">' . $errorMessages['city'] . '</div>';
}
echo '</div>';

// County
echo '<div class="mb-3">';
echo '<label for="county" class="form-label">County</label>';
echo '<input type="text" class="form-control" id="county" name="county" placeholder="Enter County" value="' . $county . '">';
if (isset($errorMessages['county'])) {
    echo '<div class="text-danger">' . $errorMessages['county'] . '</div>';
}
echo '</div>';

// Postal Code
echo '<div class="mb-3">';
echo '<label for="postal_code" class="form-label">Postal Code</label>';
echo '<input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Enter Postal Code" value="' . $postalCode . '">';
if (isset($errorMessages['postal_code'])) {
    echo '<div class="text-danger">' . $errorMessages['postal_code'] . '</div>';
}
echo '</div>';

// Submit button
echo '<button type="submit" class="btn btn-outline-success">Submit</button>';

echo '</form>'; // Form closing tag
echo '</div>'; // Card-body closing tag
echo '</div>'; // Card closing tag
echo '</div>'; // Column closing tag
echo '</div>'; // Row closing tag
echo '</div>'; // Container closing tag

include_once "footer.php";

