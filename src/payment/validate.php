<?php

require_once 'functions.php';

$error = false;
if (
        empty($_GET['Amount'])              || filter_var( $_GET['Amount'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 1000]] ) === false ||
        empty($_GET['TransactionID'])       || checkUUIDv4($_GET['TransactionID']) === false                                                                        ||
        empty($_GET['UserEmail'])           || filter_var( $_GET['UserEmail'], FILTER_VALIDATE_EMAIL ) === false                                                    ||
        empty($_GET['Signature'])           || generateSignature($_GET['TransactionID'], $_GET['Amount'], $_GET['UserEmail']) !== $_GET['Signature']
    )
    $error = true;

if ($error) {
    header('Location: /?' . $_SERVER['QUERY_STRING']);
    die('');
}

if (file_put_contents(apache_getenv('TRANSACTION_DIR') . "/{$_GET['TransactionID']}.ok", $_GET['Signature']) === false)
        die('Error : could not create transaction file, contact administrator.');

$url_redirect = "http://donate.retro.nft:{$_SERVER['SERVER_PORT']}/thankyou?TransactionID={$_GET['TransactionID']}";

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Payment transaction</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">
  <link rel="icon" type="image/png" href="favicon.png" />
  <meta http-equiv="refresh" content="5; URL=<?= $url_redirect ?>">

</head>
<body>

<div class="wrapper" id="app">
    <div class="card-form">
      <div class="card-form__inner" style="padding:35px">
        <div class="div_green"><strong>Payment successful !</strong></div>
        <br>
        <center>
          <p>You'll be shortly redirectly to your merchant's website...</p><br>
          <img src="images/loading.gif" style="width:32px"><br><br>
          <a href="<?= $url_redirect ?>">Click here to return now</a>
        </center>
      </div>
    </div>
</div>

</body>
</html>
