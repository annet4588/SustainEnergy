<?php
include_once "header.php";

//Access to the classes in order to grab info
include_once "classes/dbh.classes.php";
include_once "classes/credit_card.classes.php";
include_once "classes/credit_card-contr.classes.php";
include_once "classes/credit_card-view.classes.php";

// Check if $_SESSION is set and not empty
if (!isset($_SESSION['userid']) || !isset($_SESSION['useruid'])) {
    // Handle the case where $_SESSION is not set or empty
    header("location: ../login.php?error=session");
    exit();
}

//Instantiate CreditCardView class to retrieve data to display the card
$creditCardView = new CreditCardView();
$userId = $_SESSION['userid'] ?? null;


//Check if the form is submitted for deleting a card
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_card_details'])) {
    // Check if confirmation checkbox is checked
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        // Get the card ID from the form
        $cardId = $_POST['card_id'];
        // Define the necessary variables for deleting the card
        $userId = $_SESSION['userid']; // Assuming you have already defined this elsewhere
        $cardType = '';
        $cardholderName = '';
        $cardNumber = '';
        $expirationDate = '';
        $cvv = '';
        $billingAddress = '';
        $city = '';
        $county = '';
        $postalCode = '';
        $createdAt = '';
        $updatedAt = '';
        $deletedAt = date('Y-m-d'); // Define 


        try {
            // Create an instance of CreditCardContr to delete the card
            $creditCardContr = new CreditCardContr($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt);
            $creditCardContr->deleteCreditCard($cardId, $userId);

            // Display success message or redirect to another page
            echo '<div class="alert alert-success" role="alert">';
            echo 'Card details deleted successfully!';
            echo '</div>';
        } catch (Exception $e) {
            // Handle any exceptions here
            echo '<div class="alert alert-danger" role="alert">';
            echo 'An error occurred: ' . $e->getMessage();
            echo '</div>';
        }
    } else {
        // Display a message if confirmation checkbox is not checked
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Please confirm deletion by checking the checkbox.';
        echo '</div>';
    }
}
// Fetch credit card details after processing the delete action
$creditCardDetails = $creditCardView->fetchCreditCardInfo($userId);
// Display added credit cards
echo '<div class="container mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center mt-4  p-3">Added Credit Cards</h3>';
echo '<div class="row justify-content-center">';
if (!empty($creditCardDetails)) {
    foreach ($creditCardDetails as $card) {
        echo '<div class="col-md-6 p-3">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Card Details</h5>';
        echo '<div class="alert alert-success" role="alert">';
        echo '<p>Card type: <span>' . (isset($card['card_type']) ? $card['card_type'] : '') . '</span></p>';
        echo '<p>Cardholder name: <span>' . (isset($card['cardholder_name']) ? $card['cardholder_name'] : '') . '</span></p>';
        echo '<p>Card number: <span>**** **** **** ' . (isset($card['card_number']) ? substr($card['card_number'], -4) : '') . '</span></p>';
        echo '<p>Expiration date: <span>' . (isset($card['expiration_date']) ? date("m/Y", strtotime($card['expiration_date'])) : '') . '</span></p>';
        echo '<form method="POST" action="credit_card_added.php">';
        echo '<div class="alert alert-warning">';
        echo '<strong>Warning:</strong> Deleting your card is irreversible. Please confirm below.';
        echo '</div>';
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="checkbox" id="confirm_delete" name="confirm_delete" value="yes">';
        echo '<label class="form-check-label" for="confirm_delete">I confirm that I want to delete my card details.</label>';
        echo '</div>';
        echo '<input type="hidden" name="card_id" value="' . (isset($card['card_id']) ? $card['card_id'] : '') . '">';
        echo '<button type="submit" class="btn btn-danger btn-sm" name="delete_card_details">Delete Card</button>';
        echo '<input type="text" name="delete_confirmation" readonly style="border: none; background-color: transparent;">';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Store card details in creditCards array
        $creditCards[] = $card;
    }

    // Storing credit cards array in the session
    $_SESSION['credit_cards'] = $creditCards;

    // Debugging: Dump the credit cards array
    // var_dump($_SESSION['credit_cards']);

} else {
    echo '<div class="col-md-6">';
    echo '<div class="card mt-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title text-center">Your Cards</h5>';
    echo '<div class="text-center">';
    echo '<div class="alert alert-success" role="alert">';
    echo '<p>No added cards.</p>'; 
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';

include_once "footer.php";
