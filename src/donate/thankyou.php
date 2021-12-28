<?php

require_once 'bootstrap.php';

$errors = Validator::checkParams([
    'TransactionID' => 'uuid'
]);

if (!empty((array)$errors)) {
    http_response_code(401);
    $error_message = '';
    foreach($errors as $name => $detail) {
        $error_message .= "<li>$name : $detail</li>\n";
    }
}
else {
    $transaction_obj = Donation::getTransactionFile($_REQUEST['TransactionID']);

    if ($transaction_obj === false) {
        http_response_code(404);
        $error_message = "<li>Unknown TransactionID.</li>";
    }
    else if (Donation::isTransactionPaid($_REQUEST['TransactionID']) === false) {
        http_response_code(402);
        $error_message = "<li>Transaction has not been paid yet.</li>";
    }
    else {
        $voucher_suffix = strtoupper(substr(md5($transaction_obj->Signature), 0, 8));
    }
}

?>

<?php include_once('./includes/header.php'); ?>

<?php if (empty($error_message)): ?>

          <!-- Thank you -->
          <section>
            <h2 id="thankyou"><a href="#thankyou">#</a>Thank you !</h2>
            <p>The Retro community is thankful for <strong><span class="nes-text is-primary">your donation of <?= $transaction_obj->Amount ?></span><i class="nes-icon coin is-small"></i> !<strong></p>

            <?php if (isset(NFT_VOUCHER_MAP[$transaction_obj->Amount])): ?>

            
            <section class="message-list">
                <section class="message -left">
                    <i class="nes-bcrikko" style="color:#fbc69c"></i>
                    <div class="nes-balloon from-left">
                        <p>Please accept this exclusive NFT voucher :</p>
                        <center><pre><code><?= NFT_VOUCHER_MAP[$transaction_obj->Amount] ?><?= $transaction_obj->Amount == 42000 ? '' : "_$voucher_suffix" ?></code></pre></center>
                        <p style="text-align: end;">PuN <i class="nes-icon heart is-small"></i></p>
                    </div>
                </section>

            </section>

            <?php else: ?>
            
            <section class="message-list">
                <section class="message -left">
                    <i class="nes-bcrikko" style="color:#fbc69c"></i>
                    <div class="nes-balloon from-left">
                        <p>
                            We appreciate your donation !
                            In order <span class="nes-text is-primary">to get a NFT voucher</span>, please donate exactly one of the following amounts :
                        </p>
                        <p>
                            &nbsp; &nbsp; <i class="nes-charmander"></i><i class="nes-kirby"></i><i class="nes-icon star is-huge"></i><br><br>

                            - 20&euro; &nbsp; &nbsp;: Charmander</i><br>
                            - 50&euro; &nbsp; &nbsp;: Kirby</i><br>
                            - 42000&euro; : Secret NFT<br>
                        </p>
                        <p style="text-align: end;">PuN <i class="nes-icon heart is-small"></i></p>
                    </div>
                </section>

            </section>

            <?php endif ?>

            <br>
            <br>
            <h2 id="NoEmails"><a href="#noemails">#</a>Maintenance</h2>
            <p><span class="nes-text is-error">Our mail servers are down</span> at the moment and you will not get a receipt by email...</p>
            <p>Make sure to bookmark this page or you will have to donate again for a new voucher !<strong></p>


          </section>

<?php else: ?>

          <!-- Errors -->
          <section class="nes-container with-title"><h3 class="title"><span class="nes-text is-error">Error !</span></h3>
          
            <p>An error occured :</p>

            <ul class="nes-list is-disc">
                <?= $error_message ?>
            </ul>
                    
          </section>

            
<?php endif ?>
        <script>
            const h = document.querySelector('head');
            ['./lib/dialog-polyfill.css', './lib/highlight-theme.css'].forEach(a => {
            const l = document.createElement('link');
            l.href = a;
            l.rel = 'stylesheet';
            h.appendChild(l);
            })
        </script>
<?php include_once('./includes/footer.php'); ?>