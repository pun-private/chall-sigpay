<?php

require_once 'bootstrap.php';

$errors = Validator::checkParams([
    'Amount'        => 'number',
    'UserEmail'     => 'email'
]);

if (!empty((array)$errors)) {
    http_response_code(401);
    $error_message = '';
    foreach($errors as $name => $detail) {
        $error_message .= "<li>$name : $detail</li>\n";
    }
}
else {
    $amount         = $_REQUEST['Amount'];
    $user_email     = $_REQUEST['UserEmail'];
    $transaction_id = Utils::generateUUIDv4();

    $signature = Donation::generateSignature($transaction_id, $amount, $user_email);

    if (Donation::createTransactionFile($transaction_id, $amount, $user_email) === false)
        die('Error : could not create transaction file, contact administrator.');

    $redirect_url = PAYMENT_GATEWAY . ":{$_SERVER['SERVER_PORT']}/?Amount=$amount&TransactionID=$transaction_id&UserEmail=$user_email&Signature=$signature";
}

?>

<?php include_once('./includes/header.php'); ?>

<?php if (empty($error_message)): ?>

          <!-- Redirect -->
          <section class="nes-container with-title"><h3 class="title">Redirecting...</h3>
          
            <p><progress id="progress_bar" class="nes-progress" value="0" max="100"></progress></p>
          
            <p>You are being redirected to our partner's payment gateway. It might take a few seconds.</p>
            <p>Once your payment is complete, you'll be redirected to the voucher page !</p>
          
            <p><center><a href="<?= $redirect_url ?>"><button type="button" class="nes-btn is-primary">Click here if you want to be redirected now.</button></a></center><p>
          
          </section>

          <script>
                setInterval(update_progress_bar, 200); 
                function update_progress_bar() {
                    var current = document.getElementById('progress_bar').value;
                    if (current == 100) {
                        document.getElementById('progress_bar').className = 'nes-progress is-pattern'
                        return ;
                    }
                    document.getElementById('progress_bar').value = current + 2;
                }
          </script>

<?php else: ?>

          <!-- Errors -->
          <section class="nes-container with-title"><h3 class="title"><span class="nes-text is-error">Error !</span></h3>
          
            <p>The following errors happened during the checkout process :</p>

            <ul class="nes-list is-disc">
                <?= $error_message ?>
            </ul>
          
            <p><center><a href="/"><button type="button" class="nes-btn is-error">Go back</button></a></center><p>
          
          </section>


<?php endif ?>

<?php include_once('./includes/footer.php'); ?>