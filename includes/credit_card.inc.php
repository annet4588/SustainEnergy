<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Getting data from the POST request
    // $uid = $_POST['uid'];
    // $pws = $_POST['pwd'];
    // $pwdRepeat = $_POST['pwdrepeat'];
    // $email = $_POST['email'];

    $userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
    $cardType = $cardholderName = $cardNumber = $expirationDate = $cvv = $billingAddress = $city = $county = $postalCode = '';
    $createdAt = date('Y-m-d');
    $updatedAt = date('Y-m-d');
    $deletedAt = date('Y-m-d');


    //Sanitising data
    // $uid = htmlspecialchars($_POST["uid"], ENT_QUOTES, 'UTF-8');
    // $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    // $pwdRepeat = htmlspecialchars($_POST["pwdrepeat"], ENT_QUOTES, 'UTF-8');
    // $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');

    // Sanitize data from $_POST
    $cardType = isset($_POST["card_type"]) ? $_POST["card_type"] : '';
    $cardholderName = isset($_POST["cardholder_name"]) ? $_POST["cardholder_name"] : '';
    $cardNumber = isset($_POST["card_number"]) ? $_POST["card_number"] : '';
    $expirationDate = isset($_POST["expiration_date"]) ? $_POST["expiration_date"] : '';
    $cvv = isset($_POST["cvv"]) ? $_POST["cvv"] : '';
    $billingAddress = isset($_POST["billing_address"]) ? $_POST["billing_address"] : '';
    $city = isset($_POST["city"]) ? $_POST["city"] : '';
    $county = isset($_POST["county"]) ? $_POST["county"] : '';
    $postalCode = isset($_POST["postal_code"]) ? $_POST["postal_code"] : '';

  
    // Validate if all fields are filled
    if (empty($cardType) || empty($cardholderName) || empty($cardNumber) || empty($expirationDate) || empty($cvv) || empty($billingAddress) || empty($city) || empty($county) || empty($postalCode)) {
        echo '<script>alert("Please fill in all fields before submitting.");</script>';
    } else {   
    // Explode the expiration date to separate month and year
    $expirationDateParts = explode('/', $expirationDate);

    // Check if the expiration date has two parts (month and year)
    if (count($expirationDateParts) == 2) {
        $expirationMonth = $expirationDateParts[0];
        $expirationYear = $expirationDateParts[1];

        // Create a date string in YYYY-MM-DD format using the last day of the expiration month
        $expirationDate = date('Y-m-d', strtotime("$expirationYear-$expirationMonth-01"));
    } else {
        // Handle invalid expiration date format
        // You may want to display an error message to the user
        // or take other appropriate action
        echo "Invalid expiration date format";
        exit; // Stop further execution
    }


 // Dump all variables for debugging
//  var_dump($userId, $cardType, $cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt);

 try {

    include_once "classes/dbh.classes.php";
    include_once "classes/credit_card.classes.php";
    include_once "classes/credit_card-contr.classes.php";
    include_once "classes/credit_card-view.classes.php";
    
    // Dump all variables for debugging
    // var_dump($userId, $cardType, $cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt);

    // Instantiate CreditCardContr class to retrieve data
    $creditCardContr = new CreditCardContr($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt);

    // Fetch profile information
    $creditCardContr->processCreditCard();

    // Display success message or redirect to another page
    echo "Credit card information saved successfully!";
} catch (Exception $e) {
    // Handle any exceptions here
    echo "An error occurred: " . $e->getMessage();
    
}
}

}
    // Display the card form
    echo '<div class="container">';
    echo '<h3 class="text-center mt-4">Add Credit Card</h3>';
    echo '<div class="row justify-content-center">';
    echo '<div class="col-md-6">';
    echo '<div class="card mt-3">';
    echo '<div class="card-body">';
    echo '<form action="credit_card.inc.php" method="post">'; // Form opening tag

    // Include userId as a hidden input
    echo '<input type="hidden" id="userid" name="userid" value="' . $userId . '">';
    // Include createdAt as a hidden input
    echo '<input type="hidden" id="created_at" name="created_at" value="' . $createdAt . '">';

    // Include updatedAt as a hidden input
    echo '<input type="hidden" id="updated_at" name="updated_at" value="' . $updatedAt . '">';

    // Include deletedAt as a hidden input
    echo '<input type="hidden" id="deleted_at" name="deleted_at" value="' . $deletedAt . '">';

    // Card Type
    echo '<div class="mb-3">';
    echo '<label for="card_type" class="form-label">Card Type</label>';
    echo '<select class="form-select" id="card_type" name="card_type">';
    echo '<option value="visa" ' . ($cardType == 'visa' ? 'selected' : '') . '>Visa</option>';
    echo '<option value="mastercard" ' . ($cardType == 'mastercard' ? 'selected' : '') . '>Mastercard</option>';
    echo '<option value="amex" ' . ($cardType == 'amex' ? 'selected' : '') . '>American Express</option>';
    echo '</select>';
    echo '</div>';

    // Cardholder Name
    echo '<div class="mb-3">';
    echo '<label for="cardholder_name" class="form-label">Cardholder Name</label>';
    echo '<input type="text" class="form-control" id="cardholder_name" name="cardholder_name" placeholder="Enter Cardholder Name" value="' . $cardholderName . '">';
    echo '</div>';

    // Card Number
    echo '<div class="mb-3">';
    echo '<label for="card_number" class="form-label">Card Number</label>';
    echo '<input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter Card Number" value="' . $cardNumber . '">';
    echo '</div>';

    // Expiration Date
    echo '<div class="mb-3">';
    echo '<label for="expiration_date" class="form-label">Expiration Date</label>';
    echo '<input type="text" class="form-control" id="expiration_date" name="expiration_date" placeholder="MM/YYYY" value="' . $expirationDate . '">';
    echo '</div>';

    // CVV
    echo '<div class="mb-3">';
    echo '<label for="cvv" class="form-label">CVV</label>';
    echo '<input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV" value="' . $cvv . '">';
    echo '</div>';

    // Billing Address
    echo '<div class="mb-3">';
    echo '<label for="billing_address" class="form-label">Billing Address</label>';
    echo '<input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Enter Billing Address" value="' . $billingAddress . '">';
    echo '</div>';

    // City
    echo '<div class="mb-3">';
    echo '<label for="city" class="form-label">City</label>';
    echo '<input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="' . $city . '">';
    echo '</div>';

    // County
    echo '<div class="mb-3">';
    echo '<label for="county" class="form-label">County</label>';
    echo '<input type="text" class="form-control" id="county" name="county" placeholder="Enter County" value="' . $county . '">';
    echo '</div>';

    // Postal Code
    echo '<div class="mb-3">';
    echo '<label for="postal_code" class="form-label">Postal Code</label>';
    echo '<input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Enter Postal Code" value="' . $postalCode . '">';
    echo '</div>';

    // Submit button
    echo '<button type="submit" class="btn btn-outline-success">Submit</button>';

    echo '</form>'; // Form closing tag
    echo '</div>'; // Card-body closing tag
    echo '</div>'; // Card closing tag
    echo '</div>'; // Column closing tag
    echo '</div>'; // Row closing tag
    echo '</div>'; // Container closing tag




 



